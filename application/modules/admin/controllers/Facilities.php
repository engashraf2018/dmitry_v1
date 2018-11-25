<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facilities extends MY_Controller
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
        redirect(base_url().'admin/facilities/show','refresh');
    }

    public function show(){
        $pg_config['sql'] = $this->data->get_sql('facilities','','id_facilities','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/facilities/show", $data); 
    }

    public function add(){
        $this->load->view("admin/facilities/add"); 
    }

    public function add_action(){
        $lang=$this->input->post('lang');
        $name=$this->input->post('name');

        $data['name'] = $name;
        $data['active'] = 0;
        $data['lang_key'] = $lang;
        $data['creation_date'] = date("Y-m-d");

        $this->db->insert('facilities',$data);

        $this->session->set_flashdata('msg', 'Success Added');
        redirect(base_url().'admin/facilities/show','refresh');
    }

    public function delete(){
        $id_facilities = $this->input->get('id_facilities');
        $check=$this->input->post('check');

        if($id_facilities!=""){
        $ret_value=$this->data->delete_table_row('facilities',array('id_facilities'=>$id_facilities)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('facilities',array('id_facilities'=>$check[$i]));    
        }
        }

        $this->session->set_flashdata('msg', 'Success Deleted');
        redirect(base_url().'admin/facilities/show','refresh');
    }

    function active(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("facilities",array("id_facilities"=>$id,"active" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("facilities",array("active" => "0"),array("id_facilities"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("facilities",array("active" => "1"),array("id_facilities"=>$id));
            echo "1";
        } 
    }

    public function edit(){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('facilities',array('id_facilities'=>$id));
        $this->load->view("admin/facilities/edit",$data); 
    }

    function edit_action(){
        $id=$this->input->post('id');
        $name=$this->input->post('name');

        $data = array('name'=>$name);
        $re=$this->data->edit_table_id('facilities',array('id_facilities'=>$id),$data);
        $this->session->set_flashdata('msg', 'Success Edited');
        redirect(base_url().'admin/facilities/show','refresh');
    }

}