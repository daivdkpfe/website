<?php
/**
 * Created by PhpStorm.
 * User: LinMin
 * Date: 2018/1/30
 * Time: 10:47
 */

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class News
{
    public static function getList($cate_uid){

            $list=DB::table('news')->select('uid','belone_top_menu_uid','belone_menu_uid','news_title')->where('belone_top_menu_uid',$cate_uid)->orWhere('belone_menu_uid',$cate_uid)->paginate(15);

            return $list;
    }//获取新闻列表
    public static function insert($request){
        //上传
        $img_url=null;
        if ($request->hasFile('news_file1') && $request->file('news_file1')->isValid()) {
            $photo = $request->file('news_file1');
            $extension = $photo->extension();
            //$store_result = $photo->store('photo');

            $store_result = $photo->store('public/images/news');
            $url=asset($store_result);
            $img_url=str_replace('/public/','/storage/',$url);

        }



        $id = DB::table('news')->insertGetId(
            [
                'belone_menu_uid'=>$request->input('belone_menu_uid'),
                'belone_top_menu_uid'=>$request->input('belone_top_menu_uid'),
                'news_title'=>$request->input('news_title'),
                'news_author'=>$request->input('news_author'),
                'news_content'=>$request->input('news_content'),
                'news_file1'=>$img_url
            ]
        );
        return $id;
    }//插入新闻
    public static function detail($uid){
        DB::table('news')->where('uid',$uid)->increment('news_hit', 1);
        $detail=DB::table('news')->where('uid',$uid)->get();
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
    }//新闻详情
}