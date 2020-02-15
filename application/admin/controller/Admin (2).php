<?php
namespace app\admin\controller;
use think\Controller;
use think\facade\Request;
use think\Db;

class Admin extends Controller
{//管理员列表页面
  public function adminpg()
  {
    $res=Db::name('admin')->paginate(8);
  
   
    if($res)
    {
      
      $this->assign('res',$res);
      return $this->fetch();
    }
    return $this->fetch();
  }
  //管理员添加页面
  public function add()
  {
    $res=Db::name('auth_group')->field('title')->select();
    if($res)
    {
      $this->assign('res',$res);
      return $this->fetch();
    }
    return $this->fetch();
  }
  //管理员添加
  public function save()
  {
      $request=Request::instance();
      $msg=$request->param();
    
      if($msg!=false)
      {
        $data=[];
      $data['name'] = $msg['username'];
      $data['role'] =$msg['select'] ;
      $data['password'] = $msg['pwd'];
      $data['truename'] = $msg['truename'];
      if(array_key_exists('status', $msg))
      $data['statue'] = (int)$msg['status'];
      else
      $data['statue']=0;
   
        $res=Db::name('admin')->insert($data);
        if($res)
        {
          return json_encode(array('code'=>0,'msg'=>'添加成功'));
        }
        return json_encode(array('code'=>1,'msg'=>'添加失败'));
      }
  }
  public function moviepg()
  {
    return $this->fetch();
  }
  public function rolepg()
  {
    return $this->fetch();
  }
  public function del()
  {
    $request=Request::instance();
    $msg=$request->param();
    if($msg!=false)
    {
      $res=Db::name('admin')->where('id',$msg['id'])->delete();
      if($res)
      {
        return ['code'=>0,'msg'=>'删除成功'];
      }
       return  ['code'=>1,'msg'=>'删除失败'];
    }
    return ['code'=>1,'msg'=>'删除失败'];
  }
  public function edit()
  { 
    $request=Request::instance();
    $msg=$request->param();
    if($msg)
    {
      $res=Db::name('admin')->where('id',$msg['id'])->select();
      if($res)
      {
        $this->assign('res',$res);
        return $this->fetch();
      }
    }
}
  public function update()
  {
    $request=Request::instance();
    $msg=$request->param();

    if($msg)
    {
      $res=Db::name('admin')->where('id',$msg['id'])->update($msg);
      if($res>0)
      {
        return ['code'=>0,'msg'=>'更新成功'];
      }
      else
      {
        return ['code'=>1,'msg'=>'更新失败，请更改数据内容'];
      }
    }
    else
    {
      return ['code'=>1,'msg'=>'数据错误'];
    }
  }
}