<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use DateTime;
use App\Product;
use App\Category;
use App\Value;
use App\Category_characteristic;
use App\Usersproductsfavorit;
use Illuminate\Http\Request;
use PhpParser\NodeVisitor\FirstFindingVisitor;

class OurproductController extends Controller
{
    private $redirectBuy = "buyform";
    public function __construct()
    {
        parent::init("description","keywords","title","products");
    }
    public function ourproduct(Request $request)
    {
        $category = $request->category;
        $api_token = auth()->user()->api_token;

        $characteristic =  Category::with(["get_characteristics"])->
        where("id",$request->category)->first();
        return view("ourproduct",(parent::data_site()
               +compact('category','characteristic','api_token')));
    }
    public function oneproduct($id)
    {
        $product = \App\Product::where('id',$id)->first();
        $images = $product->images;
        if(auth()->user() == null)return view("auth.login");
        else return view("oneproduct",(parent::data_site()+compact('product','images')));
    }
    public function addfavorite(Request $request)
    {
        $ver = parent::notverified();
        if($ver!=null)return $ver;

        if(null === Usersproductsfavorit::where('idProduct',$request->product)
        ->where('idUser',$request->user)->first()){
            $favorite = new Usersproductsfavorit;

            $favorite->idProduct = $request->product;
            $favorite->idUser = $request->user;

            $favorite->save();
        }
        $product = \App\Product::where('id',$request->product)->first();
        $images = $product->images;
        return view("oneproduct",(parent::data_site()+compact('product','images')));
        
    }
    public function show()
    {
        return Product::all();
    }
    public function find($id)
    {
        return Product::findOrFail($id);
    }

    public function store(ProductRequest $request)
    {
        return Product::create($request->all());
    }

    public function update(ProductRequest $request, $id)
    {
        $article = Product::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    public function delete($id)
    {
        $article = Product::findOrFail($id);
        $article->delete();

        return 204;
    }
    public function paging()
    {
        $article = Product::paginate(12);
        
        return $article;
    }
}
