<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\facade\Request;

class Cate extends Controller
{
  public function catepg()
  {
    $res=Db::name('cate')->field('id,catename,sort,statue')->select();
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
      
      $res=Db::name('cate')->insert($msg);
      if($res)
        return json_encode(['code'=>0,'msg'=>'添加成功']);
      else
        return json_encode(['code'=>1,'msg'=>'添加失败']);
    }
    return json_encode(['code'=>1,'msg'=>'获取信息失败']);

  }
  public function del()
  {
     $request=Request::instance();
    $msg=$request->param();
    if($msg!=false)
    {
      $res=Db::name('cate')->where('id',$msg['id'])->delete();
      if($res)
      {
        return ['code'=>0,'msg'=>'删除成功'];
      }
       return  ['code'=>1,'msg'=>'删除失败'];
    }
    return ['code'=>1,'msg'=>'删除失败'];
  
  }
}