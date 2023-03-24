<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\GeneralSetting;

class GeneralSettingController extends Controller
{
    public function index(){
        $general = GeneralSetting::first();
        $pageTitle = 'General Setting';
        $timezones =json_decode(file_get_contents(resource_path('views/backend/includes/partials/timezone.json')));

    	return view('backend.setting.general-setting',compact('general','pageTitle','timezones'));
    }

    public function update(Request $request){
    	$request->validate([
            'base_color' => 'nullable', 'regex:/^[a-f0-9]{6}$/i',
            'secondary_color' => 'nullable', 'regex:/^[a-f0-9]{6}$/i',
            'timezone' => 'required',
        ]);

        $general = GeneralSetting::first();
        $general->ev = $request->ev ? 1 : 0;
        $general->en = $request->en ? 1 : 0;
        $general->sv = $request->sv ? 1 : 0;
        $general->sn = $request->sn ? 1 : 0;
        $general->force_ssl = $request->force_ssl ? 1 : 0;
        $general->secure_password = $request->secure_password ? 1 : 0;
        $general->registration = $request->registration ? 1 : 0;
        $general->agree = $request->agree ? 1 : 0;
        $general->sitename = $request->sitename;
        $general->cur_text = $request->cur_text;
        $general->cur_sym = $request->cur_sym;
        $general->base_color = $request->base_color;
        $general->save();

        return redirect()->back();
    }
}
