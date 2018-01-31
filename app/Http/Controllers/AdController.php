<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ad;
class AdController extends Controller
{
    //
    public function insert(Request $request){

        try {
            Ad::insert($request->input('ad_name'), $request->input('ad_value'), $request->input('ad_remake'), $request->input('ad_rate'));

            $respond=array(
                'ret'=>200,
                'date'=>[
                    'status'=>1
                ]
            );
            return json_encode($respond);
        }
        catch(Exception $e){
            $respond=array(
                'ret'=>202,
                'date'=>[
                    'status'=>0
                ]
            );
            return json_encode($respond);
        }
    }
}
