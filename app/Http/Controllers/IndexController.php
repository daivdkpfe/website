<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Menu;
class IndexController extends Controller
{
    //
    public function getIndex(){

        $title=DB::table('config')->where('cf_name','website_title_ch')->get();//获取网站的中文名字
        $logo=DB::table('config')->where('cf_name','logo_img')->get();//获取LOGO
        $flash=DB::table('config')->where('cf_name','flash_img')->get();//获取flash图片
        $menu=Menu::getMenu();//获取目录
        return json_encode(
            [
                'ret'=>200,
                'data'=>[
                    'title'=>$title,
                    'nav'=>$menu,
                    'logo'=>$logo,
                    'flash'=>$flash,
                ]
            ]
        );
    }
}
