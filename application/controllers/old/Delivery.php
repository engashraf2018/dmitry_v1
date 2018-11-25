<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery extends CI_Controller {

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

/*******************************************App Services*****************************************/




public function logindelivery_api(){
$json = file_get_contents('php://input');
$username =$this->input->post('username');
$password =$this->input->post('pass');
$lang =$this->input->post('lang');
$passwordp=md5($password);
$array = array(); 
$customer_id="";
$customer_not="";
$customer_not = $this->data->get_table_row('delivery',array('phone'=>$username,'password'=>$passwordp,'active'=>'0'),'id');
if($customer_not==""){
$customer_not = $this->data->get_table_row('delivery',array('email'=>$username,'password'=>$passwordp,'active'=>'0'),'id');
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
else {
$customer_id = $this->data->get_table_row('delivery',array('phone'=>$username,'password'=>$passwordp,'active'=>'1'),'id');
if($customer_id==""){
$customer_id = $this->data->get_table_row('delivery',array('email'=>$username,'password'=>$passwordp,'active'=>'1'),'id');
 }

if($customer_id != ""){
$user_email =$this->data->get_table_row('delivery',array('id'=>$customer_id),'email');
$user_phone =$this->data->get_table_row('delivery',array('id'=>$customer_id),'phone');
$user_img =$this->data->get_table_row('delivery',array('id'=>$customer_id),'img');
$fname =$this->data->get_table_row('delivery',array('id'=>$customer_id),'name');
 $nickname =$this->data->get_table_row('delivery',array('id'=>$customer_id),'nickname');

if($user_img!=""){$main_img="https://bsor3a.com/site/ar/images/delivery/".$user_img;}else{
 $main_img="https://bsor3a.com/site/ar/images/delivery/defaultmain.png";
}
$main_img=$main_img;
$m['messageID']=1;
if($lang==2){
$m['message'] ="تم تسجيل الدخول بنجاح";
}
else {
$m['message'] ="Logged in successfully";
}
$a['fullname'] =$fname;
$a['delivery id'] =$customer_id;
$a['delivery phone'] =$user_phone;
$a['main_img'] =$main_img;
$a['nick name'] =$nickname;
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

public function deliveryregister_api(){	
$this->load->view('pages/config/deliveryregister_api');
}


public function contactus_api(){
$json = file_get_contents('php://input');
$array=array();
$contact_info= $this->db->get_where('contact_info')->result();
foreach($contact_info as $contact_info)
$phone=$contact_info->phone;
$email=$contact_info->email;
$hot_line=$contact_info->hot_line;
$fax=$contact_info->fax	;
$face_account=$contact_info->face_account;
$googleplus=$contact_info->googleplus;
$twitter=$contact_info->twitter	;
$a['phone']=$phone;
$a['email']=$email;
$a['hot_line']=$hot_line;
$a['fax']=$fax;
$a['face_account']=$face_account;
$a['googleplus']=$googleplus;
$a['twitter']=$twitter;
$array["data"][]= $a;

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


public function edit_delivery_profile_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client=$this->input->post('id_delivery');
$fname=$this->input->post('name');
$phone=$this->input->post('phone');
$email=$this->input->post('email');
$password=$this->input->post('password');
$address=$this->input->post('address');
$nickname=$this->input->post('nickname');
$table='delivery';
$key=0;
if($fname!=""){
$data= array('name'=>$fname);
$key=1;
$new=$this->data->edit_table($table,$id_client,$data);
}
if($address!=""){
$data= array('address'=>$address);
$key=1;
$new=$this->data->edit_table($table,$id_client,$data);
}

if($nickname!=""){
$data= array('nickname'=>$nickname);
$key=1;
$new=$this->data->edit_table($table,$id_client,$data);
}

if($fname!=""){
$data= array('name'=>$fname);
$key=1;
$new=$this->data->edit_table($table,$id_client,$data);
}

if($phone!=""){
$result_phone= $this->db->get_where('delivery',array('phone'=>$phone))->result();
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

$result_email= $this->db->get_where('delivery',array('email'=>$email))->result();
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


if(isset($_FILES['img']['name'])&&$_FILES['img']['name']!=""){
$logo = $this->data->get_table_row('clients',array('id'=>$id_client),'img'); 
if ($logo != "") {
unlink("site/ar/images/delivery/$logo");
}
$img_name=$this->gen_random_string(); 
$imagename = $img_name;
$config['upload_path'] = 'site/ar/images/delivery/';
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
$this->data->edit_table('delivery',$id_client,$data);
if($lang==2){$a['message']="تم رفع الصورة ";}
else {$a['message']="Image uploaded"; }
//$a['url_img']="https://bsor3a.com/site/ar/images/delivery/".$imagename.".".$file_extension;
//$array['message'][]= $a;
}
$key=1;
}

if($key==1){
$a['messageID']=1;
if($lang==2){
$a['message']="تم تعديل البيانات بنجاح";
}
else {
$a['message']="Data successfully Edited"; 
}
$array['message'][]= $a;
}

$total_hours= $this->db->get_where("delivery_timer",array('delivery_id'=>$id_client))->result();
$total_hour=0;
foreach($total_hours as $totalhours)
{
    $on_time=date("Y-m-d H:i:s",strtotime($totalhours->on_time));
    $off_time=date("Y-m-d H:i:s",strtotime($totalhours->off_time));
 $time1 = strtotime($on_time);
$time2 = strtotime($off_time);
$difference = round(abs($time2 - $time1) / 3600,2);
$total_hour=$total_hour+$difference;
}


$total_rate= $this->db->get_where("rate",array('id_rate'=>$id_client,'type'=>'2'))->result();
$count_rate=count($total_rate);
$final_rate=0;
foreach($total_rate as $totalrate)
{$final_rate=$totalrate->value_rate+$final_rate;}
$deliver_final_rate=($final_rate)/$count_rate;


$total_order= $this->db->get_where("orders",array('id_delivery'=>$id_client,'status'=>'6'))->result();

$delivery_commission= $this->data->get_table_row('site_info',array('id'=>1),'delivery_commetion');

$total_price=0;
$total_order_count=count($total_order);
foreach($total_order as $totalorder)
{$total_price=$totalorder->total_price+$total_price;}
$total_commission=($total_price*$delivery_commission)/100;


$data_statistics= array('total_hours'=>$total_hour,'total_rate'=>round($deliver_final_rate),'total_order'=>$total_order_count,'total_commation'=>$total_commission);
$this->data->edit_table('delivery',$id_client,$data_statistics);

$result_clients= $this->db->get_where("delivery",array('id'=>$id_client))->result();

foreach($result_clients as $result_clients){
$fname=$result_clients->name;
$email=$result_clients->email;
$phone=$result_clients->phone;
$img=$result_clients->img;
$address=$result_clients->address;
$nickname=$result_clients->nickname;
if($img!=""){$main_img="https://bsor3a.com/site/ar/images/delivery/".$img;}
else {
$main_img="https://bsor3a.com/site/ar/images/delivery/defaultmain.png";}
$rate=$result_clients->total_rate;
$total_commation=$result_clients->total_commation;
$total_order=$result_clients->total_order;
$total_hours=$result_clients->total_hours;
$b['full_name'] =$fname;
$b['email'] =$email;
$b['phone'] =$phone;
$b['rate'] =$rate;
$b['total_commation'] =$total_commation;
$b['total_order'] =$total_order;
$b['total_hours'] =$total_hours;
$b['client_img'] =$main_img;
}
$b['id_delivery'] =$id_client;
$array['data'][]= $b; 
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}




public function delivery_on_of_api(){
    date_default_timezone_set('Africa/Cairo');
    $daydate=date("Y-m-d H:i:s");
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client= $this->input->post('id_delivery');
$key= $this->input->post('key');
$result_clients=$this->db->get_where('delivery',array('id'=>$id_client))->result();
if(count($result_clients)>0){
    if($key==1){
$data = array('on_time'=>$daydate,'delivery_id'=>$id_client);
$this->db->insert('delivery_timer',$data);
$a['messageID']=1;
if($lang==2){
$a['message']="انت الان اون لاين";
}
else {
$a['message']="You now online";
}
$array["message"][]= $a;
}
else if($key==2){
$result_taxi=$this->db->order_by('id','desc')->limit(1)->get_where('delivery_timer',array('delivery_id'=>$id_client))->result();
foreach($result_taxi as $result_taxi)
$id=$result_taxi->id;
$on_time=$result_taxi->on_time;
$total_hours = abs(strtotime($on_time) - strtotime($daydate))/(60*60);

$data_update= array('off_time'=>$daydate,'total_hours'=>$total_hours);
$this->db->update('delivery_timer',$data_update,array('id'=>$id));

$a['messageID']=1;
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







public function delivery_accept_reject_api(){
    date_default_timezone_set('Africa/Cairo');
    $daydate=date("Y-m-d H:i:s");
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client= $this->input->post('id_delivery');
$id_order= $this->input->post('id_order');
$key= $this->input->post('key');
$result_clients=$this->db->get_where('delivery',array('id'=>$id_client))->result();
if(count($result_clients)>0){
    if($key==1){
$data_order = array('status'=>'1');
$this->db->update('orders',$data_order,array('id'=>$id_order));
$a['messageID']=1;
if($lang==2){
$a['message']="تم الموافقة على استلام الطلب";
}
else {
$a['message']="Your order has been approved";
}
$array["message"][]= $a;
}
else if($key==2){
$data_order = array('status'=>'2');
$this->db->update('orders',$data_order,array('id'=>$id_order));

$a['messageID']=1;
if($lang==2){
$a['message']="تم رفض استلام الطلب";
}
else {
$a['message']="Request received was denied";
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





public function delivery_received_not_receive_api(){
date_default_timezone_set('Africa/Cairo');
$daydate=date("Y-m-d H:i:s");
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client= $this->input->post('id_delivery');
$id_order= $this->input->post('id_order');
$key= $this->input->post('key');
$result_clients=$this->db->get_where('orders',array('id'=>$id_order))->result();
if(count($result_clients)>0){
    if($key==3){
$data_order = array('status'=>'3');
$this->db->update('orders',$data_order,array('id'=>$id_order));
$a['messageID']=1;
if($lang==2){
$a['message']="تم استلام الطلب من العميل";
}
else {
$a['message']="The order has been received from the customer";
}
$array["message"][]= $a;
}
else if($key==4){
$data_order = array('status'=>'4');
$this->db->update('orders',$data_order,array('id'=>$id_order));

$a['messageID']=1;
if($lang==2){
$a['message']="فشل استلام الطلب من العميل";
}
else {
$a['message']="Failed to receive order from customer";
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



public function delivery_submission_not_submission_api(){
date_default_timezone_set('Africa/Cairo');
$daydate=date("Y-m-d H:i:s");
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_client= $this->input->post('id_delivery');
$id_order= $this->input->post('id_order');
$code= $this->input->post('code');
$key= $this->input->post('key');
$result_clients=$this->db->get_where('orders',array('id'=>$id_order))->result();
if(count($result_clients)>0){
    if($key==5){
    $result_code=$this->db->get_where('orders',array('id'=>$id_order,'code_order'=>$code))->result();
if(count($result_code)>0){
$a['messageID']=1;
if($lang==2){
$a['message']="نم تأكيد الكود وتسليم الطلب بنجاح";
}
else {
$a['message']="Confirm the code and submit the request successfully";
}
$array["message"][]= $a; 

$data_order = array('status'=>'5','delivery_time'=>$daydate);
$this->db->update('orders',$data_order,array('id'=>$id_order));

}
else {
 $a['messageID']=0;
if($lang==2){
$a['message']="كود التاكيد غير صحيح";
}
else {
$a['message']="The confirmation code is incorrect";
}
$array["message"][]= $a;    
    
    
}


}
else if($key==6){
$data_order = array('status'=>'6');
$this->db->update('orders',$data_order,array('id'=>$id_order));

$a['messageID']=1;
if($lang==2){
$a['message']="فشل تسليم الطلب";
}
else {
$a['message']="Order delivery failed";
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


 public function orders_old(){
        $json = file_get_contents('php://input');
        $lang =$this->input->post('lang');
        $id_delivery=$this->input->post('id_delivery');
        $array = array();
        $result = $this->db->get_where("orders",array('status'=>'6','id_delivery'=>$id_delivery))->result();
        if($result){
        foreach($result as $result){
            $name_order=$result->name;
            $code_order=$result->code_order;
            $id_client=$result->id_client;
            $creation_date=$result->creation_date;
            $delivery_time=$result->delivery_time;
            $space=$result->space;
            $total_price=$result->total_price;
            $id_order=$result->id_order;
        }
        $b['name order']=$name_order;
        $b['code order']=$code_order;
        $b['id client']=$id_client;
        $b['id delivery']=$id_delivery;
        $b['creation date']=$creation_date;
        $b['space']=$space;
        $b['total price']=$total_price;
        $b['id_order']=$id_order;
        }
        if($result){
            $a['messageID']=1;
            $array['data'] = $b;
        }
        else{
            $a['messageID']=0;
            if($lang==2){
            $a['message']="عفوا لاتوجد طلبات";
            }
            else {
            $a['message']="Sorry there are no orders"; 
            }
            $array["message"][]= $a;
        }
        @header("Content-Type: application/json;charset=utf-8");
        echo json_encode($array);
    }



public function orders_new(){
        $json = file_get_contents('php://input');
        $lang =$this->input->post('lang');
        $id_delivery=$this->input->post('id_delivery');
        $array = array();
        $result = $this->db->get_where("orders",array('status'=>'7','id_delivery'=>$id_delivery))->result();
        if($result){
        foreach($result as $result){
            $name_order=$result->name;
            $code_order=$result->code_order;
            $id_client=$result->id_client;
            $creation_date=$result->creation_date;
            $delivery_time=$result->delivery_time;
            $space=$result->space;
            $total_price=$result->total_price;
            $id_order=$result->id;
        }
        $b['name order']=$name_order;
        $b['code order']=$code_order;
        $b['id client']=$id_client;
        $b['id delivery']=$id_delivery;
        $b['creation date']=$creation_date;
        $b['space']=$space;
        $b['total price']=$total_price;
        $b['id_order']=$id_order;
        
        }
        if($result){
            $a['messageID']=1;
            $array['data'] = $b;
        }
        else{
            $a['messageID']=0;
            if($lang==2){
            $a['message']="عفوا لاتوجد طلبات";
            }
            else {
            $a['message']="Sorry there are no orders"; 
            }
            $array["message"][]= $a;
        }
        @header("Content-Type: application/json;charset=utf-8");
        echo json_encode($array);
    }



public function delivery_rate_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_order= $this->input->post('id_order');
$rate_value= $this->input->post('rate_value');
$result_order = $this->db->get_where("orders",array('id'=>$id_order))->result();
            foreach($result_order as $result_order)
            $id_delivery=$result_order->id_delivery;
            $id_client=$result_order->id_client;
            
$result_taxi=$this->db->get_where('rate',array('id_rate'=>$id_client,'id_user'=>$id_delivery,'type'=>'1','id_order'=>$id_order))->result();
if(count($result_taxi)==0){
$result = $this->db->get_where("orders",array('id'=>$id_order))->result();
            foreach($result as $results)
            $data['id_user']=$results->id_delivery;
            $data['id_rate']=$results->id_client;
            $data['type']='1';
            $data['id_order']=$id_order;
            $data['value_rate']=$rate_value;
$this->db->insert('rate',$data);

$data_rate['rate_delivery']='1';
$this->db->update('orders',$data_rate,array('id'=>$id_order));

}
else {
$data['value_rate']=$rate_value;
$this->db->update('rate',$data,array('id_rate'=>$id_client,'id_user'=>$id_delivery,'type'=>'1','id_order'=>$id_order));
$data_rate['rate_delivery']='1';
$this->db->update('orders',$data_rate,array('id'=>$id_order));
    
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




public function delivery_last_rate_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_delivery= $this->input->post('id_delivery');

$result_taxi=$this->db->order_by('id','desc')->limit(1)->get_where('orders',array('id_delivery'=>$id_delivery,'rate_delivery'=>'0'))->result();
if(count($result_taxi)==0){
$a['messageID']=0;
$array["message"][]= $a;
}
 else {
foreach($result_taxi as $result_taxi)
$id_delivery=$result_taxi->id_delivery;
$id_client=$result_taxi->id_client;
$delivery_time=$result_taxi->delivery_time;
$space=$result_taxi->space;
$total_price=$result_taxi->total_price;
$code_order=$result_taxi->code_order;
$name=$result_taxi->name;

$id_order=$result_taxi->id;
$main_data=$this->db->get_where('clients',array('id'=>$id_client))->result();
foreach($main_data as $main_data){
$driver_name=$main_data->name;
$img_dirver=$main_data->img;
$driver_phone=$main_data->phone;
if($img_dirver!=""){$main_img="http://tareki.com/site/ar/images/clients/".$img_dirver;}
else {$main_img="http://tareki.com/site/ar/images/clients/defaultmain.png";}
$a['messageID']=1;
$order_data['client_id']=$id_client;
$order_data['client name']=$driver_name;
$order_data['img']=$main_img;
$order_data['phone']=$driver_phone;
$order_data['id order']=$id_order;
$order_data['Space']=$space;
$order_data['Total price']=$total_price;
$order_data['Code order']=$code_order;
$order_data['name order']=$name;
$order_data['Delivery time']=$delivery_time;
$array["message"][]= $a;
$array["order_data"][]= $order_data;
}
 }
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}



 public function order_details(){
        $json = file_get_contents('php://input');
        $lang = $this->input->post('lang');
        $id_order = $this->input->post('id_order');
        $array = array();
        $result = $this->db->get_where("orders",array('id'=>$id_order))->result();
        foreach($result as $results){
        $a['name']=$results->name;
        $a['code_order']=$results->code_order;
        $a['id_client']=$results->id_client;
        $a['id_delivery']=$results->id_delivery;
        $a['creation_date']=$results->creation_date;
        $st=$results->status;
        if($st==1){if($lang==2){$main_status="تم قبول الطلب";} else {$main_status="Order accepted";} }
        if($st==2){if($lang==2){$main_status="تم رفض الطلب";} else {$main_status="Order  rejected";} }
        if($st==3){if($lang==2){$main_status="تم استلام الطلب";} else {$main_status="Order Recived";} }
        if($st==4){if($lang==2){$main_status="لم يتم استلام الطلب";} else {$main_status="Order  rejected";} }
        if($st==5){if($lang==2){$main_status="لم يتم تسليم الطلب";} else {$main_status="Order Recived";} }
        if($st==6){if($lang==2){$main_status="تم تسليم الطلب";} else {$main_status="Order rejected";} }
        $a['status']=$main_status;
        $a['id_reciver']=$results->id_reciver;
        $a['map_address_client']=$results->map_address_client;
        $a['client_lat']=$results->client_lat;
        $a['client_lag']=$results->client_lag;
        $a['map_address_reciver']=$results->map_address_reciver;
        $a['reciver_lat']=$results->reciver_lat;
        $a['reciver_lag']=$results->reciver_lag;
        $a['total_price']=$results->total_price;
        $a['promo_id']=$results->promo_id;
        $a['delivery_time']=$results->delivery_time;
        $a['space']=$results->space;
        $array['reciver'] = $this->db->get_where("order_reciver",array('id'=>$results->id_reciver))->result();
        $array['client'] = $this->db->get_where("clients",array('id'=>$results->id_client))->result();
        //$array["data"][]= $a;
        }
        if($result){
            $a['messageID']=1;
            $array["order details"][]= $a;
        }else{
            $a['messageID']=0;
            if($lang==2){
            $a['message']="عفوا لاتوجد نتيجة";
            }
            else {
            $a['message']="Sorry there is no result"; 
            }
            $array["message"][]= $a;
        }
        @header("Content-Type: application/json;charset=utf-8");
        echo json_encode($array);
    }




public function delivery_wallet_api(){
$json = file_get_contents('php://input');
$array=array();
$daydate=date("Y-m-d");
$id_client=$this->input->post('id_delivery');
$lang=$this->input->post('lang');
$table='delivery';
$total_delivery= $this->db->get_where("delivery",array('id'=>$id_client))->result();
if(count($total_delivery)>0){

$total_hours= $this->db->get_where("delivery_timer",array('delivery_id'=>$id_client))->result();
$total_hour=0;
if(count($total_hours)>0){
foreach($total_hours as $totalhours)
{
    $on_time=date("Y-m-d H:i:s",strtotime($totalhours->on_time));
    $off_time=date("Y-m-d H:i:s",strtotime($totalhours->off_time));
 $time1 = strtotime($on_time);
$time2 = strtotime($off_time);
$difference = round(abs($time2 - $time1) / 3600,2);
$total_hour=$total_hour+$difference;
}
}

$total_rate= $this->db->get_where("rate",array('id_rate'=>$id_client,'type'=>'2'))->result();
$count_rate=count($total_rate);
$final_rate=0;
$deliver_final_rate=0;
if($count_rate>0){
foreach($total_rate as $totalrate)
{$final_rate=$totalrate->value_rate+$final_rate;}
$deliver_final_rate=($final_rate)/$count_rate;
}

$daily_order= $this->db->get_where("orders",array('id_delivery'=>$id_client,'status'=>'6','date_delivery'=>$daydate))->result();

$total_order= $this->db->get_where("orders",array('id_delivery'=>$id_client,'status'=>'6'))->result();

$delivery_commission= $this->data->get_table_row('site_info',array('id'=>1),'delivery_commetion');

$total_price=0;
$total_order_count=count($total_order);
$total_space=0;
foreach($total_order as $totalorder)
{$total_price=$totalorder->total_price+$total_price;
$total_space=$totalorder->space+$total_space;
    
}
$total_commission=($total_price*$delivery_commission)/100;



$total_price_day=0;
$total_space_day=0;
$total_order_count_day=count($daily_order);
foreach($daily_order as $dailyorder)
{$total_price_day=$dailyorder->total_price+$total_price_day;
    $total_space_day=$dailyorder->space+$total_space_day;
}
$total_commission_day=($total_price_day*$delivery_commission)/100;


$data_statistics= array('total_hours'=>$total_hour,'total_rate'=>round($deliver_final_rate),'total_order'=>$total_order_count,'total_commation'=>$total_commission,'total_money'=>$total_price,'daily_commission'=>$total_commission_day,'total_day'=>$total_price_day);
$this->data->edit_table('delivery',$id_client,$data_statistics);

$result_clients= $this->db->get_where("delivery",array('id'=>$id_client))->result();

foreach($result_clients as $result_clients){
    
$total_money=$result_clients->total_money;
$daily_commission=$result_clients->daily_commission;
$total_day=$result_clients->total_day;
$total_paid=$result_clients->total_paid;
$day_paid	=$result_clients->day_paid;
$rate=$result_clients->total_rate;
$total_commation=$result_clients->total_commation;
$total_order=$result_clients->total_order;
$total_hour=$result_clients->total_hours;

$b['rate'] =$rate;
$b['total_money'] =$total_money;
$b['total_commation'] =$total_commation;
$b['Required to be paid Total'] =$total_money-$total_commation;
$b['total_order'] =$total_order;
$b['total_hours'] =$total_hour;
$b['total day'] =$total_day;
$b['daily commission'] =$daily_commission;
$b['Required to be paid day'] =$total_day-$daily_commission;
$b['total paid'] =$total_paid;
$b['day paid'] =$day_paid;
$b['Total Order day']=count($daily_order);
$b['total_space'] =$total_space;
$b['day space'] =$total_space_day;

}
$b['id_delivery'] =$id_client;
$array['data'][]= $b; 
}
else {
             $a['messageID']=0;
            if($lang==2){
            $a['message']="عفوا لاتوجد نتيجة";
            }
            else {
            $a['message']="Sorry there is no result"; 
            }
            $array["message"][]= $a;   
    
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}


}