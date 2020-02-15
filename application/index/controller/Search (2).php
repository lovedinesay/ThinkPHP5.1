<?php
namespace app\index\controller;
use think\Controller;
use think\facade\Request;
use think\Db;

class Search extends Controller
{
  public function search()
  {
      // $request=Request::instance();
      // $search=$request->param();
return $this->fetch();

      // if($search!==false)
      // {
      //   return json_encode(array('code'=>0,'msg'=>$search['search']));

      // }
      // else 
      // {
      //   return json_encode(array('code'=>1,'msg'=>'搜索信息不能为空'));
      // }
  }
  public function selectmatch()
  {
    $request=Request::instance();
    $msg=$request->param();
    

      if(!empty($msg['search']))
      {
          //将request的查询值转换为string
        $search=$msg['search'];
        //分割数组
        $search=preg_split('/(?<!^)(?!$)/u',$search);
        $count=count($search);
       
        for($i=0;$i<$count;$i++)
        {
          $res[$i]=Db::name('video')->where('title','like','%'.$search[$i].'%')->field('title,img,vid,catename')->select();
        
          
        }
        
       
        $result=[];
        $k = 0;
        //三维转二维
        foreach ($res as $key => $val) {
        foreach ($val as $key2 => $val2) {
        $result[$k]['title'] = $val2['title'];
        $result[$k]['img'] = $val2['img'];
        $result[$k]['vid'] = $val2['vid'];
         $result[$k]['catename'] = $val2['catename'];
        $k++;
        }
        }
        
        $result =array_unique($result, SORT_REGULAR);
        $this->assign('res',$result);
        return $this->fetch();

          

      }
      else
        return ;

  }
}