<?php
namespace app\admin\controller;
use think\Controller;
use think\facade\Session;
use think\facade\Request;
use think\Db;


class Login extends Controller
{
    public function login()
   {
      return $this->fetch();
   }
    public function dologin()
    {

        $request=Request::instance();
        $res=$request->param();

        
        if($res!=false)
        {
          if($res['uname']=='')
        {
          return json_encode(array('code'=>1,'msg'=>'用户名不能为空'));
        }
          if($res['pwd']=='')
        {
           return json_encode(array('code'=>1,'msg'=>'密码不能为空'));
        }

        $login=Db::name('admin')->where(['name'=>$res['uname'],'password'=>$res['pwd']])->find();
        
        
        if($login&&$login['statue']==1)
        {
        Session::set('uname',$res['uname']);
        Session::set('pwd',$res['pwd']);
        return json_encode(array('code'=>0,'msg'=>'登陆成功'));
        }
        else
          return json_encode(array('code'=>1,'msg'=>'用户名或密码错误'));
        
        }
        return json_encode(array('code'=>1,'msg'=>'请输入用户名和密码'));
      
        
    }
    public function logout()
    {
      Session::delete('uname');
      if(!session('uname'))
      {
        return ['code'=>0,'msg'=>'退出成功'];
      }
    }
    
}
