<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amenities extends MY_Controller
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
        redirect(base_url().'admin/amenities/show','refresh');
    }

    public function show(){
        $pg_config['sql'] = $this->data->get_sql('amenities','','id_amenities','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/amenities/show", $data); 
    }

    public function add(){
        $this->load->view("admin/amenities/add"); 
    }

    public function add_action(){
        $lang=$this->input->post('lang');
        $name=$this->input->post('name');

        $data['name'] = $name;
        $data['active'] = 0;
        $data['lang_key'] = $lang;
        $data['creation_date'] = date("Y-m-d");

        $this->db->insert('amenities',$data);

        $this->session->set_flashdata('msg', 'Success Added');
        redirect(base_url().'admin/amenities/show','refresh');
    }

    public function delete(){
        $id_amenities = $this->input->get('id_amenities');
        $check=$this->input->post('check');

        if($id_amenities!=""){
        $ret_value=$this->data->delete_table_row('amenities',array('id_amenities'=>$id_amenities)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('amenities',array('id_amenities'=>$check[$i]));    
        }
        }

        $this->session->set_flashdata('msg', 'Success Deleted');
        redirect(base_url().'admin/amenities/show','refresh');
    }

    function active(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("amenities",array("id_amenities"=>$id,"active" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("amenities",array("active" => "0"),array("id_amenities"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("amenities",array("active" => "1"),array("id_amenities"=>$id));
            echo "1";
        } 
    }

    public function edit(){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('amenities',array('id_amenities'=>$id));
        $this->load->view("admin/amenities/edit",$data); 
    }

    function edit_action(){
        $id=$this->input->post('id');
        $name=$this->input->post('name');

        $data = array('name'=>$name);
        $re=$this->data->edit_table_id('amenities',array('id_amenities'=>$id),$data);
        $this->session->set_flashdata('msg', 'Success Edited');
        redirect(base_url().'admin/amenities/show','refresh');
    }

}