<?php


$dbhost = 'localhost';

$dbuser = 'almasrya_db';

$dbpass = 'oHUkxi6ZxWRT';

$dbname = 'almasrya_db';


// This is an example opendb.php

$con = mysql_connect($dbhost, $dbuser, $dbpass);

if (!$con)

  {

  die('Could not connect: ' . mysql_error());

  }

  else{

	  mysql_select_db($dbname);

      mb_internal_encoding("UTF8");

	 // mysql_query("SET NAMES 'cp1256'"); 

      mysql_query("SET character_set_client=utf8");

      mysql_query("SET character_set_connection='utf8'");

      mysql_query('SET character_set_results=utf8');  

  }

?> 