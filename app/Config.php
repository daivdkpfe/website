<?php
/**
 * Created by PhpStorm.
 * User: LinMin
 * Date: 2018/1/31
 * Time: 16:04
 */

namespace App;


class Config
{
    public static function get($cf_name){
        $cf=DB::table('config')->where('cf_name',$cf_name)->get();
        return $cf;
    }
}