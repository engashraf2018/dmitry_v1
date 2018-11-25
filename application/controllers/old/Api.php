<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

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

    public function index(){
    echo "ooo";
    }

public function gen_random_string(){
$chars ="1234567890";//length:36
$final_rand='';
for($i=0;$i<6; $i++) {
$final_rand .= $chars[ rand(0,strlen($chars)-1)];
}
return $final_rand;
}

/*******************************************App Services*****************************************/
public function loginpassanger_api(){
$json = file_get_contents('php://input');
$username =$this->input->post('username');
$password =$this->input->post('pass');
$lang =$this->input->post('lang');
$token_id =$this->input->post('token_id');
$passwordp=md5($password);
$customer_id="";
$customer_not="";
$array = array(); 
$customer_not = $this->data->get_table_row('clients',array('phone'=>$username,'password'=>$passwordp,'view'=>'0','code_actvation'=>'1','type'=>'1'),'id');
if($customer_not==""){
$customer_not = $this->data->get_table_row('clients',array('email'=>$username,'password'=>$passwordp,'view'=>'0','code_actvation'=>'1','type'=>'1'),'id');
 }
if($customer_not!=""){
$a['messageID']=0;
if($lang==2){
$a['message'] ="الاكونت محظور حاليا";
}
else {
$a['message'] ="Account is currently blocked";	
}
$array["message"][]= $a;
}
$customer_not = $this->data->get_table_row('clients',array('phone'=>$username,'password'=>$passwordp,'view'=>'1','code_actvation'=>'0','type'=>'1'),'id');
if($customer_not==""){
$customer_not = $this->data->get_table_row('clients',array('email'=>$username,'password'=>$passwordp,'view'=>'1','code_actvation'=>'0','type'=>'1'),'id');
 }
if($customer_not!=""){
$a['messageID']=0;
if($lang==2){
$a['message'] ="حسابك غير مفعل";
}
else {
$a['message'] ="Account is not confirm";	
}
$array["message"][]= $a;

}

	else {
$customer_id = $this->data->get_table_row('clients',array('phone'=>$username,'password'=>$passwordp,'view'=>'1','code_actvation'=>'1','type'=>'1'),'id');
 if($customer_id==""){
$customer_id = $this->data->get_table_row('clients',array('email'=>$username,'password'=>$passwordp,'view'=>'1','code_actvation'=>'1','type'=>'1'),'id');
 }  
if($customer_id != ""){
if($token_id!=""){
$data_location = array('token_id'=>$token_id);
$this->db->update('clients',$data_location,array('id'=>$customer_id));
}
$user_email =$this->data->get_table_row('clients',array('id'=>$customer_id),'email');
$user_phone =$this->data->get_table_row('clients',array('id'=>$customer_id),'phone');
$user_img =$this->data->get_table_row('clients',array('id'=>$customer_id),'img');
$type =$this->data->get_table_row('clients',array('id'=>$customer_id),'type');
$fname =$this->data->get_table_row('clients',array('id'=>$customer_id),'fname');
$user_email=$user_email;
$fname_admin=$fname;
$id_admin=$customer_id;
$user_phone=$user_phone;
$type_admin=$type;
if($user_img!=""){$main_img="http://tareki.com/site/ar/images/passanger/".$user_img;}else {
$main_img="http://tareki.com/site/ar/images/passanger/defaultmain.png";}
$main_img=$main_img;
$m['messageID']=1;
if($lang==2){
$m['message'] ="تم تسجيل الدخول بنجاح";
	 }
else {
$m['message']  ="Logged in successfully"; 
	 }
$array["message"][]=$m;
$a['fname_admin'] =$fname;
$a['id_admin'] =$customer_id;
$a['user_phone'] =$user_phone;
$a['main_img'] =$main_img;
//$a['token_id']=$token_id;
 $array["data"][]= $a;
 
}



 else {
$a['messageID']=0;
	 if($lang==2){
$a['message'] ="كلمة المرور او اسم الايميل غير صحيح";
	 }
else {
$a['message']  ="Password or E_mail not correct"; 
	 }
$array["message"][]= $a;
    }
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }




public function logindriver_api(){
$json = file_get_contents('php://input');
$username =$this->input->post('username');
$password =$this->input->post('pass');
$lang =$this->input->post('lang');
$token_id=$this->input->post('token_id');
$passwordp=md5($password);
$array = array(); 
$customer_id="";
$customer_not="";
$customer_not = $this->data->get_table_row('clients',array('phone'=>$username,'password'=>$passwordp,'view'=>'0','code_actvation'=>'1','type'=>'0'),'id');
if($customer_not==""){
$customer_not = $this->data->get_table_row('clients',array('email'=>$username,'password'=>$passwordp,'view'=>'0','code_actvation'=>'1','type'=>'0'),'id');
 }
if($customer_not!="")
{
$a['messageID']=0;

if($lang==2){
$a['message'] ="الاكونت محظور حاليا";
}
else {
$a['message'] ="Account is currently blocked";	
}
$array["message"][]= $a;
}
$customer_not = $this->data->get_table_row('clients',array('phone'=>$username,'password'=>$passwordp,'view'=>'1','code_actvation'=>'0','type'=>'0'),'id');
if($customer_not==""){
$customer_not = $this->data->get_table_row('clients',array('email'=>$username,'password'=>$passwordp,'view'=>'1','code_actvation'=>'0','type'=>'0'),'id');
 }
if($customer_not!=""){
$a['messageID']=0;
if($lang==2){
$a['message'] ="حسابك غير مفعل";
}
else {
$a['message'] ="Account is not confirm";	
}
$array["message"][]= $a;
}


else {
$customer_id = $this->data->get_table_row('clients',array('phone'=>$username,'password'=>$passwordp,'view'=>'1','code_actvation'=>'1','type'=>'0'),'id');
 if($customer_id==""){
$customer_id = $this->data->get_table_row('clients',array('email'=>$username,'password'=>$passwordp,'view'=>'1','code_actvation'=>'1','type'=>'0'),'id');
 }  


if($customer_id != ""){
    if($token_id!=""){
$data_location = array('token_id'=>$token_id);
$this->db->update('clients',$data_location,array('id'=>$customer_id));
}
$user_email =$this->data->get_table_row('clients',array('id'=>$customer_id),'email');
$user_phone =$this->data->get_table_row('clients',array('id'=>$customer_id),'phone');
$user_img =$this->data->get_table_row('clients',array('id'=>$customer_id),'img');
$type =$this->data->get_table_row('clients',array('id'=>$customer_id),'type');
$fname =$this->data->get_table_row('clients',array('id'=>$customer_id),'fname');
 $id_type=$this->data->get_table_row('attachment',array('id_clients'=>$customer_id),'id');
 $token_id=$this->data->get_table_row('clients',array('id'=>$customer_id),'token_id');
if($id_type!=""){
$id_category=$this->data->get_table_row('attachment',array('id_clients'=>$customer_id),'id_category');
$client_type="Individually";
$client_typear="حساب فردى";
 }

else {
$id_type=$this->data->get_table_row('company',array('id_clients'=>$customer_id),'id');
$client_type="Company";
$client_typear="حساب شركات";

$id_category=$this->data->get_table_row('company',array('id_clients'=>$customer_id),'id_category');
 }

$result_services= $this->db->get_where('category',array('id'=>$id_category))->result();
if( count($result_services)==1){
foreach($result_services as $result_services){
$name_cat=$result_services->titleeng;
$name_catar=$result_services->title;	
}
}
if($user_img!=""){$main_img="http://tareki.com/site/ar/images/driver/".$user_img;}else{
 $main_img="http://tareki.com/site/ar/images/driver/defaultmain.png";
}
$main_img=$main_img;
$m['messageID']=1;
if($lang==2){
$m['message'] ="تم تسجيل الدخول بنجاح";
$a['fname_admin'] =$fname;
$a['id_admin'] =$customer_id;
$a['user_phone'] =$user_phone;
$a['main_img'] =$main_img;
$a['client_type'] =$client_typear;
$a['Service_type'] =$name_catar;
//$a['token_id']=$token_id;
}
else {
$m['message'] ="Logged in successfully";
$a['fname_admin'] =$fname;
$a['id_admin'] =$customer_id;
$a['user_phone'] =$user_phone;
$a['main_img'] =$main_img;
$a['client_type'] =$client_type;
$a['Service_type'] =$name_cat;
//$a['token_id']=$token_id;
}
$array["message"][]= $m;
 $array["data"][]= $a;
}

else {
$a['messageID']=0;
if($lang==2){
$a['message'] ="كلمة المرور او اسم الايميل غير صحيح";
}
else {
$a['message'] ="Password or E_mail not correct"; 
}
$array["message"][]= $a;
}
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }




public function foget_password_api(){
$this->load->view('pages/config/foget_password_api');		
}

public function passangerregister_api(){	
$this->load->view('pages/config/passangerregister_api');
}





public function nextpassangerregister_api(){
$json = file_get_contents('php://input');
$id_mess = $this->input->post('token_id');
$client_id= $this->input->post('client_id');
$array = array();  
$lang = $this->input->post('lang');

if(isset($_FILES['file']['name'])&&$_FILES['file']['name']!=""){
$logo = $this->data->get_table_row('clients',array('id'=>$client_id),'img'); 
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
 $errors = $this->upload->display_errors();
$main_da=0;
$m['message']=$errors;

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
$a['url_img']="http://tareki.com/site/ar/images/passanger/".$imagename.".".$file_extension;
$array['message'][]= $a;

}
}



@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}




public function driverregister_api(){	
$this->load->view('pages/config/driverregister_api');
}


public function service_type(){
$json = file_get_contents('php://input');
$account_type =$this->input->post('account_type');
$lang =$this->input->post('lang');
if($account_type==1){
$result_services= $this->db->get_where('category',array('position!='=>'0'))->result();
}
if($account_type==0){
$result_services= $this->db->get_where('category',array('position!='=>'1'))->result();
}
foreach($result_services as $result_services){
$services_type=$result_services->titleeng;
$services_typear=$result_services->title;	
$id_services=$result_services->id;
$model=$result_services->model;	

if($lang==2){
$a['services_type'] =$services_typear;
$a['id_services'] =$id_services;
$a['model_services'] =$model;
}
else {

$a['services_type'] =$services_type;
$a['id_services'] =$id_services;
$a['model_services'] =$model;
}
 $array["data"][]= $a;
}


@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }






public function get_model_api(){
$json = file_get_contents('php://input');
$id_services=$this->input->post('id_services');
$lang =$this->input->post('lang');
$array=array();
$result_services= $this->db->get_where('category',array('id'=>$id_services))->result();
foreach($result_services as $result_services){
$model=$result_services->model;	
$date = '05/06/'.$model;
$date = strtotime($date);
$date = strtotime('- 1 year', $date);
 $date=date('Y', $date);
$datay=date('Y');
while($date<$datay) {
$main_d=$date+1;
$date =$main_d;
$a['model']=$main_d;
$array["data"][]= $a;
}
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }








public function car_type(){
$json = file_get_contents('php://input');
$id_services=$this->input->post('id_services');
$lang =$this->input->post('lang');
$result_cars= $this->db->get_where('cars',array('id_category'=>$id_services))->result();
foreach($result_cars as $result_cars){
$cars_type=$result_cars->titleeng;
$cars_typear=$result_cars->title;	
$id_cars=$result_cars->id;	

if($lang==2){
$a['car_type'] =$cars_typear;
$a['id_car'] =$id_cars;
}
else {
$a['car_type'] =$cars_type;
$a['id_car'] =$id_cars;
}
 $array["data"][]= $a;
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }






public function nextdriverregister_api(){
$json = file_get_contents('php://input');
$client_id = $this->input->post('client_id');
$id_mess=$client_id;
$token_id=$this->data->get_table_row('clients',array('id'=>$client_id),'token_id');
 if($client_id!=""){
$lang = $this->input->post('lang');
$account_type = $this->input->post('account_type');
$service_id = $this->input->post('service_id');
$car_model = $this->input->post('car_model');
$car_number = $this->input->post('car_number');
$car_color = $this->input->post('car_color');
$car_type_id = $this->input->post('car_type_id');
$city_id= $this->input->post('city_id');
 if($account_type==1) { 
 $result_clients= $this->db->get_where('company',array('id_clients'=>$client_id))->result();
if( count($result_clients)==1){
$ids = $this->data->get_table_row('company',array('id_clients'=>$client_id),'id'); 	
$data = array('id_category'=>$service_id,'city_id'=>$city_id);
$this->db->update('company',$data,array('id'=>$ids));
}
else { 
$data['id_clients'] = $id_mess;
$data['id_category'] = $service_id;
$this->db->insert('company',$data);
$ids = $this->db->insert_id(); 
}
 
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
if($lang==2){$a['message']="لم يتم رفع الصورة";}
else {$a['message']="Image not uploaded"; }

$array['message'][]= $a;
 }

else {
$url= $_FILES['imgid']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('national_id'=>$imagename.".".$file_extension);
$this->data->edit_table('company',$ids,$data);
if($lang==2){$a['message']="تم رفع الصورة ";}
else {$a['message']="Image uploaded"; }
$a['url_img']="http://tareki.com/site/ar/images/driver/".$imagename.".".$file_extension;
$array['message'][]= $a;
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
	 
if($lang==2){$a['message']="لم يتم رفع الصورة";}
else {$a['message']="Image not uploaded"; }
$array['message'][]= $a;
 }

else {
$url= $_FILES['file']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('img'=>$imagename.".".$file_extension);
$this->data->edit_table('clients',$id_mess,$data);
if($lang==2){
$a['message']="تم رفع الصورة ";
}
else {
$a['message']="Image uploaded"; 
}
$array['message'][]= $a;
}

  }
$a['messageID']=1;
if($lang==2){
$a['message'] ="يرجى تفعيل حسابك,تم التسجيل بنجاح";
}
else {
$a['message'] ="Please activate your account, registration successful";
}

 }


if($account_type==0){
$result_clients= $this->db->get_where('attachment',array('id_clients'=>$client_id))->result();
if( count($result_clients)==1){
$ids = $this->data->get_table_row('attachment',array('id_clients'=>$client_id),'id'); 	
$data = array('id_category'=>$service_id,'model'=>$car_model,'car_number'=>$car_number,'car_color'=>$car_color,'car_type'=>$car_type_id);
$this->db->update('attachment',$data,array('id'=>$ids));
}
else {
$data['id_clients'] = $client_id;
$data['id_category'] = $service_id;
$data['model'] = $car_model;
$data['car_number'] = $car_number;
$data['car_color'] = $car_color;
$data['car_type'] = $car_type_id;
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
if($lang==2){$a['message']="لم يتم رفع الصورة";}
else {$a['message']="Image not uploaded"; }
$array['message'][]= $a;
 }

else {
$url= $_FILES['imgid']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('nationalid'=>$imagename.".".$file_extension);
$this->data->edit_table('attachment',$ids,$data);
if($lang==2){$a['message']="تم رفع الصورة ";}
else {$a['message']="Image uploaded"; }
$array['message'][]= $a;
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
 if($lang==2){$a['message']="لم يتم رفع الصورة";}
else {$a['message']="Image not uploaded"; }
$array['message'][]= $a;
 }

else {
$url= $_FILES['license']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('drivinglicense'=>$imagename.".".$file_extension);
$this->data->edit_table('attachment',$ids,$data);
if($lang==2){$a['message']="تم رفع الصورة ";}
else {$a['message']="Image uploaded"; }
$array['message'][]= $a;
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
if($lang==2){$a['message']="لم يتم رفع الصورة";}
else {$a['message']="Image not uploaded"; }
$array['message'][]= $a;
 }

else {
$url= $_FILES['carimg']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('carpicture'=>$imagename.".".$file_extension);
$this->data->edit_table('attachment',$ids,$data);
if($lang==2){$a['message']="تم رفع الصورة ";}
else {$a['message']="Image uploaded"; }
$array['message'][]= $a;
}

  }
  
 

  }




$b['token_id'] =$token_id;
$b['client_id'] =$client_id;
 $array["message"][]= $a;
$array["data"][]= $b;

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}








public function about_us_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
if($lang==2){
$a['link_url'] ="http://tareki.com/home/aboutus?lang=ar";
}
else {
$a['link_url'] ="http://tareki.com/home/aboutus?lang=en";
}
 $array["data"][]= $a;

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }

