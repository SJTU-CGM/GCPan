<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include 'include/libs.php' ?>
	<title>Gastric Carcinoma table</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/rice_table.css">
	

	<script>
	function check_all(obj,cName){
		var checklist = document.getElementsByName(cName);
		for(var i=0; i<checklist.length; i++){
			checklist[i].checked = obj.checked;
		}
	}

	function selectAll(){
		var checklist = document.getElementsByName("selection[]");
		var itembox = document.getElementById("sumitems");
		
		if(document.getElementById("controlAll").checked){
			for(var i=0;i<checklist.length;i++){
				checklist[i].checked = 1;
			} 
			itembox.innerHTML=checklist.length + ' items selected ';
		}else{
			for(var j=0;j<checklist.length;j++){
				checklist[j].checked = 0;
			}
			itembox.innerHTML='0 items selected ';
		}
	}
	function selectOne(){
		var checklist = document.getElementsByName("selection[]");
		var sumcheck = 0;
		for(var i=0;i<checklist.length;i++){
			if (checklist[i].checked){
				sumcheck++;
			}
		}
		var itembox = document.getElementById("sumitems");
		itembox.innerHTML=sumcheck + ' items selected ';
	}

	function vs(){
		document.getElementById("sum_form").action="visualization/index.php";
		document.getElementById("sum_form").submit();
	}

	function sm(){
		document.getElementById("sum_form").action="sharedGene.php";
		document.getElementById("sum_form").submit();
	}

	function default_check(){
		document.getElementsByName("ALL_t")[0].click();
		document.getElementsByName("ALL_subType")[0].click();
		document.getElementById("browse_form").submit();
	}
	</script>

</head>
<body <?php if (!isset($_POST['type']) || !isset($_POST['subType'])) { 
	echo "onload='default_check()'";
} 
?>
>
<?php include 'include/header.php' ?>
<?php include 'include/connect.php' ?>
<div class="container">
<div class="page-header">
   <h1>Gastric Carcinoma Accessions Information Table</h1>
</div>
<h4>Browse options:</h4>
<p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NOTE:</strong><em> the browsed result is the intersection of all the different options!</em></p>
<p style="text-indent:30px">Users should check the filters and click <b>"Refresh table"</b> to acquire the needed accessions. After selecting some accessions, please click <b>"Visualization"</b> or <b>"Summary"</b> button below.</p>

<form action="?action=submit" method="post" id="browse_form">
	<table>
	<tr> 
		<td><strong>Type</strong><br>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="ALL_t" <?php if(isset($_POST["ALL_t"])){echo "checked='checked'";} ?> onclick="check_all(this,'type[]')"> ALL
			<input type="checkbox" name="type[]" value="N" <?php if(isset($_POST["N"]) and in_array("N", $_POST["N"])){echo "checked='checked'";} ?>> N	
			<input type="checkbox" name="type[]" value="T" <?php if(isset($_POST["T"]) and in_array("T", $_POST["T"])){echo "checked='checked'";} ?>> T 
		</td>
	</tr>
	<tr> 
		<td><strong>subType</strong><br>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="ALL_subType" <?php if(isset($_POST["ALL_subType"])){echo "checked='checked'";} ?> onclick="check_all(this,'subType[]')"> ALL
			<input type="checkbox" name="subType[]" value="" <?php if(isset($_POST["subType"]) and in_array("", $_POST["subType"])){echo "checked='checked'";} ?>> normal	
			<input type="checkbox" name="subType[]" value="1" <?php if(isset($_POST["subType"]) and in_array("1", $_POST["subType"])){echo "checked='checked'";} ?>> 1
			<input type="checkbox" name="subType[]" value="2" <?php if(isset($_POST["subType"]) and in_array("2", $_POST["subType"])){echo "checked='checked'";} ?>> 2
			<input type="checkbox" name="subType[]" value="3" <?php if(isset($_POST["subType"]) and in_array("3", $_POST["subType"])){echo "checked='checked'";} ?>> 3
			<input type="checkbox" name="subType[]" value="4" <?php if(isset($_POST["subType"]) and in_array("4", $_POST["subType"])){echo "checked='checked'";} ?>> 4
			<input type="checkbox" name="subType[]" value="5" <?php if(isset($_POST["subType"]) and in_array("5", $_POST["subType"])){echo "checked='checked'";} ?>> 5
			<input type="checkbox" name="subType[]" value="6" <?php if(isset($_POST["subType"]) and in_array("6", $_POST["subType"])){echo "checked='checked'";} ?>> 6
			<input type="checkbox" name="subType[]" value="7" <?php if(isset($_POST["subType"]) and in_array("7", $_POST["subType"])){echo "checked='checked'";} ?>> 7
			<input type="checkbox" name="subType[]" value="8" <?php if(isset($_POST["subType"]) and in_array("8", $_POST["subType"])){echo "checked='checked'";} ?>> 8
			<input type="checkbox" name="subType[]" value="9" <?php if(isset($_POST["subType"]) and in_array("9", $_POST["subType"])){echo "checked='checked'";} ?>> 9
			<input type="checkbox" name="subType[]" value="10" <?php if(isset($_POST["subType"]) and in_array("10", $_POST["subType"])){echo "checked='checked'";} ?>> 10
			<input type="checkbox" name="subType[]" value="11" <?php if(isset($_POST["subType"]) and in_array("11", $_POST["subType"])){echo "checked='checked'";} ?>> 11
			<input type="checkbox" name="subType[]" value="12" <?php if(isset($_POST["subType"]) and in_array("12", $_POST["subType"])){echo "checked='checked'";} ?>> 12
			<input type="checkbox" name="subType[]" value="13" <?php if(isset($_POST["subType"]) and in_array("13", $_POST["subType"])){echo "checked='checked'";} ?>> 13
			<input type="checkbox" name="subType[]" value="14" <?php if(isset($_POST["subType"]) and in_array("14", $_POST["subType"])){echo "checked='checked'";} ?>> 14
			<input type="checkbox" name="subType[]" value="15" <?php if(isset($_POST["subType"]) and in_array("15", $_POST["subType"])){echo "checked='checked'";} ?>> 15
			<input type="checkbox" name="subType[]" value="16" <?php if(isset($_POST["subType"]) and in_array("16", $_POST["subType"])){echo "checked='checked'";} ?>> 16
			<input type="checkbox" name="subType[]" value="17" <?php if(isset($_POST["subType"]) and in_array("17", $_POST["subType"])){echo "checked='checked'";} ?>> 17
			<input type="checkbox" name="subType[]" value="18" <?php if(isset($_POST["subType"]) and in_array("18", $_POST["subType"])){echo "checked='checked'";} ?>> 18
		</td>
	</tr>
	</table>
	<input type="submit" value=" Refresh table " id="submit_option">
