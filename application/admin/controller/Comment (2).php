<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\facade\Request;

class Comment extends Controller
{
  public function comment()
  {
    $res=Db::name('comment')->select();
    if($res)
    {
      $username=Db::name('users')->alias('u')->join('comment c','u.uid=c.uid')->field('username,u.uid')->select();
      if($username)
      {
        $this->assign('username',$username);
      
      }
    }
    $this->assign('res',$res);
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
      $res=Db::name('comment')->where('id',$msg['id'])->delete();
      if($res)
      {
        return ['code'=>0,'msg'=>'删除成功'];
      }
      return ['code'=>1,'msg'=>'删除失败'];
    }
    return ['code'=>1,'msg'=>'信息有误'];
  }

}