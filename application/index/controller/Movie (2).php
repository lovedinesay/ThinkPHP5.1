<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\facade\Request;
use think\facade\Session;

class Movie extends Controller
{
  public function detail()
  {
    $request=Request::instance();
    $arg=$request->param();
   
    
    if($arg)
    {
      $res=Db::name('video')->where('vid',$arg['vid'])->field('vid,img,title,catename,url,score,count,desc')->select();

      

      $count=$res[0]['count'];
      $score=$res[0]['score'];
      //如果初次被点击
      if($score==0||$score==0)
      {
       
        $score=0;
        //当前模板分数设为0
        $currentgrade=0;
      }
      
    else
      $currentgrade=2*ceil($score/$count);
      
      if($currentgrade>10)
        $currentgrade=10;
      $this->assign('score',$currentgrade);
      $result=Db::name('comment')->where('videoid',$arg['vid'])->field('uid,content,date')->select();
      if($result)
      {
        foreach ($result as $key => $value) {
        $uid[$key]=$value['uid'];
        $nameres=Db::name('users')->where('uid',$uid[$key])->field('username')->find();
       }
       
      if($nameres)
        $this->assign('username',$nameres);
      }
      


    if($res)
    $this->assign('res',$res);
    if($result)
      $this->assign('comment',$result);
     
    return $this->fetch();
    }
    return ['code'=>1,'msg'=>'信息错误'];
    
  }
  public function videoplay()
  {
     $request=Request::instance();
     $msg=$request->param();

     if($msg)
     {
      $this->assign('msg',$msg);
     }
     return $this->fetch();
  }
  public function test()
  {
    return $this->fetch();
  }
  public function comment()
  {
    $request=Request::instance();
    $comment=$request->param();

    if($comment!=false&&$comment['content']!=null)
    {
      
      if(null!=Session::get('name'))
      {
        $username=Session::get('name');
        $users=Db::name('users')->where('username',$username)->field('uid')->find();
        
        $comment['uid']=$users['uid'];
        $comment['date']=date("Y-m-d");
        $res=Db::name('comment')->insert($comment);
          
      if($res)
        return ['code'=>0,'msg'=>'评论成功'];

      return ['code'=>1,'msg'=>'评论失败'];
      }
      else
        return ['code'=>1,'msg'=>'请先登录再评论'];
    
    } 
  }
  public function mark()
  {
    
    $request=Request::instance();
    $score=$request->param();
   
    if($score['score'])
    {
      $newmark=(int)($score['score']);
      $result=Db::name('video')->where('vid',$score['vid'])
      ->field('count,score')->find();
      $score['count']=$result['count'];
      $oldmark=$result['score'];
      $mark=$newmark+$oldmark;
      $count=$score['count'];
      
      if($count==null||$count==0)
      {
        $count=1;
      }
      else
      {
        $count=$count+1;
      }
   
      $score['count']=$count;
      $score['score']=$mark;
      if(null!=Session::get('name'))
      {
      $score['scorehistory']=Session::get('name');
       $res=Db::name('video')->where('vid',$score['vid'])
      ->update(['count'=>$score['count'],'score'=>$score['score'],'scorehistory'=>$score['scorehistory']]);
      
      if($res>0)
        return ['code'=>0,'msg'=>'打分成功'];
      return ['code'=>1,'msg'=>'打分出错'];
      }
       
    }
    return ['code'=>1,'msg'=>'未选择分数'];
  }
  public function upmsg()
  {
    
  }

}