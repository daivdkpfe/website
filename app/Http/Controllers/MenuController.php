<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Menu;
class MenuController extends Controller
{

    public function create(Request $request){

     /*
     * POST
     *
     * */
        try{
            Menu::creaate($request);
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

    }//创建目录



}
