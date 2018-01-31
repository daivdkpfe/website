<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Menu;
use Ad;
use Config;
class IndexController extends Controller
{
    //
    public function getIndex(){


        $title=Config::get('website_title_ch');//获取网站的中文名字
        $logo=Config::get('logo_img');//获取LOGO
        $flash=Ad::get('logo_img');//获取flash图片
        $menu=Menu::getMenu();//获取目录
        $link=Ad::get('friend_link');
        return json_encode(
            [
                'ret'=>200,
                'data'=>[
                    'title'=>$title,
                    'nav'=>$menu,
                    'logo'=>$logo,
                    'flash'=>$flash,
                    'link'=>$link,
                ]
            ]
        );
    }
}
