<?php
/**
 * Created by PhpStorm.
 * User: LinMin
 * Date: 2018/1/30
 * Time: 9:29
 */

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class Menu
{
    public static function creaate($request){
        $id = DB::table('menu')->insertGetId(
            [
                'belone_uid' => $request->input('belone_uid'),
                'cate_name'=>$request->input('cate_name'),
                'cate_type'=>$request->input('cate_type'),
                'cate_url'=>$request->input('cate_url'),
                'cate_rate'=>$request->input('cate_rate')
            ]
        );
    }//创建目录
    public static function getMenu(){
        $menu_first=DB::table('menu')->where('cate_show',1)->where('belone_uid',0)->get();
        foreach ($menu_first as $i=>$v){
            $menu_second=DB::table('menu')->where('cate_show',1)->where('belone_uid',$v->uid)->get();
            $menu_first[$i]->childNode=$menu_second;
        }

        return $menu_first;
    }//获取目录
}