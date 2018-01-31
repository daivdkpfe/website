<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Product;
class ProductController extends Controller
{
    //
    public function insert(Request $request){
        try{
            Product::insert($request);
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
                'date'=>[]
            );
            return json_encode($respond);
        }
    }

    public function getList(Request $request){
        try{
            $list=Product::getList($request->input('cate_uid'));
            $respond=array(
                'ret'=>200,
                'date'=>$list
            );
            return json_encode($respond);
        }
        catch(Exception $e){
            $respond=array(
                'ret'=>202,
                'date'=>[]
            );
            return json_encode($respond);
        }
    }
}
