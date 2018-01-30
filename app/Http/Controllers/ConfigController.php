<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ConfigController extends Controller
{
    //
    public function getConfig()
    {
        $title=DB::table('config')->where('cf_name','website_title_ch')->get();
        return $title;
    }
}
