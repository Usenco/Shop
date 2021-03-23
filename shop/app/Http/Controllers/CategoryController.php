<?php

namespace App\Http\Controllers;

use App\Category;
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
            if(isset($request->price_start) && isset($request->price_end))
            {
                return Product::where("idCategory",$request->category)
                       ->where("price",">",$request->price_start)
                       ->where("price","<",$request->price_end)->paginate(12);
            }
            return Product::where("idCategory",$request->category)->paginate(12);
        }
        return "Hello";
    }
}
