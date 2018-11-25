<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper("url");
		$this->load->model('data');
		$this->load->library('pagination');
$this->load->library('email');
$this->load->helper('array');
$this->load->library('session');
$this->load->library('upload');
$this->load->helper(array('form', 'url','text'));
//$this->session->keep_flashdata('msg');
	}
	

public function gen_random_string(){
$chars ="1234567890";//length:36
$final_rand='';
for($i=0;$i<6; $i++) {
$final_rand .= $chars[ rand(0,strlen($chars)-1)];
}
return $final_rand;
}


public function index(){
$this->load->view('pages/home');
	}
		
		
public function news(){
    $tables = "articles";
    $config = array();
    $config['base_url'] = base_url().'home/news'; 
    $config['total_rows'] = $this->data->record_count($tables,array(),'','id','desc');
    $config['per_page'] =21;
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
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
else:
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$data["results"] = $this->data->view_all_data($tables, array('views'=>'1'), $config["per_page"], $page,'id','desc');
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
$this->load->view('pages/news',$data);
  }

	
public function events(){
    $tables = "events";
    $config = array();
    $config['base_url'] = base_url().'home/events'; 
    $config['total_rows'] = $this->data->record_count($tables,array('views'=>'1'),'','id','desc');
    $config['per_page'] =21;
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
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
else:
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$data["results"] = $this->data->view_all_data($tables, array('views'=>'1'), $config["per_page"], $page,'id','desc');
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
$this->load->view('pages/events',$data);
  }	
	


	public function contactus()
	{
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contactx'] = $this->data->get_table_data('contact_info');
$data['slider_home'] = $this->data->get_table_data('slider_home',array('view'=>'1'));
$this->load->view('pages/contactus',$data);
	}


	
	public function aboutus()
	{
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$data['slider_home'] = $this->data->get_table_data('slider_home',array('view'=>'1'));
$this->load->view('pages/aboutus',$data);
	}

	
public function how(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$data['slider_home'] = $this->data->get_table_data('slider_home',array('view'=>'1'));
$this->load->view('pages/how',$data);
}

	/**************************12-12-2017***************************************/
	
public function news_details(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$check = $this->data->get_table_row("articles",array("id"=>$this->uri->segment(3)),"reading");
$sum = $check + 1;
$this->data->edit_table("articles",$this->uri->segment(3),array("reading"=>$sum));
$this->load->view('pages/news_details',$data);
}

public function events_details(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$check = $this->data->get_table_row("events",array("id"=>$this->uri->segment(3)),"reading");
$sum = $check + 1;
$this->data->edit_table("events",$this->uri->segment(3),array("reading"=>$sum));
$this->load->view('pages/events_details',$data);
}

public function action_contact(){
$lang=$this->input->post('lang');
$name=$this->input->post('name');
$phone=$this->input->post('phone');
$email=$this->input->post('email');
$subject=$this->input->post('subject');
$message=$this->input->post('message');

$data['name'] = $name;
$data['phone'] = $phone;
$data['email'] = $email;
$data['subject'] = $subject;
$data['message'] = $message;

$this->db->insert('messages',$data);

$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$this->session->set_flashdata('msg', 'added');
    redirect('/home/contactus?lang='.$lang);

}
/********************************************************/
/************************25-12-2017*********************/

public function cartype(){
	$idp=$this->uri->segment(3);
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$data['cartype'] = $this->data->get_table_data('cartype',array('id_category'=>$idp));
$data['category'] = $this->data->get_table_data('category',array('id'=>$idp));
$this->load->view('pages/cartype',$data);
}


public function signup(){	
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$this->load->view('pages/signup',$data);
}

/***************************************************************************
*****************************27-12-2017************************************/
public function check_email(){
$mail = $this->input->post('email');	
$id_jobseeker = $this->data->get_table_row('clients',array('email'=>$mail),'id');
if($id_jobseeker>0){
$exite=1 ; 
}
else{
$exite=0;
}
echo json_encode ($exite) ; 
}

public function check_mobile(){
$mobile = $this->input->post('mobile');	
$id_jobseeker = $this->data->get_table_row('clients',array('phone'=>$mobile),'id');
if($id_jobseeker>0){
$exite=1 ; 
}
else{
$exite=0;
}
echo json_encode ($exite) ; 
}


public function register(){	
$this->load->view('pages/config/register');
}


public function nextregister(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->input->get('id');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();

$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
if( count($result_clients)==1){
$this->load->view('pages/nextregister',$data);
}
else {
$this->load->view('pages/page_404',$data);	
}
}

public function confirm(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->input->get('accountid');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
if( count($result_clients)==1){
$this->load->view('pages/confirm',$data);
}
else {
$this->load->view('pages/page_404',$data);	
}
}

public function confirm_action(){
$id_mess = $this->input->post('ids');
$code_confirm = $this->input->post('code_confirm');
$lang = $this->input->post('lang');
$result_email= $this->db->get_where("clients",array('code'=>$code_confirm,'id'=>$id_mess))->result();
if( count($result_email)==1){
$data = array('code_actvation'=>'1');
$this->db->update('clients',$data,array('id'=>$id_mess));
$this->session->set_flashdata('msg',$confirmsuccess);
$this->session->mark_as_flash('msg');
redirect("/home/success_confirm?$lang&id=$id_mess");
}
else {
$this->session->set_flashdata('msg',$confirmerror);
$this->session->mark_as_flash('msg');
redirect("/home/confirm?$lang&accountid=$id_mess");	
}
}

public function success_confirm(){
$id_mess = $this->input->get('id');
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');

$result_email= $this->db->get_where('clients',array('id'=>$id_mess,'code_actvation'=>'1'))->result();
if( count($result_email)==1){
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess,'code_actvation'=>'1'));
$this->load->view('pages/success_confirm',$data);
}
else {
$this->load->view('pages/page_404',$data);	
}
}

public function page_404(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$this->load->view('pages/page_404');	
}


