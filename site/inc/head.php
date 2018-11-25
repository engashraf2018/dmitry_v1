<head>
<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<?php 
header('Content-type: text/html; charset=utf-8');

foreach($result_siteinfo as $result_siteinfo)
if($langxxx=="lang=en"):$title_site=$result_siteinfo->name_eng;
else:
$title_site=$result_siteinfo->name;
endif;
$mm=$this->uri->segment(2);
$this->session->set_userdata(array('page_name' =>$mm));

 $activation_alert=""; $activation_mess=""; $activation_mywallet="";
 $activation_das="";$activation_pro=""; $activation_offer_rides="";
 $activation_history_trips="";$activation_mytrips="";
  $activation_Addreviews="";
  $activation_edit="";
if($mm=="Addreviews"){
$activation_Addreviews="active";
}
if($mm=="history_trips"){
$activation_history_trips="active";
}
if($mm=="mytrips"){
$activation_mytrips="active";
}


if($mm=="dashboard"){
$activation_das="active";
}

if($mm=="profile"){
$activation_pro="active";
}

if($mm=="messages"){
$activation_mess="active";
}

if($mm=="offered_rides"){
$activation_offer_rides="active";
}

if($mm=="mywallet"){
$activation_mywallet="active";
}
if($mm=="edit_information"){
$activation_edit="active";
}

if($mm=="editphone"){
$activation_edit="active";
}
if($mm=="editemail"){
$activation_edit="active";
}

if($mm=="ride-alert"){
$activation_alert="active";
}

if($mm=="news_details"){
$art_news = $this->db->get_where("articles",array("id"=>$this->uri->segment(3)))->result();
foreach ($art_news as $artnews)
?>

<meta property="og:description" content="<?php if($langxxx=="lang=en"):echo $artnews->short_descriptioneng;else:echo $artnews->short_description;endif;?>" />
<meta property="og:title" content="<?php if($langxx="lang=en"):echo $artnews->titleeng;else:echo $artnews->title;endif;?>" />
<meta property="og:image" content="<?php echo base_url()?>site/ar/images/articles/<?php echo $artnews->img;?>" />
<?php }if($mm=="events_details"){
$art_events = $this->db->get_where("events",array("id"=>$this->uri->segment(3)))->result();
foreach ($art_events as $artevents)
?>

<meta property="og:description" content="<?php if($langxxx=="lang=en"):echo $artevents->short_descriptioneng;else:echo $artevents->short_description;endif;?>" />
<meta property="og:title" content="<?php if($langxxx=="lang=en"):echo $artevents->titleeng;else:echo $artevents->title;endif;?>" />
<meta property="og:image" content="<?php echo base_url()?>site/ar/images/events/<?php echo $artevents->img;?>" />
<?php }?>


<title><?php echo $title_site;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link href="<?php echo base_url()?>site/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/roboto" type="text/css"/>
<link href="<?php echo base_url()?>site/assets/revolution-slider/css/settings.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/jquery.datetimepicker.css"/>
<link  rel="icon" href="<?php echo base_url();?>site/ar/images/site_setting/<?php echo $result_siteinfo->favicon;?>" />
<meta name="description" content="<?php echo $result_siteinfo->meta_describtion?>" />
<meta name="keywords" content="<?php echo $result_siteinfo->keywords?>" />
<?php 
if($langxxx=="lang=ar"):
?>
 <link rel="stylesheet"  href="<?php echo base_url()?>site/css/bootstrapar.css"  type="text/css"/>

 <link rel="stylesheet"  href="<?php echo base_url()?>site/css/stylear.css"  type="text/css"/>
 <?php 
 else :
 ?>
 <link rel="stylesheet"  href="<?php echo base_url()?>site/css/bootstrap.css"  type="text/css"/>
 <link rel="stylesheet"  href="<?php echo base_url()?>site/css/style.css"  type="text/css"/>
<?php 
endif;

?>

<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5a14e3d26b072900120eaa99&product=inline-share-buttons"></script>


</head>
<!--<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "ded59d3e-c471-4e72-b36f-dae68258d86b", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>-->