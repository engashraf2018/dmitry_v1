<?php
ob_start();
include('opendb.inc');
$name=$_POST['name'];
$descrip=$_POST['descrip'];
$keyword=$_POST['keyword'];
$id_lang=$_REQUEST['id_lang'];
//echo $_FILES["logo"]['name'];
$allowed=array('gif', 'jpeg', 'jpg', 'png', 'ico', 'bmp');
$logo=upload($_FILES["logo"], $allowed);
$logo_type=uploaded_type($_FILES["logo"]);
$favicon=upload($_FILES["favicon"], $allowed);
function upload($file, $allowed){
	$data="";
	if (is_uploaded_file($file['tmp_name'])) {
		$tmpName = $file['tmp_name'];
		 $ext = strtolower(substr(strrchr($file['name'], "."), 1));
		if(!in_array($ext, $allowed)){
            echo json_encode("رسالة خطأ! نوع الملفات المرفوعة ليست صور .");
			die;
		}
        $fp = fopen($tmpName, 'r');
        $data = fread($fp, filesize($tmpName));
        $data = addslashes($data);
        fclose($fp);
	}
	return $data;
 }
 function uploaded_type($file){
	return $ext = strtolower(substr(strrchr($file['name'], "."), 1));
 }
$sql="SELECT id FROM site_info  where id_lang='$id_lang'";
$rsd=mysql_query($sql);
$row=mysql_fetch_array($rsd);
if($row){
	if($logo==""&&$favicon==""){
		$sql = "UPDATE site_info SET name='$name',description='$descrip', keywords='$keyword' where id_lang='$id_lang'";
		$rsd= mysql_query($sql) or die(mysql_error());
	}else if($logo==""&&$favicon!=""&&$banner==""){
		$sql = "UPDATE site_info SET name='$name' icon='$favicon', description='$descrip', keywords='$keyword'     where id_lang='$id_lang'";
		$rsd= mysql_query($sql) or die(mysql_error());
	}else if($logo!=""&&$favicon==""){
		$sql = "UPDATE site_info SET name='$name' , logo='$logo', description='$descrip', keywords='$keyword'    where id_lang='$id_lang'";
		$rsd= mysql_query($sql) or die(mysql_error());
	}
	else if($logo==""&&$favicon=="" ){
		$sql = "UPDATE site_info SET name='$name',description='$descrip', keywords='$keyword'     where id_lang='$id_lang'";
		$rsd= mysql_query($sql) or die(mysql_error());
	}
	else if($logo!=""&&$favicon=="" ){
		$sql = "UPDATE site_info SET name='$name' ,logo='$logo',description='$descrip', keywords='$keyword'     where id_lang='$id_lang'";
	$rsd= mysql_query($sql) or die(mysql_error());
	}
	
	else if($logo==""&&$favicon!="" ){
$sql = "UPDATE site_info SET name='$name' , icon='$favicon', description='$descrip', keywords='$keyword'     where id_lang='$id_lang'";
		$rsd= mysql_query($sql) or die(mysql_error());
	}
else{
$sql = "UPDATE site_info SET name='$name' , logo='$logo', icon='$favicon', description='$descrip', keywords='$keyword'    where id_lang='$id_lang'";
		$rsd= mysql_query($sql) or die(mysql_error());
	}
}else{
	if($logo==""||$favicon==""){
        echo json_encode("رسالة خطأ! من فضلك اختر شعار الموقع وال favicon.");
		die;
	}else{
		$sql = "INSERT INTO site_info (name,logo,icon,description,about_us,keywords,id_lang,phone) VALUES('$name', '$logo', '$logo_type', '$favicon', '$descrip',$about_us,'$keyword','$id_lang','$phone')";
	    $rsd= mysql_query($sql) or die(mysql_error());
	}
}
header("location:../sett.php?up=1&id_lang=$id_lang");	
include('closedb.inc');
ob_flush();
?>
