<?php
/**
 * Created by PhpStorm.
 * User: LinMin
 * Date: 2018/1/31
 * Time: 14:29
 */

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class Ad
{
    public static function insert($ad_name,$ad_value,$ad_remake,$ad_rate,$only=false){

        if($only){
            //插入数据库
            DB::beginTransaction();
            try{

                DB::table('ad')->where('ad_name', $ad_name)->delete();
                $id = DB::table('ad')->insertGetId(
                    ['ad_name' => $ad_name, 'ad_value' => $ad_value,'ad_remake'=>$ad_remake,'ad_rate'=>$ad_rate]
                );
                DB::commit();
            }catch (Exception $e) {

                DB::rollBack();
            }
        }
        else{
            $id = DB::table('ad')->insertGetId(
                ['ad_name' => $ad_name, 'ad_value' => $ad_value,'ad_remake'=>$ad_remake,'ad_rate'=>$ad_rate]
            );
            return $id;
        }

    }//插入广告

    public static function get($ad_name){
        return DB::table('ad')->where('ad_name',$ad_name)->orderBy('ad_rate', 'esc')->get();
    }
}