<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clases\LiqPay;
use App\Product;
use App\Bought;
use App\Settlement;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Redirect;
use SebastianBergmann\Environment\Console;

use function GuzzleHttp\json_decode;

class BuyController extends Controller
{
    private $api = "2d4c2f87c031d0656ba514730e4bec53";
    private $server = "https://api.novaposhta.ua/v2.0/json/";
    public function __construct()
    {
        parent::init("description","keywords","title","products");
    }

    private function checkcitie($ref)
    {
        return $this->apinp(
            new Request([
            "modelName"=> "Address",
            "calledMethod"=> "getStreet",
               "methodProperties"=> [
                   "Limit"=> 1,
                   "CityRef"=>$ref
               ]
           ])
        )->original->success==1?true:false;
    }
    private function checkdepart($ref,$dep)
    {
        if($dep == "")return false;
        return $this->apinp(
            new Request([
            "modelName"=> "Address",
            "calledMethod"=> "getWarehouses",
               "methodProperties"=> [
                   "Limit"=> 1,
                   "CityRef"=> $ref,
                   "Ref"=>$dep
               ]
           ])
        )->original->success==1?true:false;
    }
    private function checkstreet($ref,$str)
    {
        if($str == "")return false;
        return $this->apinp(
            new Request([
            "modelName"=> "Address",
            "calledMethod"=> "getStreet",
               "methodProperties"=> [
                   "Limit"=> 1,
                   "CityRef"=> $ref,
                   "Ref"=>$str
               ]
           ])
           )->original->success==1?true:false;
    }
    private function checkPostData(Request $request,&$data,&$error)
    {
        if($request->post == "new")
        {
            if($this->checkcitie($request->citie)){
                $data["citie"] = $request->citie;
                $data["citieName"] = $request->citieName;
                if($request->where_in_post == "department")
                {
                    if($this->checkdepart($request->citie,$request->where))
                    {
                        $data["where"] = $request->where;
                        $data["depart"] = $request->depart;
                    }
                    else
                    {
                        $error["depart"] = "incorrect depart";
                        
                    }
                }
                else if($request->where_in_post == "courier")
                {
                    if($this->checkstreet($request->citie,$request->where)
                        && $request->flat > 0 )
                    {
                        $data["where"] = $request->where;
                        $data["street"] = $request->street;
                        $data["house"] = $request->house;
                        $data["flat"] = $request->flat;
                    }
                    else
                    {
                        $error["street"] = "incorrect street, house or flat data";
                    }
                }
                else if($request->where_in_post == "parcel_machine")
                {
                    if($this->checkdepart($request->citie,$request->where))
                    {
                        $data["where"] = $request->where;
                        $data["parcel_machine"] = $request->parcel_machine;
                    }
                    else
                    {
                        $error["parcel_machine"] = "incorrect parcel machine";
                    }
                }
                else $error["critical"] = "1";
            }
            else $error["citie"] = "inccorect citie data";
        }
        else $error["critical"] = "1";
        $data["post"] = $request->post;
        $data["where_in_post"] = $request->where_in_post;
    }
    private function checkUserData(Request $request,&$data,&$error)
    {
        if(strlen($request->name)>0&&!preg_match("/[\d]+/", $request->name))
             $data["name"] = $request->name;
        else $error["name"] = "incorrect name";

        if(strlen($request->surname)>0&&!preg_match("/[\d]+/", $request->surname))
             $data["surname"] = $request->surname;
        else $error["surname"] = "incorrect surname";

        if (preg_match('/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $request->phone))
             $data["phone"] = $request->phone;
        else $error["phone"] = "incorrect phone";

        $data["coment"] = $request->coment;
    }
    public function buypay(Request $request)
    {       
        if(isset($request->product))
            $request->session()->put('productId',$request->product);

        $product = Product::where("id",$request->session()->get('productId',0))->first();
        $title_p = $product->title;
        $description_p = $product->description;
        $price = $product->price;
        $whole_price = $product->whole_price;
        $whole_num = $product->whole_num;
        $mainimg = $product->mainimg;

        if(isset($request->product))
            return view("buy.buyform",parent::data_site()+compact(
                'title_p','description_p','mainimg','price','whole_price','whole_num'));

        $data = array();
        $error = array();
        if($request->count_return > 0)
        {
            $this->checkPostData($request,$data,$error);
        }
        else $error["critical"] = "1";

        $data["btntext"] = $request->btntext;
        $data["btnimg"] = $request->btnimg;

        $data["count"] = $request->count_return;
        $this->checkUserData($request,$data,$error);

        if(!empty($error))
        {
            return view("buy.buyform",parent::data_site()+compact(
                'error','data','title_p','description_p','mainimg','price','whole_price','whole_num'));
        }

        $price = Product::where("id",$request->session()->get('productId',0))->first()->price;
        if($whole_num != null){
            $price = ($request->count_return < $whole_num)?
                      $request->count_return*$price:
                      $request->count_return*$whole_price;
        }
        else
        {
            $price = $request->count_return*$price;
        }

        $id = Product::where("id",$request->session()->get('productId',0))->first()->id;
        
        $order_id = (rand(0,10000)*$id);
        $request->session()->put("order_id",$order_id);

        $liqpay = new LiqPay("sandbox_i87312214202", "sandbox_IWfW1Z6UYNb3wLr0ffAcdo9ZaprTg7dl0jRWMPGd");
        $html = $liqpay->cnb_form(array(
            'action'         => 'pay',
            'amount'         => $price,
            'currency'       => 'UAH',
            'description'    => 'pay for '.$title_p,
            'order_id'       => $order_id,
            'server_url'     => 'http://te905shop.pp.ua/confirm/',
            'redirect_to'    => 'http://te905shop.pp.ua/confirm/',
            'result_url'     => 'http://te905shop.pp.ua/confirm/',
            'version'        => '3'
        ));
        
        $data["idProduct"] =  $id;
        $data["Price"]     =  $price;
        $data["user"]     =  auth()->user()->id;

        $request->session()->put("data",$data);

        $this->setBought($request->session()->get("data"));
        
        return view("buy.priceform",parent::data_site()+compact('html'));
    }
    public function apinp(Request $request)
    {
        $data = $request->all();
        $data["apiKey"] = $this->api;
        $curl = curl_init();
        curl_setopt_array($curl, array(
           CURLOPT_URL => $this->server,
           CURLOPT_RETURNTRANSFER => True,
           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           CURLOPT_CUSTOMREQUEST => "POST",
           CURLOPT_POSTFIELDS => json_encode($data),
           CURLOPT_HTTPHEADER => array("content-type: application/json",),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
        return response()->json(json_decode($response));
        }
    }
    public function confirmpay(Request $request)
    {
        /*$sign = base64_encode( sha1( 
            "sandbox_IWfW1Z6UYNb3wLr0ffAcdo9ZaprTg7dl0jRWMPGd" .  
            $request->data. 
            "sandbox_IWfW1Z6UYNb3wLr0ffAcdo9ZaprTg7dl0jRWMPGd"
            , 1 ));*/
        //$signserver = $request->session()->get('signature',0);
        //if($sign == $signserver)return "success";
        //else return "not success";

        /*
        $liqpay = new LiqPay($public_key, $private_key);
$res = $liqpay->api("request", array(
'action'        => 'status',
'version'       => '3',
'order_id'      => 'order_id_1'
));
         */
        //return "success";
        return view('buy.congratulations',parent::data_site());        
    }
    public function enterpay(Request $request)
    {
    }
    private function setBought($data)
    {
        $idSettl = 0;
        if($data["where_in_post"] == "department"){
            $idSettl = Settlement::create([
                'where_in_post' => $data["where_in_post"],
                'post'          => $data["post"],
                'citie'         => $data["citieName"],
                'citie_ref'     => $data["citie"],
                'where'         => $data['where'],
                'branch'        => $data["depart"]
            ])->id;
        }
        else if($data["where_in_post"] == "courier"){
            $idSettl=Settlement::create([
                'where_in_post' => $data["where_in_post"],
                'post'          => $data["post"],
                'citie'         => $data["citieName"],
                'citie_ref'     => $data["citie"],
                'where'         => $data['where'],
                'street'        => $data["street"],
                'house_number'  => $data["house"],
                'flat'          => $data["flat"]

            ])->id;
        }
        else if($data["where_in_post"] == "parcel_machine"){
            $idSettl = Settlement::create([
                'where_in_post' => $data["where_in_post"],
                'post'          => $data["post"],
                'citie'         => $data["citieName"],
                'citie_ref'     => $data["citie"],
                'where'         => $data['where'],
                'postomat'      => $data["parcel_machine"],
            ])->id;
        }
        Bought::create([
                        'idProduct'  =>  $data["idProduct"],
                        'idSettl'    =>  $idSettl,
                        'idUser'     =>  $data["user"],
                        'Count'      =>  $data["count"],
                        'Price'      =>  $data["Price"],
                        'name'       =>  $data["name"],
                        'surname'    =>  $data["surname"],
                        'phone'      =>  $data["phone"],
                        'coments'    =>  $data["coment"]
                       ]);
        
    }
    public function showboughts(Request $request)
    {
        $ver = parent::notverified();
        if($ver!=null)return $ver;
        $token = auth()->user()->api_token;
        return view('buy.congratulation',parent::data_site()); 
        return view('buy.boughts',parent::data_site()+compact('token'));
    }

    public function apiboughts(Request $request)
    {
        $user =  \App\User::where("id",auth()->user()->id)->first();
        
        $userboughts = $user->userboughts()->paginate(2);

        $tmp = json_decode(json_encode($userboughts));
        
        $next_page_url = $tmp->next_page_url;
        $last_page_url = $tmp->last_page_url;
        $last_page = $tmp->last_page;
        $current_page = $tmp->current_page;
        $prev_page_url =$tmp->prev_page_url;
        
        $products = array();
        foreach($userboughts as $bought){
            array_push($products,$bought->with("boughtsettlement","boughtproduct")->get() );
        }
        $tmp_array = array
        (
            "current_page"=>$current_page,
            "data"=>$products,
            "last_page"=>$last_page,
            "last_page_url"=>$last_page_url,
            "next_page_url"=>$next_page_url,
            "prev_page_url"=>$prev_page_url,
        );
        return response()->json($tmp_array);
    }
    public function singleBuy(Request $request)
    {
        $ver = parent::notverified();
        if($ver!=null)return $ver;

        $info = Bought::where("id",$request->id)->with("boughtsettlement","boughtproduct")->first();

        $data = [];
        $data["id_bought"] = $info->id;
        $data["title_product"] = $info->boughtproduct->title;
        $data["count"] = $info->Count;
        $data["price"] = $info->Price;
        $data["img"] = $info->boughtproduct->mainimg;

        if($info->boughtsettlement->post == "new")$data["post"] = "Нова пошта";
        $data["citie"] = $info->boughtsettlement->citie;
        $data["branch"] = $info->boughtsettlement->branch;
        $data["where_in_post"] = $info->boughtsettlement->where_in_post;
        $data["parcel_machine"] = $info->boughtsettlement->postomat;
        $data["street"] = $info->boughtsettlement->street;
        $data["house_number"] = $info->boughtsettlement->house_number;
        $data["flat"] = $info->boughtsettlement->flat;

        $data["name"] = $info->name;
        $data["surname"] = $info->surname;
        $data["phone"] = $info->phone;
        $data["coment"] = $info->coments;

        $data["status"] = $info->status;

        return view('buy.singlebought',parent::data_site()+$data);
    }
    public function boughtanswer(Request $request)
    {
        if(isset($request->back))
        {
            return redirect("boughts");
        }
    } 
    public function cancelbought(Request $request)
    {
        $liqpay = new LiqPay("sandbox_i87312214202", "sandbox_IWfW1Z6UYNb3wLr0ffAcdo9ZaprTg7dl0jRWMPGd");
        $res = $liqpay->api("request", array(
           'action'        => 'refund',
           'version'       => '3',
           'order_id'      => 'order_id_1',
           'server_url'     => 'http://te905shop.pp.ua/confirm/',
           'redirect_to'    => 'http://te905shop.pp.ua/confirm/',
           'result_url'     => 'http://te905shop.pp.ua/confirm/'
        ));
        echo "<pre>";
        print_r($res);
        echo "</pre>";
    }
    public function changedata(Request $request)
    {
        if(isset($request->id))
           $request->session()->put("boughtId",$request->id);
        $info = Bought::where("id",$request->session()->get("boughtId"))->first();
        $data["citie"] = $info->boughtsettlement->citie_ref;
        $data["citieName"] = $info->boughtsettlement->citie;
        $data["post"] = $info->boughtsettlement->post;
        $data["depart"] = $info->boughtsettlement->branch;
        $data["where_in_post"] = $info->boughtsettlement->where_in_post;
        $data["parcel_machine"] = $info->boughtsettlement->postomat;
        $data["street"] = $info->boughtsettlement->street;
        $data["house"] = $info->boughtsettlement->house_number;
        $data["flat"] = $info->boughtsettlement->flat;
        $data["where"] = $info->boughtsettlement->where;

        $data["name"] = $info->name;
        $data["surname"] = $info->surname;
        $data["phone"] = $info->phone;
        $data["coment"] = $info->coments;

        if(isset($request->id))
            return view("buy.changedata",parent::data_site()+["data"=>$data]);
        else
        {
            $data = array();
            $error = array();

            $this->checkPostData($request,$data,$error);
            $this->checkUserData($request,$data,$error);


            if(!empty($error))
            {
                return view("buy.changedata",parent::data_site()+["data"=>$data]);
            }
            else
            {

                $postData = Settlement::where("id",$info->boughtsettlement->id)->first();

                $postData->citie_ref = $request->citie;
                $postData->citie = $request->citieName;
                $postData->post = $request->post;
                $postData->branch = $request->depart;
                $postData->where_in_post = $request->where_in_post;
                $postData->postomat = $request->parcel_machine;
                $postData->street = $request->street;
                $postData->house_number = $request->house;
                $postData->flat = $request->flat;

                $postData->save();
     
                $info->name = $request->name;
                $info->surname = $request->surname;
                $info->phone = $request->phone;
                $info->coments = $request->coment;

                $info->save();

                return redirect( ("bought/".$request->session()->get("boughtId")) );

            }
        }
    }

}
