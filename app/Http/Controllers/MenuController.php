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

    public function getProduct(){
        try{
            $menu=Menu::getProductCate();
            return json_encode([
               'ret'=>200,
               'data'=>$menu
            ]);
        }
        catch(Exception $e){
            $respond=array(
                'ret'=>202,
                'date'=>[]
            );
            return json_encode($respond);
        }
    }//获取商品分类

}
