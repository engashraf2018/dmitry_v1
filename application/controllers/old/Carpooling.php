<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carpooling extends CI_Controller {

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

public function carpooling_passanger_cancel_api(){
$json = file_get_contents('php://input');
$lang =$this->input->post('lang');
$id_passanger= $this->input->post('id_passanger');
$id_trip= $this->input->post('id_trip');
$key= $this->input->post('key');
$id_clients= $this->input->post('id_clients');

$json = file_get_contents('php://input');
define( 'API_ACCESS_KEY', 'AAAA9TqJzwM:APA91bEiARn-Fau8rMnHGR_eEn9BHe5j5AnkhbI736FZicE6JWla5qlmvrxBmXgFr_dAn-H_ds17dq1AexPBzw-8JGwIgIGQDiZ9jpIWayuI0rjM9nVX6pjQgo7PwoJOoMvELHFcWg7b');
$main_tok=array();
$array=array();

$result_check=$this->db->get_where('booking',array('id_passanger'=>$id_passanger,'id_offers'=>$id_trip,'start_finish'=>'1'))->result();
if(count($result_check)==1){
$a['Response Code']=400;
if($lang==2){
$a['message']="تم بدأ الرحلة لا يجوز الغاءها";
}
else {
$a['message']="Trip can't be cancel"; 
}
$array['message'][]= $a; 
}
else {

$carpooling_check=$this->db->get_where('carpooling',array('id_clients'=>$id_clients))->result();
    foreach($carpooling_check as $result_taxi)
    $num_account=$result_taxi->num_account;
    $seats=$result_taxi->seats;
    $num_account=$seats-$seat_number;
    if(count($num_account<0)){

if($key==2){
    
     $id_passanger=$result_taxi->id_driver;
$data_location = array('passanger_activation'=>'2','seat_number'=>0);
$this->db->update('booking',$data_location,array('id_passanger'=>$id_passanger,'id_offers'=>$id_trip));
$a['Response Code']=200;
if($lang==2){
$a['message']="الغاء الرحلة بالفعل";
$message="الغاء الرحلة بالفعل" ;
}
else {
$a['message']="The trip was canceled"; 
$message="The trip was canceled"; 
}
$array['message'][]= $a; 


$result_taxi=$this->db->get_where('booking',array('id_passanger'=>$id_passanger,'id_offers'=>$id_trip))->result();
foreach($result_taxi as $result_taxi){
     $id_passanger=$result_taxi->id_driver;
$driver_data=$this->db->get_where('clients',array('id'=>$id_driver))->result();
 foreach($driver_data as $driver_data)
$token_id=$driver_data->token_id;
array_push($main_tok,$token_id);
}

$registrationIds =$main_tok;
$msg = array
(
	'message' 	=>$message,
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
$main_not['carpooling_passanger_cancel']=$result;
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
}
}
@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}




public function carpooling_passanger_arrived_api(){
$json = file_get_contents('php://input');
$lang =$this->input->post('lang');
$id_passanger= $this->input->post('id_passanger');
$id_trip= $this->input->post('id_trip');
$key= $this->input->post('key');
$json = file_get_contents('php://input');
define( 'API_ACCESS_KEY', 'AAAA9TqJzwM:APA91bEiARn-Fau8rMnHGR_eEn9BHe5j5AnkhbI736FZicE6JWla5qlmvrxBmXgFr_dAn-H_ds17dq1AexPBzw-8JGwIgIGQDiZ9jpIWayuI0rjM9nVX6pjQgo7PwoJOoMvELHFcWg7b');
$main_tok=array();



$result_check=$this->db->get_where('booking',array('id_passanger'=>$id_passanger,'id_offers'=>$id_trip,'driver_activation'=>'2'))->result();

$result_check_start=$this->db->get_where('booking',array('id_passanger'=>$id_passanger,'id_offers'=>$id_trip,'start_finish'=>'1'))->result();


if(count($result_check)>1){
$a['Response Code']=400;
if($lang==2){
$a['message']="تم الغاء الرحلة";
}
else {
$a['message']="Cancel the trip"; 
}
$array['message'][]= $a; 
}

else if(count($result_check_start)>1){
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
$data_location = array('passanger_activation'=>'3');
$this->db->update('booking',$data_location,array('id_passanger'=>$id_passanger,'id_offers'=>$id_trip));
$a['Response Code']=200;
if($lang==2){
$a['message']="السيارة وصلت الى المنطقة المحددة";
$message="السيارة وصلت الى المنطقة المحددة";
}
else {
$a['message']="The car arrived at the specified area"; 
$message="The car arrived at the specified area"; 
}
$array['message'][]= $a; 


$result_taxi=$this->db->get_where('booking',array('id_passanger'=>$id_passanger,'id_offers'=>$id_trip))->result();
foreach($result_taxi as $result_taxi){
     $id_passanger=$result_taxi->id_driver;
$driver_data=$this->db->get_where('clients',array('id'=>$id_passanger))->result();
 foreach($driver_data as $driver_data)
$token_id=$driver_data->token_id;
array_push($main_tok,$token_id);
}

$registrationIds =$main_tok;
$msg = array
(
	'message' 	=>$message,
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
$main_not['carpooling_passanger_arrive']=$result;
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


public function carpooling_driver_newhostory_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_driver= $this->input->post('id_driver');
$result_taxi=$this->db->get_where('booking',array('driver_activation'=>'0','id_driver'=>$id_driver,'start_finish'=>'0','passanger_action'=>'0'))->result();
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
$event_img="http://tareki.com/site/ar/images/passanger/default.png";
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



public function carpooling_driver_oldhostory_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$id_driver= $this->input->post('id_driver');
$result_taxi=$this->db->get_where('booking',array('driver_activation'=>'1','id_driver'=>$id_driver,'start_finish'=>'2','passanger_action'=>'1'))->result();
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
$event_img="http://tareki.com/site/ar/images/passanger/default.png";
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




public function reset_api(){
$json = file_get_contents('php://input');
$array=array();
$lang =$this->input->post('lang');
$order_id= $this->input->post('order_id');

$result_taxi=$this->db->get_where('taxi',array('id'=>$order_id))->result();
$data_location = array('driver_action'=>'0','client_action'=>'0','start_finish'=>'0');
$this->db->update('taxi',$data_location,array('id'=>$order_id,));
$a['Response Code']=200;
if($lang==2){
$a['message']="تم استخراج الريسيت";
$message="تم استخراج الرسيست";
}
else {
$a['message']="the reset is extracted"; 
$message="the reset is extracted"; 
}
$array['message'][]= $a; 



@header("Content-Type: application/json;charset=utf-8");
echo json_encode($array);
}









}