<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;

class Contact_usController extends Controller
{
    public function __construct()
    {
        parent::init("description","keywords","title","products");
    }
    public function contact(Request $request)
    {
        $ver = parent::notverified();
        if($ver!=null)return $ver;
        $feed = $request->session()->get("isSetFeed","no");
        return view("contact_us",parent::data_site()+compact("feed"));
    }
    public function addfeedback(Request $request)
    {
        if(isset($request->subject) && isset($request->feedback) && $request->session()->get("isSetFeed",null)==null )
        {
            $request->session()->put("isSetFeed","yes");
            Feedback::create([
                "idUser"   => auth()->user()->id,
                "subject"  => $request->subject,
                "feedback" => $request->feedback
            ]);
        }
        return redirect('contact');
    }
}
