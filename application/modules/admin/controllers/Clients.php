<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->model('data','','true');
        $this->load->model('paging','','true');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url','text'));
        $this->load->library('lib_pagination'); 
    }

    public function index(){
        redirect(base_url().'admin/clients/type/?t=0','refresh');
    }

    public function show(){
        $pg_config['sql'] = $this->data->get_sql('clients','','id_clients','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/clients/show", $data); 
    }

    public function type(){
        $type=$this->input->get('t');
        $tables = "clients";
        $config = array();
        
        $config['base_url'] = base_url().'admin/clients/type'; 
        $config['total_rows'] = $this->data->record_count($tables,array('type'=>$type),'','id_clients','desc');
        $config['per_page'] =10;
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
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
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
        $data['result_amount'] = $this->data->record_count($tables,array('type'=>$type),'','id_clients','desc');
        else:
        $data["results"] = $this->data->view_all_data($tables, array('type'=>$type), $config["per_page"], $page,'id_clients','desc');
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links);
        $data['result_amount'] = $this->data->record_count($tables,array('type'=>$type),'','id_clients','desc');
        endif;
        $this->load->view('admin/clients/type',$data);
    }


    public function view(){
        $id=$this->input->get('id');
        $up = array('view'=>'1');
        $re=$this->data->edit_table_id('clients',array('id_clients'=>$id),$up);
        //echo $this->db->last_query();die;
        $data['data'] = $this->data->get_table_data('clients',array('id_clients'=>$id));
        $this->load->view("admin/clients/view",$data); 
    }

    public function verify(){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('clients',array('id_clients'=>$id));
        $this->load->view("admin/clients/verify",$data); 
    }

    function active(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("clients",array("id_clients"=>$id,"active" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("clients",array("active" => "0"),array("id_clients"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("clients",array("active" => "1"),array("id_clients"=>$id));
            echo "1";
        } 
    }

    function active_mail(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("clients",array("id_clients"=>$id,"active_mail" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("clients",array("active_mail" => "0"),array("id_clients"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("clients",array("active_mail" => "1"),array("id_clients"=>$id));
            echo "1";
        } 
    }

    function active_phone(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("clients",array("id_clients"=>$id,"active_phone" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("clients",array("active_phone" => "0"),array("id_clients"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("clients",array("active_phone" => "1"),array("id_clients"=>$id));
            echo "1";
        } 
    }

    function active_img(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("clients",array("id_clients"=>$id,"active_img" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("clients",array("active_img" => "0"),array("id_clients"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("clients",array("active_img" => "1"),array("id_clients"=>$id));
            echo "1";
        } 
    }

    public function send_action(){
        unset($_SESSION['msg']);
        $this->session->unset_userdata('msg');
        $this->load->library('email');
        $name=$this->input->post('name');
        $email_to=$this->input->post('email');
        $subject=$this->input->post('subject');
        $send_message=$this->input->post('message');
        $subject = $subject;
        $mail_message='Dear '.$name.','. "\r\n";
        $mail_message.='Thanks For clientsing With Us'."\r\n";
        $mail_message.='<br>Dmitry.com'."\r\n";
        $mail_message.=$send_message;
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
        ->from('dmitry@tareki.com')
        ->reply_to('dmitry@tareki.com')    // Optional, an account where a human being reads.
        ->to($email_to)
        ->subject($subject)
        ->message($body)
        ->send();
        //  echo $email_to;
        //  var_dump($result);
        //  echo $this->email->print_debugger();
        //  die;
        $type=$this->input->post('t');
        if($result==true){
          $this->session->set_flashdata('msg','Replay sent to your $email');
          redirect(base_url().'admin/clients/type/?t='.$type,'refresh');
        }else{
          $this->session->set_flashdata('msg','Failed to send please try again!');
          redirect(base_url().'admin/clients/type/?t='.$type,'refresh');
        }
        
    }

    public function delete(){
        $id_clients = $this->input->get('id_clients');
        $check=$this->input->post('check');

        if($id_clients!=""){
        $ret_value=$this->data->delete_table_row('clients',array('id_clients'=>$id_clients)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('clients',array('id_clients'=>$check[$i]));    
        }
        }
        $type=$this->input->get('t');
        $this->session->set_flashdata('msg', 'Success Deleted');
        redirect(base_url().'admin/clients/type/?t='.$type,'refresh');

    }

}