public function news_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
if($lang==2){
$a['link_url'] ="http://tareki.com/home/news?lang=ar";
}
else {
$a['link_url'] ="http://tareki.com/home/news?lang=en";
}
 $array["data"][]= $a;

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }


public function news_details_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id=$this->uri->segment(3);

if($lang==2){
$a['link_url'] ="http://tareki.com/home/news_details/$id?lang=ar";
}
else {
$a['link_url'] ="http://tareki.com/home/news_details/$id?lang=en";
}
 $array["data"][]= $a;

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }

public function contactus_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');

if($lang==2){
$a['link_url'] ="http://tareki.com/home/contactus?lang=ar";
}
else {
$a['link_url'] ="http://tareki.com/home/contactus?lang=en";
}
 $array["data"][]= $a;

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }

public function all_services_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$result_category= $this->db->get_where('category',array('view'=>'1'))->result();
foreach($result_category as $result_category){

$name_cat=$result_category->titleeng;
$name_catar=$result_category->title;
$service_id=$result_category->id;

if($lang==2){
$a['service_name'] =$name_catar;
$a['service_id'] =$service_id;
}
else {
$a['service_name'] =$name_catar;
$a['service_id'] =$service_id;
}
 $array["data"][]= $a;
}

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }







public function carpooling(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$leaving_id=$this->input->post('leaving_id');
$gooing_id=$this->input->post('gooing_id');
$data=$this->input->post('data');

if($leaving_id==""&&$gooing_id==""){
$result_carpooling= $this->db->get_where('carpooling',array())->result();
}
if($leaving_id!=""&&$gooing_id==""){
$result_carpooling= $this->db->get_where('carpooling',array('leaving'=>$leaving_id))->result();
}
if($leaving_id==""&&$gooing_id!=""){
$result_carpooling= $this->db->get_where('carpooling',array('gooing'=>$gooing_id))->result();
}
if($leaving_id!=""&&$gooing_id!=""){
$result_carpooling= $this->db->get_where('carpooling',array('leaving'=>$leaving_id,'gooing'=>$gooing_id))->result();
}



foreach($result_carpooling  as $result_carpooling){
 $id_clients_pooling=$result_carpooling->id_clients;
 $id_leaving=$result_carpooling->leaving;
 $id_gooing=$result_carpooling->gooing;
 $datedata=$result_carpooling->datedata;
 $seats=$result_carpooling->seats;
 $messages=$result_carpooling->messages;
 $finalspace=$result_carpooling->finalspace;
 $finalprice=$result_carpooling->finalprice;
 $pernumber=$result_carpooling->pernumber;
$duration=$result_carpooling->duration;
$num_account=$result_carpooling->num_account;

$startpoint=$result_carpooling->startpoint;
$endpoint=$result_carpooling->endpoint;
$direction_text=$result_carpooling->direction_text;
$time_trip=$result_carpooling->time_trip;

$carpicture= $this->data->get_table_row('attachment',array('id_clients'=>$id_clients_pooling),'carpicture');
$car_type= $this->data->get_table_row('attachment',array('id_clients'=>$id_clients_pooling),'car_type');
$car_ar= $this->data->get_table_row('cars',array('id'=>$car_type),'title');
$car_eng= $this->data->get_table_row('cars',array('id'=>$car_type),'titleeng');


if($carpicture!=""){$carpicture="http://tareki.com/site/ar/images/driver/".$carpicture;}
else {
 $carpicture="http://tareki.com/site/ar/images/driver/defaultmain.png";
}

$client_fname= $this->data->get_table_row('clients',array('id'=>$id_clients_pooling),'fname');
$client_img= $this->data->get_table_row('clients',array('id'=>$id_clients_pooling),'img');
if($client_img!=""){$Profile_img="http://tareki.com/site/ar/images/driver/".$client_img;}
else {
 $Profile_img="http://tareki.com/site/ar/images/driver/defaultmain.png";
}
$leaving_city_ar= $this->data->get_table_row('city',array('id'=>$id_leaving),'name');
$leaving_city= $this->data->get_table_row('city',array('id'=>$id_leaving),'name_eng');




$leaving_lat= $this->data->get_table_row('city',array('id'=>$id_leaving),'lat');
$leaving_lag= $this->data->get_table_row('city',array('id'=>$id_leaving),'lag');


$gooing_city_ar= $this->data->get_table_row('city',array('id'=>$id_gooing),'name');
$gooing_city= $this->data->get_table_row('city',array('id'=>$id_gooing),'name_eng');

$gooing_lat= $this->data->get_table_row('city',array('id'=>$id_gooing),'lat');
$gooing_lag= $this->data->get_table_row('city',array('id'=>$id_gooing),'lag');

$current_date=date("Y-m-d H",strtotime($datedata));
$daydate=date("Y-m-d H");
if($duration==1){
$duration="one day";
 if($daydate>=$current_date){
$key=0;
}
else{
$key=1;
}
}
else{
$duration="daily";
$key=1;
}
if($data!=""){
$maindate=date("Y-m-d H",strtotime($data));
$current_date=date("Y-m-d H",strtotime($datedata));
if($maindate==$current_date){
$a['client_name']=$client_fname;
$a['Profile_img']=$Profile_img;
if($lang==2){
$a['Leaving_city']=$leaving_city_ar;
$a['Gooin_city']=$gooing_city_ar;
$a['car_name']=$car_ar;
}
else {
$a['Leaving_city']=$leaving_city;
$a['Gooin_city']=$gooing_city;
$a['car_name']=$car_eng;
}
$a['leaving_lat']=$leaving_lat;
$a['leaving_lag']=$leaving_lag;
$a['gooing_lat']=$gooing_lat;
$a['gooing_lag']=$gooing_lag;
$a['number_seats']=$seats;
$a['messages']=$messages;
$a['finalspace']=$finalspace;
$a['finalprice']=$finalprice;
$a['price_price_client']=$pernumber;
$a['seate_rservation']=$num_account;
 $a['trips_date']=$current_date;
$a['duration']=$duration;
$a['validation_trip']=$key;
$a['startpoint']=$startpoint;
$a['endpoint']=$endpoint;
$a['direction']=$direction_text;
$a['time_trip']=$time_trip;
$a['carpicture']=$carpicture;

$a['id_trips']=$result_carpooling->id;
 $array["data"][]= $a;
}
}
else {
$a['client_name']=$client_fname;
$a['Profile_img']=$Profile_img;

if($lang==2){
$a['Leaving_city']=$leaving_city_ar;
$a['Gooin_city']=$gooing_city_ar;
$a['car_name']=$car_ar;
}
else {
$a['Leaving_city']=$leaving_city;
$a['Gooin_city']=$gooing_city;
$a['car_name']=$car_eng;
}
$a['leaving_lat']=$leaving_lat;
$a['leaving_lag']=$leaving_lag;
$a['gooing_lat']=$gooing_lat;
$a['gooing_lag']=$gooing_lag;
$a['number_seats']=$seats;
$a['messages']=$messages;
$a['finalspace']=$finalspace;
$a['finalprice']=$finalprice;
$a['price_price_client']=$pernumber;










$a['seate_rservation']=$num_account;
 $a['trips_date']=$current_date;
$a['duration']=$duration;
$a['validation_trip']=$key;
$a['startpoint']=$startpoint;
$a['endpoint']=$endpoint;
$a['direction']=$direction_text;
$a['time_trip']=$time_trip;
$a['carpicture']=$carpicture;
 $a['id_trips']=$result_carpooling->id;
 $array["data"][]= $a;
}
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }

public function Organizations(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$city_id=$this->input->post('city_id');
$model=$this->input->post('model');
$car_id=$this->input->post('car_id');

if($model==""&&$car_id==""){
if($city_id!=""){
$result_Organization= $this->db->get_where('company',array('city_id'=>$city_id,'activation'=>'1'))->result();
}
else {
$result_Organization= $this->db->get_where('company',array('activation'=>'1'))->result();
}
if(count($result_Organization)>=1){

foreach($result_Organization as $result_carpooling){
$national_id=$result_carpooling->national_id;
$about_you=$result_carpooling->about_you;
$id_clients=$result_carpooling->id_clients;
$id_category=$result_carpooling->id_category;
$city_id=$result_carpooling->city_id;
$gooing_city_ar= $this->data->get_table_row('city',array('id'=>$city_id),'name');
$gooing_city= $this->data->get_table_row('city',array('id'=>$city_id),'name_eng');
$gooing_lat= $this->data->get_table_row('city',array('id'=>$city_id),'lat');
$gooing_lag= $this->data->get_table_row('city',array('id'=>$city_id),'lag');
$client_fname= $this->data->get_table_row('clients',array('id'=>$id_clients),'fname');
$client_rate= $this->data->get_table_row('clients',array('id'=>$id_clients),'rate');
$client_img= $this->data->get_table_row('clients',array('id'=>$id_clients),'img');
if($client_img!=""){$Profile_img="http://tareki.com/site/ar/images/driver/".$client_img;}
else {
 $Profile_img="http://tareki.com/site/ar/images/driver/defaultmain.png";
}


$title= $this->data->get_table_row('category',array('id'=>$id_category),'title');
$titleeng= $this->data->get_table_row('category',array('id'=>$id_category),'titleeng');

$a['company_name']=$client_fname;
$a['Profile_img']=$Profile_img;
if($lang==2){
$a['category_title']=$title;
$a['Address']=$gooing_city_ar;
}
else {
$a['category_title']=$titleeng;
$a['Address']=$gooing_city;
}
$a['lat']=$gooing_lat;
$a['lag']=$gooing_lag;
$a['comapny_rate']=$client_rate;
$a['about_company']=$about_you;
$a['id_organizations']=$result_carpooling->id;;
$array["data"][]=$a;

}



}
else {
$a['messageID']=0;
if($lang==2){
$a['message']="نأسف لعدم وجود بيانات";
}
else {
$a['message']="Sorry for missing data"; 
}
$array["message"][]=$a;
}
}
/*****************End First Codiation**********************************/

else if($model!=""&&$car_id==""){
$result_model= $this->db->get_where('company_car',array('model'=>$model))->result();
if(count($result_model)>0){
foreach($result_model as $result_model){
 $id_organization=$result_model->id_organization;
if($city_id!=""){
$result_Organization= $this->db->get_where('company',array('city_id'=>$city_id,'id'=>$id_organization,'activation'=>'1'))->result();
}
else {
$result_Organization= $this->db->get_where('company',array('id'=>$id_organization,'activation'=>'1'))->result();
}
if(count($result_Organization)>0){
foreach($result_Organization as $result_carpooling)
 $national_id=$result_carpooling->national_id;
 $about_you=$result_carpooling->about_you;
$id_clients=$result_carpooling->id_clients;
$id_category=$result_carpooling->id_category;
$city_id=$result_carpooling->city_id;
$gooing_city_ar= $this->data->get_table_row('city',array('id'=>$city_id),'name');
$gooing_city= $this->data->get_table_row('city',array('id'=>$city_id),'name_eng');
$gooing_lat= $this->data->get_table_row('city',array('id'=>$city_id),'lat');
$gooing_lag= $this->data->get_table_row('city',array('id'=>$city_id),'lag');
$client_fname= $this->data->get_table_row('clients',array('id'=>$id_clients),'fname');
$client_rate= $this->data->get_table_row('clients',array('id'=>$id_clients),'rate');
$client_img= $this->data->get_table_row('clients',array('id'=>$id_clients),'img');
if($client_img!=""){$Profile_img="http://tareki.com/site/ar/images/driver/".$client_img;}
else {
 $Profile_img="http://tareki.com/site/ar/images/driver/defaultmain.png";
}


$title= $this->data->get_table_row('category',array('id'=>$id_category),'title');
$titleeng= $this->data->get_table_row('category',array('id'=>$id_category),'titleeng');

$a['company_name']=$client_fname;
$a['Profile_img']=$Profile_img;
if($lang==2){
$a['category_title']=$title;
$a['Address']=$gooing_city_ar;
}
else {
$a['category_title']=$titleeng;
$a['Address']=$gooing_city;
}
$a['lat']=$gooing_lat;
$a['lag']=$gooing_lag;
$a['comapny_rate']=$client_rate;
$a['about_company']=$about_you;
$a['id_organizations']=$result_carpooling->id;;
 $array["data"][]=$a;
}
else {
$a['messageID']=0;
if($lang==2){
$a['message']="نأسف لعدم وجود بيانات";
}
else {
$a['message']="Sorry for missing data"; 
}
$array["message"][]=$a;

}

}

}
else {
$a['messageID']=0;
if($lang==2){
$a['message']="نأسف لعدم وجود بيانات";
}
else {
$a['message']="Sorry for missing data"; 
}
$array["message"][]=$a;

}
}
/***********************************************/

/*****************End Second Codiation**********************************/

else if($model!=""&&$car_id!=""){
$result_model= $this->db->get_where('company_car',array('model'=>$model,'car_type'=>$car_id))->result();
if(count($result_model)>0){
foreach($result_model as $result_model){
 $id_organization=$result_model->id_organization;
if($city_id!=""){
$result_Organization= $this->db->get_where('company',array('city_id'=>$city_id,'id'=>$id_organization,'activation'=>'1'))->result();
}
else {
$result_Organization= $this->db->get_where('company',array('id'=>$id_organization,'activation'=>'1'))->result();
}
if(count($result_Organization)>0){
foreach($result_Organization as $result_carpooling)
 $national_id=$result_carpooling->national_id;
 $about_you=$result_carpooling->about_you;
$id_clients=$result_carpooling->id_clients;
$id_category=$result_carpooling->id_category;
$city_id=$result_carpooling->city_id;
$gooing_city_ar= $this->data->get_table_row('city',array('id'=>$city_id),'name');
$gooing_city= $this->data->get_table_row('city',array('id'=>$city_id),'name_eng');
$gooing_lat= $this->data->get_table_row('city',array('id'=>$city_id),'lat');
$gooing_lag= $this->data->get_table_row('city',array('id'=>$city_id),'lag');
$client_fname= $this->data->get_table_row('clients',array('id'=>$id_clients),'fname');
$client_rate= $this->data->get_table_row('clients',array('id'=>$id_clients),'rate');
$client_img= $this->data->get_table_row('clients',array('id'=>$id_clients),'img');
if($client_img!=""){$Profile_img="http://tareki.com/site/ar/images/driver/".$client_img;}
else {
 $Profile_img="http://tareki.com/site/ar/images/driver/defaultmain.png";
}


$title= $this->data->get_table_row('category',array('id'=>$id_category),'title');
$titleeng= $this->data->get_table_row('category',array('id'=>$id_category),'titleeng');

$a['company_name']=$client_fname;
$a['Profile_img']=$Profile_img;
if($lang==2){
$a['category_title']=$title;
$a['Address']=$gooing_city_ar;
}
else {
$a['category_title']=$titleeng;
$a['Address']=$gooing_city;
}
$a['lat']=$gooing_lat;
$a['lag']=$gooing_lag;
$a['comapny_rate']=$client_rate;
$a['about_company']=$about_you;
$a['id_organizations']=$result_carpooling->id;;
 $array["data"][]=$a;
}
else {
$a['messageID']=0;
if($lang==2){
$a['message']="نأسف لعدم وجود بيانات";
}
else {
$a['message']="Sorry for missing data"; 
}
$array["message"][]=$a;

}

}

}
else {
$a['messageID']=0;
if($lang==2){
$a['message']="نأسف لعدم وجود بيانات";
}
else {
$a['message']="Sorry for missing data"; 
}
$array["message"][]=$a;

}
}
/***********************************************/




/*****************End Thrid Codiation**********************************/

else if($model==""&&$car_id!=""){
$result_model= $this->db->get_where('company_car',array('car_type'=>$car_id))->result();
if(count($result_model)>0){
foreach($result_model as $result_model){
 $id_organization=$result_model->id_organization;
if($city_id!=""){
$result_Organization= $this->db->get_where('company',array('city_id'=>$city_id,'id'=>$id_organization,'activation'=>'1'))->result();
}
else {
$result_Organization= $this->db->get_where('company',array('id'=>$id_organization,'activation'=>'1'))->result();
}
if(count($result_Organization)>0){
foreach($result_Organization as $result_carpooling)
 $national_id=$result_carpooling->national_id;
 $about_you=$result_carpooling->about_you;
$id_clients=$result_carpooling->id_clients;
$id_category=$result_carpooling->id_category;
$city_id=$result_carpooling->city_id;
$gooing_city_ar= $this->data->get_table_row('city',array('id'=>$city_id),'name');
$gooing_city= $this->data->get_table_row('city',array('id'=>$city_id),'name_eng');
$gooing_lat= $this->data->get_table_row('city',array('id'=>$city_id),'lat');
$gooing_lag= $this->data->get_table_row('city',array('id'=>$city_id),'lag');
$client_fname= $this->data->get_table_row('clients',array('id'=>$id_clients),'fname');
$client_rate= $this->data->get_table_row('clients',array('id'=>$id_clients),'rate');
$client_img= $this->data->get_table_row('clients',array('id'=>$id_clients),'img');
if($client_img!=""){$Profile_img="http://tareki.com/site/ar/images/driver/".$client_img;}
else {
 $Profile_img="http://tareki.com/site/ar/images/driver/defaultmain.png";
}


$title= $this->data->get_table_row('category',array('id'=>$id_category),'title');
$titleeng= $this->data->get_table_row('category',array('id'=>$id_category),'titleeng');

$a['company_name']=$client_fname;
$a['Profile_img']=$Profile_img;
if($lang==2){
$a['category_title']=$title;
$a['Address']=$gooing_city_ar;
}
else {
$a['category_title']=$titleeng;
$a['Address']=$gooing_city;
}
$a['lat']=$gooing_lat;
$a['lag']=$gooing_lag;
$a['comapny_rate']=$client_rate;
$a['about_company']=$about_you;
$a['id_organizations']=$result_carpooling->id;;
 $array["data"][]=$a;
}
else {
$a['messageID']=0;
if($lang==2){
$a['message']="نأسف لعدم وجود بيانات";
}
else {
$a['message']="Sorry for missing data"; 
}
$array["message"][]=$a;

}

}

}
else {
$a['messageID']=0;
if($lang==2){
$a['message']="نأسف لعدم وجود بيانات";
}
else {
$a['message']="Sorry for missing data"; 
}
$array["message"][]=$a;

}
}
/***********************************************/



@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }


public function event(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$result_events= $this->db->get_where('events',array('views'=>'1'))->result();
foreach($result_events as $result_events){
 $title=$result_events->title;
$titleeng=$result_events->titleeng;
$description=$result_events->description;
$descriptioneng=$result_events->descriptioneng;
 $short_description=$result_events->short_description;
 $date=$result_events->date;
 $img=$result_events->img;
 $city_id=$result_events->city_id;
$current_date=date("Y-m-d H",strtotime($date));
$daydate=date("Y-m-d H");

$gooing_city_ar= $this->data->get_table_row('city',array('id'=>$city_id),'name');
$gooing_city= $this->data->get_table_row('city',array('id'=>$city_id),'name_eng');
$gooing_lat= $this->data->get_table_row('city',array('id'=>$city_id),'lat');
$gooing_lag= $this->data->get_table_row('city',array('id'=>$city_id),'lag');

 $short_descriptioneng=$result_events->short_descriptioneng;
 $price=$result_events->price;
 $event_date=$result_events->event_date;
$event_date=$result_events->event_date;

if($img!=""){$event_img="http://tareki.com/site/ar/images/events/".$img;}
else {
 $event_img="http://tareki.com/site/ar/images/events/defaultmain.png";
}
$a['id_event']=$result_events->id;
if($lang==2){
$a['event_title']=$title;

$a['short_description']=$short_description;
$a['full_description']=$description;
$a['Address']=$gooing_city_ar;
}
else {
$a['event_title']=$titleeng;
$a['short_description']=$short_descriptioneng;
$a['full_description']=$descriptioneng;
$a['Address']=$gooing_city;
}
if($daydate>=$current_date){
$key=0;
}
else{
$key=1;
}

$a['lat']=$gooing_lat;
$a['lag']=$gooing_lag;
$a['event_price']=$price;
$a['event_date']=$event_date;
$a['event_img']=$event_img;
$a['event_validation']=$key;
 $array["data"][]= $a;
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }




public function passanger_profile(){
$json = file_get_contents('php://input');
$lang =$this->input->post('lang');
$id_mess =$this->input->post('id_client');
$id_token=$this->input->post('id_token');
$full_name=$this->input->post('full_name');
$email=$this->input->post('email');
$phone=$this->input->post('phone');
$password=$this->input->post('password');
$main_da=0;
$array=array();
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
///dddd

if($id_token!=""){
$data = array('token_id'=>$id_token);
$this->data->edit_table('clients',$id_mess,$data);
$main_da=1;
}

if($full_name!=""){
$data = array('fname'=>$full_name);
$this->data->edit_table('clients',$id_mess,$data);
$main_da=1;
}
if($email!=""){
$data = array('email'=>$email);
$this->data->edit_table('clients',$id_mess,$data);
$main_da=1;

}
if($phone!=""){
$data = array('phone'=>$phone);
$this->data->edit_table('clients',$id_mess,$data);
$main_da=1;
}

if($password!=""){
$data = array('password'=>md5($password),'text_value'=>$password);
$this->data->edit_table('clients',$id_mess,$data);
$main_da=1;
}



if(isset($_FILES['file']['name'])&&$_FILES['file']['name']!=""){
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
 $errors = $this->upload->display_errors();
$main_da=0;
$m['message']=$errors;
 }

else {
$url= $_FILES['file']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('img'=>$imagename.".".$file_extension);
$this->data->edit_table('clients',$id_mess,$data);
$main_da=1;
}
}




if($main_da==1){
$m['messageID']=1;
if($lang==2){
$m['message']="تم تعديل البيانات بنجاح";
}
else {
$m['message']="Data modified successfully"; 
}
}
else {
$m['messageID']=1;
if($lang==2){
$m['message']="بيانات حسابى";
}
else {
$m['message']="My Account"; 
}
}
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
foreach($result_clients as $result_clients){
$fname=$result_clients->fname;
$email=$result_clients->email;
$phone=$result_clients->phone;
$img=$result_clients->img;

if($img!=""){$main_img="http://tareki.com/site/ar/images/passanger/".$img;}else {
$main_img="http://tareki.com/site/ar/images/passanger/defaultmain.png";}
$token_id=$result_clients->token_id;
$rate=$result_clients->rate;
$mywallet=$result_clients->mywallet;
$killomater=$result_clients->killomater;
$a['full_name'] =$fname;
$a['email'] =$email;
$a['phone'] =$phone;
$a['rate'] =$rate;
$a['mywallet'] =$mywallet;
$a['killomater'] =$killomater;
$a['client_img'] =$main_img;
}
$array['message'][]= $m; 
$array['data'][]= $a; 


}

else {
$a['messageID']=0;
if($lang==2){
$a['message']="بيانات الحساب غير صحيحة";
}
else {
$a['message']="Account data is incorrect"; 
}
$array['message'][]= $a; 
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}


public function mywallet_passanger(){
$json = file_get_contents('php://input');
$lang =$this->input->post('lang');
$id_mess =$this->input->post('id_client');
$id_token=$this->input->post('id_token');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
	
foreach($result_clients as $result_clients){
$rate=$result_clients->rate;
$mywallet=$result_clients->mywallet;
$killomater=$result_clients->killomater;
$m['messageID']=1;
if($lang==2){
$m['message']="بيانات الحساب  صحيحة";
}
else {
$m['message']="Account data is correct"; 
}
$a['rate'] =$rate;
$a['mywallet'] =$mywallet;
$a['killomater'] =$killomater;
}
$array['data'][]= $m;
$array['data'][]= $a; 
}

else {
$a['messageID']=0;
if($lang==2){
$a['message']="بيانات الحساب غير صحيحة";
}
else {
$a['message']="Account data is incorrect"; 
}
$array['message'][]= $a; 
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}




public function mywallet_driver(){
$json = file_get_contents('php://input');
$lang =$this->input->post('lang');
$id_mess =$this->input->post('id_client');
$id_token=$this->input->post('id_token');
$result_clients= $this->db->get_where("clients",array('id'=>$id_mess))->result();
if( count($result_clients)==1){
foreach($result_clients as $result_clients){
$rate=$result_clients->rate;
$mywallet=$result_clients->mywallet;
$killomater=$result_clients->killomater;
$m['messageID']=1;
if($lang==2){
$m['message']="بيانات الحساب  صحيحة";
}
else {
$m['message']="Account data is correct"; 
}
$a['rate'] =$rate;
$a['mywallet'] =$mywallet;
$a['killomater'] =$killomater;
}
$array['data'][]= $m;
$array['data'][]= $a; 
}

else {
$a['messageID']=0;
if($lang==2){
$a['message']="بيانات الحساب غير صحيحة";
}
else {
$a['message']="Account data is incorrect"; 
}
$array['message'][]= $a; 
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}



public function city_api(){
$json = file_get_contents('php://input');
$lang =$this->input->post('lang');
$result_city= $this->db->get_where('city',array('view'=>'1'))->result();
foreach($result_city  as $result_services){
$city_name=$result_services->name_eng;
$city_namear=$result_services->name;	
$id_city=$result_services->id;
$lat=$result_services->lat;
$lag=$result_services->lag;
if($lang==2){
$a['city_name'] =$city_namear;
$a['id_city'] =$id_city;
}
else {

$a['city_name'] =$city_name;
$a['id_city'] =$id_city;
}
$a['lat'] =$lat;
$a['lag'] =$lag;

 $array["data"][]= $a;
}


@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }




public function state_api(){
$json = file_get_contents('php://input');
$lang =$this->input->post('lang');
$id_city=$this->input->post('id_city');
$result_state= $this->db->get_where('state',array('view'=>'1','id_city'=>$id_city))->result();
foreach($result_state  as $result_services){
$city_name=$result_services->name_eng;
$city_namear=$result_services->name;	
$id_city=$result_services->id;

if($lang==2){
$a['city_name'] =$city_namear;
$a['id_city'] =$id_city;
}
else {

$a['city_name'] =$city_name;
$a['id_city'] =$id_city;
}
 $array["data"][]= $a;
}


@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }





public function tarekiservice1_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$service_id=3;
if($lang==2){
$a['link_url'] ="http://tareki.com/home/cartype/$service_id/?lang=ar";
}
else {
$a['link_url'] ="http://tareki.com/home/cartype/$service_id/?lang=en";
}
 $array["data"][]= $a;

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }

public function tarekiservice2_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$service_id=4;
if($lang==2){
$a['link_url'] ="http://tareki.com/home/cartype/$service_id/?lang=ar";
}
else {
$a['link_url'] ="http://tareki.com/home/cartype/$service_id/?lang=en";
}
 $array["data"][]= $a;

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }

