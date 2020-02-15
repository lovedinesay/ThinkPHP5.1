<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Index extends Controller
{
    public function index()
    {
        $result=[];
        $k = 0;
        $catename=Db::name('cate')->field('catename')->select();
        foreach ($catename as $key => $value) {
         
             $res[$key]=Db::name('video')->where('catename','in',$value)->
             field('vid,title,img,catename,desc')->select();
           }
         
        //三维转二维
        foreach ($res as $key => $val) {
        foreach ($val as $key2 => $val2) {
        $result[$k]['title'] = $val2['title'];
        $result[$k]['img'] = $val2['img'];
        $result[$k]['vid'] = $val2['vid'];
        $result[$k]['catename'] = $val2['catename'];
        $result[$k]['desc'] = $val2['desc'];
        $k++;
        }
        }

      if($result)
      {
        $this->assign('res',$result);
        return $this->fetch();
      }
      return $this->fetch();
    }

    public function mainpg()
    {
        
      $result=[];
        $k = 0;
        $catename=Db::name('cate')->field('catename')->select();
        foreach ($catename as $key => $value) {
         
             $res[$key]=Db::name('video')->where('catename','in',$value)->
             field('vid,title,img,catename,desc')->select();
           }
         
        //三维转二维
        foreach ($res as $key => $val) {
        foreach ($val as $key2 => $val2) {
        $result[$k]['title'] = $val2['title'];
        $result[$k]['img'] = $val2['img'];
        $result[$k]['vid'] = $val2['vid'];
        $result[$k]['catename'] = $val2['catename'];
        $result[$k]['desc'] = $val2['desc'];
        $k++;
        }
        }
        
  
      if($result)
      {
        $this->assign('res',$result);
        return $this->fetch();
      }
       else
      {
        echo "<script>alert('该板块暂无视频内容');window.history.go(-1);</script>";
        return;
      }
      return $this->fetch();
    }
    public function japanpg()
    {
      
      $res=Db::name('video')->where('catename','日本动漫')->field('vid,title,img,catename,desc')->select();
  
      if($res)
      {
        $this->assign('res',$res);
        return $this->fetch();
      }
       else
      {
        echo "<script>alert('该板块暂无视频内容');window.history.go(-1);</script>";
        return;
      }
      return $this->fetch();
    }
    public  function chinapg()
    {
      $res=Db::name('video')->where('catename','国产动漫')->field('vid,title,img,catename,desc')->select();
  
      if($res)
      {
        $this->assign('res',$res);
        return $this->fetch();
      }
       else
      {
        echo "<script>alert('该板块暂无视频内容');window.history.go(-1);</script>";
        return;
      }
      return $this->fetch();
    }
    public function  usoupg()
    {
      
      $res=Db::name('video')->where('catename','欧美动漫')->field('vid,title,img,catename,desc')->select();
  
      if($res)
      {
        $this->assign('res',$res);
        return $this->fetch();
      }
       else
      {
        echo "<script>alert('该板块暂无视频内容');window.history.go(-1);</script>";
        return;
      }
      return $this->fetch();
    }
    public function filmpg()
    {
      
      $res=Db::name('video')->where('catename','电影动漫')->field('vid,title,img,catename,desc')->select();
  
      if($res)
      {
        $this->assign('res',$res);
        return $this->fetch();
      }
       else
      {
        echo "<script>alert('该板块暂无视频内容');window.history.go(-1);</script>";
        return;
      }
      return $this->fetch();
    }
    public function childpg()
    {
      
      $res=Db::name('video')->where('catename','亲子动漫')->field('vid,title,img,catename,desc')->select();
      
  
      if(!empty($res))
      {
        $this->assign('res',$res);
        return $this->fetch();
      }
      else
      {
        echo "<script>alert('该板块暂无视频内容');window.history.go(-1);</script>";
        return;
      }
      return $this->fetch();
    }
    public function ovapg()
    {
      
      $res=Db::name('video')->where('catename','剧场版')->field('vid,title,img,catename,desc')->select();
  
      if($res)
      {
        $this->assign('res',$res);
        return $this->fetch();
      }
       else
      {
        echo "<script>alert('该板块暂无视频内容');window.history.go(-1);</script>";
        return;
      }
      return $this->fetch();
    }
    public function rankpg()
    {
      
      $res=Db::name('video')->where('catename','排行榜')->field('vid,title,img,catename,desc')->select();
  
      if($res)
      {
        $this->assign('res',$res);
        return $this->fetch();
      }
       else
      {
        echo "<script>alert('该板块暂无视频内容');window.history.go(-1);</script>";
        return;
      }
      return $this->fetch();
    }

}
