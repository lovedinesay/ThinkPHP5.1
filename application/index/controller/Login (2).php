<?php
namespace app\index\controller;
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
          return ['code'=>1,'msg'=>'用户名不能为空'];
        }
          if($res['pwd']=='')
        {
           return ['code'=>1,'msg'=>'密码不能为空'];
        }
        $user=Db::name('users')->where(['username'=>$res['uname'],'userpwd'=>$res['pwd']])->find();
    
       if($user!=null&&$user['statue']==1)
        {
          
          Session::set('name',$res['uname']);
          Session::set('pwd',$res['pwd']);
         return ['code'=>0,'msg'=>'登陆成功'];
        }
        else
        {
          return ['code'=>1,'msg'=>'该用户被封禁'];
        }
         
        }
        else
         return ['code'=>1,'msg'=>'请输入用户名和密码'];
      
  }
  public function regeister()
    {
      return $this->fetch();
    }
    public function checkmsg()
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
        if($res['confirm']=='')
        {
          return json_encode(array('code'=>1,''=>'验证密码不能为空'));
        }
        if($res['pwd']!==$res['confirm'])
        {
          {
          return json_encode(array('code'=>1,''=>'两次输入的密码不一致'));
          }
        }
        if($res['truename']=='')
        {
          return json_encode(array('code'=>1,''=>'真实姓名不能为空'));
        }
        
        $data=
        [
         
          'username'=>$res['uname'],
          'truename'=>$res['truename'],
          'userpwd'=>$res['pwd']
        ];
        if($data)
        $result=Db::name('users')->insert($data);
        if($result)
        {
        Session::set('name',$res['uname']);
        Session::set('pwd',$res['pwd']);
        return json_encode(array('code'=>0,'msg'=>'登陆成功'));
        }
         
        
        
        
        return json_encode(array('code'=>1,'msg'=>'请输入用户信息'));
        
      }
    }
    public function logout()
    {
      Session::clear();
     
      echo '<script >setTimeout(window.location.href="http://localhost/animesite/public/index.php/index/login/login",2000)</script>';

    }
}