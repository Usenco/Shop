<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $redirectTo = 'email/verify';

    private $description = "description";
    private $title = "title";
    private $keywords = "keywords";
    private $page = "home";
    public function init($description,$keywords,$title,$page)
    {
        $this->description = $description;
        $this->title = $title;
        $this->page = $page;
        $this->keywords = $keywords;
    }
    protected function data_site()
    {
        return [
            'description' => $this->description,
            'title' => $this->title,
            'keywords' => $this->keywords,
            'page' => $this->page];        
    }
    protected function notverified()
    {
        if(auth()->user()->email_verified_at == null){
             return redirect($this->redirectTo);
        }
        return null;
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
