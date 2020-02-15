<?php
namespace app\admin\controller;

use app\common\controller\Common;
use think\Controller;
use think\facade\Request;
use think\facade\Session;
use think\Db;

class User extends Controller
{
  public function user()
  {
    $res=Db::name('users')->field('uid,username,truename,statue')->select();
    if($res)
    {
      $this->assign('res',$res);
      return $this->fetch();
    }
    return $this->fetch();
  }
  public function add()
  {
    return $this->fetch();
  }
  public function save()
  {
    $request=Request::instance();
    $msg=$request->param();
    if($msg)
    {
      $res=Db::name('users')->insert($msg);
      if($res)
      {
        return json_encode(['code'=>0,'msg'=>'添加成功']);

      }
      return json_encode(['code'=>1,'msg'=>'添加失败']);
    }
    return json_encode(['code'=>1,'msg'=>'信息有误']);
  }
  public function del()
  {
    $request=Request::instance();
    $msg=$request->param();
    if($msg!=false)
    {
      $res=Db::name('users')->where('uid',$msg['id'])->delete();
      if($res)
      {
        return json_encode(['code'=>0,'msg'=>'删除成功']);
      }
      return json_encode(['code'=>1,'msg'=>'删除失败']);
    }
    return json_encode(['code'=>1,'msg'=>'信息有误']);
  }
 

  public function edit()
  {
    $request=Request::instance();
    $msg=$request->param();
    if($msg)
    {
      $res=Db::name('users')->where('uid',$msg['uid'])->select();
      if($res)
      {
        $this->assign('res',$res);
        return $this->fetch();
      }
       
      else
        return ['code'=>1,'msg'=>'数据错误'];
    }
  }
  public function update()
  {
    $request=Request::instance();
    $msg=$request->param();
    if($msg)
    {
      $res=Db::name('users')->where('uid',$msg['uid'])->update($msg);
      if($res>0)
        return ['code'=>0,'msg'=>'更新成功'];
      else
        return ['code'=>1,'msg'=>'更新失败'];
    }
    else
    {
      return ['code'=>1,'msg'=>'数据错误'];
    }
  }
}