public function tarekiservice3_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$service_id=5;
if($lang==2){
$a['link_url'] ="http://tareki.com/home/cartype/$service_id/?lang=ar";
}
else {
$a['link_url'] ="http://tareki.com/home/cartype/$service_id/?lang=en";
}
 $array["data"][]= $a;

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }

public function tarekiservice4_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$service_id=6;
if($lang==2){
$a['link_url'] ="http://tareki.com/home/cartype/$service_id/?lang=ar";
}
else {
$a['link_url'] ="http://tareki.com/home/cartype/$service_id/?lang=en";
}
 $array["data"][]= $a;

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }

public function tarekiservice5_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$service_id=7;
if($lang==2){
$a['link_url'] ="http://tareki.com/home/cartype/$service_id/?lang=ar";
}
else {
$a['link_url'] ="http://tareki.com/home/cartype/$service_id/?lang=en";
}
 $array["data"][]= $a;

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }










public function addcar_api(){
$json = file_get_contents('php://input');
$id_client= $this->input->post('id_client');
$companyid=$this->data->get_table_row('company',array('id_clients'=>$id_client),'id');
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
$a['messageID']=1;
if($lang==2){
$a['message']="تم اضافة السيارة بنجاح";
}
else {
$a['message']="The car has been successfully added."; 
}
$array['message'][]= $a; 

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);


}







