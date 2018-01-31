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
        $menu_first=DB::table('menu')->where([
            ['cate_show',1],
            ['belone_uid',0],
        ])->orderBy('cate_rate', 'esc')->get();
        foreach ($menu_first as $i=>$v){
            $menu_second=DB::table('menu')->where([
                ['cate_show',1],
                ['belone_uid',$v->uid]])->orderBy('cate_rate', 'esc')->get();
            $menu_first[$i]->childNode=$menu_second;
        }

        return $menu_first;
    }//获取目录
    public static function getProductCate(){

        $menu=DB::table('menu')->where([['cate_show','=','2']])->orderBy('cate_rate', 'esc')->get();
        $tree = self::getTree($menu, 0);
        return $tree;

    }//获取商品分类





    public static function getTree($data, $pId)
    {
        $tree = [];
        foreach($data as $k => $v)
        {

            if($v->belone_uid == $pId)
            {        //父亲找到儿子

                $v->child = self::getTree($data, $v->uid);
                $tree[] = $v;
            }
        }
        return $tree;
    }//数组转数

}