public function uploadimg(){
$id_mess = $this->input->post('id');
$lang = $this->input->post('lang');
if(isset($_FILES['file']['name'])&&$_FILES['file']['name']!=""){
	// echo $_FILES['file']['size'];
$logo = $this->data->get_table_row('clients',array('id'=>$id_mess),'img'); 
if ($logo != "") {
unlink("site/ar/images/passanger/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = 'site/ar/images/passanger/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =1000000;
$config['max_width']            =1000000;
$config['max_height']           =1000000;
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
$this->data->edit_table('clients',$id_mess,$data);

$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
if( count($result_clients)==1){
$this->load->helper('url');
redirect("home/confirm?accountid=$id_mess&$lang", 'refresh');
}



 }

  }

else {
	 if($id_mess!=""){
$this->load->helper('url');
redirect("home/nextregister?id=$id_mess&$lang", 'refresh');
	 }
	 else {
		 
	$this->load->helper('url');
redirect("home/nextregister", 'refresh');	 
	 }
}

}




public function get_state(){
$this->load->view('pages/get_state');
} 
public function get_model(){
$this->load->view('pages/get_model');
} 
/****************************2-1-2018***********************/
public function get_description(){
$this->load->view('pages/get_description');
} 



public function uploadimgs(){
$id_mess = $this->input->post('id');
 if($id_mess!=""){
$lang = $this->input->post('lang');
$type_account = $this->input->post('account_type');
$result_service = $this->input->post('result_service');
$result_service1 = $this->input->post('result_service1');
$car_model = $this->input->post('car_model');
$car_number = $this->input->post('car_number');
$car_color = $this->input->post('car_color');
$car_type = $this->input->post('car_type');
$city_id= $this->input->post('city_id');

 if($type_account==0){
 $result_clients= $this->db->get_where('attachment',array('id_clients'=>$id_mess))->result();

if( count($result_clients)==1){
$ids = $this->data->get_table_row('attachment',array('id_clients'=>$id_mess),'id'); 	
$data = array('id_category'=>$result_service1,'model'=>$car_model,'car_number'=>$car_number,'car_color'=>$car_color,'car_type'=>$car_type);
$this->db->update('attachment',$data,array('id'=>$ids));
}
else {
$data['id_clients'] = $id_mess;
$data['id_category'] = $result_service1;
$data['model'] = $car_model;
$data['car_number'] = $car_number;
$data['car_color'] = $car_color;
$data['car_type'] = $car_type;
$this->db->insert('attachment',$data);
$ids = $this->db->insert_id(); 
}
if(isset($_FILES['file']['name'])&&$_FILES['file']['name']!=""){
$logo = $this->data->get_table_row('clients',array('id'=>$client_id),'img'); 
if ($logo != "") {
unlink("site/ar/images/driver/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = 'site/ar/images/driver/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =1000000;
$config['max_width']            =1000000;
$config['max_height']           =1000000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
 $this->upload->initialize($config);
 if (!$this->upload->do_upload('imgid')){
if($lang==2){$a['message']="لم يتم رفع الصورة";}
else {$a['message']="Image not uploaded"; }
$array['message'][]= $a;
 }

else {
$url= $_FILES['file']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('img'=>$imagename.".".$file_extension);
$this->data->edit_table('clients',$client_id,$data);
if($lang==2){$a['message']="تم رفع الصورة ";}
else {$a['message']="Image uploaded"; }
$array['message'][]= $a;
}

  }



if(isset($_FILES['imgid']['name'])&&$_FILES['imgid']['name']!=""){
$logo = $this->data->get_table_row('attachment',array('id'=>$ids),'nationalid'); 
if ($logo != "") {
unlink("site/ar/images/driver/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = 'site/ar/images/driver/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =1000000;
$config['max_width']            =1000000;
$config['max_height']           =1000000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
 $this->upload->initialize($config);
 if (!$this->upload->do_upload('imgid')){
 echo $this->upload->display_errors();
 }

else {
$url= $_FILES['imgid']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('nationalid'=>$imagename.".".$file_extension);
$this->data->edit_table('attachment',$ids,$data);

}

  }


if(isset($_FILES['license']['name'])&&$_FILES['license']['name']!=""){
$logo = $this->data->get_table_row('attachment',array('id'=>$ids),'drivinglicense'); 
if ($logo != "") {
unlink("site/ar/images/driver/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = 'site/ar/images/driver/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =1000000;
$config['max_width']            =1000000;
$config['max_height']           =1000000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
 $this->upload->initialize($config);
 if (!$this->upload->do_upload('license')){
 echo $this->upload->display_errors();
 }

else {
$url= $_FILES['license']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('drivinglicense'=>$imagename.".".$file_extension);
$this->data->edit_table('attachment',$ids,$data);

}

  }
  
  
  if(isset($_FILES['carimg']['name'])&&$_FILES['carimg']['name']!=""){
$logo = $this->data->get_table_row('attachment',array('id'=>$ids),'carpicture'); 
if ($logo != "") {
unlink("site/ar/images/driver/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = 'site/ar/images/driver/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =1000000;
$config['max_width']            =1000000;
$config['max_height']           =1000000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
 $this->upload->initialize($config);
 if (!$this->upload->do_upload('carimg')){
 echo $this->upload->display_errors();
 }

else {
$url= $_FILES['carimg']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('carpicture'=>$imagename.".".$file_extension);
$this->data->edit_table('attachment',$ids,$data);

}

  }
  
 

  }
 else {
	 
 $result_clients= $this->db->get_where('company',array('id_clients'=>$id_mess))->result();
if( count($result_clients)==1){
$ids = $this->data->get_table_row('company',array('id_clients'=>$id_mess),'id'); 	
$data = array('id_category'=>$result_service,'city_id'=>$city_id);
$this->db->update('company',$data,array('id'=>$ids));
}
	 
	 
$data['id_clients'] = $id_mess;
$data['id_category'] = $result_service;
$this->db->insert('company',$data);
$ids = $this->db->insert_id();  
if(isset($_FILES['imgid']['name'])&&$_FILES['imgid']['name']!=""){
$logo = $this->data->get_table_row('company',array('id'=>$ids),'national_id'); 
if ($logo != "") {
unlink("site/ar/images/driver/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = 'site/ar/images/driver/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =1000000;
$config['max_width']            =1000000;
$config['max_height']           =1000000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
 $this->upload->initialize($config);
 if (!$this->upload->do_upload('imgid')){
 echo $this->upload->display_errors();
 }

else {
$url= $_FILES['imgid']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('national_id'=>$imagename.".".$file_extension);
$this->data->edit_table('company',$ids,$data);

}

  }
 
 }

if(isset($_FILES['file']['name'])&&$_FILES['file']['name']!=""){
$logo = $this->data->get_table_row('clients',array('id'=>$id_mess),'img'); 
if ($logo != "") {
unlink("site/ar/images/driver/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = 'site/ar/images/driver/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =1000000;
$config['max_width']            =1000000;
$config['max_height']           =1000000;
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
$this->data->edit_table('clients',$id_mess,$data);

}

  }
$this->load->helper('url');
redirect("home/confirm?accountid=$id_mess&$lang", 'refresh');
 }
 
 else {
$this->load->helper('url');
redirect("home/nextregister", 'refresh');	 
	 
 }


}

public function login(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$this->load->view('pages/login',$data);
}

public function forgotpassword(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$this->load->view('pages/forgotpassword',$data);
}




public function submitlogin(){
$dd=base_url();
$lang = $this->security->sanitize_filename($this->input->post('lang'),true);
if($lang=="en"){
	$account_sub="Sorry your account is temporarily suspended!";
	$error="Your email or password incorrect !";
	}
else {
	$account_sub="نأسف لأن هذا الحساب معلق حاليا";
	$error="الايميل او كلمة المرور غير صحيحة";
}
	
    $username = $this->security->sanitize_filename($this->input->post('username'),true);
    $password = $this->security->sanitize_filename($this->input->post('pass'),true);
    $passwordp=md5($password);
    $customer_id="";
	$customer_not="";
	
$customer_not = $this->data->get_table_row('clients',array('phone'=>$username,'password'=>$passwordp,'view'=>'0','code_actvation'=>'1'),'id');
if($customer_not==""){
$customer_not = $this->data->get_table_row('clients',array('email'=>$username,'password'=>$passwordp,'view'=>'0','code_actvation'=>'1'),'id');
 }
if($customer_not!=""){
$this->session->set_flashdata('msg',$account_sub);
$this->session->mark_as_flash('msg');
redirect('/home/login?lang='.$lang);
//header('location:'.$dd.'home/login?suspend&lang='.$lang);	
}

$customer_not = $this->data->get_table_row('clients',array('phone'=>$username,'password'=>$passwordp,'view'=>'1','code_actvation'=>'0'),'id');
if($customer_not==""){
$customer_not = $this->data->get_table_row('clients',array('email'=>$username,'password'=>$passwordp,'view'=>'1','code_actvation'=>'0'),'id');
 }
 
if($customer_not!=""){

 $user_email =$this->data->get_table_row('clients',array('id'=>$customer_not),'email');
    $this->session->set_userdata(array('id_admin' => $customer_not));
    $this->session->set_userdata(array('user_email' => $user_email));
    if(isset($_SESSION['user_email'])){
	 redirect('/home/repeatconfirm?lang='.$lang);
    }

}
 $customer_not = $this->data->get_table_row('clients',array('phone'=>$username,'password'=>$passwordp,'view'=>'0','code_actvation'=>'0'),'id');
if($customer_not==""){
$customer_not = $this->data->get_table_row('clients',array('email'=>$username,'password'=>$passwordp,'view'=>'0','code_actvation'=>'0'),'id');
 }
 
 if($customer_not!=""){
$this->session->set_flashdata('msg',$account_sub);
$this->session->mark_as_flash('msg');
redirect('/home/login?lang='.$lang);
}
 
 
 /**************************************************************************************

 *****************************************************************************************/
	else {
$customer_id = $this->data->get_table_row('clients',array('phone'=>$username,'password'=>$passwordp,'view'=>'1','code_actvation'=>'1'),'id');
 if($customer_id==""){
$customer_id = $this->data->get_table_row('clients',array('email'=>$username,'password'=>$passwordp,'view'=>'1','code_actvation'=>'1'),'id');
 }  
    if($customer_id != ""){
    $user_email =$this->data->get_table_row('clients',array('id'=>$customer_id),'email');
	$user_phone =$this->data->get_table_row('clients',array('id'=>$customer_id),'phone');
	$user_img =$this->data->get_table_row('clients',array('id'=>$customer_id),'img');
    $type =$this->data->get_table_row('clients',array('id'=>$customer_id),'type');
	 $fname =$this->data->get_table_row('clients',array('id'=>$customer_id),'fname');
	  $date_last=date('Y-m-d H:m');
	  $data = array('last_login'=>$date_last,'online'=>'1');
      $this->db->update('clients',$data,array('id'=>$customer_id));
	 $fname =$this->data->get_table_row('clients',array('id'=>$customer_id),'fname');
    $this->session->set_userdata(array('id_admin' => $customer_id));
	$this->session->set_userdata(array('fname_admin' => $fname));
    $this->session->set_userdata(array('user_email' => $user_email));
    $this->session->set_userdata(array('type_admin' => $type));
    $this->session->set_userdata(array('user_phone' => $user_phone));
	if($user_img!=""){$main_img=$user_img;}else $main_img="defaultmain.png";
    $this->session->set_userdata(array('profile_mainimg' => $main_img));
    if(isset($_SESSION['user_email'])){
     header('location:'.$dd.'home/profile?lang='.$lang);
    }
}
 else {
$this->session->set_flashdata('msg',$error);
$this->session->mark_as_flash('msg');
redirect('/home/login?lang='.$lang);
    }
	}
    

  }


public function repeatconfirm(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->session->userdata('id_admin');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
if( count($result_clients)==1){
$this->load->view('pages/repeatconfirm',$data);
}
else {
$this->load->view('pages/page_404',$data);	
}
}

public function resent_email(){
$this->load->view('pages/config/resent_email');
}


/**********************************************END 2-1-2017******************************************
***********************************************Start 3-1-2018****************************************
*****************************************************************************************************/


public function profile(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->session->userdata('id_admin');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();

if( count($result_clients)==1){
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
$data['comments_data']=$this->data->get_table_data('comments',array('id_reciver'=>$id_mess));
$this->load->view('pages/profile',$data);
}
else {
redirect('/home/login?lang=en');	
}
}
public function logout(){
	$lang=$this->input->get('lang');
 $this->session->unset_userdata('id_admin');
 $this->session->unset_userdata('user_email');
 $this->session->unset_userdata('user_phone');
 $this->session->unset_userdata('type_admin');
 $this->session->unset_userdata('main_img');
  redirect('/home/login?lang='.$lang);
    }



public function forgetpass(){
	$lang=$this->input->post('lang');
	$username=$this->input->post('username');
	
$customer_id = $this->data->get_table_row('clients',array('phone'=>$username),'id');
 if($customer_id==""){
$customer_id = $this->data->get_table_row('clients',array('email'=>$username),'id');
 }  

	
if($customer_id==""){
$this->session->set_flashdata('msg',$error_forget);
$this->session->mark_as_flash('msg');
redirect('/home/forgotpassword?lang='.$lang);	
}
else {
$this->load->view('pages/config/forgetpass');
}

}



public function reset_password(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->input->get('id');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
if( count($result_clients)==1){
$this->load->view('pages/reset_password',$data);
}
else {
$this->load->view('pages/page_404',$data);	
}
}

public function reset_action(){
$pass = $this->input->post('pass');
$id_mess = $this->input->post('id');
$lang = $this->input->post('lang');

$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');

$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();

if( count($result_clients)==1){
$data = array('password'=>md5($pass),'text_value'=>$pass);
$this->db->update('clients',$data,array('id'=>$id_mess));
redirect('/home/login?'.$lang);	
}
else {
$this->load->view('pages/page_404',$data);	
}
}

public function confirm_account(){
$id_mess = $this->input->get('id');
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
$data = array('code_actvation'=>'1');
$this->db->update('clients',$data,array('id'=>$id_mess));
redirect('/home/login');	
}
else {
$this->load->view('pages/page_404',$data);	
}
}
public function success_reset(){
$id_mess = $this->input->get('keyid');
$lang = "lang=".$this->input->get('lang');
 
$result_email= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if($lang=="lang=en"){
$confirmsuccess="Email has been sent,Please check the email.";}
else{
$confirmsuccess=".تم ارسال الباسورد على الايميل,من فضلك مراجعة الايميل";
}

if( count($result_email)==1){
$this->session->set_flashdata('msg',$confirmsuccess);
$this->session->mark_as_flash('msg');
redirect("/home/reset_success?$lang&id=$id_mess");
}
else {
$this->session->set_flashdata('msg',$confirmerror);
$this->session->mark_as_flash('msg');
redirect("/home/confirm?$lang&accountid=$id_mess");	
}
}


public function reset_success(){
$id_mess = $this->input->get('id');
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');

$result_email= $this->db->get_where('clients',array('id'=>$id_mess,'code_actvation'=>'1'))->result();
if( count($result_email)==1){
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess,'code_actvation'=>'1'));
$this->load->view('pages/reset_success',$data);
}
else {
$this->load->view('pages/page_404',$data);	
}
}

public function messages(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->session->userdata('id_admin');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
$data['data_message']=$this->data->get_table_data('clients_message',array('id_reciver'=>$id_mess,'client_delete'=>'0','id_mess'=>'0'));
$data['data_sent_message']=$this->data->get_table_data('clients_message',array('id_sender'=>$id_mess,'client_delete'=>'0','id_mess'=>'0'));
$this->load->view('pages/messages',$data);
}
else {
redirect('/home/login?lang=en');	
}

}

public function dashboard(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->session->userdata('id_admin');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
if( count($result_clients)==1){
$this->load->view('pages/dashboard',$data);
}
else {
redirect('/home/login?lang=en');	
}

}


public function delete_message(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');

$id_mess = $this->session->userdata('id_admin');
$idmess=$this->uri->segment(3);
$lang=$this->uri->segment(4);

$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
$data = array('client_delete'=>'1');
$this->db->update('clients_message',$data,array('id'=>$idmess));
$sub_mess= $this->db->get_where("clients_message",array('id_mess'=>$idmess))->result();
foreach($sub_mess as $sub_mess){
	 $subidmess=$sub_mess->id;
$data = array('client_delete'=>'1');
$this->db->update('clients_message',$data,array('id'=>$subidmess));	
}

$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
$data['data_message']=$this->data->get_table_data('clients_message',array('id_reciver'=>$id_mess,'client_delete'=>'0'));
$data['data_sent_message']=$this->data->get_table_data('clients_message',array('id_sender'=>$id_mess,'client_delete'=>'0'));
$this->load->view('pages/messages',$data);
redirect("/home/messages?lang=$lang");
}
else {
redirect('/home/login?lang=en');	
}
}

public function action_message(){
$lang=$this->input->post('lang');
$subject=$this->input->post('subject');
$message=$this->input->post('message');
$messid=$this->input->post('messid');
$id_mess = $this->session->userdata('id_admin');

$data['subject'] = $subject;
$data['messages'] = $message;
$data['id_sender'] = $id_mess;
$data['id_mess'] = $messid;
$data['client_delete']='0';
$this->db->insert('clients_message',$data);
$this->session->set_flashdata('msg',$confirmsuccess);
redirect("/home/messages?$lang");

}

public function action_compose(){
ob_start();
$lang=$this->input->post('lang');
$subject=$this->input->post('subject');
$message=$this->input->post('message');
$id_mess = $this->session->userdata('id_admin');

$data['subject'] = $subject;
$data['messages'] = $message;
$data['id_sender'] = $id_mess;
$data['client_delete']='0';
if($lang=="lang=en"){
$confirmsuccess="Your message has been successfully sent";
}
else {
$confirmsuccess="تم ارسالة رسالتك بنجاح";
}
$this->db->insert('clients_message',$data);
$this->session->set_flashdata('msg',$confirmsuccess);
redirect("/home/messages?$lang");
}

public function edit_information(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->session->userdata('id_admin');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
if( count($result_clients)==1){
$this->load->view('pages/edit_information',$data);
}
else {
redirect('/home/login?lang=en');	
}
}


public function action_infomation(){
ob_start();
	$type=0;
$id_mess = $this->session->userdata('id_admin');
$type_admin = $this->session->userdata('type_admin');
$name=$this->input->post('name');
$address=$this->input->post('address');
$about_you=$this->input->post('about_you');
$lang=$this->input->post('lang');
 $CheckboxGroup1=$this->input->post('CheckboxGroup1');
  $result_service=$this->input->post('result_service');
  $result_service1=$this->input->post('result_service1');
  $car_color=$this->input->post('car_color');
  $car_number=$this->input->post('car_number');
  $car_type=$this->input->post('car_type');
  $car_model=$this->input->post('car_model');
 
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
$data = array('fname'=>$name,'address'=>$address);
$this->db->update('clients',$data,array('id'=>$id_mess));	
$this->session->set_userdata(array('fname_admin' => $name));

if($type_admin==0){
$attachment_count= $this->db->get_where("attachment",array("id_clients"=> $id_mess))->result();
 if(count($attachment_count)==1){
	 $type=1;
	$data = array('about_you'=>$about_you,'id_category'=>$result_service,'car_color'=>$car_color,'car_number'=>$car_number,'car_type'=>$car_type,'model'=>$car_model);
$this->db->update('attachment',$data,array('id_clients'=>$id_mess));
$idattachment = $this->data->get_table_row('attachment',array('id_clients'=>$id_mess),'id');

if(isset($CheckboxGroup1)&&$CheckboxGroup1!=""){
	 $ret_value=$this->data->delete_table_row('interests',array('id_clients'=>$id_mess));
$check=$this->input->post('CheckboxGroup1');
$length=count($check);
for($i=0;$i<$length;$i++){
$data = array('main_data'=>$check[$i],'id_clients'=>$id_mess);
$this->data->insert_filed('interests',$data);
}
}


	 
 }
 else {
$company_count= $this->db->get_where("company",array("id_clients"=> $id_mess))->result();
 if(count($company_count)==1){
$type=2;
$data = array('about_you'=>$about_you,'id_category'=>$result_service1);
$this->db->update('company',$data,array('id_clients'=>$id_mess));	
$idcompany = $this->data->get_table_row('company',array('id_clients'=>$id_mess),'id');	 
 
 }
	 
	 
 }
}

if(isset($_FILES['file']['name'])&&$_FILES['file']['name']!=""){
	echo $_FILES['file']['size'];
$logo = $this->data->get_table_row('clients',array('id'=>$id_mess),'img'); 
if ($logo != "") {
	if($this->session->userdata('type_admin')==1){
unlink("site/ar/images/passanger/$logo");
	}
	else {
	unlink("site/ar/images/driver/$logo");	
	}
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
if($this->session->userdata('type_admin')==1){
$config['upload_path'] = 'site/ar/images/passanger/';
}
else {
$config['upload_path'] = 'site/ar/images/driver/';	
}
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =1000000;
$config['max_width']            =1000000;
$config['max_height']           =1000000;
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
$this->data->edit_table('clients',$id_mess,$data);
}
}


/***********************************************************************
************************************************************************/


if(isset($_FILES['imgid']['name'])&&$_FILES['imgid']['name']!=""){
if($type==1){
$logo = $this->data->get_table_row('attachment',array('id_clients'=>$id_mess),'nationalid');
	}
if($type==2){
$logo = $this->data->get_table_row('company',array('id_clients'=>$id_mess),'national_id');
	}
if ($logo != "") {
	unlink("site/ar/images/driver/$logo");	
	}

$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = 'site/ar/images/driver/';	
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =1000000;
$config['max_width']            =1000000;
$config['max_height']           =1000000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
 $this->upload->initialize($config);
 if (!$this->upload->do_upload('imgid')){
 echo $this->upload->display_errors();
 }
else {
$url= $_FILES['imgid']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
if($type==1){
$data = array('nationalid'=>$imagename.".".$file_extension);
$this->data->edit_table('attachment',$idattachment,$data);
}
if($type==2){
$data = array('national_id'=>$imagename.".".$file_extension);
$this->data->edit_table('company',$idcompany,$data);

}
}
}





if(isset($_FILES['carimg']['name'])&&$_FILES['carimg']['name']!=""){
$logo = $this->data->get_table_row('attachment',array('id_clients'=>$id_mess),'carpicture');
if ($logo != "") {
	unlink("site/ar/images/driver/$logo");	
	}

$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = 'site/ar/images/driver/';	
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =1000000;
$config['max_width']            =1000000;
$config['max_height']           =1000000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
$this->upload->initialize($config);
if (!$this->upload->do_upload('carimg')){
echo $this->upload->display_errors();
 }
else {
$url= $_FILES['carimg']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('carpicture'=>$imagename.".".$file_extension);
$this->data->edit_table('attachment',$idattachment,$data);
}
}

/*****************************************************************************/

if(isset($_FILES['license']['name'])&&$_FILES['license']['name']!=""){
$logo = $this->data->get_table_row('attachment',array('id_clients'=>$id_mess),'drivinglicense');
if ($logo != "") {
	unlink("site/ar/images/driver/$logo");	
	}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = 'site/ar/images/driver/';	
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =1000000;
$config['max_width']            =1000000;
$config['max_height']           =1000000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
 $this->upload->initialize($config);
 if (!$this->upload->do_upload('license')){
 echo $this->upload->display_errors();
 }
else {
$url= $_FILES['license']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('drivinglicense'=>$imagename.".".$file_extension);
$this->data->edit_table('attachment',$idattachment,$data);
}
}



/*********************************************************************
/*********************************************************************/
redirect("/home/edit_information?$lang");
}

else {
redirect('/home/login?lang=en');	
}
}


public function editemail(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->session->userdata('id_admin');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
if( count($result_clients)==1){
$this->load->view('pages/editemail',$data);
}
else {
redirect('/home/login?lang=en');	
}
}

public function action_mail(){
$id_mess = $this->session->userdata('id_admin');
$email=$this->input->post('email');
$lang=$this->input->post('lang');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
$data = array('email'=>$email);
$this->db->update('clients',$data,array('id'=>$id_mess));	
$this->session->set_userdata(array('user_email' => $email));
redirect("/home/edit_information?$lang");
}
else {
redirect('/home/login?lang=en');	
}
}


public function editphone(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->session->userdata('id_admin');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
if( count($result_clients)==1){
$this->load->view('pages/editphone',$data);
}
else {
redirect('/home/login?lang=en');	
}
}

public function action_phone(){
$id_mess = $this->session->userdata('id_admin');
$phone=$this->input->post('phone');
$lang=$this->input->post('lang');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
$data = array('phone'=>$phone);
$this->db->update('clients',$data,array('id'=>$id_mess));	
$this->session->set_userdata(array('user_phone' => $phone));
redirect("/home/edit_information?$lang");
}
else {
redirect('/home/login?lang=en');	
}
}


public function editpassword(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->session->userdata('id_admin');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
if( count($result_clients)==1){
$this->load->view('pages/editpassword',$data);
}
else {
redirect('/home/login?lang=en');	
}
}

public function action_password(){
$id_mess = $this->session->userdata('id_admin');
$password=$this->input->post('pass');
$lang=$this->input->post('lang');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
$data = array('password'=>md5($password),'text_value'=>$password);
$this->db->update('clients',$data,array('id'=>$id_mess));	
redirect("/home/edit_information?$lang");
}
else {
redirect('/home/login?lang=en');	
}
}

public function check_password(){
$oldpassword = $this->input->post('oldpassword');	
$id_mess = $this->session->userdata('id_admin');
$id_jobseeker = $this->data->get_table_row('clients',array('text_value'=>$oldpassword,'id'=>$id_mess),'id');
if($id_jobseeker>0){
$exite=1 ; 
}
else{
$exite=0;
}
echo json_encode ($exite) ; 
}
/***************************************************************************************************************
****************************************************************************************************************
*******************************************10-1-2018************************************************************/



public function Addreviews(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->session->userdata('id_admin');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
$this->load->view('pages/Addreviews',$data);
}
else {
redirect('/home/login?lang=en');	
}

}




public function action_reviews(){
$lang=$this->input->post('lang');
$client_id=$this->input->post('client_id');
$message=$this->input->post('message');
$id_mess = $this->session->userdata('id_admin');
 if($lang=="lang=en"){
$confirmsuccess="Your comment has been sent successfully";	 
 }
 else {
$confirmsuccess="تم إرسال تعليقك بنجاح";	 	 
 }
$data['id_reciver'] = $client_id;
$data['message'] = $message;
$data['id_sender'] = $id_mess;
$data['active']='0';
$this->db->insert('comments',$data);
$this->session->set_flashdata('msg',$confirmsuccess);
redirect("/home/Addreviews?$lang",'refresh');

}


public function offered_rides(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->session->userdata('id_admin');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
$data['city']=$this->data->get_table_data('city',array('view'=>'1'));	
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
$this->load->view('pages/offered_rides',$data);
}
else {
redirect('/home/login?lang=en');	
}

}


public function carpooling_insert(){
$leavingdata=$this->input->post('leavingdata');
$gooingdata=$this->input->post('gooingdata');
$datedata=$this->input->post('datedata');
$numberdata=$this->input->post('numberdata');
$messagedata=$this->input->post('messagedata');

$finalspace=$this->input->post('finalspace');
$finalprice=$this->input->post('finalprice');
$pernumber=$this->input->post('pernumber');
$finalduration_trip=$this->input->post('finalduration_trip');

$id_mess = $this->session->userdata('id_admin');
$data['id_clients'] = $id_mess;
$data['leaving'] = $leavingdata;
$data['gooing'] = $gooingdata;
$data['datedata']=$datedata;
$data['seats']=$numberdata;
$data['messages']=$messagedata;
$data['finalspace']=$finalspace;
$data['finalprice']=$finalprice;
$data['pernumber']=$pernumber;
$data['duration']=$finalduration_trip;
$this->db->insert('carpooling',$data);
$ids = $this->db->insert_id(); 
echo json_encode ($ids) ;
}

public function cityname(){
$id=$this->input->post('id');
$lang=$this->input->post('lang');
$name = $this->data->get_table_row('city',array('id'=>$id),'name');
$name_eng = $this->data->get_table_row('city',array('id'=>$id),'name_eng');
$lat = $this->data->get_table_row('city',array('id'=>$id),'lat');
$lag = $this->data->get_table_row('city',array('id'=>$id),'lag');
$a=array();
if($lang=="lang=en"){
$exite=$name_eng;
array_push($a,$exite,$lat,$lag);
}
else{
$exite=$name;
array_push($a,$exite,$lat,$lag);
}
echo json_encode ($a) ; 


}

public function mytrips(){
	$id_mess = $this->session->userdata('id_admin');
    $tables = "carpooling";
    $config = array();
    $config['base_url'] = base_url().'home/mytrips'; 
    $config['total_rows'] = $this->data->record_count($tables,array('id_clients'=>$id_mess),'','id','desc');
    $config['per_page'] =24;
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
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
else:
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$data["results"] = $this->data->view_all_data($tables, array('id_clients'=>$id_mess), $config["per_page"], $page,'id','desc');
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
$this->load->view('pages/mytrips',$data);
}
else {
redirect('/home/login?lang=en');	
}

  }