public function mycars_organization_api(){
$json = file_get_contents('php://input');

$array=array();
$lang =$this->input->post('lang');
$id_client=$this->input->post('id_client');
$companyid=$this->data->get_table_row('company',array('id_clients'=>$id_client),'id');
$result_events= $this->db->get_where('company_car',array('id_organization'=>$companyid))->result();
if(count($result_events)>=1){
foreach($result_events as $result_events){
$model=$result_events->model;
$color=$result_events->color;
$car_number=$result_events->car_number;
$carimg=$result_events->carimg;
$car_type=$result_events->car_type;
$car_id=$result_events->id;


$car_name_ar= $this->data->get_table_row('cars',array('id'=>$result_events->car_type),'title');
$car_name= $this->data->get_table_row('cars',array('id'=>$result_events->car_type),'titleeng');
if($carimg!=""){$event_img="http://tareki.com/site/ar/images/organizations/".$carimg;}
else {
$event_img="http://tareki.com/site/ar/images/organizations/default.png";
}

$a['car_model']=$model;
$a['car_color']=$color;
$a['car_number']=$car_number;
if($lang==2){
$a['car_name']=$car_name_ar;
}
else {
$a['car_name']=$car_name;
}
$a['car_img']=$event_img;

$a['car_id']=$car_id;
$array["data"][]= $a;
}
}
else {

$a['messageID']=0;
if($lang==2){
$a['message']="نأسف لعدم وجود بيانات";
}
else {
$a['message']="TSorry for missing data"; 
}
$array["message"][]= $a;
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }





public function delete_mycars(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$car_id=$this->input->post('car_id');
$ret_value=$this->data->delete_table_row('company_car',array('id'=>$car_id));

if($lang==2){
$a['message']="تم حذف السيارة بنجاح";
}
else {
$a['message']="The car has been successfully deleted"; 
}
$array["message"][]= $a;
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}





public function addfrined_api(){
$json = file_get_contents('php://input');
$email= $this->input->post('email');
$id_client= $this->input->post('id_client');
$lang= $this->input->post('lang');
$myfrinedid=$this->data->get_table_row('clients',array('email'=>$email),'id');
if($myfrinedid==""){
$a['messageID']=0;
if($lang==2){
$a['message']="نأسف لعدم وجود هذا الايميل";
}
else {
$a['message']="This email not found"; 
}
$array['message'][]= $a; 
  }
else {
$result_events= $this->db->get_where('myfriends',array('id_clients'=>$id_client))->result();
if(count($result_events)>=5){
$a['messageID']=0;
if($lang==2){
$a['message']="لقد وصلت الى الحد المسموح به من الاضافة";
}
else {
$a['message']="You have reached the limit of the add-on"; 
}
$array['message'][]= $a; 
}
else {


$result_events= $this->db->get_where('myfriends',array('id_clients'=>$id_client,'id_myfriend'=>$myfrinedid))->result();
if(count($result_events)>=1){
$a['messageID']=0;
if($lang==2){
$a['message']="هذا الايميل مضاف سابقا";
}
else {
$a['message']="This email has already been added"; 
}
$array['message'][]= $a; 
}
else {
$data['id_clients'] = $id_client;
$data['id_myfriend'] = $myfrinedid;
$this->db->insert('myfriends',$data);
$a['messageID']=1;
if($lang==2){
$a['message']="تم الاضافة بنجاح";
}
else {
$a['message']="Successfully added"; 
}
$array['message'][]= $a; 
}
}


}

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);


}




