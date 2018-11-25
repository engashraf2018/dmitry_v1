<?php

require_once("config/opendb.inc");

if(!empty($_POST["country_id"])) {
	$query ="SELECT * FROM category WHERE id_main_cat= '" . $_POST["country_id"] . "'";
	$results = mysql_query($query);
?>
<?php
	while($state=mysql_fetch_array($results)){
?>
	<option value="<?php echo $state["id"]; ?>"><?php echo $state["name"]; ?></option>
<?php
	}

}else {
?>
<option value="0">حدد القسم الفرعى</option>
<?php }?>