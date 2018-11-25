<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller
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
        redirect(base_url().'admin/blog/show','refresh');
    }

    public function show(){
        $pg_config['sql'] = $this->data->get_sql('blog','','id_blog','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/blog/show", $data); 
    }

    public function add(){
        $this->load->view("admin/blog/add"); 
    }

    public function add_action(){
        $lang=$this->input->post('lang');
        $title=$this->input->post('title');
        $short_desc=$this->input->post('short_desc');
        $description=$this->input->post('description');

        $data['title'] = $title;
        $data['short_desc'] = $short_desc;
        $data['description'] = $description;
        $data['active'] = 0;
        $data['lang_key'] = $lang;
        $data['creation_date'] = date("Y-m-d");
        $this->db->insert('blog',$data);
        $id = $this->db->insert_id();
        if($_FILES['img']['name']!=""){
            $img_name=$this->gen_random_string(); 
            $imagename = $img_name;
            $config['upload_path'] = 'site/ar/images/blog/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             =100000;
            $config['max_width']            =100000;
            $config['max_height']           =100000;
            $config['file_name'] = $imagename; 
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('img')){
                echo $this->upload->display_errors();
                print_r($config);
                die;
            }
            else {
            $url= $_FILES['img']['name'];
            $ext = explode(".",$url);
            $file_extension = end($ext);
            $data = array('image'=>$imagename.".".$file_extension);
            $this->data->edit_table_id('blog',array('id_blog'=>$id),$data);
            }
        }
        $this->session->set_flashdata('msg', 'Success Added');
        redirect(base_url().'admin/blog/show','refresh');
    }

    public function delete(){
        $id_blog = $this->input->get('id_blog');
        $check=$this->input->post('check');

        if($id_blog!=""){
        $ret_value=$this->data->delete_table_row('blog',array('id_blog'=>$id_blog)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('blog',array('id_blog'=>$check[$i]));    
        }
        }

        $this->session->set_flashdata('msg', 'Success Deleted');
        redirect(base_url().'admin/blog/show','refresh');
    }

    function active(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("blog",array("id_blog"=>$id,"active" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("blog",array("active" => "0"),array("id_blog"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("blog",array("active" => "1"),array("id_blog"=>$id));
            echo "1";
        } 
    }

    public function edit(){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('blog',array('id_blog'=>$id));
        $this->load->view("admin/blog/edit",$data); 
    }

    function edit_action(){
        $id=$this->input->post('id');
        $title=$this->input->post('title');
        $short_desc=$this->input->post('short_desc');
        $description=$this->input->post('description');

        $data['title'] = $title;
        $data['short_desc'] = $short_desc;
        $data['description'] = $description;

        $data = array('title'=>$title,'short_desc'=>$short_desc,'description'=>$description);
        $re=$this->data->edit_table_id('blog',array('id_blog'=>$id),$data);

        $old_img = $this->data->get_table_row('blog',array('id_blog'=>$id),'image'); 
        echo "../uploads/blog/$old_img";
        //die;

        if($_FILES['img']['name']!=""){
            $img_name=$this->gen_random_string(); 
            $imagename = $img_name;
            $config['upload_path'] = 'site/ar/images/blog/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             =100000;
            $config['max_width']            =100000;
            $config['max_height']           =100000;
            $config['file_name'] = $imagename; 
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('img')){
                echo $this->upload->display_errors();
                print_r($config);
                die;
            }
            else {
            if ($old_img != "") {
                    unlink("site/ar/images/blog/$old_img");
            }
            $url= $_FILES['img']['name'];
            $ext = explode(".",$url);
            $file_extension = end($ext);
            $data = array('image'=>$imagename.".".$file_extension);
            $this->data->edit_table_id('blog',array('id_blog'=>$id),$data);
            }
        }

        $this->session->set_flashdata('msg', 'Success Edited');
        redirect(base_url().'admin/blog/show','refresh');
    }

}