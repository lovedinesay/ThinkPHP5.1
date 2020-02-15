<?php
namespace app\admin\controller;
use think\Controller;
class Test extends Controller
{
  public function test()
  {
    return $this->fetch();
  }
  public function upload()
  {
    define('MUILTI_FILE_UPLOAD', '10');
//设置文件大小不超过5MB
define('MAX_SIZE_FILE_UPLOAD', '500000' );
//设置上传文件的存储目录
define('FILE_UPLOAD_DIR', '/fileUploads');
//允许上传的文件扩展名
$array_extention_interdite = array( '.flv' , '.wmv' , '.rmvb' , '.php' , '.php3' , '.php4' , '.exe' , '.msi' , '.htaccess' , '.gz' );
//显示信息的公共函数
function func_message($message='', $ok=''){
 echo '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
 if($ok == true)
 echo '<tr><td width="50%"> '.$message.'</td></tr>' ;
 else
 echo '<tr><td width="50%"> '.$message.'</td></tr>';
 echo '</table>';  
}
//处理表单提交
$action = (isset($_POST['action'])) ? $_POST['action'] :'' ;
$file = (isset($_POST['file'])) ? $_POST['file'] :'' ;
if($file != '')
  $file = $file.'/';
$message_true = '';
$message_false = '';
switch($action){
 case 'upload' :  
 chmod(FILE_UPLOAD_DIR,0777);  
 for($nb = 1 ; $nb <= MUILTI_FILE_UPLOAD ; $nb ++ ){   
  if( $_FILES['file_'.$nb]['size'] >= 10 ){ 
  if ($_FILES['file_'.$nb]['size'] <= MAX_SIZE_FILE_UPLOAD ){ 
   if (!in_array(ereg_replace('^[[:alnum:]]([-_.]?[[:alnum:]])*.' ,'.', $_FILES['file_'.$nb]['name'] ) , $array_extention_interdite) ){ 
           if($_POST['file_name_'.$nb] !='')
             $file_name_final = $_POST['file_name_'.$nb].$extension ;
           else
             $file_name_final = $_FILES['file_'.$nb]['name'] ;
           //修改文件名
           $file_name_final = strtr($file_name_final, 'aaaaaa', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'); 
           $file_name_final = preg_replace('/([^.a-z0-1]+)/i', '_', $file_name_final ); 
             
           $_FILES['file_'.$nb]['name'] = $file_name_final;  
           //开始上传
           move_uploaded_file( $_FILES['file_'.$nb]['tmp_name'] , FILE_UPLOAD_DIR . $file . $file_name_final );
         
           $message_true .= '文件上传成功 : '.$_FILES['file_'.$nb]['name'] .'<br>'; 
        }else
           $message_false .= '文件上传失败 : '.$_FILES['file_'.$nb]['name'] .' <br>';
      }else
        $message_false .= '文件最大尺寸不能超过'.MAX_SIZE_FILE_UPLOAD/1000 . 'KB : "'.$_FILES['file_'.$nb]['tmp_name'].'" <br>';
    }
  }//end for
 break;
}
  }
