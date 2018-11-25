<?php
    if (@$_FILES['img1']['name'] != "") {
            
            $filesCount = count($_FILES['img1']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img1']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img1']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img1']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img1']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img1']['size'][$i];

                $uploadPath = 'site/ar/images/articles/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $idnews;
                }
            }
            

        
        }

    if (@$_FILES['img2']['name'] != "") {
        
    
            $filesCount = count($_FILES['img2']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img2']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img2']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img2']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img2']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img2']['size'][$i];

                $uploadPath = 'site/ar/images/articles/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $idnews;
                }
            }
            

        
        }        
     
    if (@$_FILES['img3']['name'] != "") {
        
    
            $filesCount = count($_FILES['img3']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img3']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img3']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img3']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img3']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img3']['size'][$i];

                $uploadPath = 'site/ar/images/articles/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $idnews;
                }
            }
            

        
        }    if (@$_FILES['img4']['name'] != "") {
        
    
            $filesCount = count($_FILES['img4']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img4']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img4']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img4']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img4']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img4']['size'][$i];

                $uploadPath = 'site/ar/images/articles/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $idnews;
                }
            }
            

        
        }    if (@$_FILES['img5']['name'] != "") {
        
    
            $filesCount = count($_FILES['img5']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img5']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img5']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img5']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img5']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img5']['size'][$i];

                $uploadPath = 'site/ar/images/articles/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $idnews;
                }
            }
            

        
        }    if (@$_FILES['img6']['name'] != "") {
        
    
            $filesCount = count($_FILES['img6']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img6']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img6']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img6']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img6']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img6']['size'][$i];

                $uploadPath = 'site/ar/images/articles/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $idnews;
                }
            }
            

        
        }    if (@$_FILES['img7']['name'] != "") {
        
    
            $filesCount = count($_FILES['img7']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img7']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img7']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img7']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img7']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img7']['size'][$i];

                $uploadPath = 'site/ar/images/articles/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $idnews;
                }
            }
            

        
        }    if (@$_FILES['img8']['name'] != "") {
        
    
            $filesCount = count($_FILES['img8']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img8']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img8']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img8']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img8']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img8']['size'][$i];

                $uploadPath = 'site/ar/images/idnews/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $idnews;
                }
            }
            

        
        }    if (@$_FILES['img9']['name'] != "") {
        
    
            $filesCount = count($_FILES['img9']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img9']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img9']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img9']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img9']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img9']['size'][$i];

                $uploadPath = 'site/ar/images/articles/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $idnews;
                }
            }
            

        
        }    if (@$_FILES['img10']['name'] != "") {
        
    
            $filesCount = count($_FILES['img10']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img10']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img10']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img10']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img10']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img10']['size'][$i];

                $uploadPath = 'site/ar/images/articles/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $idnews;
                }
            }
            

        
        }    if (@$_FILES['img11']['name'] != "") {
        
    
            $filesCount = count($_FILES['img11']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img11']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img11']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img11']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img11']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img11']['size'][$i];

                $uploadPath = 'site/ar/images/articles/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                                              if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $idnews;
                }
            }
            

        
        }    if (@$_FILES['img12']['name'] != "") {
        
    
            $filesCount = count($_FILES['img12']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img12']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img12']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img12']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img12']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img12']['size'][$i];

                $uploadPath = 'site/ar/images/articles/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $idnews;
                }
            }
            

        
        }    if (@$_FILES['img13']['name'] != "") {
        
    
            $filesCount = count($_FILES['img13']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img13']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img13']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img13']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img13']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img13']['size'][$i];

                $uploadPath = 'site/ar/images/articles/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $idnews;
                }
            }
            

        
        }    if (@$_FILES['img14']['name'] != "") {
        
    
            $filesCount = count($_FILES['img14']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['img14']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['img14']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['img14']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['img14']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['img14']['size'][$i];

                $uploadPath = 'site/ar/images/articles/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['img'] = $fileData['file_name'];
                    $uploadData[$i]['id_article'] = $idnews;
                }
            }
            

        
        }

                        if (count($uploadData) != 0) {
                        $this->db->insert_batch('gallery_article',$uploadData);
                        }
                                
        ?>