public function delete_mytrips(){
$id_mess = $this->session->userdata('id_admin');
$idmess=$this->uri->segment(3);
$lang=$this->uri->segment(4);
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
$ret_value=$this->data->delete_table_row('carpooling',array('id'=>$idmess));
redirect("/home/mytrips?lang=$lang");
}
else {
redirect('/home/login?lang=en');	
}
}


public function update_mytrips(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$idmess=$this->uri->segment(3);
$lang=$this->uri->segment(4);
$id_mess = $this->session->userdata('id_admin');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
$data['city']=$this->data->get_table_data('city',array('view'=>'1'));	
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
$data['carpooling_data']=$this->data->get_table_data('carpooling',array('id'=>$idmess));
$this->load->view("pages/update_mytrips",$data);
}
else {
redirect('/home/login?lang=en');	
}

}





public function carpooling_update(){

$leavingdata=$this->input->post('leavingdata');
$gooingdata=$this->input->post('gooingdata');
$datedata=$this->input->post('datedata');
$numberdata=$this->input->post('numberdata');
$messagedata=$this->input->post('messagedata');
$idtrip=$this->input->post('idtrip');
$finalspace=$this->input->post('finalspace');
$finalprice=$this->input->post('finalprice');
$pernumber=$this->input->post('pernumber');
$finalduration_trip=$this->input->post('finalduration_trip');

$data['leaving'] = $leavingdata;
$data['gooing'] = $gooingdata;
$data['datedata']=$datedata;
$data['seats']=$numberdata;
$data['messages']=$messagedata;
$data['finalspace']=$finalspace;
$data['finalprice']=$finalprice;
$data['pernumber']=$pernumber;
$data['duration']=$finalduration_trip;
$this->db->update('carpooling',$data,array('id'=>$idtrip));
echo json_encode ($ids) ;
}



