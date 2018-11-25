<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules extends MY_Controller
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
        redirect(base_url().'admin/rules/show','refresh');
    }

    public function show(){
        $pg_config['sql'] = $this->data->get_sql('rules','','id_rules','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/rules/show", $data); 
    }

    public function add(){
        $this->load->view("admin/rules/add"); 
    }

    public function add_action(){
        $lang=$this->input->post('lang');
        $name=$this->input->post('name');

        $data['name'] = $name;
        $data['active'] = 0;
        $data['lang_key'] = $lang;
        $data['creation_date'] = date("Y-m-d");

        $this->db->insert('rules',$data);

        $this->session->set_flashdata('msg', 'Success Added');
        redirect(base_url().'admin/rules/show','refresh');
    }

    public function delete(){
        $id_rules = $this->input->get('id_rules');
        $check=$this->input->post('check');

        if($id_rules!=""){
        $ret_value=$this->data->delete_table_row('rules',array('id_rules'=>$id_rules)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('rules',array('id_rules'=>$check[$i]));    
        }
        }

        $this->session->set_flashdata('msg', 'Success Deleted');
        redirect(base_url().'admin/rules/show','refresh');
    }

    function active(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("rules",array("id_rules"=>$id,"active" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("rules",array("active" => "0"),array("id_rules"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("rules",array("active" => "1"),array("id_rules"=>$id));
            echo "1";
        } 
    }

    public function edit(){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('rules',array('id_rules'=>$id));
        $this->load->view("admin/rules/edit",$data); 
    }

    function edit_action(){
        $id=$this->input->post('id');
        $name=$this->input->post('name');

        $data = array('name'=>$name);
        $re=$this->data->edit_table_id('rules',array('id_rules'=>$id),$data);
        $this->session->set_flashdata('msg', 'Success Edited');
        redirect(base_url().'admin/rules/show','refresh');
    }

}