<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class GeneralSettingController extends Controller
{
    public function index(){

    	return view('backend.setting.general-setting');
    }
}