public function trips(){
	$id_mess = $this->session->userdata('id_admin');
    $tables = "carpooling";
    $config = array();
    $config['base_url'] = base_url().'home/trips'; 
    $config['total_rows'] = $this->data->record_count($tables,array('id_clients!='=>$id_mess),'','id','desc');
    $config['per_page'] =24;
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
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
else:
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$data["results"] = $this->data->view_all_data($tables, array('id_clients!='=>$id_mess), $config["per_page"], $page,'id','desc');
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
$this->load->view('pages/trips',$data);
  }



/*********************************
********************************************/



public function action_events(){
$lang=$this->input->post('lang');
$name=$this->input->post('name');
$phone=$this->input->post('phone');
$email=$this->input->post('email');
$address=$this->input->post('address');
$idevent=$this->input->post('idevent');
$message=$this->input->post('message');
$final_price=$this->input->post('final_price');
$id_client=$this->session->userdata('id_admin');
$result_clients= $this->db->get_where("join_events",array('id_client'=>$id_client))->result();
if(count($result_clients)==0){
$data['name'] = $name;
$data['phone'] = $phone;
$data['email'] = $email;
$data['id_event'] = $idevent;
$data['address'] = $address;
$data['message'] = $message;
$data['final_price'] = $final_price;
$data['id_client'] = $id_client;

$this->db->insert('join_events',$data);
}
if($lang=="lang=en"){
$confirmsuccess="Your Join has been successfully,We contact as soon";	 
}
else {
$confirmsuccess="لقد تم الاشتراك بنجاح، وسوف نتواصل بيك أقرب وقت
";	 	 
}
echo $confirmsuccess;

$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$this->session->set_flashdata('msg',$confirmsuccess);
redirect("/home/events?$lang");
}



