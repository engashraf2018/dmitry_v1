
<?php
ob_start();
include('opendb.inc');
$title=$_POST['title'];
$short_description=$_POST['short_description'];
$description=$_POST['description'];
$sele=$_POST['sele'];
$meta_keywords=$_POST['meta_keywords'];
$meta_description=$_POST['meta_description'];
$id_authors=$_POST['id_authors'];
$video=$_POST['video'];
$link=$_POST['link'];
$publish=$_POST['publish'];
$titleeng=$_POST['titleeng'];
$short_descriptioneng=$_POST['short_descriptioneng'];
$descriptioneng=$_POST['descriptioneng'];

date_default_timezone_set("Africa/Cairo");
$dattx=date('Y-m-d');


$date=date("Y-m-d",strtotime($functional_date));
$cat=$_POST['cat'];
$data['title'] = $title;
$data['description'] = $description;
$data['short_description'] = $short_description;
$data['meta_keywords'] = $meta_keywords;
$data['meta_description'] = $meta_description;
$data['type'] = $sele;
$data['titleeng'] = $titleeng;
$data['short_descriptioneng'] = $short_descriptioneng;
$data['descriptioneng'] = $descriptioneng;

function gen_random_string()
{
    $chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";//length:36
    $final_rand='';
    for($i=0;$i<4; $i++)
    {
        $final_rand .= $chars[ rand(0,strlen($chars)-1)];
    }
    return $final_rand;
}

 if ($_FILES['main_img']['name'] != "") {
                $config['upload_path']          = '../site/ar/images/events/';
                $config['allowed_types']        = 'gif|jpg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('main_img');
                $data1['main_img'] = $this->upload->data();
                $photo = $data1['main_img']['file_name'];
                $data['img'] = $photo;
                
        }

 $insert = $this->db->insert('events',$data);
 $ids = $this->db->insert_id();             
if ($sele == "video") {
     $data1 = array("video"=>$video,"id_article"=>$ids,"type"=>'1');
     $insert = $this->db->insert('video',$data1);

}
if ($sele == "link") {
     $data1 = array("link"=>$link,"id_article"=>$ids,"type"=>'1');
     $insert = $this->db->insert('link',$data1);
}
if ($sele == "slider") {

    if ($_FILES['img1']['name'] != "") {
        
    
            $filesCount = count($_FILES['img1']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img1']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img1']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img1']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img1']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img1']['size'][$i];

                $uploadPath = '../site/ar/images/events/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $ids;
					 $uploadData[$i]['type'] = '1';
                }
            }
            

        
        }

    if ($_FILES['img2']['name'] != "") {
        
    
            $filesCount = count($_FILES['img2']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img2']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img2']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img2']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img2']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img2']['size'][$i];

                $uploadPath ='../site/ar/images/events/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $ids;
					$uploadData[$i]['type'] = '1';
                }
            }
            

        
        }        
     
    if ($_FILES['img3']['name'] != "") {
        
    
            $filesCount = count($_FILES['img3']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img3']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img3']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img3']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img3']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img3']['size'][$i];

                $uploadPath ='../site/ar/images/events/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $ids;
					$uploadData[$i]['type'] = '1';
                }
            }
            

        
        }    if ($_FILES['img4']['name'] != "") {
        
    
            $filesCount = count($_FILES['img4']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img4']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img4']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img4']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img4']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img4']['size'][$i];

                $uploadPath = '../site/ar/images/events/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $ids;
					$uploadData[$i]['type'] = '1';
                }
            }
            

        
        }    if ($_FILES['img5']['name'] != "") {
        
    
            $filesCount = count($_FILES['img5']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img5']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img5']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img5']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img5']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img5']['size'][$i];

                $uploadPath = '../site/ar/images/events/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $ids;
					$uploadData[$i]['type'] = '1';
                }
            }
            

        
        }    if ($_FILES['img6']['name'] != "") {
        
    
            $filesCount = count($_FILES['img6']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img6']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img6']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img6']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img6']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img6']['size'][$i];

                $uploadPath = '../site/ar/images/events/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $ids;
					$uploadData[$i]['type'] = '1';
                }
            }
            

        
        }    if ($_FILES['img7']['name'] != "") {
        
    
            $filesCount = count($_FILES['img7']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img7']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img7']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img7']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img7']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img7']['size'][$i];

                $uploadPath ='../site/ar/images/events/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $ids;
					$uploadData[$i]['type'] = '1';
                }
            }
            

        
        }    if ($_FILES['img8']['name'] != "") {
        
    
            $filesCount = count($_FILES['img8']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img8']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img8']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img8']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img8']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img8']['size'][$i];

                $uploadPath ='../site/ar/images/events/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $ids;
					$uploadData[$i]['type'] = '1';
                }
            }
            

        
        }    if ($_FILES['img9']['name'] != "") {
        
    
            $filesCount = count($_FILES['img9']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img9']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img9']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img9']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img9']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img9']['size'][$i];

                $uploadPath ='../site/ar/images/events/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $ids;
					$uploadData[$i]['type'] = '1';
                }
            }
            

        
        }    if ($_FILES['img10']['name'] != "") {
        
    
            $filesCount = count($_FILES['img10']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img10']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img10']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img10']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img10']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img10']['size'][$i];

                $uploadPath = '../site/ar/images/events/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $ids;
					$uploadData[$i]['type'] = '1';
                }
            }
            

        
        }    if ($_FILES['img11']['name'] != "") {
        
    
            $filesCount = count($_FILES['img11']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img11']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img11']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img11']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img11']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img11']['size'][$i];

                $uploadPath = '../site/ar/images/events/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                                              if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $ids;
					$uploadData[$i]['type'] = '1';
                }
            }
            

        
        }    if ($_FILES['img12']['name'] != "") {
        
    
            $filesCount = count($_FILES['img12']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img12']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img12']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img12']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img12']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img12']['size'][$i];

                $uploadPath = '../site/ar/images/events/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $ids;
					$uploadData[$i]['type'] = '1';
                }
            }
            

        
        }    if ($_FILES['img13']['name'] != "") {
        
    
            $filesCount = count($_FILES['img13']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img13']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img13']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img13']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img13']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img13']['size'][$i];

                $uploadPath = '../site/ar/images/events/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $ids;
					$uploadData[$i]['type'] = '1';
                }
            }
            

        
        }    if ($_FILES['img14']['name'] != "") {
        
    
            $filesCount = count($_FILES['img14']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img14']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img14']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img14']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img14']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img14']['size'][$i];

                $uploadPath = '../site/ar/images/events/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $ids;
					$uploadData[$i]['type'] = '1';
                }
            }
            

        
        }
                        $this->db->insert_batch('gallery_article',$uploadData);
   
        }






include('closedb.inc');
ob_flush();
header("location:".base_url()."home/events");

?>
