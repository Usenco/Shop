<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin_apiController extends Controller
{
    public function get_banners()
    {
        return json_encode(\App\Banner::all());
    }
    public function story_banners(Request $request)
    {
        return \App\Banner::create($request->all());
    }
    public function update_banners(Request $request, $id)
    {
        $banners = \App\Banner::findOrFail($id);
        $banners->update($request->all());

        return $banners;
    }

    public function delete_banners($id)
    {
        $banners = \App\Banner::findOrFail($id);
        $banners->delete();

        return 204;
    }
}
