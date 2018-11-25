<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends MY_Controller {
public function __construct()

        {
          parent::__construct();
          $this->load->library('session');
          $this->load->library('pagination');
          $this->load->model('data','','true');
          $this->load->library('upload');
          $this->load->helper(array('form', 'url','text'));
          $this->load->library('lib_pagination'); 
        }

    

/****Gen_Random_String***********************************************/

public function gen_random_string()

{
$chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";//length:36
$final_rand='';
for($i=0;$i<4; $i++) {
 $final_rand .= $chars[ rand(0,strlen($chars)-1)];
    }
return $final_rand;
}

/**** END Gen_Random_String**********************************************/

public function index(){
$this->load->view('home');
}

public function home(){
$this->load->view('home');
}

public function template(){
  $this->load->view('template');
  }
  

/*******************************************************18-12-2017*/
public function main_page(){
$this->data = array(
'mainpage'=> $this->data->get_table_data('site_info'));	
$this->load->view('main_page',$this->data);
}








public function update_mainpage(){
$titlear_solgin=$this->input->post('titlear_solgin');
$title_solgin=$this->input->post('title_solgin');
$descriptionar_solgin=$this->input->post('descriptionar_solgin');
$description_solgin=$this->input->post('description_solgin');
$block1=$this->input->post('block1');
$block2=$this->input->post('block2');
$block3=$this->input->post('block3');
$block1ar=$this->input->post('block1ar');
$block2ar=$this->input->post('block2ar');
$block3ar=$this->input->post('block3ar');



$btitle1=$this->input->post('btitle1');
$btitle2=$this->input->post('btitle2');
$btitle3=$this->input->post('btitle3');
$btitle_ar1=$this->input->post('btitle_ar1');
$btitle_ar2=$this->input->post('btitle_ar2');
$btitle_ar3=$this->input->post('btitle_ar3');

$policyar=$this->input->post('policyar');
$policy=$this->input->post('policy');


$main_title=$this->input->post('main_title');
$main_titlear=$this->input->post('main_titlear');
$t1=$this->input->post('t1');
$t2=$this->input->post('t2');
$t3=$this->input->post('t3');
$t1ar=$this->input->post('t1ar');
$t2ar=$this->input->post('t2ar');
$t3ar=$this->input->post('t3ar');

$data = array('title_solgin'=>$title_solgin,'titlear_solgin'=>$titlear_solgin,'description_solgin'=>$description_solgin,'descriptionar_solgin'=>$descriptionar_solgin,'block1'=>$block1,'block2'=>$block2,'block3'=>$block3,'block1ar'=>$block1ar,'block2ar'=>$block2ar,'block3ar'=>$block3ar,'btitle1'=>$btitle1,'btitle2'=>$btitle2,'btitle3'=>$btitle3,'btitle_ar1'=>$btitle_ar1,'btitle_ar2'=>$btitle_ar2,'btitle_ar3'=>$btitle_ar3,'policyar'=>$policyar,'policy'=>$policy,'main_title'=>$main_title,'main_titlear'=>$main_titlear,'t1'=>$t1,'t2'=>$t2,'t3'=>$t3,'t1ar'=>$t1ar,'t2ar'=>$t2ar,'t3ar'=>$t3ar);
$re=$this->data->edit_table('site_info','2',$data);


if($_FILES['b1']['name']!=""){
$logo = $this->data->get_table_row('site_info',array(),'b1'); 
if ($logo != "") {
unlink("../site/ar/images/site_setting/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = '../site/ar/images/site_setting/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =600000;
$config['max_width']            = 600000;
$config['max_height']           = 600000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
$this->upload->initialize($config);
if (!$this->upload->do_upload('b1')){
echo $this->upload->display_errors();
 }
else {
$url= $_FILES['b1']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('b1'=>$imagename.".".$file_extension);
$this->db->update('site_info',$data,array('id'=>'2'));
  }

  }

  
if($_FILES['b2']['name']!=""){
$logo = $this->data->get_table_row('site_info',array(),'b2'); 
if ($logo != "") {
unlink("../site/ar/images/site_setting/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = '../site/ar/images/site_setting/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =600000;
$config['max_width']            = 600000;
$config['max_height']           = 600000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
$this->upload->initialize($config);
if (!$this->upload->do_upload('b2')){
echo $this->upload->display_errors();
 }
else {
$url= $_FILES['b2']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('b2'=>$imagename.".".$file_extension);
$this->db->update('site_info',$data,array('id'=>'2'));
  }

  }  
  
   
if($_FILES['b3']['name']!=""){
$logo = $this->data->get_table_row('site_info',array(),'b3'); 
if ($logo != "") {
unlink("../site/ar/images/site_setting/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = '../site/ar/images/site_setting/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =600000;
$config['max_width']            = 600000;
$config['max_height']           = 600000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
$this->upload->initialize($config);
if (!$this->upload->do_upload('b3')){
echo $this->upload->display_errors();
 }
else {
$url= $_FILES['b3']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('b3'=>$imagename.".".$file_extension);
$this->db->update('site_info',$data,array('id'=>'2'));
  }
  }


if($_FILES['policyimg']['name']!=""){
$logo = $this->data->get_table_row('site_info',array(),'policyimg'); 
if ($logo != "") {
unlink("../site/ar/images/site_setting/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = '../site/ar/images/site_setting/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =6000000;
$config['max_width']            =6000000;
$config['max_height']           =6000000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
$this->upload->initialize($config);
if (!$this->upload->do_upload('policyimg')){
echo $this->upload->display_errors();
 }
else {
$url= $_FILES['policyimg']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('policyimg'=>$imagename.".".$file_extension);
$this->db->update('site_info',$data,array('id'=>'2'));
  }
  }

/*****************/
if($_FILES['imgt1']['name']!=""){
$logo = $this->data->get_table_row('site_info',array(),'imgt1'); 
if ($logo != "") {
unlink("../site/ar/images/site_setting/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = '../site/ar/images/site_setting/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =6000000;
$config['max_width']            =6000000;
$config['max_height']           =6000000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
$this->upload->initialize($config);
if (!$this->upload->do_upload('imgt1')){
echo $this->upload->display_errors();
 }
else {
$url= $_FILES['imgt1']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('imgt1'=>$imagename.".".$file_extension);
$this->db->update('site_info',$data,array('id'=>'2'));
  }
  }


if($_FILES['imgt2']['name']!=""){
$logo = $this->data->get_table_row('site_info',array(),'imgt2'); 
if ($logo != "") {
unlink("../site/ar/images/site_setting/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = '../site/ar/images/site_setting/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =6000000;
$config['max_width']            =6000000;
$config['max_height']           =6000000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
$this->upload->initialize($config);
if (!$this->upload->do_upload('imgt2')){
echo $this->upload->display_errors();
 }
else {
$url= $_FILES['imgt2']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('imgt2'=>$imagename.".".$file_extension);
$this->db->update('site_info',$data,array('id'=>'2'));
  }
  }

if($_FILES['imgt3']['name']!=""){
$logo = $this->data->get_table_row('site_info',array(),'imgt3'); 
if ($logo != "") {
unlink("../site/ar/images/site_setting/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = '../site/ar/images/site_setting/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =6000000;
$config['max_width']            =6000000;
$config['max_height']           =6000000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
$this->upload->initialize($config);
if (!$this->upload->do_upload('imgt3')){
echo $this->upload->display_errors();
 }
else {
$url= $_FILES['imgt3']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('imgt3'=>$imagename.".".$file_extension);
$this->db->update('site_info',$data,array('id'=>'2'));
  }
  }
$this->load->helper('url');
redirect('/home/main_page?success', 'refresh');  
}



public function about_page(){
$this->data = array(
'mainpage'=> $this->data->get_table_data('site_info'));	
$this->load->view('about_page',$this->data);
}


public function update_aboutpage(){
$video=$this->input->post('video');
$video_about=$this->input->post('video_about');
$video_about_ar=$this->input->post('video_about_ar');
$about_titlear=$this->input->post('about_titlear');
$about_title=$this->input->post('about_title');
$main_descripar=$this->input->post('main_descripar');
$main_descrip=$this->input->post('main_descrip');
$about_titlebar=$this->input->post('about_titlebar');
$about_titleb=$this->input->post('about_titleb');
$secmain_descripar=$this->input->post('secmain_descripar');
$secmain_descrip=$this->input->post('secmain_descrip');

$data = array('video'=>$video,'video_about'=>$video_about,'video_about_ar'=>$video_about_ar,'about_titlear'=>$about_titlear,'about_title'=>$about_title,'main_descripar'=>$main_descripar,'main_descrip'=>$main_descrip,'about_titlebar'=>$about_titlebar,'about_titleb'=>$about_titleb,'secmain_descripar'=>$secmain_descripar,'secmain_descrip'=>$secmain_descrip);
$re=$this->data->edit_table('site_info','2',$data);


if($_FILES['about_img1']['name']!=""){
$logo = $this->data->get_table_row('site_info',array(),'about_img1'); 
if ($logo != "") {
unlink("../site/ar/images/site_setting/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = '../site/ar/images/site_setting/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =600000;
$config['max_width']            = 600000;
$config['max_height']           = 600000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
$this->upload->initialize($config);
if (!$this->upload->do_upload('about_img1')){
echo $this->upload->display_errors();
 }
else {
$url= $_FILES['about_img1']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('about_img1'=>$imagename.".".$file_extension);
$this->db->update('site_info',$data,array('id'=>'2'));
  }

  }

  
if($_FILES['about_img']['name']!=""){
$logo = $this->data->get_table_row('site_info',array(),'about_img'); 
if ($logo != "") {
unlink("../site/ar/images/site_setting/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = '../site/ar/images/site_setting/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =600000;
$config['max_width']            = 600000;
$config['max_height']           = 600000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
$this->upload->initialize($config);
if (!$this->upload->do_upload('about_img')){
echo $this->upload->display_errors();
 }
else {
$url= $_FILES['about_img']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('about_img'=>$imagename.".".$file_extension);
$this->db->update('site_info',$data,array('id'=>'2'));
  }

  }  
  
   

$this->load->helper('url');
redirect('/home/about_page?success', 'refresh');  
}




/**********************************************************/

public function login(){
$this->load->view('admin/login');
}





public function user_profile(){
  $id_admin=$this->session->userdata['id_admin'];;
$this->data = array(
'num_admin'=> $this->data->get_table_data('admin'),
'data_admin'=>$this->data->get_table_data('admin',array('id'=>$id_admin)));
 $this->load->view('admin/user_profile',$this->data);
    }



public function update_profile(){
  $id_admin=$this->session->userdata['id_admin'];
  
  $fname=$this->input->post('fname');
  $lname=$this->input->post('lname');
  $phone=$this->input->post('phone');
  $email=$this->input->post('email');
  $this->session->set_userdata(array('admin_name' => $fname));
  $data['fname']=$fname;
  $data['lname']=$lname;
  $data['mail']=$email;
  $data['phone']=$phone;
  $res_result=$this->data->edit_table('admin',$id_admin,$data);
  $this->session->set_flashdata('msg', 'Your request update success');
$this->session->mark_as_flash('msg'); 
redirect('/admin/user_profile', 'refresh'); 

}

public function profileimg(){
  $id_admin=$this->session->userdata['id_admin'];
//echo $_FILES['file']['name'];
if($_FILES['file']['name']!=""){

  $logo = $this->data->get_table_row('admin',array('id'=>$id_admin),'img'); 
  if ($logo != "") {
  unlink("site/ar/images/site_setting/$logo");
  }
 
  $img_name=$this->gen_random_string(); 
  $imagename = $img_name;
  $config['upload_path'] = 'site/ar/images/site_setting/';
  $config['allowed_types']        = 'gif|jpg|png|jpeg';
  $config['max_size']             =600000;
  $config['max_width']            = 600000;
  $config['max_height']           = 600000;
  $config['file_name'] = $imagename; 
  $this->load->library('upload', $config);
  $this->upload->initialize($config);
  if (!$this->upload->do_upload('file')){
  echo $this->upload->display_errors();
   }
  else {
  $url= $_FILES['file']['name'];
  $ext = explode(".",$url);
  $file_extension = end($ext);
  $data = array('img'=>$imagename.".".$file_extension);
  $this->db->update('admin',$data,array('id'=>$id_admin));
  $this->session->set_flashdata('msg', 'Your request update success');
$this->session->mark_as_flash('msg'); 
redirect('/admin/user_profile', 'refresh'); 
    }
  
    }

  }
public function logout(){
  $this->load->view('admin/logout');
}

    public function sendpassword($mail)
    {
      $this->load->library('email');
      $email = $mail;
      $findemail = $this->data->get_table_row('admin',array('mail'=>$email),'id');
      $name = $this->data->get_table_row('admin',array('mail'=>$email),'username');
      //echo $findemail;die;
      if (count($findemail)>0)
        {
          $passwordplain = "";
          $passwordplain  = $this->gen_random_string();
          $newpass = md5($passwordplain);
          $data = array('password'=>$newpass);
          $this->data->edit_table('admin',$findemail,$data);
          $subject = 'Your Reset Password';
          $mail_message='Dear '.$name.','. "\r\n";
          $mail_message.='Thanks for contacting regarding to forgot password,<br> Your New <b>Password</b> is <b>'.$passwordplain.'</b>'."\r\n";
          $mail_message.='<br>Please Update your password.';
          $mail_message.='<br>Thanks & Regards';
          $mail_message.='<br>Dmitry.com';
          $message = $mail_message;
          $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml">
          <head>
              <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
              <title>' . html_escape($subject) . '</title>
              <style type="text/css">
                  body {
                      font-family: Arial, Verdana, Helvetica, sans-serif;
                      font-size: 16px;
                  }
              </style>
          </head>
          <body>
          ' . $message . '
          </body>
          </html>';
          $result = $this->email
        ->from('islam.devphp@gmail.com')
        ->reply_to('islam.devphp@gmail.com')    // Optional, an account where a human being reads.
        ->to($email)
        ->subject($subject)
        ->message($body)
        ->send();
    
        //var_dump($result);
        if($result==true){
          $this->session->set_flashdata('msg','Password sent to your email!');
          redirect(base_url().'admin/login','refresh');
        }else{
          $this->session->set_flashdata('msg','Failed to send password, please try again!');
          redirect(base_url().'admin/login','refresh');
        }
        //echo $this->email->print_debugger();
        }
        else
        {  
         $this->session->set_flashdata('msg','Email not found try again!');
         redirect(base_url().'admin/login','refresh');
        }
    }
        
    
    public function ForgotPassword()
    {
      $email = $this->input->post('email');      
      $findemail = $this->data->get_table_row('admin',array('mail'=>$email),'mail');
      if($findemail){
      $this->sendpassword($findemail);        
      }else{
      $this->load->helper('url');
      $this->session->set_flashdata('msg','Email not found!');
      redirect(base_url().'admin/login','refresh');
      }
    }

    public function submit_login(){
      $dd=base_url();
      ob_start();
          $username = $this->security->sanitize_filename($this->input->post('user_name'),true);
          $password = $this->security->sanitize_filename($this->input->post('password'),true);
          $passwordp=md5($password);
           //echo $username;
           //echo $password;
          $customer_id="";
      $customer_id = $this->data->get_table_row('admin',array('username'=>$username,'password'=>$passwordp,'view'=>'1'),'id');
          if($customer_id != ""){
          $site_name = $this->data->get_table_row('site_info',array(),'name');
          $site_favicon = $this->data->get_table_row('site_info',array(),'favicon');
          $username =$this->data->get_table_row('admin',array('id'=>$customer_id),'username');
          $type =$this->data->get_table_row('admin',array('id'=>$customer_id),'type');
          $last_login =$this->data->get_table_row('admin',array('id'=>$customer_id),'last_login');
                     $this->session->set_userdata(array('id_admin' => $customer_id));
          $this->session->set_userdata(array('admin_name' => $username));
          $this->session->set_userdata(array('type_admin' => $type));
          $this->session->set_userdata(array('last_login' => $last_login));
          $this->session->set_userdata(array('site_name' => $site_name));
          $this->session->set_userdata(array('site_favicon' => $site_favicon));
          if(isset($_SESSION['admin_name'])){
           //echo $_SESSION['admin_name'];
           //$url = $dd.'admin';
          //header("location:$url");
          redirect(base_url().'admin/','refresh');
          }
          }
          else {
            //$url = $dd.'admin/login';
            //header("location:$url");
            $this->session->set_flashdata('msg','Error in username or password');
            redirect(base_url().'admin/login','refresh');
          }      
}

public function team_work(){
  $pg_config['sql'] = $this->data->get_sql('admin','','id','DESC');
  $pg_config['per_page'] =15;
  $data = $this->lib_pagination->create_pagination($pg_config);
  //print_r($data);die;
  $this->load->view("admin/admin/team_work", $data); 
  }





 public function add_admin(){
 $this->load->view('admin/admin/add_admin',$this->data);
    } 

  

public function update_admin(){
$this->load->view("admin/admin/update_admin");
    }



public function admin_action(){
  $mail=$this->input->post('mail');
  $username = $this->input->post('username');
  $fname=$this->input->post('fname');
  $lname=$this->input->post('lname');
  $phone=$this->input->post('phone');
  $permission=$this->input->post('permission');
  $password=$this->input->post('password');
 
  
  $data_inerest= array('password'=>md5($password),'type'=>$permission,'mail'=>$mail,'username'=>$username,'fname'=>$fname,'lname'=>$lname,'phone'=>$phone);
  $this->db->insert('admin',$data_inerest);  
  $insert_id = $this->db->insert_id();
  
 
 
  if($_FILES['file']['name']!=""){
 
   $img_name=$this->gen_random_string(); 
   $imagename = $img_name;
   $config['upload_path'] = 'site/ar/images/site_setting/';
   $config['allowed_types']        = 'gif|jpg|png|jpeg';
   $config['max_size']             =600000;
   $config['max_width']            = 600000;
   $config['max_height']           = 600000;
   $config['file_name'] = $imagename; 
   $this->load->library('upload', $config);
   $this->upload->initialize($config);
   if (!$this->upload->do_upload('file')){
   echo $this->upload->display_errors();
    }
   else {
   $url= $_FILES['file']['name'];
   $ext = explode(".",$url);
   $file_extension = end($ext);
   $data = array('img'=>$imagename.".".$file_extension);
   $this->db->update('admin',$data,array('id'=>$insert_id));
    //echo $this->db->last_query();
  //die();
     }
   
     }
 
 
 $this->session->set_flashdata('msg', 'Data added successfully');
 $this->session->mark_as_flash('msg');
 redirect('/admin/team_work', 'refresh');
}

public function update_admin_action(){
 $id=$this->input->post('id');
 $mail=$this->input->post('mail');
 $username = $this->input->post('username');
 $fname=$this->input->post('fname');
 $lname=$this->input->post('lname');
 $phone=$this->input->post('phone');
 $permission=$this->input->post('permission');
 $password=$this->input->post('password');

 
 $data_inerest= array('mail'=>$mail,'username'=>$username,'fname'=>$fname,'lname'=>$lname,'phone'=>$phone);
 $this->data->edit_table('admin',$id,$data_inerest);  

 if($password!=""){
  $datapassword = array('password'=>md5($password));
 $this->data->edit_table('admin',$id,$datapassword);    
 }

 if($permission!=""){
 $datapermission= array('type'=>$permission);
 $this->data->edit_table('admin',$id,$datapermission);
 }


 if($_FILES['file']['name']!=""){


  $logo = $this->data->get_table_row('admin',array('id'=>$id),'img'); 
  if ($logo != "") {
  unlink("site/ar/images/site_setting/$logo");
  }
  $img_name=$this->gen_random_string(); 
  $imagename = $img_name;
  $config['upload_path'] = 'site/ar/images/site_setting/';
  $config['allowed_types']        = 'gif|jpg|png|jpeg';
  $config['max_size']             =600000;
  $config['max_width']            = 600000;
  $config['max_height']           = 600000;
  $config['file_name'] = $imagename; 
  $this->load->library('upload', $config);
  $this->upload->initialize($config);
  if (!$this->upload->do_upload('file')){
  echo $this->upload->display_errors();
   }
  else {
  $url= $_FILES['file']['name'];
  $ext = explode(".",$url);
  $file_extension = end($ext);
  $data = array('img'=>$imagename.".".$file_extension);
  $this->db->update('admin',$data,array('id'=>$id));
   //echo $this->db->last_query();
 //die();
    }
  
    }


$this->session->set_flashdata('msg', 'Data added successfully');
$this->session->mark_as_flash('msg');
redirect('/admin/team_work', 'refresh');
 }

public function delete_admin(){
   $product_id = $this->input->get('id_type');
  //echo $product_id;
   $check=$this->input->post('check');
   if($product_id!=""){
   $ret_value=$this->data->delete_table_row('admin',array('id'=>$product_id)); 
   }

      if(isset($check)&&$check!=""){  
   $check=$this->input->post('check');
   $length=count($check);
   for($i=0;$i<$length;$i++){
   $ret_value=$this->data->delete_table_row('admin',array('id'=>$check[$i]));    
    }
   }
 
 $this->session->set_flashdata('msg', 'Data added successfully');
$this->session->mark_as_flash('msg');
 redirect('/admin/team_work?success', 'refresh');

  }

   public function check_view_teamwork(){    
    $id = $this->input->post("id");
    $ser = $this->db->get_where("admin",array("id"=>$id,"view" => "1"))->num_rows();
    if ($ser == 1) {
      $this->db->update("admin",array("view" => "0"),array("id"=>$id));
      echo "0";
    }
    if ($ser == 0) {
      $this->db->update("admin",array("view" => "1"),array("id"=>$id));
      echo "1";
    }    

  }   

/********************************************************************

*********************************************************************

*********************************************************************

******Gen_Random_String**********************************************/

public function setting(){

//$site_info=$this->db->get_where('site_info')->result();
$this->load->view('admin/setting');
  }

public function update_setting(){
$site_name=$this->input->post('site_name');
$facebook=$this->input->post('facebook');
$twitter=$this->input->post('twitter');
$google_pluse=$this->input->post('google_pluse');
$linkedin=$this->input->post('linkedin');
$email_sales=$this->input->post('email_sales');
$email_support=$this->input->post('email_support');
$meta_desc=$this->input->post('meta_desc');
$key_words=$this->input->post('key_words');
$on_off=$this->input->post('on_off');
$commision=$this->input->post('commision');

$data = array('site_name'=>$site_name,'email_sales'=>$email_sales,'email_support'=>$email_support,
'facebook'=>$facebook,'twitter'=>$twitter,'google_pluse'=>$google_pluse,'linkedin'=>$linkedin,
'key_words'=>$key_words,'meta_desc'=>$meta_desc,'offline_website'=>$on_off,'commision'=>$commision);
$this->db->update('site_info',$data,array('id'=>1));
echo $this->db->last_query();
//die();
//echo "fFF".$_FILES['file']['name'];
if($_FILES['file']['name']!=""){
  $logo = $this->data->get_table_row('site_info',array('id'=>1),'logo'); 
  if ($logo != "") {
  unlink("site/ar/images/site_setting/$logo");
  }
  $img_name=$this->gen_random_string(); 
  $imagename = $img_name;
  $config['upload_path'] = 'site/ar/images/site_setting/';
  $config['allowed_types']        = 'gif|jpg|png|jpeg';
  $config['max_size']             =600000;
  $config['max_width']            = 600000;
  $config['max_height']           = 600000;
  $config['file_name'] = $imagename; 
  $this->load->library('upload', $config);
  $this->upload->initialize($config);
  if (!$this->upload->do_upload('file')){
  echo $this->upload->display_errors();
   }
  else {
  $url= $_FILES['file']['name'];
  $ext = explode(".",$url);
  $file_extension = end($ext);
  $data = array('logo'=>$imagename.".".$file_extension);
  $this->db->update('site_info',$data,array('id'=>1));
   //echo $this->db->last_query();
 //die();
    }
  
    }



    if($_FILES['file1']['name']!=""){
      $logo = $this->data->get_table_row('site_info',array('id'=>1),'favicon'); 
      if ($logo != "") {
      unlink("site/ar/images/site_setting/$logo");
      }
      $img_name=$this->gen_random_string(); 
      $imagename = $img_name;
      $config['upload_path'] = 'site/ar/images/site_setting/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg';
      $config['max_size']             =600000;
      $config['max_width']            = 600000;
      $config['max_height']           = 600000;
      $config['file_name'] = $imagename; 
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if (!$this->upload->do_upload('file1')){
      echo $this->upload->display_errors();
       }
      else {
      $url= $_FILES['file1']['name'];
      $ext = explode(".",$url);
      $file_extension = end($ext);
      $data = array('favicon'=>$imagename.".".$file_extension);
      $this->db->update('site_info',$data,array('id'=>1));
        }
        }

if($_FILES['file2']['name']!=""){
      $logo = $this->data->get_table_row('site_info',array('id'=>1),'logo2'); 
      if ($logo != "") {
      unlink("site/ar/images/site_setting/$logo");
      }
      $img_name=$this->gen_random_string(); 
      $imagename = $img_name;
      $config['upload_path'] = 'site/ar/images/site_setting/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg';
      $config['max_size']             =600000;
      $config['max_width']            = 600000;
      $config['max_height']           = 600000;
      $config['file_name'] = $imagename; 
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if (!$this->upload->do_upload('file2')){
      echo $this->upload->display_errors();
       }
      else {
      $url= $_FILES['file2']['name'];
      $ext = explode(".",$url);
      $file_extension = end($ext);
      $data = array('logo2'=>$imagename.".".$file_extension);
      $this->db->update('site_info',$data,array('id'=>1));
        }
}


$this->session->set_flashdata('msg', 'Data added successfully');
$this->session->mark_as_flash('msg');
redirect('/admin/setting');
  }

  

/********************************************************************************************************
*********************************************************************************************************
*************************************************Start Notes Section*************************************
*********************************************************************************************************/

public  function dbrestor_action(){
$this->load->view('config/dbrestor');
}

public  function dbrestor(){
$this->load->view('dbrestor');
}

public  function restdb(){
$this->load->view('restdb');
}   

public  function rest_db(){
$this->load->view('config/rest_db');
}



/*****************************************************************************************************

******************************************************************************************************

***********************END SLIDER HOME & NOTESn*******************************************************

******************************************************************************************************/

  public function delete_gallery_article()  {    
  $id_img = $this->uri->segment(3);
  $row1 = $this->db->get_where("gallery_article",array("id" => $id_img))->result();
  foreach ($row1 as $row1) {
unlink("./site/ar/images/articles/".$row1->img);
}
if ($this->data->delete_table_row("gallery_article",array("id" => $id_img))) {
redirect($_SERVER['HTTP_REFERER']);
}
}  
  public function delete_gallery_accolade()

  {    

  $id_img = $this->uri->segment(3);

  $row1 = $this->db->get_where("sub_accolade",array("id" => $id_img))->result();

  foreach ($row1 as $row1) {
    unlink("./site/ar/images/".$row1->img);
  }
  if ($this->data->delete_table_row("sub_accolade",array("id" => $id_img))) {
redirect($_SERVER['HTTP_REFERER']);



  }

  } 
  public function delete_gallery_pages()

  {    

  $id_img = $this->uri->segment(3);

  $row1 = $this->db->get_where("gallery_pages",array("id" => $id_img))->result();

  foreach ($row1 as $row1) {

    unlink("./site/ar/images/".$row1->img);



  }  

  if ($this->data->delete_table_row("gallery_pages",array("id" => $id_img))) {



    redirect($_SERVER['HTTP_REFERER']);



  }

  }


public function add_user(){

$this->data = array(

'num_admin'=> $this->data->get_table_data('admin'),

'site_info'=> $this->data->get_table_data('site_info'));

$this->load->view('add_user',$this->data);

}




public function pages_action(){
$this->load->view('config/pages_action');
}
public function accolade_action(){

$this->load->view('config/accolade_action');

}



public function pages(){

$this->data = array(

'num_admin'=> $this->data->get_table_data('admin'),

'site_info'=> $this->data->get_table_data('site_info'));

$this->load->view('pages',$this->data);

}

/**************************************************************************************

***********************************Start Sub Values************************************

****************************************Start Articles**********************************/



public function articles(){
    $tables = "articles";
    $config = array();
    $config['base_url'] = base_url().'home/articles'; 
    $config['total_rows'] = $this->data->record_count($tables,array(),'','id','desc');
    $config['per_page'] =20;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';   
    $config['last_link'] = '»»';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['first_link'] = '««';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '«';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '»';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a>';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);
if($this->uri->segment(3)){
$page = ($this->uri->segment(3)) ;
}
else{
$page =0;
}

$rs = $this->db->get($tables);
if($rs->num_rows() == 0):
$data["results"] = array();
$data["links"] = array();
$data['num_admin']= $this->data->get_table_data('admin');
$data['site_info']= $this->data->get_table_data('site_info');
else:
$data['num_admin']= $this->data->get_table_data('admin');
$data['site_info']= $this->data->get_table_data('site_info');
$data["results"] = $this->data->view_all_data($tables, array(), $config["per_page"], $page);
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
$this->load->view('articles/articles',$data);
  }

  public function search_articles(){

    $tables = "articles";
    $title = $this->input->post("search");
    $config = array();

    $config['base_url'] = base_url().'home/search_articles'; 
    $this->db->like('title', $title);
    $this->db->order_by('id', 'desc');
    $config['total_rows'] = $this->db->get($tables)->num_rows();

    $config['per_page'] =20;

    $config['full_tag_open'] = '<ul class="pagination">';

    $config['full_tag_close'] = '</ul>';   

    $config['last_link'] = '»»';

    $config['last_tag_open'] = '<li>';

    $config['last_tag_close'] = '</li>';

    $config['first_link'] = '««';

    $config['first_tag_open'] = '<li>';

    $config['first_tag_close'] = '</li>';

    $config['prev_link'] = '«';

    $config['prev_tag_open'] = '<li>';

    $config['prev_tag_close'] = '</li>';

    $config['next_link'] = '»';

    $config['next_tag_open'] = '<li>';

    $config['next_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="active"><a>';

    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li>';

    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);

if($this->uri->segment(3)){

$page = ($this->uri->segment(3)) ;

}

else{

$page =0;

}
    $this->db->like('title', $title);
    $this->db->order_by('id', 'desc');
$rs = $this->db->get($tables);


if($rs->num_rows() == 0):

$data["results"] = array();

$data["links"] = array();



$data['num_admin']= $this->data->get_table_data('admin');

$data['site_info']= $this->data->get_table_data('site_info');

else:

$data['num_admin']= $this->data->get_table_data('admin');

$data['site_info']= $this->data->get_table_data('site_info');
$data["results"] = $this->data->view_all_data_search($tables,$title, array(), $config["per_page"], $page);
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
$this->load->view('articles/search_articles',$data);

  }
  
  



public function add_article(){
$this->data = array(
'num_admin'=> $this->data->get_table_data('admin'),
'site_info'=> $this->data->get_table_data('site_info'));
$this->load->view('articles/add_article',$this->data);
}

 
public function delete_vote(){

  $product_id = $this->input->get('id');

  $check=$this->input->post('check');

  if($product_id!=""){

 

  $ret_value=$this->data->delete_table_row('vote_content',array('id'=>$product_id));

   

    }

  if(isset($check)&&$check!=""){  

  $check=$this->input->post('check');

  $length=count($check);

  for($i=0;$i<$length;$i++){

    

  $ret_value=$this->data->delete_table_row('vote_content',array('id'=>$check[$i]));     

  }



   }

$this->load->helper('url');

redirect('/home/vote?success', 'refresh');

  }





public function update_article(){
$id_lnews=$this->input->get('id');
$this->data = array(
'num_admin'=> $this->data->get_table_data('admin'),
'site_info'=> $this->data->get_table_data('site_info'),
'articles' => $this->data->get_table_data('articles',array('id'=>$id_lnews)));
$this->load->view('articles/update_article',$this->data);
}



public function update_articles()

{
$title=$this->input->post('title');
    $description=$this->input->post('description');
    $date=$this->input->post('date');
    $short_description=$this->input->post('short_description');
    $meta_keywords=$this->input->post('meta_keywords');
    $meta_description=$this->input->post('meta_description');
  $idnews=$this->input->post('id');
    $titleeng=$this->input->post('titleeng');
    $short_descriptioneng=$this->input->post('short_descriptioneng');
    $descriptioneng=$this->input->post('descriptioneng');
    $sel=$this->input->post('sel');
    $link=$this->input->post('link');
    $video=$this->input->post('video');
    $date=$this->input->post('date');


    if($sel == "link" and $link != "")

    {
if ($this->db->get_where('link',array('id_article'=>$idnews,'type'=>'0'))->num_rows() > 0) {
        $this->db->update('link',array("link"=>$link),array('id_article'=>$idnews,'type'=>'0'));
      }else{
        $this->db->insert('link',array("link"=>$link,'id_article'=>$idnews,'type'=>'0'));
      }
 $this->data->delete_table_row('gallery_article',array('id_article'=>$idnews,'type'=>'0'));
      $this->data->delete_table_row('video',array('id_article'=>$idnews,'type'=>'0'));
}

    if($sel == "video" and $video != "")

    {

      if ($this->db->get_where('video',array('id_article'=>$idnews,'type'=>'0'))->num_rows() > 0) {

        $this->db->update('video',array("video"=>$video),array('id_article'=>$idnews,'type'=>'0'));

      }else{

        $this->db->insert('video',array("video"=>$video,'id_article'=>$idnews,'type'=>'0'));

      }

      $this->data->delete_table_row('gallery_article',array('id_article'=>$idnews,'type'=>'0'));

      $this->data->delete_table_row('link',array('id_article'=>$idnews,'type'=>'0'));



    }





    $data = array('title'=>$title,'description'=>$description,'type'=>$sel,'titleeng'=>$titleeng,'meta_keywords'=>$meta_keywords,'meta_description'=>$meta_description,'type'=>$sel,'short_description'=>$short_description,"short_descriptioneng"=>$short_descriptioneng,'descriptioneng'=>$descriptioneng);
    $re=$this->data->edit_table('articles',$idnews,$data);

    if($_FILES['main_img']['name']!=""){
    $img_right = $this->data->get_table_row('articles',array('id'=>$idnews),'img'); 
    $img_name=$this->gen_random_string(); 
    $imagename = $img_name;
    $config['upload_path'] = '../site/ar/images/articles/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             =100000;
    $config['max_width']            =100000;
    $config['max_height']           =100000;

    $config['file_name'] = $imagename; 
    $this->load->library('upload', $config);
        $this->upload->initialize($config);
    if (!$this->upload->do_upload('main_img')){
	 echo $this->upload->display_errors();
    }

    else {
    $url= $_FILES['main_img']['name'];
    $ext = explode(".",$url);
    $file_extension = end($ext);
    @unlink("../site/ar/images/articles/$img_right"); 
    $data = array('img'=>$imagename.".".$file_extension);
    $this->data->edit_table('articles',$idnews,$data);
    }

    }
      $send['idnews'] = $idnews; 
    if($sel == "slider")

    {
      $this->data->delete_table_row('video',array('id_article'=>$idnews,'type'=>'0'));
      $this->data->delete_table_row('link',array('id_article'=>$idnews,'type'=>'0'));
        $this->load->view('code_img',$send);
		}
 $this->load->helper('url');
redirect('/home/articles?success', 'refresh');  
}

public function add_img_action(){
 $title=$this->input->post('title');
    $id=$this->input->post('id');
    $data['title'] = $title;
    $data['id_accolade'] = $id;

 if ($_FILES['main_img']['name'] != "") {
                $config['upload_path']          = 'site/ar/images/';
                $config['allowed_types']        = 'gif|jpg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('main_img');
                $data1['main_img'] = $this->upload->data();
                $photo = $data1['main_img']['file_name'];
                $data['img'] = $photo;
        }
$this->db->insert("sub_accolade",$data);
    redirect('/home/accolade?success', 'refresh'); 
 }     

public function update_pages_action(){





    $idnews=$this->input->post('id');
    $name=$this->input->post('name');
    $data['name'] = $name;





    $re=$this->data->edit_table('committees',$idnews,$data);



    $this->load->helper('url');

    redirect('/home/pages?success', 'refresh'); 



}
public function user_action(){
$idnews=$this->input->post('id');
    $name=$this->input->post('name');
    $description=$this->input->post('description');
    $data['name'] = $name;
    $data['id_committees'] = $idnews;
    $data['description'] = $description;
$re=$this->db->insert('committees_users',$data);
$this->load->helper('url');
redirect($_SERVER['HTTP_REFERER']);
}
public function services_action(){

    $name=$this->input->post('name');
    $link=$this->input->post('link');
    $data['link'] = $link;
    $data['name'] = $name;


if(@$_FILES['file']['name']!=""){

$img_name=$this->gen_random_string(); 

$imagename = $img_name;

$config['upload_path'] = 'site/ar/images/';

$config['allowed_types']        = 'psd|pdf|dox|gif|jpg|png';

$config['max_size']             =1000000;



$config['file_name'] = $imagename; 

$this->load->library('upload', $config);

                $this->upload->initialize($config);





 if ( ! $this->upload->do_upload('file')){

 }

 

else {

$url= $_FILES['file']['name'];

$ext = explode(".",$url);

$file_extension = end($ext);



$data['file'] = $imagename.".".$file_extension;



  }

  }


    $re=$this->db->insert('services',$data);



    $this->load->helper('url');

redirect('/home/services?success', 'refresh');



}

public function delete_user(){
    $idnews=$this->uri->segment(3);
    $re=$this->db->delete('committees_users',array("id"=>$idnews));
    $this->load->helper('url');
    redirect($_SERVER['HTTP_REFERER']);
}
/***************** START SLIDER **********************/
  public function slider_home(){
  $pg_config['sql'] = $this->data->get_sql('slider','','id_slider','DESC');
  $pg_config['per_page'] =15;
  $data = $this->lib_pagination->create_pagination($pg_config);
  //print_r($data);die;
  $this->load->view("admin/slider/slider_home", $data); 
  }


   public function add_slider(){
$this->data = array(
'num_admin'=> $this->data->get_table_data('admin'),
'site_info'=> $this->data->get_table_data('site_info'));
$this->load->view('admin/slider/add_slider',$this->data);
  }

public function slider_action(){
$metadesc=$this->input->post('title');
$metadesceng=$this->input->post('description');
$link=$this->input->post('link');
if($_FILES['file']['name']!=""){
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = 'site/ar/images/slider/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =1000000;
$config['max_width']            = 1000000;
$config['max_height']           = 1000000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
$this->upload->initialize($config);
if (!$this->upload->do_upload('file')){
echo $this->upload->display_errors();
 }

else {
$url= $_FILES['file']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('image'=>$imagename.".".$file_extension,'title'=>$metadesc,'description'=>$metadesceng,'link'=>$link);
$this->db->insert('slider',$data);
}
	
}

$this->session->set_flashdata('msg', 'Data added successfully');
redirect(base_url().'admin/slider_home','refresh');
}
 
  public function check_view_slider(){
  $id = $this->input->post("id");
  $ser = $this->db->get_where("slider",array("id_slider"=>$id,"active" => "1"))->num_rows();
  if ($ser == 1) {
  $this->db->update("slider",array("active" => "0"),array("id_slider"=>$id));
  echo "0";
  }
  if ($ser == 0) {
  $this->db->update("slider",array("active" => "1"),array("id_slider"=>$id));
  echo "1";
        }      
    } 

public function delete_slider(){
$product_id = $this->input->get('id_type');
$check=$this->input->post('check');
if($product_id!=""){
$img_right = $this->data->get_table_row('slider',array('id_slider'=>$product_id),'image');
if($img_right!=""){ 
unlink("site/ar/images/slider/$img_right");  
}
$ret_value=$this->data->delete_table_row('slider',array('id_slider'=>$product_id));
}
if(isset($check)&&$check!=""){  
  $check=$this->input->post('check');
  $length=count($check);
  for($i=0;$i<$length;$i++){
$img_right = $this->data->get_table_row('slider',array('id_slider'=>$check[$i]),'image');
if($img_right!=""){ 
unlink("site/ar/images/slider/$img_right");  
}
$ret_value=$this->data->delete_table_row('slider',array('id_slider'=>$check[$i]));     
 }
 }
 $this->load->helper('url');
 $this->session->set_flashdata('msg', 'Data Deleted successfully');
 $this->session->mark_as_flash('msg');
 redirect('/admin/slider_home', 'refresh');
  }
  
    public function update_slider(){
		$id_slider=$this->input->get('id_type');
$this->data = array(
'num_admin'=> $this->data->get_table_data('admin'),
'site_info'=> $this->data->get_table_data('site_info'),
'silder_data'=> $this->data->get_table_data('slider',array('id_slider'=>$id_slider)));
$this->session->set_flashdata('msg', 'Data Updated successfully');
$this->session->mark_as_flash('msg');
$this->load->view('admin/slider/update_slider',$this->data);
  } 
  
  
 public function updateslider_action(){
  $metadesc=$this->input->post('title');
  $metadesceng=$this->input->post('description');
  $link=$this->input->post('link');
$id=$this->input->post('id');
$data = array('title'=>$metadesc,'description'=>$metadesceng,'link'=>$link);
$this->db->update('slider',$data,array('id_slider'=>$id));

if($_FILES['file']['name']!=""){
  $logo = $this->data->get_table_row('slider',array('id_slider'=>$id),'image'); 
  if ($logo != "") {
  unlink("site/ar/images/slider/$logo");
  }
  $img_name=$this->gen_random_string(); 
  $imagename = $img_name;
  $config['upload_path'] = 'site/ar/images/slider/';
  $config['allowed_types']        = 'gif|jpg|png|jpeg';
  $config['max_size']             =600000;
  $config['max_width']            = 600000;
  $config['max_height']           = 600000;
  $config['file_name'] = $imagename; 
  $this->load->library('upload', $config);
  $this->upload->initialize($config);
  if (!$this->upload->do_upload('file')){
  echo $this->upload->display_errors();
   }
  else {
  $url= $_FILES['file']['name'];
  $ext = explode(".",$url);
  $file_extension = end($ext);
  $data = array('image'=>$imagename.".".$file_extension);
  $this->db->update('slider',$data,array('id_slider'=>$id));
    }
  
    }


$this->load->helper('url');
$this->session->set_flashdata('msg', 'Data added successfully');
$this->session->mark_as_flash('msg');
redirect('/admin/slider_home', 'refresh');
  }
/********************************************************************/
/**************************************24-12-2017********************************/
 public function delete_gallery()  {    
  $id_img = $this->uri->segment(3);
  $row1 = $this->db->get_where("gallery",array("id" => $id_img))->result();
  foreach ($row1 as $row1) {
unlink("./site/ar/images/articles/".$row1->img);
}
if ($this->data->delete_table_row("gallery",array("id" => $id_img))) {
redirect($_SERVER['HTTP_REFERER']);
}
}  
/***************************************End 24-12-2017************************************************/
/***************************************Start 1-1-2018************************************************/





 

/***************************************End 1-1-2018************************************************/






/**********************************************4-1-2018*************************************************
/********************************************Start Country*************************************************/
public function country(){
  $pg_config['sql'] = $this->data->get_sql('country','','id_country','DESC');
  $pg_config['per_page'] = 10;
  $data = $this->lib_pagination->create_pagination($pg_config);
  $this->load->view("admin/places/country", $data); 
}

public function add_country(){
$this->load->view("admin/places/add_country"); 
}

public function country_action(){
  $id_country=$this->input->post('id_country');
  $data['title'] = $id_country;
  if($_FILES['file']['name']!=""){
    $img_name=$this->gen_random_string(); 
    $imagename = $img_name;
    $config['upload_path'] = 'site/ar/images/flag/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $config['max_size']             =600000;
    $config['max_width']            = 600000;
    $config['max_height']           = 600000;
    $config['file_name'] = $imagename; 
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if (!$this->upload->do_upload('file')){
    echo $this->upload->display_errors();
     }
    else {
    $url= $_FILES['file']['name'];
    $ext = explode(".",$url);
    $file_extension = end($ext);
    $data['flag'] =$imagename.".".$file_extension;
      }
      }
  $this->data->insert_filed('country',$data);
  $id = $this->db->insert_id();
  $this->load->helper('url');
  $this->session->set_flashdata('msg', 'Data added successfully');
$this->session->mark_as_flash('msg');
redirect('/admin/country');
  }

  public function check_view_country(){
    $id = $this->input->post("id");
      $ser = $this->db->get_where("country",array("id_country"=>$id,"active" => "1"))->num_rows();
      if ($ser == 1) {
        $this->db->update("country",array("active" => "0"),array("id_country"=>$id));
        echo "0";
      }
      if ($ser == 0) {
        $this->db->update("country",array("active" => "1"),array("id_country"=>$id));
        echo "1";
      }      
  } 
  

  

  public function delete_country(){
    $product_id = $this->input->get('id_type');
    $check=$this->input->post('check');
    if($product_id!=""){
    $ret_value=$this->data->delete_table_row('country',array('id_country'=>$product_id)); 
    }
 if(isset($check)&&$check!=""){  
    $check=$this->input->post('check');
    $length=count($check);
    for($i=0;$i<$length;$i++){
    $ret_value=$this->data->delete_table_row('country',array('id_country'=>$check[$i]));    
     }
    }
    $this->session->set_flashdata('msg', 'Data added successfully');
    $this->session->mark_as_flash('msg');
    redirect('/admin/country');
  }

  public function update_country(){
    $id_type=$this->input->post('id_type');
    $data['data']= $this->data->get_table_data('country',array('id_country'));
    $this->load->view("admin/places/update_country",$data); 
    }
    
    public function update_country_action(){
      $title=$this->input->post('id_country');
      $id_type=$this->input->post('id');
      $data['title'] = $title;

      $this->db->update('country',$data,array('id_country'=>$id_type));
    
      if($_FILES['file']['name']!=""){
        $img_name=$this->gen_random_string(); 
        $imagename = $img_name;
        $config['upload_path'] = 'site/ar/images/flag/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             =600000;
        $config['max_width']            = 600000;
        $config['max_height']           = 600000;
        $config['file_name'] = $imagename; 
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file')){
        echo $this->upload->display_errors();
         }
        else {
        $url= $_FILES['file']['name'];
        $ext = explode(".",$url);
        $file_extension = end($ext);
        $datap['flag'] =$imagename.".".$file_extension;
        $this->db->update('country',$datap,array('id_country'=>$id_type));
          }
          }


      $this->load->helper('url');
      $this->session->set_flashdata('msg', 'Data added successfully');
    $this->session->mark_as_flash('msg');
    redirect('/admin/country');
      }

      /******************************************************state*********************/

      public function state(){
        $pg_config['sql'] = $this->data->get_sql('state',array('type'=>'1'),'id_state','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/places/state", $data); 
      }
      
      public function add_state(){
      $this->load->view("admin/places/add_state"); 
      }
      
      public function state_action(){
        $state=$this->input->post('state');
        $id_country=$this->input->post('id_country');
        $data['title'] = $state;
        $data['country_id'] = $id_country;
        
        $this->data->insert_filed('state',$data);
        $this->load->helper('url');
        $this->session->set_flashdata('msg', 'Data added successfully');
      $this->session->mark_as_flash('msg');
      redirect('/admin/state');
        }
      
        public function check_view_state(){
          $id = $this->input->post("id");
            $ser = $this->db->get_where("state",array("id_state"=>$id,"active" => "1"))->num_rows();
            if ($ser == 1) {
              $this->db->update("state",array("active" => "0"),array("id_state"=>$id));
              echo "0";
            }
            if ($ser == 0) {
              $this->db->update("state",array("active" => "1"),array("id_state"=>$id));
              echo "1";
            }      
        } 
        
      
        
      
        public function delete_state(){
          $product_id = $this->input->get('id_type');
          $check=$this->input->post('check');
          if($product_id!=""){
          $ret_value=$this->data->delete_table_row('state',array('id_state'=>$product_id)); 
          }
       if(isset($check)&&$check!=""){  
          $check=$this->input->post('check');
          $length=count($check);
          for($i=0;$i<$length;$i++){
          $ret_value=$this->data->delete_table_row('state',array('id_state'=>$check[$i]));    
           }
          }
          $this->session->set_flashdata('msg', 'Data added successfully');
          $this->session->mark_as_flash('msg');
          redirect('/admin/state');
        }
      
        public function update_state(){
          $id_type=$this->input->post('id_type');
          $data['data']= $this->data->get_table_data('state',array('id_state'));
          $this->load->view("admin/places/update_state",$data); 
          }
          
          public function update_state_action(){
            $id_country=$this->input->post('id_country');
            $id_type=$this->input->post('id');
            $title=$this->input->post('title');
            $data['title'] = $title;
            $this->db->update('state',$data,array('id_state'=>$id_type));
            if($id_country!=0){
              $datap['country_id'] = $id_country;
              $this->db->update('state',$datap,array('id_state'=>$id_type));
                }
      
      
            $this->load->helper('url');
            $this->session->set_flashdata('msg', 'Data added successfully');
          $this->session->mark_as_flash('msg');
          redirect('/admin/state');
            }
      /***********************************************Start City******************************/
      

      public function city(){
        $pg_config['sql'] = $this->data->get_sql('state',array('type'=>'2'),'id_state','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/places/city", $data); 
      }
      
      public function add_city(){
      $this->load->view("admin/places/add_city"); 
      }
      
      public function city_action(){
        $state=$this->input->post('state');
        $parent_id=$this->input->post('id_country');
        $data['title'] = $state;
        $data['type'] = '2';
        $data['parent_id'] = $parent_id;
        
        $this->data->insert_filed('state',$data);
        $this->load->helper('url');
        $this->session->set_flashdata('msg', 'Data added successfully');
      $this->session->mark_as_flash('msg');
      redirect('/admin/city');
        }
      
        public function check_view_city(){
          $id = $this->input->post("id");
            $ser = $this->db->get_where("state",array("id_state"=>$id,"active" => "1"))->num_rows();
            if ($ser == 1) {
              $this->db->update("state",array("active" => "0"),array("id_state"=>$id));
              echo "0";
            }
            if ($ser == 0) {
              $this->db->update("state",array("active" => "1"),array("id_state"=>$id));
              echo "1";
            }      
        } 
        
      
        
      
        public function delete_city(){
          $product_id = $this->input->get('id_type');
          $check=$this->input->post('check');
          if($product_id!=""){
          $ret_value=$this->data->delete_table_row('state',array('id_state'=>$product_id)); 
          }
       if(isset($check)&&$check!=""){  
          $check=$this->input->post('check');
          $length=count($check);
          for($i=0;$i<$length;$i++){
          $ret_value=$this->data->delete_table_row('state',array('id_state'=>$check[$i]));    
           }
          }
          $this->session->set_flashdata('msg', 'Data added successfully');
          $this->session->mark_as_flash('msg');
          redirect('/admin/city');
        }
      
        public function update_city(){
          $id_type=$this->input->post('id_type');
          $data['data']= $this->data->get_table_data('state',array('id_state'));
          $this->load->view("admin/places/update_city",$data); 
          }
          
          public function update_city_action(){
            $parent_id=$this->input->post('parent_id');
            $id_type=$this->input->post('id');
            $title=$this->input->post('title');
            $data['title'] = $title;
            $this->db->update('state',$data,array('id_state'=>$id_type));
            if($parent_id!=0){
              $datap['parent_id'] = $parent_id;
              $this->db->update('state',$datap,array('id_state'=>$id_type));
                }
      
            $this->load->helper('url');
            $this->session->set_flashdata('msg', 'Data added successfully');
          $this->session->mark_as_flash('msg');
          redirect('/admin/city');
            }

/**********************************************End Country***************************************************/
public function porperty_type(){
  $pg_config['sql'] = $this->data->get_sql('list_type','','id_list_type','DESC');
  $pg_config['per_page'] = 10;
  $data = $this->lib_pagination->create_pagination($pg_config);
  $this->load->view("admin/property/porperty_type", $data); 
}

public function add_property(){
$this->load->view("admin/property/add_property"); 
}

public function property_action(){
  $title=$this->input->post('property_type');
  $data['title'] = $title;
  $this->data->insert_filed('list_type',$data);
  $id = $this->db->insert_id();
  $this->load->helper('url');
  $this->session->set_flashdata('msg', 'Data added successfully');
$this->session->mark_as_flash('msg');
redirect('/admin/porperty_type');
  }

  public function check_view_type(){
    $id = $this->input->post("id");
      $ser = $this->db->get_where("list_type",array("id_list_type"=>$id,"view" => "1"))->num_rows();
      if ($ser == 1) {
        $this->db->update("list_type",array("view" => "0"),array("id_list_type"=>$id));
        echo "0";
      }
      if ($ser == 0) {
        $this->db->update("list_type",array("view" => "1"),array("id_list_type"=>$id));
        echo "1";
      }      
  } 
  

  

  public function delete_lisiting_type(){
    $product_id = $this->input->get('id_type');
    $check=$this->input->post('check');
    if($product_id!=""){
    $ret_value=$this->data->delete_table_row('list_type',array('id_list_type'=>$product_id)); 
    }
 if(isset($check)&&$check!=""){  
    $check=$this->input->post('check');
    $length=count($check);
    for($i=0;$i<$length;$i++){
    $ret_value=$this->data->delete_table_row('list_type',array('id_list_type'=>$check[$i]));    
     }
    }
    $this->session->set_flashdata('msg', 'Data added successfully');
    $this->session->mark_as_flash('msg');
    redirect('/admin/porperty_type');
  }

  public function update_lisiting_type(){
    $id_type=$this->input->post('id_type');
    $data['data']= $this->data->get_table_data('list_type',array('id_list_type'));
    $this->load->view("admin/property/update_lisiting_type",$data); 
    }
    
    public function lisiting_type_action(){
      $title=$this->input->post('title');
      $id_type=$this->input->post('id');
      $data['title'] = $title;
      $this->db->update('list_type',$data,array('id_list_type'=>$id_type));
      $this->load->helper('url');
      $this->session->set_flashdata('msg', 'Data added successfully');
    $this->session->mark_as_flash('msg');
    redirect('/admin/porperty_type');
      }

  

      

      public function messages(){
        $pg_config['sql'] = $this->data->get_sql('messages','','id_message','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/messages/messages", $data); 
      }
      public function view_message(){
      $id_type=$this->input->get('id_type');
      $data['viewmessage']=$this->db->get_where('messages',array('id_message'=>$id_type))->result();
     $this->load->view("admin/messages/view_message", $data); 
      }

      
      public function check_password(){
      $password=$this->input->post('newpassword');
$repassword=$this->input->post('confirmpassword');
if($password!=$repassword){$exit="1";}
else if($password==""&&$repassword==""){$exit="1";}
echo json_encode($exit);
      }
      public function old_password(){
        $id_admin=$this->session->userdata['id_admin'];;
        $password=$this->input->post('oldpassword');
$count_pass=$this->db->get_where('admin',array('id'=>$id_admin,'password'=>md5($password)))->result();
 if(count($count_pass)>0){$exit="1";}
 else if(count($count_pass)==0){$exit="2";}
  if($password==""){$exit="3";}
  echo json_encode($exit);
        }

        
        public function editpassword(){
          $id_admin=$this->session->userdata['id_admin'];;
          $newpassword=$this->input->post('newpassword');
             
              $data['password'] = md5($newpassword);
          $re=$this->db->update('admin',$data,array('id'=>$id_admin));
          $this->load->helper('url');
          $this->session->set_flashdata('msg', 'Data added successfully');
        $this->session->mark_as_flash('msg');
        redirect('/admin/user_profile');
          }
      
}



  