<?php

require_once("opendb.inc");

if(!empty($_POST["country_id"])) {

	$query ="SELECT * FROM sub_category WHERE id_cat= '" . $_POST["country_id"] . "'";

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