public function myfrineds_api(){
$json = file_get_contents('php://input');

$array=array();
$lang =$this->input->post('lang');
$id_client=$this->input->post('id_client');
$result_events= $this->db->get_where('myfriends',array('id_clients'=>$id_client))->result();
if(count($result_events)>=1){
foreach($result_events as $result_events){
$id_myfriend=$result_events->id_myfriend;

$fname= $this->data->get_table_row('clients',array('id'=>$id_myfriend),'fname');
$email= $this->data->get_table_row('clients',array('id'=>$id_myfriend),'email');
$carimg= $this->data->get_table_row('clients',array('id'=>$id_myfriend),'img');
if($carimg!=""){$event_img="http://tareki.com/site/ar/images/passanger/".$carimg;}
else {
$event_img="http://tareki.com/site/ar/images/organizations/default.png";
}
$a['fname']=$fname;
$a['email']=$email;
$a['myfriend_img']=$event_img;
$a['id_mylist']=$result_events->id;;
$array["data"][]= $a;
}
}
else {

$a['messageID']=0;
if($lang==2){
$a['message']="نأسف لعدم وجود بيانات";
}
else {
$a['message']="TSorry for missing data"; 
}
$array["message"][]= $a;
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }






public function delete_myfrinds(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_mylist=$this->input->post('id_mylist');
$ret_value=$this->data->delete_table_row('myfriends',array('id'=>$id_mylist));

if($lang==2){
$a['message']="تم الحذف صديقك بنجاح";
}
else {
$a['message']="Your friend has been successfully deleted"; 
}
$array["message"][]= $a;
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}





public function organization_cars_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_organizations=$this->input->post('id_organizations');
$id_clients= $this->data->get_table_row('company',array('id'=>$id_organizations),'id_clients');
$company_name= $this->data->get_table_row('clients',array('id'=>$id_clients),'fname');
$company_rate= $this->data->get_table_row('clients',array('id'=>$id_clients),'rate');
$com['company_name']=$company_name;
$com['company_rate']=$company_rate;
$array["company_details"][]= $com;
$result_events= $this->db->get_where('company_car',array('id_organization'=>$id_organizations))->result();
if(count($result_events)>=1){

foreach($result_events as $result_events){
$model=$result_events->model;
$color=$result_events->color;
$car_number=$result_events->car_number;
$car_type=$result_events->car_type;

$carimg=$result_events->carimg;
$title= $this->data->get_table_row('cars',array('id'=>$car_type),'title');
$titleeng= $this->data->get_table_row('cars',array('id'=>$car_type),'titleeng');
if($carimg!=""){$event_img="http://tareki.com/site/ar/images/organizations/".$carimg;}
else {
$event_img="http://tareki.com/site/ar/images/organizations/default.png";
}

$a['model']=$model;
$a['color']=$color;
$a['car_number']=$car_number;
if($lang==2){
$a['car_type']=$title;
}
else {
$a['car_type']=$titleeng; 
}
$a['car_img']=$event_img;
$a['id_car']=$result_events->id;;

$array["data"][]= $a;
}
}
else {

$a['messageID']=0;
if($lang==2){
$a['message']="نأسف لعدم وجود بيانات";
}
else {
$a['message']="TSorry for missing data"; 
}
$array["message"][]= $a;
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }




public function add_carpooling_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client=$this->input->post('id_client');
$id_leaving=$this->input->post('id_leaving');
$id_gooing=$this->input->post('id_gooing');
$datedata=$this->input->post('datedata');
$seats=$this->input->post('seats');
$duration=$this->input->post('duration');
$finalspace=$this->input->post('finalspace');
$startpoint=$this->input->post('startpoint');
$endpoint=$this->input->post('endpoint');
$direction_text=$this->input->post('direction_text');
$time_trip=$this->input->post('time_trip');

$pricing= $this->data->get_table_row('pricing',array('id_category'=>3),'pricing');
$pernumber=round(($pricing*$finalspace)/$seats);

$data['id_clients'] = $id_client;
$data['leaving'] = $id_leaving;
$data['gooing'] = $id_gooing;
$data['datedata'] = $datedata;
$data['seats'] = $seats;
$data['finalspace'] = $finalspace;
$data['finalprice'] = $pricing*$finalspace;
$data['pernumber'] = $pernumber;
$data['duration'] = $duration;
$data['startpoint'] = $startpoint;
$data['endpoint'] = $endpoint;
$data['direction_text'] = $direction_text;
$data['time_trip'] = $time_trip;

$this->db->insert('carpooling',$data);
$ids = $this->db->insert_id(); 

if($ids==""){

$a['messageID']=0;
if($lang==2){
$a['message']="نأسف لوجود مشكلة فى اضافة الرحلة";
}
else {
$a['message']="We're sorry to have a problem adding you"; 
}
$array["message"][]= $a;
}
else {

$a['messageID']=1;
if($lang==2){
$a['message']="تم اضافة الرحلة بنجاح";
}
else {
$a['message']="Flight successfully added"; 
}
$array["message"][]= $a;
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
 }


public function edit_driver_profile_api(){

$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client=$this->input->post('id_client');
$fname=$this->input->post('fname');
$phone=$this->input->post('phone');
$email=$this->input->post('email');
$password=$this->input->post('password');
$address=$this->input->post('address');
$img=$this->input->post('img');
$car_color=$this->input->post('car_color');
$car_number=$this->input->post('car_number');
$car_type=$this->input->post('car_type');
$model=$this->input->post('model');
$about_you=$this->input->post('about_you');
$city_id=$this->input->post('city_id');
$nationalid=$this->input->post('nationalid');
$drivinglicens=$this->input->post('drivinglicens');
$carpicture=$this->input->post('carpicture');
$national_id=$this->input->post('national_id');
$key=0;
$table='clients';
if($fname!=""){
$data= array('fname'=>$fname);
$key=1;
$new=$this->data->edit_table($table,$id_client,$data);
}
if($phone!=""){
$result_phone= $this->db->get_where('clients',array('phone'=>$phone))->result();
if(count($result_phone)>=1){
$a['messageID']=0;
if($lang==2){
$a['message']="هذا الرقم غير متاح";
}
else {
$a['message']="this phone available"; 
}
$array["message"][]= $a;
}
else{
$data= array('phone'=>$phone);
$key=1;
$new=$this->data->edit_table($table,$id_client,$data);
}
}
if($email!=""){

$result_email= $this->db->get_where('clients',array('email'=>$email))->result();
if(count($result_email)>=1){
$a['messageID']=0;
if($lang==2){
$a['message']="هذا الإيميل غير متاح";
}
else {
$a['message']="this email available"; 
}
$array["message"][]= $a;
}
else{
$data= array('email'=>$email);
$key=1;
$new=$this->data->edit_table($table,$id_client,$data);

}
}

if($password!=""){
$data= array('password'=>md5($password));
$key=1;
$new=$this->data->edit_table($table,$id_client,$data);
}

if($address!=""){
$data= array('address'=>$address);
$new=$this->data->edit_table($table,$id_client,$data);

$key=1;
}


if(isset($_FILES['img']['name'])&&$_FILES['img']['name']!=""){
$logo = $this->data->get_table_row('clients',array('id'=>$id_client),'img'); 
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
 if (!$this->upload->do_upload('img')){
if($lang==2){$a['message']="لم يتم رفع الصورة";}
else {$a['message']="Image not uploaded"; }

$array['message'][]= $a;
 }

else {
$url= $_FILES['img']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('img'=>$imagename.".".$file_extension);
$this->data->edit_table('clients',$id_client,$data);
if($lang==2){$a['message']="تم رفع الصورة ";}
else {$a['message']="Image uploaded"; }
$a['url_img']="http://tareki.com/site/ar/images/driver/".$imagename.".".$file_extension;
$array['message'][]= $a;
}
$key=0;
}

$result_attachment= $this->db->get_where('attachment',array('id_clients'=>$id_client))->result();
if(count($result_attachment)==1){
$attachment_id = $this->data->get_table_row('attachment',array('id_clients'=>$id_client),'id');
if($car_color!=""){
$data= array('car_color'=>$car_color);
$new=$this->data->edit_table("attachment",$attachment_id,$data);
$key=1;
}
if($car_number!=""){
$data= array('car_number'=>$car_number);
$new=$this->data->edit_table("attachment",$attachment_id,$data);
$key=1;
}
if($car_type!=""){
$data= array('car_type'=>$car_type);
$new=$this->data->edit_table("attachment",$attachment_id,$data);
$key=1;
}
if($model!=""){
$data= array('model'=>$model);
$new=$this->data->edit_table("attachment",$attachment_id,$data);
$key=1;
}
if($about_you!=""){
$new=array('about_you'=>$about_you);
$new=$this->data->edit_table("attachment",$attachment_id,$data);
$key=1;
}

if(isset($_FILES['nationalid']['name'])&&$_FILES['nationalid']['name']!=""){
$logo = $this->data->get_table_row('attachment',array('id'=>$attachment_id),'nationalid'); 
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
 if (!$this->upload->do_upload('img')){
if($lang==2){$a['message']="لم يتم رفع الصورة";}
else {$a['message']="Image not uploaded"; }

$array['message'][]= $a;
 }

else {
$url= $_FILES['nationalid']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('nationalid'=>$imagename.".".$file_extension);
$new=$this->data->edit_table('attachment',$attachment_id,$data);
if($lang==2){$a['message']="تم رفع الصورة ";}
else {$a['message']="Image uploaded"; }
$a['url_img']="http://tareki.com/site/ar/images/driver/".$imagename.".".$file_extension;
$array['message'][]= $a;
}
$key=0;
}

if(isset($_FILES['drivinglicens']['name'])&&$_FILES['drivinglicens']['name']!=""){
$logo = $this->data->get_table_row('attachment',array('id'=>$attachment_id),'drivinglicense'); 
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
 if (!$this->upload->do_upload('img')){
if($lang==2){$a['message']="لم يتم رفع الصورة";}
else {$a['message']="Image not uploaded"; }

$array['message'][]= $a;
 }

else {
$url= $_FILES['drivinglicens']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('drivinglicense'=>$imagename.".".$file_extension);
$new=$this->data->edit_table('attachment',$attachment_id,$data);
if($lang==2){$a['message']="تم رفع الصورة ";}
else {$a['message']="Image uploaded"; }
$a['url_img']="http://tareki.com/site/ar/images/driver/".$imagename.".".$file_extension;
$array['message'][]= $a;
}
$key=0;
}

if(isset($_FILES['carpicture']['name'])&&$_FILES['carpicture']['name']!=""){
$logo = $this->data->get_table_row('attachment',array('id'=>$attachment_id),'carpicture'); 
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
 if (!$this->upload->do_upload('img')){
if($lang==2){$a['message']="لم يتم رفع الصورة";}
else {$a['message']="Image not uploaded"; }
$array['message'][]= $a;
 }

else {
$url= $_FILES['carpicture']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('carpicture'=>$imagename.".".$file_extension);
$this->data->edit_table('attachment',$attachment_id,$data);
if($lang==2){$a['message']="تم رفع الصورة ";}
else {$a['message']="Image uploaded"; }
$a['url_img']="http://tareki.com/site/ar/images/driver/".$imagename.".".$file_extension;
$array['message'][]= $a;
}
$key=0;
}


}
else{
$result_company= $this->db->get_where('company',array('id_clients'=>$id_client))->result();
if(count($result_company)==1){
$company_id = $this->data->get_table_row('company',array('id_clients'=>$id_client),'id');
if($about_you!=""){
$new=array('about_you'=>$about_you);
$new=$this->data->edit_table("company",$company_id,$data);
$key=1;
}
if($city_id!=""){
$data=array('city_id'=>$city_id);
$new=$this->data->edit_table("company",$company_id,$data);
$key=1;
}
}



if(isset($_FILES['national_id']['name'])&&$_FILES['national_id']['name']!=""){
$logo = $this->data->get_table_row('company',array('id'=>$company_id),'national_id'); 
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
 if (!$this->upload->do_upload('img')){
if($lang==2){$a['message']="لم يتم رفع الصورة";}
else {$a['message']="Image not uploaded"; }

$array['message'][]= $a;
 }

else {
$url= $_FILES['national_id']['name'];
$ext = explode(".",$url);
$file_extension = end($ext);
$data = array('national_id'=>$imagename.".".$file_extension);
$new=$this->data->edit_table('company',$company_id,$data);
if($lang==2){$a['message']="تم رفع الصورة ";}
else {$a['message']="Image uploaded"; }
$a['url_img']="http://tareki.com/site/ar/images/driver/".$imagename.".".$file_extension;
$array['message'][]= $a;
}
$key=0;
}
}
  if($new==true){
if($key==1){
$a['messageID']=1;
if($lang==2){
$a['message']="تم تعديل البيانات بنجاح";
}
else {
$a['message']="Data successfully Edited"; 
}
}
else{
$a['messageID']=0;
if($lang==2){
$a['message']="نأسف لعد تعديل البيانات";
}
else {
$a['message']="We're sorry to doesn't edit data"; 
}
}
$array["message"][]= $a;

 }

$result_clients= $this->db->get_where("clients",array('id'=>$id_client))->result();
foreach($result_clients as $result_clients){
$fname=$result_clients->fname;
$email=$result_clients->email;
$phone=$result_clients->phone;
$img=$result_clients->img;

if($img!=""){$main_img="http://tareki.com/site/ar/images/driver/".$img;}
else {
$main_img="http://tareki.com/site/ar/images/driver/defaultmain.png";}
$token_id=$result_clients->token_id;
$rate=$result_clients->rate;
$mywallet=$result_clients->mywallet;
$killomater=$result_clients->killomater;
$b['full_name'] =$fname;
$b['email'] =$email;
$b['phone'] =$phone;
$b['rate'] =$rate;
$b['mywallet'] =$mywallet;
$b['killomater'] =$killomater;
$b['client_img'] =$main_img;
}
if(count($result_attachment)>0){ 
 foreach($result_attachment as $resultattachment)
$drivinglicense=$resultattachment->drivinglicense;
$carpicture=$resultattachment->carpicture;
$car_color=$resultattachment->car_color;
$car_number=$resultattachment->car_number;
$nationalid=$resultattachment->nationalid;

$car_type=$resultattachment->car_type;
$model=$resultattachment->model;
$car_titleeng= $this->data->get_table_row('cars',array('id'=>$car_type),'titleeng'); 
$car_title= $this->data->get_table_row('cars',array('id'=>$car_type),'title'); 

$drivinglicense="http://tareki.com/site/ar/images/driver/".$drivinglicense;
$carpicture="http://tareki.com/site/ar/images/driver/".$carpicture;
$nationalid="http://tareki.com/site/ar/images/driver/".$nationalid;
$b['nationalid'] =$nationalid;
$b['carpicture'] =$carpicture;
$b['drivinglicense'] =$drivinglicense;
$b['car_color'] =$car_color;
$b['car_number'] =$car_number;
$b['model'] =$model;
if($lang=="en"){
$b['car_title']=$car_titleeng;
}
else {
$b['car_title']=$car_title;
}
}



if(count($result_company)>0){ 
 foreach($result_company as $resultcompany)
$national_id=$resultcompany->national_id;
$city_id=$resultcompany->city_id;
$about_you=$resultcompany->about_you;
$car_titleeng= $this->data->get_table_row('city',array('id'=>$city_id),'name'); 
$car_title= $this->data->get_table_row('city',array('id'=>$city_id),'name_eng'); 
$National_ID="http://tareki.com/site/ar/images/driver/".$national_id;

$b['National_ID'] =$National_ID;
$b['about_you'] =$about_you;
if($lang=="en"){
$b['city_title']=$car_titleeng;
}
else {
$b['city_title']=$car_title;
}

}


$array['data'][]= $b; 


@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}


public function add_book_event_api(){

$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client=$this->input->post('id_client');

$id_event=$this->input->post('id_event');
$name=$this->input->post('name');
$email=$this->input->post('email');
$phone=$this->input->post('phone');
$message=$this->input->post('message');
$address=$this->input->post('address');
$id_clasification = $this->data->get_table_row('clients',array('id'=>$id_client),'id_clasification');
if($id_clasification!=""){
$value_id = $this->data->get_table_row('clasification',array('id'=>$id_clasification),'value');
}
$price= $this->data->get_table_row('events',array('id'=>$id_event),'price');
if($value_id!=""){
$final_price=($value_id*$price)/100;
}
else{
$final_price = $price;
}
$a['Response Code'] =200;
$a['Final Price']=$final_price;
$result_clients= $this->db->get_where("join_events",array('id_client'=>$id_client,'manger_activation'=>'0'))->result();
if(count($result_clients)==0){
$data=array('name'=>$name,
'phone'=>$phone,
'id_event'=>$id_event,
'email'=>$email,
'address'=>$address,
'message'=>$message,
'final_price'=>$final_price,
'id_client'=>$id_client
);

$this->data->insert_filed('join_events',$data);
 $idd= $this->db->insert_id(); 
 if($lang==2){
$a['message']="تم إضافة البيانات بنجاح";
}
else {
$a['message']="Data successfully inserted"; 
}
$array["message"][]= $a;
}
else {
foreach($result_clients as $result_clients)
  $idd=1;
  if($lang==2){
$a['message']="انت مشترك بالفعل";
}
else {
$a['message']="You are already a subscriber";
}
$array["message"][]= $a;
}
if($idd==0){
$a['messageID']=0;
if($lang==2){
$a['message']="نأسف لعد تعديل البيانات";
}
else {
$a['message']="We're sorry to doesn't edit data"; 
}
$array["message"][]= $a;
}

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}


public function book_company_car(){

$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_clients=$this->input->post('id_clients');
$id_car=$this->input->post('id_car');
$data=array('id_clients'=>$id_clients,
'id_car'=>$id_car);
$this->data->insert_filed('virtual_table',$data);
$key=1;
if($key==1){
$a['messageID']=1;
if($lang==2){
$a['message']="تم إضافة البيانات بنجاح";
}
else {
$a['message']="Data successfully inserted"; 
}
$array["message"][]= $a;
}
else{
$a['messageID']=0;
if($lang==2){
$a['message']="نأسف لعدم إضافة البيانات";
}
else {
$a['message']="We're sorry to doesn't  insert data"; 
}
$array["message"][]= $a;
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}
 
public function add_order_organization_here(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_clients=$this->input->post('id_clients');
$fname=$this->input->post('fname');
$phone=$this->input->post('phone');
$address=$this->input->post('address');
$start_date=$this->input->post('start_date');
$enddate_date=$this->input->post('enddate_date');
$email=$this->input->post('email');
$id_cars=$this->input->post('id_cars');
$result_client= $this->db->get_where('virtual_table',array('id_clients'=>$id_clients))->result();
$data=array('id_client'=>$id_clients,
           'fname'=>$fname,
            'phone'=>$phone,
            'address'=>$address,
            'start_date'=>$start_date,
             'enddate_date'=>$enddate_date,
             'email'=>$email);         

$this->data->insert_filed('organization_order_main',$data);
$id = $this->db->insert_id();

 $token = strtok($id_cars, ",");
 
while ($token !== false){  
if($token!=""){ 
$data=array('id_clients'=>$id_clients,
             'id_cars'=>$token,
              'id_order'=>$id);
$this->data->insert_filed('organization_order',$data);
$key=1;
$token = strtok(",");
}
}

if($key==1){
$a['messageID']=1;
if($lang==2){
$a['message']="تم إضافة البيانات بنجاح";
}
else {
$a['message']="Data successfully inserted"; 
}
$array["message"][]= $a;
}
else{
$a['messageID']=0;
if($lang==2){
$a['message']="نأسف لعدم إضافة البيانات";
}
else {
$a['message']="We're sorry to doesn't  insert data"; 
}
$array["message"][]= $a;
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);

}





public function book_carpooling_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$idcarpooling=$this->input->post('id_trip');
$id_client= $this->input->post('id_client');
$seat_num_data= $this->input->post('seat_num_data');
define( 'API_ACCESS_KEY', 'AAAA9TqJzwM:APA91bEiARn-Fau8rMnHGR_eEn9BHe5j5AnkhbI736FZicE6JWla5qlmvrxBmXgFr_dAn-H_ds17dq1AexPBzw-8JGwIgIGQDiZ9jpIWayuI0rjM9nVX6pjQgo7PwoJOoMvELHFcWg7b');
$main_tok=array();




$id_driver = $this->data->get_table_row('carpooling',array('id'=>$idcarpooling),'id_clients');
$result_clients= $this->db->get_where("clients",array('id'=>$id_client))->result();
$booking_idold= $this->data->get_table_row('booking',array('id_driver'=>$id_driver,'id_passanger'=>$id_client,'id_offers'=>$idcarpooling,'driver_activation'=>'0'),'id');
if( count($result_clients)==1){
if($booking_idold==""){

$data['id_passanger'] = $id_client;
$data['id_offers'] = $idcarpooling;
$data['id_driver'] = $id_driver;
$data['passanger_activation']='0';
$data['driver_activation']='0';
$data['type']='0';
$data['seat_number']=$seat_num_data;
$num_account = $this->data->get_table_row('carpooling',array('id'=>$idcarpooling),'num_account');
$seats = $this->data->get_table_row('carpooling',array('id'=>$idcarpooling),'seats');
$total_count_seat=$seat_num_data+$num_account;

if($total_count_seat<=$seats){
//$new_num=$seat_number+$num_account;
$this->db->insert('booking',$data);
$datap = array('num_account'=>$total_count_seat);
$this->db->update('carpooling',$datap,array('id'=>$idcarpooling));
$_SESSION["id_driver"]=$id_driver;
$_SESSION["idcarpooling"]=$idcarpooling;
$_SESSION["id_client"]=$id_client;


if($lang==""){$_SESSION["lang"]=1;}
else{$_SESSION["lang"]=$lang;}
$a['lang']=$_SESSION["lang"];
$a['id_client']=$_SESSION["id_client"];
$a['id_driver']=$_SESSION["id_driver"];
$a['idcarpooling']=$_SESSION["idcarpooling"];
$main_data=$this->db->get_where('clients',array('id'=>$id_client))->result();
foreach($main_data as $main_data){
$client_name=$main_data->fname;
$img=$main_data->img;
$client_phone=$main_data->phone;
if($img!=""){$main_img="http://tareki.com/site/ar/images/passanger/".$img;}
else {$main_img="http://tareki.com/site/ar/images/passanger/defaultmain.png";}
}


$passanger['Passaner name']=$client_name;
$passanger['Passaner phone']=$client_phone;
$passanger['Passaner img']=$main_img;
$passanger['Passaner id']=$id_client;
if($lang==2){
$passanger['Message']="طلب حجز رحلة جديدة";
}
else {
$passanger['Message']="Request a new trip booking";
}


$carpooling= $this->db->get_where("carpooling",array('id'=>$idcarpooling))->result();
foreach($carpooling as $carpooling)
$leaving=$carpooling->leaving;
$gooing=$carpooling->gooing;
$datedata=$carpooling->datedata;
$time_trip=$carpooling->time_trip;
$leaving_name= $this->data->get_table_row("city",array("id"=>$leaving),"name");
$leaving_name_eng= $this->data->get_table_row("city",array("id"=>$leaving),"name_eng");
$gooing_name= $this->data->get_table_row("city",array("id"=>$gooing),"name");
$gooing_name_eng= $this->data->get_table_row("city",array("id"=>$gooing),"name_eng");
if($lang=="lang=en"){
$leaving_city=$leaving_name_eng;
$gooing_city=$gooing_name_eng;
}
else {
$leaving_city=$leaving_name;
$gooing_city=$gooing_name;
}

$m['Response Code'] =200;
if($lang==2){
$m['message'] ="تم الاشتراك فى الرحلة بنجاح ";
}
else {
$m['message']="The trip was successfully completed";
}


$a['leavin city']=$leaving_city;
$a['gooing city']=$gooing_city;
$a['date trip']=$datedata;
$a['time trip']=$time_trip;
$array["message"][]= $m;
$array["data"][]= $a;


$driver_data=$this->db->get_where('clients',array('id'=>$id_driver))->result();
 foreach($driver_data as $driver_data)
$token_id=$driver_data->token_id;
array_push($main_tok,$token_id);


$registrationIds =$main_tok;
$msg = array
(
	'message' 	=>$passanger,
	'title'		=> '1'
);
$fields = array
(
	'registration_ids' 	=> $registrationIds,
	'data'			=> $msg
);
 
$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
$main_not['carpooling_booking']=$result;
$array["notifiction"][]= $main_not;
//$this->load->view("pages/config/request_mailmain");
}

else {
$a['messageID']=0;
if($lang==2){
$a['message']="نعتذر على اكتمال الرحلة";
}
else {
$a['message']="We apologize for the complete trip";
}
$array["message"][]= $a;
}



}




else {
$a['messageID']=0;
if($lang==2){
$a['message']="انت مشترك بالفعل فى الرحلة";
}
else {
$a['message']="You are already in the trip"; 
}
$array["message"][]= $a;
}

}
else {
$a['messageID']=0;
if($lang==2){
$a['message']="فشل الاشتراك فى الرحلة";
}
else {
$a['message']="Failed to sign up for the trip"; 
}
$array["message"][]= $a;
}

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}

public function request_mailmain(){
$this->load->view('pages/config/request_mailmain');
}







public function get_all_user_carpooling_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$idcarpooling=$this->input->post('id_trip');
$id_client= $this->input->post('id_client');

$result_clients=$this->db->get_where('booking',array('id_driver'=>$id_client,'id_offers'=>$idcarpooling))->result();
if( count($result_clients)>0){
foreach($result_clients as $resultclients){
 $id_passanger=$resultclients->id_passanger;
$fname= $this->data->get_table_row("clients",array("id"=>$id_passanger),"fname");
$phone= $this->data->get_table_row("clients",array("id"=>$id_passanger),"phone");
$img= $this->data->get_table_row("clients",array("id"=>$id_passanger),"img");
$email= $this->data->get_table_row("clients",array("id"=>$id_passanger),"email");
if($img!=""){$main_img="http://tareki.com/site/ar/images/passanger/".$img;}else {
$main_img="http://tareki.com/site/ar/images/passanger/defaultmain.png";}
$main_img=$main_img;
$a['Passaner name']=$fname;
$a['Passaner phone']=$phone;
$a['Passaner email']=$email;
$a['Passaner img']=$main_img;
$array["data"][]= $a;
}
}
else {
$a['messageID']=0;
if($lang==2){
$a['message']="لا يوجد مشتركين حاليا فى الرحلة";
}
else {
$a['message']="There are currently no subscribers on the trip";
}
$array["message"][]= $a;
}


@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);

}


