<?php
/**
 * Created by PhpStorm.
 * User: LinMin
 * Date: 2018/1/30
 * Time: 17:09
 */

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class Product
{
    public static function insert($request){
        $img_url=null;
        if ($request->hasFile('goods_file1') && $request->file('goods_file1')->isValid()) {
            $photo = $request->file('goods_file1');
            $extension = $photo->extension();
            //$store_result = $photo->store('photo');

            $store_result = $photo->store('public/images/goods');
            $url=asset($store_result);
            $img_url=str_replace('/public/','/storage/',$url);

        }


        $id = DB::table('goods')->insertGetId(
            [
                'belone_menu_uid'=>$request->input('belone_menu_uid'),
                'belone_top_menu_uid'=>$request->input('belone_top_menu_uid'),
                'goods_name'=>$request->input('goods_name'),
                'goods_status'=>$request->input('goods_status'),
                'goods_file1'=>$img_url,
                'goods_content'=>$request->input('goods_content'),
                'goods_price'=>$request->input('goods_price'),
                'goods_status'=>1
            ]
        );
        return $id;
    }//插入产品

    public static function getList($uid){
        return DB::table('goods')->select('uid','belone_top_menu_uid','belone_menu_uid','goods_name','goods_file1','goods_price')->where('belone_menu_uid',$uid)->orWhere('belone_top_menu_uid',$uid)->paginate(15);
    }//获取产品列表

    public static function detail($uid){
        DB::table('goods')->where('uid',$uid)->increment('goods_hit', 1);
        $detail=DB::table('goods')->where('uid',$uid);
        $list=self::getList($detail[0]->belone_menu_uid);
        $before=-1;
        $after=-1;
        $finded=false;
        foreach ($list as $k=>$v){
            if($finded)
            {
                $after=$k;
                break;
            }
            else{
                if($v->uid==$uid){
                    $finded=true;
                }
                else{
                    $before=$k;
                }
            }

        }
        $detail[0]->last=$before>-1?$list[$before]:[];
        $detail[0]->next=$after>-1?$list[$after]:[];
        return $detail;
    }//获取产品详情
}