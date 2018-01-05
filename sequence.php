<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CDS sequence</title>
	<link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.css">
	<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/main.css">
</head>
<body style="font-family: Verdana, Arial, sans-serif;">
<?php include 'include/header.php' ?>
<?php include 'include/connect.php' ?>
<div class="container">
<fieldset style="width: 600px; margin: auto;">
	<textarea name="content" cols="100" rows="30" readonly="readonly" style="font-family: Courier, monospace, Verdana, Arial, sans-serif; width: 600px;"><?php 
			if(!empty($_GET['id'])){
				$sql="SELECT * FROM `cds_seq` WHERE `gene_no`='".$_GET['id']."'";
				$query = mysql_query($sql);
				$rs = mysql_fetch_array($query);
				echo trim($rs['seq']);
			}else{
				echo "Forbidden";
			}
		 ?></textarea>
</fieldset>
</div>
</body>
</html>