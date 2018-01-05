<?php

	$con=mysqli_connect('localhost',"cgpan","cgpan2017!")or die("Mysql Access Error!");
	mysqli_select_db($con,"gcpan");
	mysqli_set_charset($con,"utf8");
	//mysql_connect("localhost","cgpan","cgpan2017!")or die("Mysql Access Error!");
	//mysql_select_db("gcpan");
?>