</form>
<hr />
<div id="sselist" class=tablelist>
<form method = "post" action="" id="sum_form" name = "summary" target ="_blank">
<div id="sumbox">
	<table cellspacing="0" cellpadding="0" style="width:100%;border:0px !important;" align="right"><tbody><tr>
		<td style="border:0px !important;" id="sumitems" align="right">0 items selected</td>
		<td style="border:0px !important;" width=10 align="right">&nbsp;&nbsp;</td>
		<td style="border:0px !important;" width=80 align="right"><input type="submit" value="Visualization" onclick="vs()"></td>
		<td style="border:0px !important;" width=80 align="right"><input type = "submit" value = "Summary" onclick="sm()"></td>
		<td width="50" style="border:0px !important;" align="right">&nbsp;&nbsp;</td>
	</tr></tbody></table>
</div>

<table class="table table-bordered table-hover">
<thead>
<tr>
	<td width=100>
	<input type=checkbox onclick="selectAll()" name="controlAll" id="controlAll"> Check All
	</td>
	<td>WGC_ID</td>
	<td>Sample_Name</td>
	<td>Type</td>
	<td>RNA-Seq</td>
	<td>subType</td>
	<td>Gender</td>
	<td>Age</td>
	<td>Location</td>
	<td>Borrman</td>
	<td>Diameter</td>
	<td>Grade</td>
	<td>Lauren</td>
	<td>Node</td>
	<td>Node_positive</td>
	<td>Depth</td>
	<td>Meta</td>
	<td>Vessel</td>
	<td>TNM_stage</td>
	<td>Radical_cure</td>
	<td>status</td>
	<td>Time</td>
	<td>Blood_type</td>
	<td>CEA</td>
	<td>CA199</td>
	<td>CA724</td>
	<td>AFP26</td>

</tr>
</thead>
<?php
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	if(isset($_POST["type"])){
		$type_sql = "";
		foreach ($_POST["type"] as $ot) {
			$type_sql .= "`Type`='".$ot."'";
			if (array_search($ot, $_POST["type"])+1 != count($_POST["type"])) {
				$type_sql .= " OR ";
			}
		}
	}
	if(isset($_POST["subType"])){
		$subType_sql = "";
		foreach ($_POST["subType"] as $ot) {
			$subType_sql .= "`subType`='".$ot."'";
			if (array_search($ot, $_POST["subType"])+1 != count($_POST["subType"])) {
				$subType_sql .= " OR ";
			}
		}
	}

	$sql="SELECT * FROM `sample_info` WHERE (".$type_sql.") AND (".$subType_sql.")";
	$query = mysql_query($sql);
	// $item = 0;
	while($rs = mysql_fetch_array($query)){
		
?>

<tr class = "trlist">
	<td class = "center"><input type="checkbox" name="selection[]" value="<?php echo $rs['line_code']; ?>" onclick="selectOne()"></td>

	<td><a href="searchByRice.php?code=<?php echo $rs['WGC_ID']; ?>"><?php echo $rs['WGC_ID']; ?></a></td>
	<td><?php echo $rs['Original_Sample_Name']; ?></td>
	<td><?php echo $rs['Type']; ?></td>
	<td><?php echo $rs['RNASeq_ID']; ?></td>
	<td><?php echo $rs['subType']; ?></td>
	<td><?php echo $rs['Gender']; ?></td>
	<td><?php echo $rs['Age']; ?></td>
	<td><?php echo $rs['Location']; ?></td>
	<td><?php echo $rs['Borrman']; ?></td>
	<td><?php echo $rs['Diameter']; ?></td>
	<td><?php echo $rs['Grade']; ?></td>
	<td><?php echo $rs['Lauren']; ?></td>
	<td><?php echo $rs['Node']; ?></td>
	<td><?php echo $rs['Node_positive']; ?></td>
	<td><?php echo $rs['Depth']; ?></td>
	<td><?php echo $rs['Meta']; ?></td>
	<td><?php echo $rs['Vessel']; ?></td>
	<td><?php echo $rs['TNM_stage']; ?></td>
	<td><?php echo $rs['Radical_cure']; ?></td>
	<td><?php echo $rs['status']; ?></td>
	<td><?php echo $rs['Time']; ?></td>
	<td><?php echo $rs['Blood_type']; ?></td>
	<td><?php echo $rs['CEA']; ?></td>
	<td><?php echo $rs['CA199']; ?></td>
	<td><?php echo $rs['CA724']; ?></td>
	<td><?php echo $rs['AFP26']; ?></td>
</tr>

<?php
	}
?>

</table>
</form>
</div>
</div>
<?php include 'include/footer.php' ?>
</body>
</html>