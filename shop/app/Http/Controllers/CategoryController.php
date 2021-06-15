<?php

namespace App\Http\Controllers;

use App\Category;
use App\Characteristic;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        parent::init("description","keywords","title","home");
    }

    public function categories(Request $request)
    {


        $categories = Category::all();
        $banners = \App\Banner::all();
        
        return view("category",(parent::data_site()+compact('categories','banners')));
    }
    public function get_product_with_characteristic(Request $request)
    {
        if(isset($request->category))
        {
            $products = Product::where("idCategory",$request->category);
            if(isset($request->price_start) && isset($request->price_end))
            {
                $products= $products
                           ->where("price",">",$request->price_start)
                           ->where("price","<",$request->price_end);
            }
            if(isset($request->settings))
            {
                $have_set = false;
                foreach($products->with("get_value")->get() as $tmp){
                    
                    if($tmp->get_value === null)continue;
                    $have_set = false;
                    foreach($request->settings as $id => $setting)
                    {
                       if(empty($setting))continue;
                       foreach($tmp->get_value as $value){
                          if($id == $value->id_characteristics)
                          {
                                foreach($setting as $one_set)
                                {
                                   if($one_set == $value->value){
                                       $have_set = true;
                                   }
                                }
                           }
                        }
                    }
                    if($have_set == false){
                        $products = $products->where("id","!=",$tmp->id );
                    }
                    
                }
            }
            return $products->paginate(12);
        }
        return null;
    }
}