public function seach_trips(){
	$id_mess = $this->session->userdata('id_admin');
	$leaving = $this->input->post('leaving');
	$gooing = $this->input->post('gooing');
	$maindate = $this->input->post('date');
 //echo $maindate ;
	$codition_data="";
	if($id_mess!=""){
	$codition_data="id_clients!="."=>".$id_mess;	
	}
	if($leaving!=""){
	$codition_data="'leaving'"."=>".$leaving;	
	}
	 $date=date("Y-m-d H",strtotime($maindate));
	 //$currecntdate=date("Y-m-d H");
	 
    $tables = "carpooling";
    $config = array();
    $config['base_url'] = base_url().'home/trips';
	if($leaving==""&&$gooing==""&&$maindate==""&$id_mess==""){
	$config['total_rows'] = $this->data->record_count($tables,array(),'','id','desc');
	} 
	else if($leaving!=""&&$gooing==""&&$id_mess==""){
	$config['total_rows'] = $this->data->record_count($tables,array('leaving'=>$leaving),'','id','desc');
	}
else if($leaving!=""&&$gooing!=""&&$id_mess==""){
	$config['total_rows'] = $this->data->record_count($tables,array('leaving'=>$leaving,'gooing'=>$gooing),'','id','desc');
	}
else if($leaving!=""&&$gooing!=""&&$id_mess!=""){
	$config['total_rows'] = $this->data->record_count($tables,array('id_clients!='=>$id_mess,'leaving'=>$leaving,'gooing'=>$gooing),'','id','desc');
	}
else if($leaving!=""&&$gooing==""&&$id_mess!=""){
	$config['total_rows'] = $this->data->record_count($tables,array('id_clients!='=>$id_mess,'leaving'=>$leaving),'','id','desc');
	}
else if($leaving==""&&$gooing!=""&&$id_mess==""){
	$config['total_rows'] = $this->data->record_count($tables,array('gooing'=>$gooing),'','id','desc');
	}
	else if($leaving==""&&$gooing!=""&&$id_mess!=""){
	$config['total_rows'] = $this->data->record_count($tables,array('id_clients!='=>$id_mess,'gooing'=>$gooing),'','id','desc');
	}
else if($leaving==""&&$gooing==""&&$id_mess!=""){
$config['total_rows'] = $this->data->record_count($tables,array('id_clients!='=>$id_mess),'','id','desc');
}		

	$config['per_page'] =24;
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
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
else:
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');

if($leaving==""&&$gooing==""&&$maindate==""&$id_mess==""){
 
	$data['results'] =$this->data->view_all_data($tables,array(), $config["per_page"], $page,'id','desc');
	}

if($leaving==""&&$gooing==""&&$maindate!=""&$id_mess==""){
 
	$data['results'] =$this->data->view_all_data($tables,array(), $config["per_page"], $page,'id','desc');
	}
	
else if($leaving!=""&&$gooing==""&&$id_mess==""){
	$data['results'] =$this->data->view_all_data($tables,array('leaving'=>$leaving), $config["per_page"], $page,'id','desc');
	}
	else if($leaving!=""&&$gooing!=""&&$id_mess==""){
	$data['results'] =$this->data->view_all_data($tables,array('leaving'=>$leaving,'gooing'=>$gooing), $config["per_page"], $page,'id','desc');
	}
else if($leaving!=""&&$gooing!=""&&$id_mess!=""){
	$data['results'] =$this->data->view_all_data($tables,array('id_clients!='=>$id_mess,'leaving'=>$leaving,'gooing'=>$gooing), $config["per_page"], $page,'id','desc');
	}
else if($leaving!=""&&$gooing==""&&$id_mess!=""){
	$data['results'] =$this->data->view_all_data($tables,array('id_clients!='=>$id_mess,'leaving'=>$leaving), $config["per_page"], $page,'id','desc');
	}

else if($leaving==""&&$gooing!=""&&$id_mess==""){
	$data['results'] =$this->data->view_all_data($tables,array('gooing'=>$gooing), $config["per_page"], $page,'id','desc');
	}
else if($leaving==""&&$gooing!=""&&$id_mess!=""){
	$data['results'] =$this->data->view_all_data($tables,array('id_clients!='=>$id_mess,'gooing'=>$gooing), $config["per_page"], $page,'id','desc');
	}
else if($leaving==""&&$gooing==""&&$id_mess!=""){
$data['results'] =$this->data->view_all_data($tables,array('id_clients!='=>$id_mess), $config["per_page"], $page,'id','desc');
}		
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
$data['maindate_client']=$maindate;
endif;
$this->load->view('pages/seach_trips',$data);

  }