public function driver_on_of_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client= $this->input->post('id_driver');
$key= $this->input->post('key');
$lat= $this->input->post('lat');
$lag= $this->input->post('lag');
$result_clients=$this->db->get_where('clients',array('id'=>$id_client))->result();
if(count($result_clients)>0){
$data = array('online'=>$key);
$this->db->update('clients',$data,array('id'=>$id_client));
if($key==1){
$result_taxi=$this->db->get_where('taxi',array('id_driver'=>$id_client))->result();
if(count($result_taxi)==1){
$data_location = array('lat_driver'=>$lat,'lag_driver'=>$lag);
$this->db->update('taxi',$data_location ,array('id_driver'=>$id_client));
}
else {
$data_location = array('lat_driver'=>$lat,'lag_driver'=>$lag,'id_driver'=>$id_client);
$this->db->insert('taxi',$data_location);
}
$a['messageID']=1;
if($lang==2){
$a['message']="انت الان اون لاين";
}
else {
$a['message']="You now online";
}
$array["message"][]= $a;
}

 else {


$ret_value=$this->data->delete_table_row('taxi',array('id_driver'=>$id_client));
$a['messageID']=0;
if($lang==2){
$a['message']="انت الان اوف لاين";
}
else {
$a['message']="You are now offline";
}
$array["message"][]= $a;


}
}
else {
$a['messageID']=0;
if($lang==2){
$a['message']="البيانات غير صحيحة";
}
else {
$a['message']="The data is incorrect";
}
$array["message"][]= $a;
}

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}



public function get_location_driver_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client= $this->input->post('id_driver');

$result_taxi=$this->db->get_where('taxi',array('id_driver'=>$id_client))->result();
if(count($result_taxi)==1){
foreach($result_taxi as $result_taxi)
 $lat=$result_taxi->lat_driver;
  $lag=$result_taxi->lag_driver;
 $a['lat_driver']=$lat;
$a['lag_driver']=$lag;
$array["data"][]= $a;

}
else {
$a['messageID']=0;
if($lang==2){
$a['message']="البيانات غير صحيحة";
}
else {
$a['message']="data not correct";
}
$array["message"][]= $a;
}

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}


public function driver_accept_reject_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client= $this->input->post('id_driver');
$key= $this->input->post('key');
$id_passanger= $this->input->post('id_client');
$lat_client= $this->input->post('lat_client');
$lag_client= $this->input->post('lag_client');

$result_taxi=$this->db->get_where('taxi',array('id_driver'=>$id_client))->result();
if(count($result_taxi)==1){
$data_location = array('driver_action'=>$key,'id_client'=>$id_passanger,'lag_client'=>$lag_client,'lat_client'=>$lat_client);
$this->db->update('taxi',$data_location ,array('id_driver'=>$id_client));

$a['messageID']=1;
if($lang==1){
 if($key==1){$a['message']="تم الموافقة على الرحلة";}
else {$a['message']="تم رفض الرحلة";
$data_empty = array('id_client'=>0);
$this->db->update('taxi',$data_empty ,array('id_driver'=>$id_client));
}
}
else {
if($key==1){$a['message']="Trip approved";}
else {$a['message']="Trip denied";
$data_empty = array('id_client'=>0);
$this->db->update('taxi',$data_empty ,array('id_driver'=>$id_client));

}
}
$array["message"][]= $a;
}
 else {
$a['messageID']=0;
if($lang==1){
$a['message']="نأسف لعدم وجود رحلة";
}
else {
$a['message']="Sorry for not having Trip";
}
$array["message"][]= $a;
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}



public function passanger_cancel_arrivel_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client= $this->input->post('id_driver');
$key= $this->input->post('key');

$result_taxi=$this->db->get_where('taxi',array('id_driver'=>$id_client,'id_client!='=>0))->result();
if(count($result_taxi)==1){
$data_location = array('client_action'=>$key);
$this->db->update('taxi',$data_location ,array('id_driver'=>$id_client,'id_client!='=>0));

$a['messageID']=1;
if($lang==1){
 if($key==1){$a['message']="تم الالتقاء بالسائق";}else {$a['message']="تم الغاء الرحلة";
$data_empty = array('id_client'=>0);
$this->db->update('taxi',$data_empty ,array('id_driver'=>$id_client));
}
}
else {
if($key==1){$a['message']="The driver was interviewed";}else {$a['message']="Trip canceled";
$data_empty = array('id_client'=>0);
$this->db->update('taxi',$data_empty ,array('id_driver'=>$id_client));
}
}
$array["message"][]= $a;
}

 else {
$a['messageID']=0;
if($lang==1){
$a['message']="نأسف لعدم وجود رحلة";
}
else {
$a['message']="Sorry for not having Trip";
}
$array["message"][]= $a;
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}




public function driver_launched_trip_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client= $this->input->post('id_driver');
$key= $this->input->post('key');
$datetime= $this->input->post('datetime');

$result_taxi=$this->db->get_where('taxi',array('id_driver'=>$id_client,'id_client!='=>0))->result();
if(count($result_taxi)==1){
$data_location = array('start_finish'=>$key,'datetime'=>$datetime);
$this->db->update('taxi',$data_location ,array('id_driver'=>$id_client,'id_client!='=>0));

$a['messageID']=1;
if($lang==1){
$a['message']="تم انطلاق الرحلة";
}
else {
$a['message']="The trip was launched";
}
$array["message"][]= $a;
}
 else {
$a['messageID']=0;
if($lang==1){
$a['message']="نأسف لعدم وجود رحلة";
}
else {
$a['message']="Sorry for not having Trip";
}
$array["message"][]= $a;
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}


public function driver_finished_trip_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client= $this->input->post('id_driver');
$key= $this->input->post('key');
$datetime= $this->input->post('datetime');

$result_taxi=$this->db->get_where('taxi',array('id_driver'=>$id_client,'id_client!='=>0))->result();
if(count($result_taxi)==1){
$data_location = array('start_finish'=>$key,'enddatetime'=>$datetime);
$this->db->update('taxi',$data_location ,array('id_driver'=>$id_client));


$query = $this->db->get('taxi');
foreach ($query->result() as $row) {
$this->db->insert('taxi_end_trip',$row);
}

$data_empty= array('id_client'=>0);
$this->db->update('taxi',$data_empty,array('id_driver'=>$id_client));


$a['messageID']=1;
if($lang==1){
$a['message']="تم انهاء الرحلة";
}
else {
$a['message']="Trip completed";
}
$array["message"][]= $a;
}
 else {
$a['messageID']=0;
if($lang==1){
$a['message']="نأسف لعدم وجود رحلة";
}
else {
$a['message']="Sorry for not having Trip";
}
$array["message"][]= $a;
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}

public function passanger_trip_request_api(){
$this->load->view('pages/config/passanger_trip_request_api');		


}

public function passanger_all_cars_api(){
$this->load->view('pages/config/passanger_all_cars_api');		
}



public function passanger_new_api(){
$this->load->view('pages/config/passanger_new_api');		
}


public function driver_new_request_api(){
$this->load->view('pages/config/driver_new_request_api');		
}

public function cancel__accept_request_api(){
$this->load->view('pages/config/cancel__accept_request_api');		
}


public function start_finish_api(){
$this->load->view('pages/config/start_finish_api');		
}

public function cancel_order_api(){
$this->load->view('pages/config/cancel_order_api');		
}



public function driver_final_trip_rate_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client= $this->input->post('id_driver');


$result_taxi=$this->db->order_by('id','desc')->limit(1)->get_where('taxi_end_trip',array('id_driver'=>$id_client,'driver_rate'=>'0'))->result();
if(count($result_taxi)==0){
$a['messageID']=1;
if($lang==1){
$a['message']=" لا يوجد رحالات حاليا";
}
else {
$a['message']="There is no data";
}
$array["message"][]= $a;
}
 else {
foreach($result_taxi as $result_taxi)
$client_id=$result_taxi->id_client;
$main_data=$this->db->get_where('clients',array('id'=>$client_id))->result();
foreach($main_data as $main_data){
$driver_name=$main_data->fname;
$img_dirver=$main_data->img;
$driver_phone=$main_data->phone;
if($img_dirver!=""){$main_img="http://tareki.com/site/ar/images/passanger/".$img;}
else {$main_img="http://tareki.com/site/ar/images/passanger/defaultmain.png";}
$driver_data['client_id']=$client_id;
$driver_data['client_name']=$driver_name;
$driver_data['img']=$main_img;
$driver_data['phone']=$driver_phone;
$array["client_data"][]= $driver_data;
}


 }
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}






