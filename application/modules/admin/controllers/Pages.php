<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller
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
        $this->load->library('CKEditor');
        $this->load->library('CKFinder');
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../design/ckfinder/');      
    }
    public function gen_random_string()
    {
        $chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";//length:36
        $final_rand='';
        for($i=0;$i<4; $i++) {
            $final_rand .= $chars[ rand(0,strlen($chars)-1)];
        }
        return $final_rand;
    }

    public function index(){
        redirect(base_url().'admin/pages/show','refresh');
    }

    public function show(){
        $pg_config['sql'] = $this->data->get_sql('pages','','id_pages','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/pages/show", $data); 
    }

    public function add(){
        $this->load->view("admin/pages/add"); 
    }

    public function add_action(){
        $lang=$this->input->post('lang');
        $title=$this->input->post('title');
        $content=$this->input->post('contents');

        $data['title'] = $title;
        $data['content'] = $content;
        $data['active'] = 0;
        $data['lang_key'] = $lang;

        $this->db->insert('pages',$data);
 
        $this->session->set_flashdata('msg', 'Success Added');
        redirect(base_url().'admin/pages/show','refresh');
    }

    public function delete(){
        $id_pages = $this->input->get('id_pages');
        $check=$this->input->post('check');

        if($id_pages!=""){
        $ret_value=$this->data->delete_table_row('pages',array('id_pages'=>$id_pages)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('pages',array('id_pages'=>$check[$i]));    
        }
        }

        $this->session->set_flashdata('msg', 'Success Deleted');
        redirect(base_url().'admin/pages/show','refresh');
    }

    function active(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("pages",array("id_pages"=>$id,"active" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("pages",array("active" => "0"),array("id_pages"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("pages",array("active" => "1"),array("id_pages"=>$id));
            echo "1";
        } 
    }

    public function edit(){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('pages',array('id_pages'=>$id));
        $this->load->view("admin/pages/edit",$data); 
    }

    function edit_action(){
        $id=$this->input->post('id');
        $title=$this->input->post('title');
        $content=$this->input->post('contents');

        $data['title'] = $title;
        $data['content'] = $content;

        $data = array('title'=>$title,'content'=>$content);
        $re=$this->data->edit_table_id('pages',array('id_pages'=>$id),$data);

        $this->session->set_flashdata('msg', 'Success Edited');
        redirect(base_url().'admin/pages/show','refresh');
    }

}