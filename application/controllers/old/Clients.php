<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller
{
    private  $username_sms = 'bsor3a';
    private  $password_sms = 'Bsor3a01281079117joodelnagar@@';
    private  $url_sms = 'https://bulksms.vsms.net/eapi/submission/send_sms/2/2.0';

    function __construct()
    {
        parent::__construct();
        header("Access-Control-Allow-Origin:*");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Headers: origin, content-type, accept, Set-Cookie");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header('Access-Control-Max-Age: 166400');
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
        echo "HI";
    }

    ///////////////////////////////////////////////  SMS Code  //////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function print_ln($content) {
        if (isset($_SERVER["SERVER_NAME"])) {
          print $content."<br />";
        }
        else {
          print $content."\n";
        }
      }
      
      function formatted_server_response( $result ) {
        $this_result = "";
        if ($result['success']) {
          $this_result .= "Success: batch ID " .$result['api_batch_id']. "API message: ".$result['api_message']. "\nFull details " .$result['details'];
        }
        else {
          $this_result .= "Fatal error: HTTP status " .$result['http_status_code']. ", API status " .$result['api_status_code']. " API message " .$result['api_message']. " full details " .$result['details'];
      
          if ($result['transient_error']) {
            $this_result .=  "This is a transient error - you should retry it in a production environment";
          }
        }
        return $this_result;
      }
      
      function send_message ( $post_body, $url ) {
        $ch = curl_init( );
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_body );
        // Allowing cUrl funtions 20 second to execute
        curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
        // Waiting 20 seconds while trying to connect
        curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 20 );
      
        $response_string = curl_exec( $ch );
        $curl_info = curl_getinfo( $ch );
      
        $sms_result = array();
        $sms_result['success'] = 0;
        $sms_result['details'] = '';
        $sms_result['transient_error'] = 0;
        $sms_result['http_status_code'] = $curl_info['http_code'];
        $sms_result['api_status_code'] = '';
        $sms_result['api_message'] = '';
        $sms_result['api_batch_id'] = '';
      
        if ( $response_string == FALSE ) {
          $sms_result['details'] .= "cURL error: " . curl_error( $ch ) . "\n";
        } elseif ( $curl_info[ 'http_code' ] != 200 ) {
          $sms_result['transient_error'] = 1;
          $sms_result['details'] .= "Error: non-200 HTTP status code: " . $curl_info[ 'http_code' ] . "\n";
        }
        else {
          $sms_result['details'] .= "Response from server: $response_string\n";
          $api_result = explode( '|', $response_string );
          $status_code = $api_result[0];
          $sms_result['api_status_code'] = $status_code;
          $sms_result['api_message'] = $api_result[1];
          if ( count( $api_result ) != 3 ) {
            $sms_result['details'] .= "Error: could not parse valid return data from server.\n" . count( $api_result );
          } else {
            if ($status_code == '0') {
              $sms_result['success'] = 1;
              $sms_result['api_batch_id'] = $api_result[2];
              $sms_result['details'] .= "Message sent - batch ID $api_result[2]\n";
            }
            else if ($status_code == '1') {
              # Success: scheduled for later sending.
              $sms_result['success'] = 1;
              $sms_result['api_batch_id'] = $api_result[2];
            }
            else {
              $sms_result['details'] .= "Error sending: status code [$api_result[0]] description [$api_result[1]]\n";
            }
          }
        }
        curl_close( $ch );
      
        return $sms_result;
      }
      
      function seven_bit_sms ( $username, $password, $message, $msisdn ) {
        $post_fields = array (
        'username' => $username,
        'password' => $password,
        'message'  => $this->character_resolve( $message ),
        'msisdn'   => $msisdn,
        'allow_concat_text_sms' => 0, # Change to 1 to enable long messages
        'concat_text_sms_max_parts' => 2
        );
      
        return $this->make_post_body($post_fields);
      }
      
      function unicode_sms ( $username, $password, $message, $msisdn ) {
        $post_fields = array (
        'username' => $username,
        'password' => $password,
        'message'  => $this->string_to_utf16_hex( $message ),
        'msisdn'   => $msisdn,
        'dca'      => '16bit'
        );
      
        return $this->make_post_body($post_fields);
      }

      function eight_bit_sms( $username, $password, $message, $msisdn ) {
        $post_fields = array (
        'username' => $username,
        'password' => $password,
        'message'  => $message,
        'msisdn'   => $msisdn,
        'dca'      => '8bit'
        );
      
        return $this->make_post_body($post_fields);
      
      }
      
      function make_post_body($post_fields) {
        $stop_dup_id = $this->make_stop_dup_id();
        if ($stop_dup_id > 0) {
          $post_fields['stop_dup_id'] = $this->make_stop_dup_id();
        }
        $post_body = '';
        foreach( $post_fields as $key => $value ) {
          $post_body .= urlencode( $key ).'='.urlencode( $value ).'&';
        }
        $post_body = rtrim( $post_body,'&' );
      
        return $post_body;
      }
      
      function character_resolve($body) {
        $special_chrs = array(
        'Δ'=>'0xD0', 'Φ'=>'0xDE', 'Γ'=>'0xAC', 'Λ'=>'0xC2', 'Ω'=>'0xDB',
        'Π'=>'0xBA', 'Ψ'=>'0xDD', 'Σ'=>'0xCA', 'Θ'=>'0xD4', 'Ξ'=>'0xB1',
        '¡'=>'0xA1', '£'=>'0xA3', '¤'=>'0xA4', '¥'=>'0xA5', '§'=>'0xA7',
        '¿'=>'0xBF', 'Ä'=>'0xC4', 'Å'=>'0xC5', 'Æ'=>'0xC6', 'Ç'=>'0xC7',
        'É'=>'0xC9', 'Ñ'=>'0xD1', 'Ö'=>'0xD6', 'Ø'=>'0xD8', 'Ü'=>'0xDC',
        'ß'=>'0xDF', 'à'=>'0xE0', 'ä'=>'0xE4', 'å'=>'0xE5', 'æ'=>'0xE6',
        'è'=>'0xE8', 'é'=>'0xE9', 'ì'=>'0xEC', 'ñ'=>'0xF1', 'ò'=>'0xF2',
        'ö'=>'0xF6', 'ø'=>'0xF8', 'ù'=>'0xF9', 'ü'=>'0xFC',
        );
      
        $ret_msg = '';
        if( mb_detect_encoding($body, 'UTF-8') != 'UTF-8' ) {
          $body = utf8_encode($body);
        }
        for ( $i = 0; $i < mb_strlen( $body, 'UTF-8' ); $i++ ) {
          $c = mb_substr( $body, $i, 1, 'UTF-8' );
          if( isset( $special_chrs[ $c ] ) ) {
            $ret_msg .= chr( $special_chrs[ $c ] );
          }
          else {
            $ret_msg .= $c;
          }
        }
        return $ret_msg;
      }
      

      function make_stop_dup_id() {
        return 0;
      }
      
      function string_to_utf16_hex( $string ) {
        return bin2hex(mb_convert_encoding($string, "UTF-16", "UTF-8"));
      }
      
      function xml_to_wbxml( $msg_body ) {
      
        $wbxmlfile = 'xml2wbxml_'.md5(uniqid(time())).'.wbxml';
        $xmlfile = 'xml2wbxml_'.md5(uniqid(time())).'.xml';
      
        //create temp file
        $fp = fopen($xmlfile, 'w+');
      
        fwrite($fp, $msg_body);
        fclose($fp);
      
        //convert temp file
        exec(xml2wbxml.' -v 1.2 -o '.$wbxmlfile.' '.$xmlfile.' 2>/dev/null');
        if(!file_exists($wbxmlfile)) {
            $this->print_ln('Fatal error: xml2wbxml conversion failed');
          return false;
        }
      
        $wbxml = trim(file_get_contents($wbxmlfile));
      
        //remove temp files
        unlink($xmlfile);
        unlink($wbxmlfile);
        return $wbxml;
      }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////  SMS Code  //////////////////////////////////////////////////////////////

    function active_sms($msg_sms,$phone){
        //$msg_sms ="ياستاذ اشرف ياجهبز انا هروح انام";
        //$phone = "201223846165";
        $post_body = $this->unicode_sms( $this->username_sms, $this->password_sms, $msg_sms, $phone );
        $result = $this->send_message( $post_body, $this->url_sms );
        if( $result['success'] ) {
            $this->print_ln( $this->formatted_server_response( $result ) );
        }
        else {
            $this->print_ln( $this->formatted_server_response( $result ) );
        }
    }

    public function login(){
    $json = file_get_contents('php://input');
    $username =$this->input->post('username');
    $password =$this->input->post('password');
    $lang =$this->input->post('lang');
    $passwordp=md5($password);
    $customer_id="";
    $customer_not="";
    $array = array(); 
    $customer_not = $this->data->get_table_row('clients',array('phone'=>$username,'password'=>$passwordp,'active'=>'0','activation_code'=>'0'),'id');
    if($customer_not==""){
    $customer_not = $this->data->get_table_row('clients',array('email'=>$username,'password'=>$passwordp,'active'=>'0','activation_code'=>'0'),'id');
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

    $customer_not = $this->data->get_table_row('clients',array('phone'=>$username,'password'=>$passwordp,'active'=>'1','activation_code'=>'0'),'id');
    if($customer_not==""){
    $customer_not = $this->data->get_table_row('clients',array('email'=>$username,'password'=>$passwordp,'active'=>'1','activation_code'=>'0'),'id');
    }
    if($customer_not!=""){
  $user_email =$this->data->get_table_row('clients',array('id'=>$customer_not),'email');
    $user_phone =$this->data->get_table_row('clients',array('id'=>$customer_not),'phone');
    $user_code=$this->data->get_table_row('clients',array('id'=>$customer_not),'code');
    $user_name=$this->data->get_table_row('clients',array('id'=>$customer_not),'name');
    $data_client['user_email']=$user_email;
    $data_client['user_phone']=$user_phone;
    $data_client['user_code']=$user_code;
    $data_client['user_name']=$user_name;
    $data_client['customer_id']=$customer_not;
    
    $a['messageID']=0;
    if($lang==2){
        $a['message'] ="حسابك غير مفعل";
    }
    else {
        $a['message'] ="Account is not confirm";	
    }
    
    $array["message"][]= $a;
    $array["data"][]= $data_client;
    }

    else {
    $customer_id = $this->data->get_table_row('clients',array('phone'=>$username,'password'=>$passwordp,'active'=>'1','activation_code'=>'1'),'id');
    if($customer_id==""){
    $customer_id = $this->data->get_table_row('clients',array('email'=>$username,'password'=>$passwordp,'active'=>'1','activation_code'=>'1'),'id');
    } 

    if($customer_id != ""){
    $user_email =$this->data->get_table_row('clients',array('id'=>$customer_id),'email');
    $user_phone =$this->data->get_table_row('clients',array('id'=>$customer_id),'phone');
    $user_img =$this->data->get_table_row('clients',array('id'=>$customer_id),'img');
    $user_nickname =$this->data->get_table_row('clients',array('id'=>$customer_id),'phone');
   
    if($user_img!=""){$main_img="https://bsor3a.com/site/ar/images/clients/".$user_img;}else{
        $main_img="https://bsor3a.com/site/ar/images/clients/defaultmain.png";
    }

    $m['messageID']=1;
    if($lang==2){
    $m['message'] ="تم تسجيل الدخول بنجاح";
    }
    else {
    $m['message']  ="Logged in successfully"; 
    }
    
    $array["message"][]=$m;
    $a['customer_id'] =$customer_id;
    $a['customer_phone'] =$user_phone;
    $a['customer_email'] =$user_email;
    $a['customer_img'] =$main_img;
    $a['nick name'] =$user_nickname;
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

public function gen_random_string(){
    $chars ="1234567890";//length:36
    $final_rand='';
    for($i=0;$i<6; $i++) {
    $final_rand .= $chars[ rand(0,strlen($chars)-1)];
    }
    return $final_rand;
}

public function register(){
    $json = file_get_contents('php://input');
    $lang =$this->input->post('lang');
    $name = $this->input->post('name');
    $phone = $this->input->post('phone');
    $state_id = $this->input->post('state_id');
    $email = $this->input->post('email');
    $nickname = $this->input->post('nickname');
    $street_name = $this->input->post('street_name');
    $building_number = $this->input->post('building_number');
    $flower_number = $this->input->post('flower_number');
    $eimg=$this->input->post('img');
    $code = "BS-".$this->gen_random_string();
    $active = '1';
    $activation_code = 0;
    $password = $this->input->post('password');
    $array = array(); 
    

    if($name==""||$phone==""||$email==""||$password==""||$nickname==""||$street_name==""||$building_number==""||$flower_number==""){
        $a['messageID'] =0;
        if($lang==2){
            $a['message'] ="من فضلك أكمل الحقول الفارغة";
        }else{
            $a['message'] ="Please complete empty fields";
        }
        $array["message"][]= $a;
    }
    else{
    $data['name'] = $name;   
    $data['phone'] = $phone;
    $data['state_id'] = $state_id;
    $data['email'] = $email;
    $data['nickname'] = $nickname;
    $data['street_name'] = $street_name;
    $data['building_number'] = $building_number;
    $data['flower_number'] = $flower_number;
    $data['code'] = $code;
    $data['active'] = $active;
    $data['activation_code'] =$activation_code;
    $data['password'] = md5($password);
    $dt=date("Ymd");
    $tm=date("his");
      if($eimg!=""){
   $rnd =$this->gen_random_string(); 
   $img_name="img_".$dt.$tm.$rnd.".jpg";
   $decodimg = base64_decode("$eimg");
   file_put_contents("site/ar/images/clients/".$img_name,$decodimg); 
    $data['img'] =$img_name;
}

    
    $result_email= $this->db->get_where("clients",array('email'=>$email))->result();
    $a['messageID'] =count($result_email);
    if( count($result_email)>=1){
    $a['messageID'] =0;
    if($lang==2){
        $a['message'] ="هذا الايميل غير متاح";
    }else{
        $a['message'] ="This email is not available";
    }
    $array["message"][]= $a;
    }

    $result_phone= $this->db->get_where("clients",array('phone'=>$phone))->result();
    if( count($result_phone)>=1){
    $a['messageID'] =0;
    if($lang==2){
        $a['message'] ="التليفون غير متاح";
    }else{
        $a['message'] ="Phone not available";
    }
    $array["message"][]= $a;
    }

    if(count($result_email)==0 && count($result_phone)==0){
    $insert = $this->db->insert('clients',$data);
    }
    else {$insert=0;}
    $msg_sms="";
    //$this->active_sms($msg_sms,$phone);
    

    if($insert!=0){
        $a['messageID'] = 1;
        if($lang==2){
            $a['message'] ="تم التسجيل بنجاح من فضلك تاكد من وصول كود التفعيل علي هاتفك";
        }else{  
            $a['message'] ="You have successfully registered. Please verify that activation code has been sent to your phone";
        }
        $array["message"][]= $a;
        $array["data"][]= $data;
        
    }else{
        $a['messageID'] = 0;
        if($lang==2){
            $a['message'] ="عفوا حدث خطاء لم يتم التسجيل";
        }else{
            $a['message'] ="Oops, there was an error that did not register";
        }
        $array["message"][]= $a;
    }
    
}

    @header("Content-Type: application/json;charset=utf-8");
    echo json_encode($array);
 

}




public function confirm_code(){
    $json = file_get_contents('php://input');
    $lang =$this->input->post('lang');
    $code = $this->input->post('code');
    $array = array();
    $result_phone= $this->db->get_where("clients",array('code'=>$code))->result();
   
    if( count($result_phone)==1){
        $data_update= array('activation_code'=>'1');
$this->db->update('clients',$data_update,array('code'=>$code));
foreach($result_phone as $result_phone)
 $id_client=$result_phone->id;
  $phone=$result_phone->phone;
    $a['messageID'] =1;
    if($lang==2){
        $a['message'] ="تم تفعيل الحساب بنجاح";
    }
    else{
        $a['message'] ="Account successfully activated";
    }
     $b['id_client']=$id_client;
     $b['phone']=$phone;
    $array["message"][]= $a;
    $array["data"][]= $b;
    }
    else{
        $a['messageID'] =0;
    if($lang==2){
        $a['message'] ="الكود المستخدم غير صحيح";
    }else{
        $a['message'] ="The code used is incorrect";
    }
    $array["message"][]= $a;
    }

    @header("Content-Type: application/json;charset=utf-8");
    echo json_encode($array);
}

public function gen_random_code(){
    $chars ="1234567890";//length:36
    $final_rand='';
    for($i=0;$i<4; $i++) {
    $final_rand .= $chars[ rand(0,strlen($chars)-1)];
    }
    return $final_rand;
}





public function resend_code(){
    $json = file_get_contents('php://input');
    $lang =$this->input->post('lang');
    $phone = $this->input->post('phone');
    $array = array();
    $result_phone= $this->db->get_where("clients",array('phone'=>$phone))->result();
    //print_r($result_phone);die;
    $code = $result_phone[0]->code;
    //echo count($result_phone);
    if( count($result_phone)>=1){
    $msg_sms="Your Activation code : ".$code;
    //$this->active_sms($msg_sms,$phone);
    $a['messageID'] =1;
    if($lang==2){
        $a['message'] ="تم إرسال كود التفعيل";
    }else{
        $a['message'] ="Activation code sent";
    }
    $array["message"][]= $a;
    }else{
        $a['messageID'] =0;
    if($lang==2){
        $a['message'] ="عفوا رقم التليفون غير صحيح";
    }else{
        $a['message'] ="Sorry phone number is incorrect";
    }
    $array["message"][]= $a;
    }

    @header("Content-Type: application/json;charset=utf-8");
    echo json_encode($array);
}


public function get_price($space){
    $total_price = $this->data->get_price("pricing","from_km <= ". $space ." AND to_km >= ". $space ."");
    //print_r($total_price);
    $price = $total_price[0]->price;
    //echo $price;
    return $price;
}

public function new_order(){
    $json = file_get_contents('php://input');
    $lang =$this->input->post('lang');
    $name = $this->input->post('name');
    $code_order = "BS-".$this->gen_random_code();
    $id_client = $this->input->post('id_client');
    $map_address_client = $this->input->post('map_address_client');
    $client_lat = $this->input->post('client_lat');
    $client_lag = $this->input->post('client_lag');
    $map_address_reciver = $this->input->post('map_address_reciver');
    $reciver_lat = $this->input->post('reciver_lat');
    $reciver_lag = $this->input->post('reciver_lag');
    $delivery_time = $this->input->post('delivery_time');
    $space = $this->input->post('space');

    $discount = 0;
    $promo_id = null;
    $rate = 1;
    $promo_code = $this->input->post('promo_code');//promo_id
    $result_code = $this->db->get_where("promo_code",array('code'=>$promo_code))->result();
    if($result_code){
        foreach($result_code as $results){
            $code_id=$results->id;
            $code_discount=$results->discount;
            $code_rate=$results->rate;
            $code_count=$results->count;
            $code_start_date=$results->start_date;
            $code_end_date=$results->end_date;
        }
        $date_now = date('Y-m-d');
        $prome_code_client = $this->db->get_where("prome_code_client",array('id_promo'=>$code_id,'id_client'=>$id_client))->result();
        //echo count($prome_code_client);die;
        if(count($prome_code_client)==1){
            foreach($prome_code_client as $results_client){
                $prome_code_client_id = $results_client->id;
                $counter=$results_client->counter;
            }
            if($counter==$code_count && strtotime($code_end_date) >= strtotime($date_now)){
                $promo_id = null;
                $a['messageID'] =0;
                if($lang==2){
                    $a['message'] ="لقد استخدمت كل نقاط كود العرض أو ربما يكون منتهي الاستخدام";
                }else{
                    $a['message'] ="You have used all the points of the discount code or it may be out of use";
                }
                $array["message"][]= $a;
            }else{
                $promo_id = $code_id;
                $data_update= array('counter'=>$counter+1);
                $new=$this->data->edit_table("prome_code_client",$prome_code_client_id,$data_update);
                $discount = $code_discount;
                $rate = ($code_rate/100);
            }
        }else{
            $promo_id = null;
            $a['messageID'] =0;
            if($lang==2){
                $a['message'] ="عفوا ليس لديك صلاحية لإستخدام هذ الكود";
            }else{
                $a['message'] ="Sorry, you do not have permission to use this code";
            }
            $array["message"][]= $a;
        }
    }else{
        $promo_id = null;
        $a['messageID'] =0;
        if($lang==2){
            $a['message'] ="كود الخصم غير صحيح";
        }else{
            $a['message'] ="The discount code is incorrect";
        }
        $array["message"][]= $a;
    }

    //order_reciver Fildes
    $name_reciver = $this->input->post('name_reciver');
    $phone_reciver = $this->input->post('phone_reciver');
    $address_reciver = $this->input->post('address_reciver');
    $street_number_reciver = $this->input->post('street_number_reciver');
    $flower_number_reciver = $this->input->post('flower_number_reciver');
    $building_number_reciver = $this->input->post('building_number_reciver');
    $array = array(); 

    if($name==""||$id_client==""||$map_address_client==""||$client_lat==""||$client_lag==""||$map_address_reciver==""||$reciver_lat==""||$reciver_lag==""||$delivery_time==""||$name_reciver==""||$phone_reciver==""||$address_reciver==""||$street_number_reciver==""||$flower_number_reciver==""||$building_number_reciver==""){
        $a['messageID'] =0;
        if($lang==2){
            $a['message'] ="من فضلك أكمل الحقول الفارغة";
        }else{
            $a['message'] ="Please complete empty fields";
        }
        $array["message"][]= $a;
    }
    else{
    $reciver['name'] = $name_reciver;
    $reciver['phone'] = $phone_reciver;
    $reciver['address'] = $address_reciver;
    $reciver['street_number'] = $street_number_reciver;
    $reciver['flower_number'] = $flower_number_reciver;
    $reciver['building_number'] = $building_number_reciver;

    $order_reciver = $this->db->insert('order_reciver',$reciver);
    $id_reciver = $this->db->insert_id();
    
    //get price
    $total_price = $this->get_price($space);
    //$a['message'] = $total_price;
    $data['name'] = $name;   
    $data['code_order'] = $code_order;
    $data['id_client'] = $id_client;
    $data['id_reciver'] = $id_reciver;
    $data['status'] = '0';
    $data['map_address_client'] = $map_address_client;
    $data['client_lat'] = $client_lat;
    $data['client_lag'] = $client_lag;
    $data['map_address_reciver'] = $map_address_reciver;
    $data['reciver_lat'] = $reciver_lat;
    $data['reciver_lag'] = $reciver_lag;
    //$data['total_price'] =$total_price;
    $data['delivery_time'] =$delivery_time;
    $data['space'] =$space;
    $data['promo_id'] =$promo_id;

    if($space <= 4){
        $final_price = $total_price;
    }else{
        $final_price = $total_price*$space;
    }

    //echo $final_price."-".$discount."-".$rate;die;
    if($final_price<=$discount && $discount!=0){
        $price = $final_price-($final_price*$rate);
        //echo $price."-o";
        //die;
    }else{
        $price = $final_price-$discount;
        //echo $final_price."-".$discount."-x";
        //die;
    }
    
    $data['total_price'] = $price;

    $insert = $this->db->insert('orders',$data);
    

    if($insert){
        $a['messageID'] = 1;
        if($lang==2){
            $a['message'] ="تم إضافة طلبك بنجاح وجاري العمل عليه";
            $a['price'] = $price;
        }else{  
            $a['message'] ="Your request has been successfully added and is being processed";
            $a['price'] = $price;
        }
        $array["message"][]= $a;
    }else{
        $a['messageID'] = 0;
        if($lang==2){
            $a['message'] ="عفوا حدث خطأ لم يتم اضافة طلبك";
        }else{
            $a['message'] ="Sorry, there was an error that did not add your request";
        }
        $array["message"][]= $a;
    }
    
}

    @header("Content-Type: application/json;charset=utf-8");
    echo json_encode($array);
}

public function edit_profile(){
    $json = file_get_contents('php://input');
    $array=array();
    $lang =$this->input->post('lang');
    $id_client=$this->input->post('id_client');
    $name=$this->input->post('name');
    $phone=$this->input->post('phone');
    $email=$this->input->post('email');
    $state_id=$this->input->post('state_id');
    $street_name=$this->input->post('street_name');
    $password=$this->input->post('password');
    $building_number=$this->input->post('building_number');
    $flower_number=$this->input->post('flower_number');
    $nickname=$this->input->post('nickname');
    $table='clients';
    $key=0;
    if($name!=""){
    $data= array('name'=>$name);
    $key=1;
    $new=$this->data->edit_table($table,$id_client,$data);
    }
    if($street_name!=""){
    $data= array('street_name'=>$street_name);
    $key=1;
    $new=$this->data->edit_table($table,$id_client,$data);
    }
    
    if($nickname!=""){
    $data= array('nickname'=>$nickname);
    $key=1;
    $new=$this->data->edit_table($table,$id_client,$data);
    }
    
    if($building_number!=""){
    $data= array('building_number'=>$building_number);
    $key=1;
    $new=$this->data->edit_table($table,$id_client,$data);
    }

    if($flower_number!=""){
    $data= array('flower_number'=>$flower_number);
    $key=1;
    $new=$this->data->edit_table($table,$id_client,$data);
    }

    if($state_id!=""){
    $data= array('state_id'=>$state_id);
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
    
    
    if(isset($_FILES['img']['name'])&&$_FILES['img']['name']!=""){
    $logo = $this->data->get_table_row('clients',array('id'=>$id_client),'img'); 
    if ($logo != "") {
    unlink("site/ar/images/clients/$logo");
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
    
    
    $result_clients= $this->db->get_where("clients",array('id'=>$id_client))->result();
    
    foreach($result_clients as $result_clients){
    $name=$result_clients->name;
    $email=$result_clients->email;
    $phone=$result_clients->phone;
    $state_id=$result_clients->state_id;
    $street_name=$result_clients->street_name;
    $img=$result_clients->img;
    $building_number=$result_clients->building_number;
    $flower_number=$result_clients->flower_number;
    $nickname=$result_clients->nickname;
    if($img!=""){$main_img="https://bsor3a.com/site/ar/images/clients/".$img;}
    else {
    $main_img="https://bsor3a.com/site/ar/images/clients/defaultmain.png";
    }
    $b['name'] =$name;
    $b['email'] =$email;
    $b['phone'] =$phone;
    $b['state_id'] =$state_id;
    $b['nickname'] =$nickname;
    $b['street_name'] =$street_name;
    $b['building_number'] =$building_number;
    $b['flower_number'] =$flower_number;
    $b['img'] =$main_img;
    }
    $b['id_client'] =$id_client;
    $array['data'][]= $b; 
    @header("Content-Type: application/json;charset=utf-8");
    echo json_encode($array);
    }

    public function orders(){
        $json = file_get_contents('php://input');
        $lang =$this->input->post('lang');
        $id_client=$this->input->post('id_client');
        $array = array();
        $result = $this->db->get_where("orders",array('id_client'=>$id_client))->result();
        //$a['data'] = $result;
        if($result){
            $a['messageID']=1;
            $array['data'] = $result;
            if($lang==2){
            $a['message']="جميع الطلبات السابقة";
            }
            else {
            $a['message']="All previous orders"; 
            }
            $array["data"][]= $a;
        }else{
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

    public function reciver(){
        $json = file_get_contents('php://input');
        $lang = $this->input->post('lang');
        $id_reciver = $this->input->post('id_reciver');
        $array = array();
        $result = $this->db->get_where("order_reciver",array('id'=>$id_reciver))->result();
        //$array['data'] = $result;
        if($result){
            $a['messageID']=1;
            $array['data'] = $result;
            if($lang==2){
            $a['message']="تفاصيل مستلم الطلب";
            }
            else {
            $a['message']="Details of the request recipient"; 
            }
            $array["data"][]= $a;
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
        $a['status']=$results->status;
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
        $array['delivery'] = $this->db->get_where("delivery",array('id'=>$results->id_delivery))->result();
        $array['client'] = $this->db->get_where("clients",array('id'=>$results->id_client))->result();
        //$array["data"][]= $a;
        }

        //$array['data'] = $result;
        if($result){
            $a['messageID']=1;
            if($lang==2){
            $a['message']="تفاصيل الطلب";
            }
            else {
            $a['message']="Details Order"; 
            }
            $array["data"][]= $a;
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

    public function delivery_details(){
        $json = file_get_contents('php://input');
        $lang = $this->input->post('lang');
        $id_delivery = $this->input->post('id_delivery');
        $array = array();
        $result = $this->db->get_where("delivery",array('id'=>$id_delivery))->result();
        foreach($result as $results){
        $a['name']=$results->name;
        $a['phone']=$results->phone;
        $a['email']=$results->email;
        $a['address']=$results->address;
        $a['total_rate']=$results->total_rate;
        //$a['img']=$results->img;
        if($results->img!=""){$a['img']="https://bsor3a.com/site/ar/images/clients/".$results->img;}
            else {
                $a['img']="https://bsor3a.com/site/ar/images/clients/defaultmain.png";
            }
        $a['nickname']=$results->nickname;
        //$array["data"][]= $a;
        }

        //$array['data'] = $result;
        if($result){
            $a['messageID']=1;
            if($lang==2){
            $a['message']="تفاصيل الدليفري";
            }
            else {
            $a['message']="Delivery Details"; 
            }
            $array["data"][]= $a;
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

    public function contactus(){
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

    public function delivery_rate(){
            $json = file_get_contents('php://input');
            $lang = $this->input->post('lang');
            $id_order = $this->input->post('id_order');
            $value_rate = $this->input->post('value_rate');
            $array = array();
            $rate = $this->db->get_where("rate",array('id_order'=>$id_order,'type'=>2))->result();
            if($rate){
                $a['messageID']=0;
                if($lang==2){
                $a['message']="عفوا تم تقييم هذا الطلب من قبل";
                }
                else {
                $a['message']="Sorry, this request has already been evaluated"; 
                }
                $array["message"][]= $a;
            }else{
            $result = $this->db->get_where("orders",array('id'=>$id_order))->result();
            foreach($result as $results){
            $data['id_user']=$results->id_client;
            $data['id_rate']=$results->id_delivery;
            $data['id_order']=$results->id;
            $data['type']=2;
            $data['value_rate']=$value_rate;
            //$array["data"][]= $a;
            }
            $insert = $this->db->insert('rate',$data);
            $values= array('rate_client'=>1);
            $new=$this->data->edit_table('orders',$id_order,$values);
            //$array['data'] = $result;
            if($insert){
                $a['messageID']=1;
                if($lang==2){
                $a['message']="تم إضافة التقييم بنجاح";
                }
                else {
                $a['message']="Rating added successfully"; 
                }
                $array["message"][]= $a;
            }else{
                $a['messageID']=0;
                if($lang==2){
                $a['message']="عفوا لم يتم التقييم";
                }
                else {
                $a['message']="Sorry, the rating has not been evaluated"; 
                }
                $array["message"][]= $a;
            }
            }
            
            @header("Content-Type: application/json;charset=utf-8");
            echo json_encode($array);
        }

}
