<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use News;
class NewsController extends Controller
{
    public function getList(Request $request){
        try{
            $list=News::getList($request->input('cate'));
            return json_encode(
                [
                    'ret'=>200,
                    'data'=>[
                        'list'=>strlen($list)==0?[]:$list
                    ]
                ]
            );

        }
        catch (Exception $e){
            return json_encode(
                [
                    'ret'=>202,
                    'data'=>[
                        'status'=>0
                    ]
                ]
            );
        }

    }//获取新闻列表
    public function insert(Request $request){
        try{
            News::insert($request);
            return json_encode([
                'ret'=>200,
                'date'=>[
                    'status'=>1
                ]
            ]);
        }catch (Exception $e){
            return json_encode([
                'ret'=>202,
                'date'=>[
                    'status'=>0
                ]
            ]);
        }
    }//插入新闻
    public function detail(Request $request){
        try{
            $detail=News::detail($request->input('uid'));
            return json_encode([
                'ret'=>200,
                'date'=>$detail
            ]);
        }catch (Exception $e){
            return json_encode([
                'ret'=>202,
                'date'=>[]
            ]);
        }


    }//查看详情
}
