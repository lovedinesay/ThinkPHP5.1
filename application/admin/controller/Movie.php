<?php
namespace app\admin\controller;

use app\common\controller\Common;
use think\Controller;
use think\facade\Request;
use think\facade\Session;
use think\Db;
class Movie extends Controller
{
  public function movie()
  {
    $res=Db::name('video')->field('vid,title,desc,img,score,status,add_time')->select();
    $this->assign('res',$res);
   return $this->fetch(); 
  }
  public function add()
  {
    $label=Db::name('cate')->field('id,catename')->select();
   
   
    $this->assign('label',$label);
    return $this->fetch();
  }
  public function upload_img(){
    $file = request()->file('file');
    if($file==null){
      exit(json_encode(array('code'=>1,'msg'=>'没有文件上传')));
    }
    $info = $file->move('./uploads');
    $ext = ($info->getExtension());
    if(!in_array($ext,array('jpg','jpeg','gif','png'))){
      exit(json_encode(array('code'=>1,'msg'=>'文件格式不支持')));
    }
    $img = '/uploads/'.$info->getSaveName();
    exit(json_encode(array('code'=>0,'msg'=>$img)));
  }
   public function upload_video(){
    $file = request()->file('file');
    if($file==null){
      exit(json_encode(array('code'=>1,'msg'=>'没有文件上传')));
    }
    $info = $file->move('./uploads');
    $ext = ($info->getExtension());
    if(!in_array($ext,array('mp4','avi','wmv','mpeg'))){
      exit(json_encode(array('code'=>1,'msg'=>'文件格式不支持')));
    }
    $video = '/uploads/'.$info->getSaveName();
    exit(json_encode(array('code'=>0,'msg'=>$video)));
  }
  public function del()
  {
    $request=Request::instance();
    $msg=$request->param();
    if(!empty($msg))
    {
      $res=Db::name('video')->where('vid',$msg['vid'])->delete();
      if($res)
        return ['code'=>0,'msg'=>'删除成功'];
      else
        return ['code'=>1,'msg'=>'删除失败'];
    }
    return ['code'=>1,'msg'=>'数据有误'];

  }
  public function save()
  {
    $request=Request::instance();
    $msg=$request->param();


    if(!empty($msg))
    {
      $result=Db::name('video')->where('url',$msg['url'])->find();
      if($result)
        return ['code'=>1,'msg'=>'不能添加同一个视频'];
      $msg['add_time']=date("Y-m-d");
      if(array_key_exists('status', $msg))
      {
        $msg['status']=1;
      }
      else
      $msg['status']=0;
      $res=Db::name('video')->insert($msg);
      if($res)
        return ['code'=>0,'msg'=>'添加成功'];
      return ['code'=>1,'msg'=>'添加失败'];

    }
    return ['code'=>1,'msg'=>'信息错误'];
  }
  
}