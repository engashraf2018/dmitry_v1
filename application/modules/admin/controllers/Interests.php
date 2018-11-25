<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interests extends MY_Controller
{

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

    public function index(){
        redirect(base_url().'admin/interests/show','refresh');
    }

    public function show(){
        $pg_config['sql'] = $this->data->get_sql('interests','','id_interests','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/interests/show", $data); 
    }

    public function add(){
        $this->load->view("admin/interests/add"); 
    }

    public function add_action(){
        $lang=$this->input->post('lang');
        $title=$this->input->post('title');

        $data['title'] = $title;
        $data['active'] = 0;
        $data['lang_key'] = $lang;

        $this->db->insert('interests',$data);

        $this->session->set_flashdata('msg', 'Success Added');
        redirect(base_url().'admin/interests/show','refresh');
    }

    public function delete(){
        $id_interests = $this->input->get('id_interests');
        $check=$this->input->post('check');

        if($id_interests!=""){
        $ret_value=$this->data->delete_table_row('interests',array('id_interests'=>$id_interests)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('interests',array('id_interests'=>$check[$i]));    
        }
        }

        $this->session->set_flashdata('msg', 'Success Deleted');
        redirect(base_url().'admin/interests/show','refresh');
    }

    function active(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("interests",array("id_interests"=>$id,"active" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("interests",array("active" => "0"),array("id_interests"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("interests",array("active" => "1"),array("id_interests"=>$id));
            echo "1";
        } 
    }

    public function edit(){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('interests',array('id_interests'=>$id));
        $this->load->view("admin/interests/edit",$data); 
    }

    function edit_action(){
        $id=$this->input->post('id');
        $title=$this->input->post('title');

        $data = array('title'=>$title);
        $re=$this->data->edit_table_id('interests',array('id_interests'=>$id),$data);
        $this->session->set_flashdata('msg', 'Success Edited');
        redirect(base_url().'admin/interests/show','refresh');
    }

}