public function joinme(){
$lang = $this->input->get('lang');
$idcarpooling=$this->uri->segment(3);
$id_driver = $this->data->get_table_row('carpooling',array('id'=>$idcarpooling),'id_clients');
$id_client= $this->session->userdata('id_admin');
$result_clients= $this->db->get_where("clients",array('id'=>$id_client))->result();
$booking_idold= $this->data->get_table_row('booking',array('id_driver'=>$id_driver,'id_passanger'=>$id_client,'id_offers'=>$idcarpooling),'id');
if( count($result_clients)==1){
if($booking_idold==""){

$data['id_passanger'] = $id_client;
$data['id_offers'] = $idcarpooling;
$data['id_driver'] = $id_driver;
$data['passanger_activation']='0';
$data['driver_activation']='0';
$data['type']='0';
$num_account = $this->data->get_table_row('carpooling',array('id'=>$idcarpooling),'num_account');
$seats = $this->data->get_table_row('carpooling',array('id'=>$idcarpooling),'seats');
if($num_account<$seats){
$new_num=$num_account+1;
$this->db->insert('booking',$data);
$data = array('num_account'=>$new_num);
$this->db->update('carpooling',$data,array('id'=>$idcarpooling));
}
redirect("/home/request_mail/$id_driver?lang=$lang");	
}
 else {
redirect("/home/trips?lang=$lang");	

}

}
else {
redirect("/home/login?lang=".$lang);	
}

}


