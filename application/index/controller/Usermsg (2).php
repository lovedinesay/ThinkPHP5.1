<?php
namespace app\index\controller;
use think\Controller;
use think\facade\Session;
use think\facade\Request;
use think\Db;
class Usermsg extends Controller
{
  public function usermsg()
  {
    if(Session::get('name'))
    {
      $name=Session::get('name');
      $res=Db::name('users')->where('username',$name)->find();

    
      if($res!=false)
      {

        $this->assign('res',$res);
        return $this->fetch();
      }
      else 
        return 'false';

    return $this->fetch();
    }
     else
     {
      echo "<script>alert('请先登录');window.history.go(-1);</script>";
     }
    
  }

}