public function passanger_final_trip_rate_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client= $this->input->post('id_passanger');


$result_taxi=$this->db->order_by('id','desc')->limit(1)->get_where('taxi_end_trip',array('id_client'=>$id_client,'driver_rate'=>'0'))->result();
if(count($result_taxi)==0){
$a['messageID']=1;
if($lang==1){
$a['message']=" لا يوجد رحالات حاليا";
}
else {
$a['message']="There is no data";
}
$array["message"][]= $a;
}
 else {
foreach($result_taxi as $result_taxi)
$client_id=$result_taxi->id_driver;
$order_id=$result_taxi->id;
$main_data=$this->db->get_where('clients',array('id'=>$client_id))->result();
foreach($main_data as $main_data){
$driver_name=$main_data->fname;
$img_dirver=$main_data->img;
$driver_phone=$main_data->phone;
if($img_dirver!=""){$main_img="http://tareki.com/site/ar/images/driver/".$img_dirver;}
else {$main_img="http://tareki.com/site/ar/images/driver/defaultmain.png";}
$driver_data['driver_id']=$client_id;
$driver_data['driver_name']=$driver_name;
$driver_data['img']=$main_img;
$driver_data['phone']=$driver_phone;
$driver_data['order_id']=$order_id;
$array["client_data"][]= $driver_data;
}


 }
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}





public function passanger_rate_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_passanger= $this->input->post('id_passanger');
$id_diver= $this->input->post('id_diver');
$rate_value= $this->input->post('rate_value');

$order_id= $this->input->post('order_id');
$result_taxi=$this->db->get_where('rate',array('id_client'=>$id_passanger,'id_client_rate'=>$id_diver,'id_order'=>$order_id))->result();
if(count($result_taxi)==0){
$data_insert= array('id_client'=>$id_passanger,'id_client_rate'=>$id_diver,'value'=>$rate_value,'id_order'=>$order_id,'type'=>'0');
$this->db->insert('rate',$data_insert);

}
else {
$data_rate_update= array('value'=>$rate_value);
$this->db->update('rate',$data_rate_update,array('id_client'=>$id_passanger,'id_client_rate'=>$id_diver,'id_order'=>$order_id));
}

if($lang==2){
$a['message']="تم التقييم بنجاح";
}
else {
$a['message']="Rating successfully"; 
}
$array['message'][]= $a; 


 
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}



public function driver_rate_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_passanger= $this->input->post('id_passanger');
$id_diver= $this->input->post('id_diver');
$rate_value= $this->input->post('rate_value');
$order_id= $this->input->post('order_id');
$result_taxi=$this->db->get_where('rate',array('id_client'=>$id_diver,'id_client_rate'=>$id_passanger,'id_order'=>$order_id))->result();
if(count($result_taxi)==0){
$data_insert= array('id_client'=>$id_diver,'id_client_rate'=>$id_passanger,'value'=>$rate_value,'id_order'=>$order_id,'type'=>'0');
$this->db->insert('rate',$data_insert);

}
else {
$data_rate_update= array('value'=>$rate_value);
$this->db->update('rate',$data_rate_update,array('id_client'=>$id_diver,'id_client_rate'=>$id_passanger,'id_order'=>$order_id));
}

if($lang==2){
$a['message']="تم التقييم بنجاح";
}
else {
$a['message']="Rating successfully"; 
}
$array['message'][]= $a; 


 
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}












public function driver_arrived_api(){
$this->load->view('pages/config/driver_arrived_api');		
}



public function get_driver_location_api(){
$json = file_get_contents('php://input');
$array=array();
$order_id= $this->input->post('order_id');
$lat_driver= $this->input->post('lat');
$lag_driver= $this->input->post('lag');

$result_taxi=$this->db->get_where('taxi',array('id'=>$order_id))->result();
if(count($result_taxi)==1){
$data_rate_update= array('lat_driver'=>$lat_driver,'lag_driver'=>$lag_driver);
$this->db->update('taxi',$data_rate_update,array('id'=>$order_id));
$a['messageID']=1;
$a['lat_driver']=$lat_driver;
$a['lag_driver']=$lag_driver;
$array["message"][]= $a;
}

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}




public function driver_accept_api(){
$this->load->view('pages/config/driver_accept_api');		
}



public function carpooling_driver_rate_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_passanger= $this->input->post('id_passanger');
$id_diver= $this->input->post('id_diver');
$rate_value= $this->input->post('rate_value');
$order_id= $this->input->post('order_id');


$result_taxi=$this->db->get_where('rate',array('id_client'=>$id_diver,'id_client_rate'=>$id_passanger,'id_order'=>$order_id))->result();

if(count($result_taxi)==0 ){
$data_insert= array('id_client'=>$id_diver,'id_client_rate'=>$id_passanger,'value'=>$rate_value,'id_order'=>$order_id,'type'=>'1');
$this->db->insert('rate',$data_insert);

}
else {
$data_rate_update= array('value'=>$rate_value);
$this->db->update('rate',$data_rate_update,array('id_client'=>$id_diver,'id_client_rate'=>$id_passanger,'id_order'=>$order_id));
}

if($lang==2){
$a['message']="تم التقييم بنجاح";
}
else {
$a['message']="Rating successfully"; 
}
$array['message'][]= $a; 


 
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}





public function carpooling_passanger_rate_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_passanger= $this->input->post('Id_passanger');
$id_diver= $this->input->post('Id_driver');
$rate_value= $this->input->post('rate_value');
$order_id= $this->input->post('order_id');

$result_taxi=$this->db->get_where('rate',array('id_client'=>$id_passanger,'id_client_rate'=>$id_diver,'id_order'=>$order_id))->result();
if(count($result_taxi)==0 ){
$data_insert= array('id_client'=>$id_passanger,'id_client_rate'=>$id_diver,'value'=>$rate_value,'id_order'=>$order_id,'type'=>'1');
$this->db->insert('rate',$data_insert);
$data_rate_update= array('client_rate'=>'1');
$this->db->update('booking',$data_rate_update,array(
    'id_passanger'=>$id_passanger,'id_offers'=>$order_id,'id_driver'=>$id_diver
    ));

    
}
else {
$data_rate_update= array('value'=>$rate_value);
$this->db->update('rate',$data_rate_update,array('id_client'=>$id_passanger,'id_client_rate'=>$id_diver,'id_order'=>$order_id));
}

if($lang==2){
$a['message']="تم التقييم بنجاح";
}
else {
$a['message']="Rating successfully"; 
}


$array['message'][]= $a; 


 
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}



public function carpooling_passanger_final_rate_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client= $this->input->post('id_passanger');
$id_trip= $this->input->post('id_trip');

$result_taxi=$this->db->order_by('id','desc')->limit(1)->get_where('booking',array('id_passanger'=>$id_client,'client_rate'=>'0'))->result();
if(count($result_taxi)==0){
$a['messageID']=1;
if($lang==2){
$a['message']=" لا يوجد رحالات حاليا";
}
else {
$a['message']="There is no data";
}
$array["message"][]= $a;
}
 else {
foreach($result_taxi as $result_taxi)
$client_id=$result_taxi->id_driver;
$order_id=$result_taxi->id;
$main_data=$this->db->get_where('clients',array('id'=>$client_id))->result();
foreach($main_data as $main_data){
$driver_name=$main_data->fname;
$img_dirver=$main_data->img;
$driver_phone=$main_data->phone;
if($img_dirver!=""){$main_img="http://tareki.com/site/ar/images/driver/".$img;}
else {$main_img="http://tareki.com/site/ar/images/driver/defaultmain.png";}
$driver_data['client_id']=$client_id;
$driver_data['client_name']=$driver_name;
$driver_data['img']=$main_img;
$driver_data['phone']=$driver_phone;
$driver_data['id_trip']=$id_trip;
$array["client_data"][]= $driver_data;
}


 }
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}


public function carpooling_driver_final_rate_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client= $this->input->post('id_driver');
$id_trip= $this->input->post('id_trip');

$result_taxi=$this->db->order_by('id','desc')->limit(1)->get_where('booking',array('id_driver'=>$id_client,'driver_rate'=>'0'))->result();
if(count($result_taxi)==0){
$a['messageID']=1;
if($lang==1){
$a['message']=" لا يوجد رحالات حاليا";
}
else {
$a['message']="There is no data";
}
$array["message"][]= $a;
}
 else {
foreach($result_taxi as $result_taxi)
$client_id=$result_taxi->id_driver;
$order_id=$result_taxi->id;
$main_data=$this->db->get_where('clients',array('id'=>$client_id))->result();
foreach($main_data as $main_data){
$driver_name=$main_data->fname;
$img_dirver=$main_data->img;
$driver_phone=$main_data->phone;
if($img_dirver!=""){$main_img="http://tareki.com/site/ar/images/passanger/".$img;}
else {$main_img="http://tareki.com/site/ar/images/passanger/defaultmain.png";}
$driver_data['client_id']=$client_id;
$driver_data['client_name']=$driver_name;
$driver_data['img']=$main_img;
$driver_data['phone']=$driver_phone;
$driver_data['id_trip']=$id_trip;
$array["client_data"][]= $driver_data;
}


 }
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}






public function carpooling_passanger_cancel_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client= $this->input->post('id_passanger');
$id_trip= $this->input->post('id_offers');


$result_taxi=$this->db->get_where('booking',array('id_passanger'=>$id_client,'id_offers'=>$id_trip,'passanger_activation'=>'2'))->result();
if(count($result_taxi)==1){
    
$a['Response Code']=200;
if($lang==2){
$a['message']="تم الغاء الرحلة";

}
else {
$a['message']="Trip canceled";
}

$array["message"][]= $a;
}

 else {
     
$data_passanger = array('passanger_activation'=>'2','seats'=>0);
$this->db->update('booking',$data_passanger ,array('id_offers'=>$id_trip,'id_passanger'=>$id_client));



$a['Response Code']=200;
if($lang==2){
$a['message']="تم إلغاء الرحلة بنجاح";

}
else {
$a['message']="Trip is canceled succefully";
}

$array["message"][]= $a;
}



if($lang==2){
$message="تم إلغاء الرحلة بنجاح";
}
else {
$message="Trip is canceled succefully";
}

$array["message"][]= $a;


$result_taxi=$this->db->get_where('booking',array('id_passanger'=>$id_passanger,'id_offers'=>$id_trip))->result();
foreach($result_taxi as $result_taxi){
     $id_driver=$result_taxi->id_driver;
$driver_data=$this->db->get_where('clients',array('id'=>$id_driver))->result();
 foreach($driver_data as $driver_data){
$token_id=$driver_data->token_id;
array_push($main_tok,$token_id);
}
$registrationIds =$main_tok;
// prep the bundle
$msg = array
(
	'message' 	=>"$message",
	'title'		=> '1'
);
$fields = array
(
	'registration_ids' 	=> $registrationIds,
	'data'			=> $msg
);
 
$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
$main_not['result']=$result;
$array["notifiction"][]= $main_not;


}


@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}



public function carpooling_driver_cancel_api(){
$json = file_get_contents('php://input');
$lang =$this->input->post('lang');
$id_driver= $this->input->post('Id_driver');
$id_trip= $this->input->post('Id_trip');
$key= $this->input->post('Key');
$json = file_get_contents('php://input');
define( 'API_ACCESS_KEY', 'AAAAtFjcBmo:APA91bGWbblK8dkWT-SRWlmu6xiTfgIAFFbCxSiQOuP8JdChCuKApVq6mLSFllc6WUrQXCrFvFyhtk-BWu2WvCzPDJs43re70gqgQa-llexWV4PLwRydgj8POGZVaJMdRhoouaiboL1o');
$main_tok=array();
$array=array();

if($key==2){
$data_location = array('driver_activation'=>'2','seat_number'=>0);
$this->db->update('booking',$data_location,array('id_driver'=>$id_driver,'id_offers'=>$id_trip));
$a['Response Code']=200;
if($lang==2){
$a['message']="تم الغاء الرحلة";;
$mess['message']="تم الغاء الرحلة";
    
}
else {
$a['message']="The trip was canceled"; 
$mess['message']="Trip was Canceled";  
}
$array['message'][]= $a; 


$result_taxi=$this->db->get_where('booking',array('id_driver'=>$id_driver,'id_offers'=>$id_trip))->result();
foreach($result_taxi as $result_taxi){
     $id_passanger=$result_taxi->id_passanger;
$driver_data=$this->db->get_where('clients',array('id'=>$id_passanger))->result();
 foreach($driver_data as $driver_data)
$token_id=$driver_data->token_id;
array_push($main_tok,$token_id);
}
$p['carpooling_cancel']=$mess;
$registrationIds =$main_tok;
$msg = array
(
	'message' 	=>$p,
	'title'		=> '1'
);
$fields = array
(
	'registration_ids' 	=> $registrationIds,
	'data'			=> $msg
);
 
$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
$main_not['carpooling_driver_cancel']=$result;
$array["notifiction"][]= $main_not;
}
else{
    $a['Response Code']=400;
if($lang==2){
$a['message']="لن يتم الغاء الرحلة";
$message="لن يتم الغاء الرحلة" ;
}
else {
$a['message']="The trip is not cancel"; 
$message="The trip is not cancel"; 
}
$array['message'][]= $a; 

    
}

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}