public function request_mail(){
		
$this->load->view('pages/config/request_mail');
}
public function request_trip(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->session->userdata('id_admin');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
if( count($result_clients)==1){
$this->load->view('pages/request_trip',$data);
}
else {
$this->load->view('pages/page_404',$data);	
}

}



public function addcar(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->session->userdata('id_admin');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();

$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
$data['clients_company']=$this->data->get_table_data('company',array('id_clients'=>$id_mess));

if( count($result_clients)==1){
$this->load->view('pages/addcar',$data);
}
else {
$this->load->view('pages/page_404',$data);	
}
}


public function history_trips(){
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->session->userdata('id_admin');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
$data['clients_company']=$this->data->get_table_data('company',array('id_clients'=>$id_mess));
if( count($result_clients)==1){
$this->load->view('pages/history_trips',$data);
}
else {
$this->load->view('pages/page_404',$data);	
}
}






public function addcar_action(){
 ob_start();
$companyid = $this->input->post('companyid');
$lang = $this->input->post('lang');
$car_model = $this->input->post('car_model');
$car_type = $this->input->post('car_type');
$car_number = $this->input->post('car_number');
$car_color = $this->input->post('car_color');

$data['model'] = $car_model;
$data['color'] = $car_color;
$data['car_number'] = $car_number;
$data['car_type'] = $car_type;
$data['id_organization'] = $companyid;

$this->db->insert('company_car',$data);
$ids = $this->db->insert_id(); 

if(isset($_FILES['carimg']['name'])&&$_FILES['carimg']['name']!=""){
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = 'site/ar/images/organizations/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =1000000;
$config['max_width']            =1000000;
$config['max_height']           =1000000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
 $this->upload->initialize($config);
 if (!$this->upload->do_upload('carimg')){
 }

else {
$url= $_FILES['carimg']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('carimg'=>$imagename.".".$file_extension);
$this->data->edit_table('company_car',$ids,$data);
  }
}


if(isset($_FILES['car_license']['name'])&&$_FILES['car_license']['name']!=""){
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = 'site/ar/images/organizations/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['max_size']             =1000000;
$config['max_width']            =1000000;
$config['max_height']           =1000000;
$config['file_name'] = $imagename; 
$this->load->library('upload', $config);
 $this->upload->initialize($config);
 if (!$this->upload->do_upload('car_license')){
 echo $this->upload->display_errors();
 }

else {
$url= $_FILES['car_license']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('car_license'=>$imagename.".".$file_extension);
$this->data->edit_table('company_car',$ids,$data);
}

  }




if($lang=="lang=en"){
$confirmsuccess="The car has been successfully added.";}
else{
$confirmsuccess="تم اضافة السيارة بنجاح";
}

$this->session->set_flashdata('msg',$confirmsuccess);
$this->session->mark_as_flash('msg');
redirect("/home/addcar?$lang");
}






