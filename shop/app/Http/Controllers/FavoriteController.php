<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use UsersProductsFavorit;


class FavoriteController extends Controller
{
    public function __construct()
    {
        parent::init("description","keywords","title","products");
    }
    
    public function apifavorites(Request $request)
    {
        $userproducts =  \App\User::where("id",auth()->user()->id)->first();
        
        $userproducts = $userproducts->userfavoritproduct()->paginate(2);

        $tmp = json_decode(json_encode($userproducts));
        
        $last_page_url = $tmp->last_page_url;
        $next_page_url = $tmp->next_page_url;
        $last_page = $tmp->last_page;
        $current_page = $tmp->current_page;
        $prev_page_url =$tmp->prev_page_url;
        
        $products = array();
        foreach($userproducts as $product){
            array_push($products, \App\Product::where("id",$product->idProduct)->first());
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
    public function userfavorits()
    {
        $ver = parent::notverified();
        if($ver!=null)return $ver;
        $token = auth()->user()->api_token;
        return view('favorites',parent::data_site()+compact('token'));
    }
}
