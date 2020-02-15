<?php
namespace app\common\controller;

use think\Controller;
use think\Session;
use think\Request;

class Common extends Controller
{
    public function initialize()
   {
        if(!session('uname')||!session('pwd'))
        {
            header('location:http://localhost/animesite/public/index.php/admin/login/login.html');
            return;
        }
      
    }
   

}