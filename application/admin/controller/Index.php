<?php
namespace app\admin\controller;

use app\common\controller\Common;
use think\Controller;
use think\facade\Request;
use think\facade\Session;


class Index extends Common
{

  public function login()
  {
    $a=Session::get('name');
    dump($a);die; 
  }
  public function index()
  {
    
    return $this->fetch();
  }
  public function handle()
  {
      $request=Request::instance();
      $res=$request->param();
      if($res)
      {
        
        $this->assign('res',$res);
        return $this->fetch('new');
      }
      else
      {
        $this->error('没有数据');
      }
  }
  public function newpage()
  {
    return $this->fetch();
  }
  public function welcome()
  {
    return $this->fetch();
  }
}