public function carpooling_driver_start_api(){
$json = file_get_contents('php://input');
$lang =$this->input->post('lang');
$id_driver= $this->input->post('Id_driver');
$id_trip= $this->input->post('Id_trip');
$key= $this->input->post('Key');
$json = file_get_contents('php://input');
define( 'API_ACCESS_KEY', 'AAAAtFjcBmo:APA91bGWbblK8dkWT-SRWlmu6xiTfgIAFFbCxSiQOuP8JdChCuKApVq6mLSFllc6WUrQXCrFvFyhtk-BWu2WvCzPDJs43re70gqgQa-llexWV4PLwRydgj8POGZVaJMdRhoouaiboL1o');
$main_tok=array();



$result_check=$this->db->get_where('booking',array('id_driver'=>$id_driver,'id_offers'=>$id_trip,'driver_activation'=>'2'))->result();
if(count($result_check)>1){
$a['Response Code']=400;
if($lang==2){
$a['message']="تم الغاء الرحلة سابقا";
}
else {
$a['message']="Trip canceled previously"; 
}
$array['message'][]= $a; 
}
else {


if($key==1){
$data_location = array('start_finish'=>'1');
$this->db->update('booking',$data_location,array('id_driver'=>$id_driver,'id_offers'=>$id_trip));
$a['Response Code']=200;
if($lang==2){
$a['message']="تم .الوصول الى نقطة الالتقاء";
$mess['message']="تم انطلق الرحلة";
}
else {
$a['message']="The trip was launched"; 
$mess['message']="The trip was launched"; 
}
$array['message'][]= $a; 
$p['Carpooling_start']=$mess;

$result_taxi=$this->db->get_where('booking',array('id_driver'=>$id_driver,'id_offers'=>$id_trip))->result();
foreach($result_taxi as $result_taxi){
     $id_passanger=$result_taxi->id_passanger;
$driver_data=$this->db->get_where('clients',array('id'=>$id_passanger))->result();
 foreach($driver_data as $driver_data)
$token_id=$driver_data->token_id;
array_push($main_tok,$token_id);
}

$registrationIds =$main_tok;
$msg = array
(
	'message' 	=>$p,
	'title'		=> '1'
);
$fields = array
(
	'registration_ids' 	=> $registrationIds,
	'data'			=> $msg
);
 
$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
$main_not['carpooling_driver_start']=$result;
$array["Notifiction"][]= $main_not;
}
else {
    
    if($lang==2){
$a['message']="الرحلة بدات فى التحرك";
}
else {
$a['message']="The trip began to start"; 
}
$array['message'][]= $a;    
}
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}




public function carpooling_driver_arrived_api(){
$json = file_get_contents('php://input');
$lang =$this->input->post('lang');
$id_driver= $this->input->post('Id_driver');
$id_trip= $this->input->post('Id_trip');
$lat_driver= $this->input->post('lat_driver');
$lag_driver= $this->input->post('lag_driver');

$key= $this->input->post('Key');
$json = file_get_contents('php://input');
define( 'API_ACCESS_KEY', 'AAAAtFjcBmo:APA91bGWbblK8dkWT-SRWlmu6xiTfgIAFFbCxSiQOuP8JdChCuKApVq6mLSFllc6WUrQXCrFvFyhtk-BWu2WvCzPDJs43re70gqgQa-llexWV4PLwRydgj8POGZVaJMdRhoouaiboL1o');
$main_tok=array();



$result_check=$this->db->get_where('booking',array('id_driver'=>$id_driver,'id_offers'=>$id_trip,'driver_activation'=>'2'))->result();
$result_check_count2=count($result_check);
$result_check_start=$this->db->get_where('booking',array('id_driver'=>$id_driver,'id_offers'=>$id_trip,'start_finish'=>'1'))->result();
$result_check_count1=count($result_check_start);

if($result_check_count2==1){
$a['Response Code']=400;
if($lang==2){
$a['message']="تم الغاء الرحلة";
}
else {
$a['message']="Cancel the trip"; 
}
$array['message'][]= $a; 
}

else if($result_check_count1==1){
$a['Response Code']=400;
if($lang==2){
$a['message']="الرحلة بدات بالفعل";
}
else {
$a['message']="The trip has already begun"; 
}
$array['message'][]= $a; 
}   
    

else {


if($key==3){
$data_location = array('driver_activation'=>'3','lat_driver'=>$lat_driver,'lag_driver'=>$lag_driver);
$this->db->update('booking',$data_location,array('id_driver'=>$id_driver,'id_offers'=>$id_trip));
$a['Response Code']=200;
if($lang==2){
$a['message']="السيارة وصلت الى المنطقة المحددة";
    $mess['message']="السيارة وصلت الى المنطقة المحددة";
}
else {
$a['message']="The car arrived at the specified area"; 
$message= 
$mess['message']="The car arrived at the specified area";
}
$mess['driver_lat']=$lat_driver;
$mess['driver_lag']=$lat_driver;
$array['message'][]= $a; 
//$array['data'][]= $mess; 
$p['carpooling_arrived']=$mess;
$result_taxi=$this->db->get_where('booking',array('id_driver'=>$id_driver,'id_offers'=>$id_trip))->result();
foreach($result_taxi as $result_taxi){
     $id_passanger=$result_taxi->id_passanger;
$driver_data=$this->db->get_where('clients',array('id'=>$id_passanger))->result();
 foreach($driver_data as $driver_data)
$token_id=$driver_data->token_id;
array_push($main_tok,$token_id);
}

$registrationIds =$main_tok;
$msg = array
(
	'message' 	=>$p,
	'title'		=> '1'
);
$fields = array
(
	'registration_ids' 	=> $registrationIds,
	'data'			=> $msg
);
 
$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
$main_not['carpooling_driver_arrived']=$result;
$array["Notifiction"][]= $main_not;
}
else {
    
    if($lang==2){
$a['message']="الرحلة بدات فى التحرك";
}
else {
$a['message']="The trip began to start"; 
}
$array['message'][]= $a;    
}
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}





public function carpooling_accept_reject_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_driver= $this->input->post('Id_driver');
$key= $this->input->post('Key');
$id_passanger= $this->input->post('Id_passanger');
$id_trip= $this->input->post('Id_trip');
define( 'API_ACCESS_KEY', 'AAAAtFjcBmo:APA91bGWbblK8dkWT-SRWlmu6xiTfgIAFFbCxSiQOuP8JdChCuKApVq6mLSFllc6WUrQXCrFvFyhtk-BWu2WvCzPDJs43re70gqgQa-llexWV4PLwRydgj8POGZVaJMdRhoouaiboL1o');
$main_tok=array();



$result_taxi=$this->db->get_where('booking',array('id_offers'=>$id_trip,'id_driver'=>$id_driver,'id_passanger'=>$id_passanger,'start_finish'=>'0','driver_activation'=>'0'))->result();
//$mess['message']="Approval on Your Request";
if(count($result_taxi)==1){
$array["message"][]= $m;
if($key==1){
$m['Response Code'] =200;
if($lang==2){
$m['message'] ="تم الموافقة على طلب الاشتراك" ;
$mess['message']="تم الموافقة على طلب الإشتراك";
}
else {
$m['message']="Approval on your request";
$mess['message']="Approval on Your Request";
}
$array["message"][]= $m;

   $data_location = array('driver_activation'=>'1');
$this->db->update('booking',$data_location,array('id_offers'=>$id_trip,'id_driver'=>$id_driver,'id_passanger'=>$id_passanger));

}

else if($key==4){
 $m['Response Code'] =200;
 if($lang==2){
$m['message'] ="تم رفض طلب الاشتراك";
$mess['message']="تم رفض الإشتراك";
 }
else {
$m['message']="Your application has been rejected";
$message="Your application has been rejected";
$mess['message']="Your application has been rejected";
} 
$array["message"][]= $m;
$data_location = array('driver_activation'=>'4');
$this->db->update('booking',$data_location,array('id_offers'=>$id_trip,'id_driver'=>$id_driver,'id_passanger'=>$id_passanger));
}

$driver_data=$this->db->get_where('clients',array('id'=>$id_passanger))->result();
 foreach($driver_data as $driver_data)
$token_id=$driver_data->token_id;
array_push($main_tok,$token_id);

if($key==1){
 $p['carpooling_accept']=$mess;
}
else{
$p['carpooling_reject']=$mess;
}


$registrationIds =$main_tok;
$msg = array
(
	'message' 	=>$p,
	'title'		=> '1'
);
$fields = array
(
	'registration_ids' 	=> $registrationIds,
	'data'			=> $msg
);
 
$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
$main_not['carpooling_driver_accept_reject']=$result;
$array["Notifiction"][]= $main_not;

}
else {$m['Response Code'] =400;
if($lang==2){
$a['message']="لا يمكن اتمام هذه العملية ";
}
else {
$a['message']="This process can not be completed";
}
$array["message"][]= $a;}


@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}









public function carpooling_passanger_newhostory_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_passanger= $this->input->post('Id_passanger');
$result_taxi=$this->db->get_where('booking',array('driver_activation'=>'0','id_passanger'=>$id_passanger,'start_finish'=>'0'))->result();
if(count($result_taxi)>=1){
foreach($result_taxi as $result_taxi){
$token_id=$result_taxi->id_offers;
$result_data=$this->db->get_where('carpooling',array('id'=>$token_id))->result();
foreach($result_data as $result_data){
    $id_clients=$result_data->id_clients;
    
    $fname= $this->data->get_table_row('clients',array('id'=>$id_clients),'fname');
$phone= $this->data->get_table_row('clients',array('id'=>$id_clients),'phone');

$carimg= $this->data->get_table_row('clients',array('id'=>$id_clients),'img');
if($carimg!=""){$event_img="http://tareki.com/site/ar/images/driver/".$carimg;}
else {
$event_img="http://tareki.com/site/ar/images/driver/default.png";
}

$result_rate=$this->db->get_where('rate',array('id_client_rate'=>$id_clients))->result();
$driver_count=count($result_rate);
$num_p=0;
foreach($result_rate as $result_rate){
$num_p=$num_p+$result_rate->value;
}
$final_rate=round($num_p/$driver_count);
    
    $leaving=$result_data->leaving;
    $gooing=$result_data->gooing;
    $id=$result_data->id;
    $seats=$result_data->seats	;
    $direction_text=$result_data->direction_text;
    $startpoint=$result_data->startpoint;
    $endpoint=$result_data->endpoint;
    $datedata=$result_data->datedata;
    $time_trip=$result_data->time_trip;
    
$city_From= $this->data->get_table_row('city',array('id'=>$leaving),'name_eng');
$city_to= $this->data->get_table_row('city',array('id'=>$gooing),'name_eng');
$driver_data['rate']=$final_rate;
$driver_data['from city']=$city_From;
$driver_data['to city']=$city_to;    
$driver_data['client_id']=$id_clients;
$driver_data['number Seats']=$seats;
$driver_data['id_trip']=$id;
$driver_data['phone']=$phone;
$driver_data['fname']=$fname;
$driver_data['img']=$event_img;
$driver_data['startpoint']=$startpoint;
$driver_data['endpoint']=$endpoint;
$driver_data['direction_text']=$direction_text;
$driver_data['Date']=$datedata;
$driver_data['Time Trip']=$time_trip;
$array["Trip data"][]=$driver_data;
}

}
}
else {
$a['Response Code'] =400;
if($lang==2){
$a['message']="نأسف لعدم وجود رحلة";
}
else {
$a['message']="Sorry there is no data";
}
$array["message"][]= $a;
}

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);

}




public function carpooling_passanger_oldhostory_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_passanger= $this->input->post('id_passanger');
$result_taxi=$this->db->get_where('booking',array('driver_activation'=>'1','id_passanger'=>$id_passanger,'start_finish'=>'2'))->result();
if(count($result_taxi)>=1){
foreach($result_taxi as $result_taxi){
$token_id=$result_taxi->id_offers;
$result_data=$this->db->get_where('carpooling',array('id'=>$token_id))->result();
foreach($result_data as $result_data){
    $id_clients=$result_data->id_clients;
    
    $fname= $this->data->get_table_row('clients',array('id'=>$id_clients),'fname');
$phone= $this->data->get_table_row('clients',array('id'=>$id_clients),'phone');

$carimg= $this->data->get_table_row('clients',array('id'=>$id_myfriend),'img');
if($carimg!=""){$event_img="http://tareki.com/site/ar/images/driver/".$carimg;}
else {
$event_img="http://tareki.com/site/ar/images/driver/default.png";
}
    
    
    $leaving=$result_data->leaving;
    $gooing=$result_data->gooing;
    $id=$result_data->id;
    $seats=$result_data->seats	;
    $direction_text=$result_data->direction_text;
    $startpoint=$result_data->startpoint;
    $endpoint=$result_data->endpoint;
    
$city_From= $this->data->get_table_row('city',array('id'=>$leaving),'name_eng');
$city_to= $this->data->get_table_row('city',array('id'=>$gooing),'name_eng');

$driver_data['from city']=$city_From;
$driver_data['to city']=$city_to;    
$driver_data['client_id']=$id_clients;
$driver_data['number Seats']=$seats;
$driver_data['id_trip']=$id;
$driver_data['phone']=$phone;
$driver_data['fname']=$fname;
$driver_data['img']=$event_img;
$driver_data['startpoint']=$startpoint;
$driver_data['endpoint']=$endpoint;
$driver_data['direction_text']=$direction_text;
$array["Trip data"][]=$driver_data;
}

}
}
else {
$a['Response Code'] =400;
if($lang==1){
$a['message']="نأسف لعدم وجود رحلة";
}
else {
$a['message']="Sorry there is no data";
}
$array["message"][]= $a;
}

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);

}



public function get_location_driver_for_passanger_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client= $this->input->post('order_id');

$result_taxi=$this->db->get_where('taxi',array('id'=>$id_client))->result();
if(count($result_taxi)==1){
foreach($result_taxi as $result_taxi)
 $lat=$result_taxi->lat_driver;
  $lag=$result_taxi->lag_driver;
  $a['responsecode']='200';
 $a['lat_driver']=$lat;
$a['lag_driver']=$lag;
$array["data"][]= $a;

}
else {
$a['messageID']=0;
if($lang==2){
$a['message']="البيانات غير صحيحة";
}
else {
$a['message']="data not correct";
}
$array["message"][]= $a;
}

@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}

public function no_driver_api(){	
$this->load->view('pages/config/no_driver_api');
}
}