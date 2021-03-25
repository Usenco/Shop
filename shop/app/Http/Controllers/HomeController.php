<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        parent::init("description","keywords","title","home");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $banners = \App\Banner::all();
        $products = \App\Product::where('arrived_time','>',(new DateTime())->getTimestamp() - 5000000)
        ->orderBy('title')
        ->take(20)
        ->get(); 
        return view("index", (parent::data_site()+compact('products','banners')) );
    }
    public function profile()
    {
        return view("profile", parent::data_site() );
    }
}