public function mycars(){
	$id_mess = $this->session->userdata('id_admin');
$companyid=$this->data->get_table_row('company',array('id_clients'=>$id_mess),'id');

    $tables = "company_car";
    $config = array();
    $config['base_url'] = base_url().'home/mycars'; 
    $config['total_rows'] = $this->data->record_count($tables,array('id_organization'=>$companyid),'','id','desc');
    $config['per_page'] =24;
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
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
else:
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$data["results"] = $this->data->view_all_data($tables, array('id_organization'=>$companyid), $config["per_page"], $page,'id','desc');
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
$this->load->view('pages/mycars',$data);
}
else {
redirect('/home/login?lang=en');	
}

  }




public function delete_mycars(){
ob_start();
$id_mess = $this->session->userdata('id_admin');
$idmess=$this->uri->segment(3);
$lang=$this->input->get('lang');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
$ret_value=$this->data->delete_table_row('company_car',array('id'=>$idmess));

if($lang=="en"){
$confirmsuccess="The car has been successfully deleted.";}
else{
$confirmsuccess="تم حذف السيارة بنجاح";
}
 echo $lang;
$this->session->set_flashdata('msg',$confirmsuccess);
$this->session->mark_as_flash('msg');
redirect("/home/mycars?lang=$lang");
}
else {
redirect('/home/login?lang=$lang');	
}
}





public function organizations(){
$id_mess = $this->session->userdata('id_admin');
    $tables = "company";
    $config = array();
    $config['base_url'] = base_url().'home/organizations'; 
    $config['total_rows'] = $this->data->record_count($tables,array('activation'=>'1'),'','id','desc');
    $config['per_page'] =24;
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
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
else:
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$data["results"] = $this->data->view_all_data($tables, array('activation'=>'1'), $config["per_page"], $page,'id','desc');
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
$result_clients= $this->db->get_where("clients",array())->result();
$this->load->view('pages/organizations',$data);
  }







public function organization_cars(){
    $tables = "company_car";
    $id_organization=$this->input->get('id_organization');

if($id_organization!=""){
$_SESSION["id_organization"]=$id_organization;
}
if($this->input->get('lang')!=""){
$lang=$this->input->get('lang');
$_SESSION["lang"]=$lang;
}

else  {$lang=$this->uri->segment(3);$_SESSION["lang"]=$this->uri->segment(3);}


$clientid= $this->data->get_table_row("company",array("id"=>$_SESSION["id_organization"]),"id_clients");
    $config = array();
    $config['base_url'] = base_url().'home/organization_cars/'.$lang; 
    $config['total_rows'] = $this->data->record_count($tables,array('id_organization'=>$_SESSION["id_organization"]),'','id','desc');
    $config['per_page'] =24;
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
if($this->uri->segment(4)){
$page = ($this->uri->segment(4)) ;
}
else{
$page =0;
}

$rs = $this->db->get($tables);
if($rs->num_rows() == 0):
$data["results"] = array();
$data["links"] = array();
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
else:
$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$data['clients_result'] = $this->data->get_table_data('clients',array('id'=>$clientid));
$data['result_company'] = $this->data->get_table_data('company',array('id'=>$_SESSION["id_organization"]));
$data["results"] = $this->data->view_all_data($tables,array('id_organization'=>$_SESSION["id_organization"]), $config["per_page"], $page,'id','desc');
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
if($_SESSION["id_organization"]!=""){
$this->load->view('pages/organization_cars',$data);
  }
else {
$this->load->view('pages/page_404',$data);
}
}


public function add_list_car(){
$car_id= $this->input->post('car_id');	
$id_clients=$this->session->userdata('id_admin');
$id_jobseeker = $this->data->get_table_row('virtual_table',array('id_car'=>$car_id,'id_clients'=>$id_clients),'id');
if($id_jobseeker>0){
$exite=1 ; 
}
else{
$data['id_car'] = $car_id;
$data['id_clients'] = $id_clients;
$this->db->insert('virtual_table',$data);
$exite=0;
}
echo json_encode ($exite) ; 
}


public function remove_list_car(){
$car_id= $this->input->post('carid');	
$id_clients=$this->session->userdata('id_admin');
$id_jobseeker = $this->data->get_table_row('virtual_table',array('id_car'=>$car_id,'id_clients'=>$id_clients),'id');
if($id_jobseeker>0){
$this->data->delete_table_row('virtual_table',array('id_car'=>$car_id,'id_clients'=>$id_clients));
$exite=0; 
}
else{
$exite=1;
}
echo json_encode ($exite) ; 
}


public function booking_cars(){	

$data['result_siteinfo'] = $this->data->get_table_data('site_info');
$data['result_contact'] = $this->data->get_table_data('contact_info');
$id_mess = $this->session->userdata('id_admin');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
$data['city']=$this->data->get_table_data('city',array('view'=>'1'));	
$data['clients_data']=$this->data->get_table_data('clients',array('id'=>$id_mess));
$data['clients_cars']=$this->data->get_table_data('virtual_table',array('id_clients'=>$id_mess));
$this->load->view('pages/booking_cars',$data);
}
else {
redirect('/home/login?lang=en');	
}

}


public function booking_cars_action(){	
$this->load->view('pages/config/booking_cars_action');
}


}