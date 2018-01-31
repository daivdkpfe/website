<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ad;
class UploadController extends Controller
{
    //
    public function flash(Request $request){
        /*
         * POST
         * flash_img:图片文件
         * */
        $respond=array(
            'ret'=>200
        );
        //上传flash图片
        if ($request->hasFile('flash_img') && $request->file('flash_img')->isValid()) {
            $photo = $request->file('flash_img');
            $extension = $photo->extension();
            //$store_result = $photo->store('photo');

            $store_result = $photo->store('public/images/flash');
            $url=asset($store_result);
            $output = [
                'extension' => $extension,
                'url' => str_replace('/public/','/storage/',$url),
                'status'=>1
            ];

            //插入数据库
            $id=Ad::insert('flash_img',$output['url'],'flash图片',0);

            $respond['data']=$output;
            return $respond;
        }
        $respond['data']['status']=0;

        return $respond ;
    }//上传FLASH图片
    public  function logo(Request $request){
        /*
         * POST
         * logo_img:图片文件
         * */
        $respond=array(
            'ret'=>200
        );
        //上传flash图片
        if ($request->hasFile('logo_img') && $request->file('logo_img')->isValid()) {
            $photo = $request->file('logo_img');
            $extension = $photo->extension();
            //$store_result = $photo->store('photo');

            $store_result = $photo->store('public/images');
            $url=asset($store_result);
            $output = [
                'extension' => $extension,
                'url' => str_replace('/public/','/storage/',$url),
                'status'=>1
            ];

            //插入数据库
            DB::beginTransaction();
            try{
                DB::table('config')->where('cf_name', 'logo_img')->delete();
                $id = DB::table('config')->insertGetId(
                    ['cf_name' => 'logo_img', 'cf_value' => $output['url']]
                );
                DB::commit();
            }catch (Exception $e) {

                DB::rollBack();
            }


            $respond['data']=$output;
            return $respond;
        }
        $respond['data']['status']=0;

        return $respond ;
    }//上传LOGO图片

}
/*
 * status=1:上传成功
 * */
/*
 * status=0:找不到图片文件
 * */