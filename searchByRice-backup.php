<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Search result</title>
	<link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.css">
	<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/search.css">


</head>
<body>

<?php include 'include/header.php'; ?>
<?php include 'include/connect.php'; ?>


<?php
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	if(isset($_POST['rname'])){
		$code_arr = explode(',', strtoupper($_POST['rname']));
		$id_arr = array();

		foreach ($code_arr as $code) {
			$t = trim($code);
			$tmp_sql = "SELECT `line_no` from `line_info` WHERE `line_code`='".$t."'";
			$q = mysql_query($tmp_sql);
			while($mm = mysql_fetch_array($q)){
				array_push($id_arr, $mm[0]);
			}
		}
		$name_sql = "`line_no`=".implode(" OR `line_no`=", $id_arr);
		if(empty($_POST['rname'])){
			$err = 1;
		}
	} 
	// echo $name_sql;

	if(isset($_POST['selection'])){
		$code_arr = $_POST['selection'];
		$name_sql = "`line_no`=".implode(" OR `line_no`=", $code_arr);
		$id_arr = $code_arr;

		if (empty($_POST['selection'])){
			$err = 1;
		}
	}
	// echo $name_sql;

 ?>

<?php
if($err != 1){
	$sql="SELECT * FROM `line_info` WHERE ".$name_sql;
	// echo $sql;
	$query = mysql_query($sql);
	$item_count = 0;
	$meta_type = array("JAP"=>0, "IND"=>0, "AUS"=>0, "ADM"=>0, "ARO"=>0, "TROP"=>0, "TEMP"=>0);
	$snp_type = array("JAP"=>0, "IND"=>0, "AUS"=>0, "ARO"=>0, "ADM"=>0);
	$sub_group = array("IG1"=>0, "IG2"=>0, "IG3"=>0, "IG4"=>0, "IG5"=>0, "AUSG6"=>0,"JG7"=>0, "JG8"=>0, "JG9"=>0, "JG10"=>0, "AROG11"=>0, "Adm"=>0);
	$region = array("Africa"=>0, "America"=>0, "East Asia"=>0, "Europe"=>0, "Oceania"=>0,
					"South Asia"=>0, "Southeast Asia"=>0, "West Asia"=>0, "West Europe"=>0,"NA"=>0);
	
	$sum_seq_dep = 0;
	$min_seq_dep = 100;
	$max_seq_dep = 0;
	$sum_map_dep = 0;
	$min_map_dep = 100;
	$max_map_dep = 0;
	$sum_map_cov = 0;
	$min_map_cov = 100;
	$max_map_cov = 0;

	$dl_rice_file_name = "dl_files/".md5(uniqid(rand())).".txt";
	$dl_rice_file = fopen($dl_rice_file_name, "w") or die("Unable to open file!");
	$rice_file_header = "#ID\tcode\tname\tmeta-infomation based subspecies\tSNP based subspecies\tsubgroup of SNP based subspecies\tcountry\tregion\tsequencing depth\tmapping depth\tmapping coverage\n";
	fwrite($dl_rice_file, $rice_file_header);
	while($rs = mysql_fetch_assoc($query)){
		$item_count += 1;
		$meta_type[$rs["meta_type"]] += 1;
		$snp_type[$rs['snp_type']] += 1;
		$sub_group[$rs['sub_group']] += 1;
		switch ($rs['region']) {
			case 'AFR':
				$region['Africa'] += 1;
				break;
			case 'AME':
				$region['America'] += 1;
				break;
			case 'EAS':
				$region['East Asia'] += 1;
				break;
			case 'EUR':
				$region['Europe'] += 1;
				break;
			case 'OCE':
				$region['Oceania'] += 1;
				break;
			case 'SEA':
				$region['Southeast Asia'] += 1;
				break;
			case 'SAS':
				$region['South Asia'] += 1;
				break;
			case 'WAS':
				$region['West Asia'] += 1;
				break;
			case 'WEU':
				$region['West Europe'] += 1;
				break;
			default:
				$region['NA'] += 1;
				break;
		}
		
		$sum_seq_dep += $rs['seq_depth'];
		$sum_map_dep += $rs['map_depth'];
		$sum_map_cov += $rs['map_cov'];
		if ($rs['seq_depth'] > $max_seq_dep) {
			$max_seq_dep = $rs['seq_depth'];
		} 
		if ($rs['seq_depth'] < $min_seq_dep) {
			$min_seq_dep = $rs['seq_depth'];
		}
		if ($rs['map_depth'] > $max_map_dep) {
			$max_map_dep = $rs['map_depth'];
		} 
		if ($rs['map_depth'] < $min_map_dep) {
			$min_map_dep = $rs['map_depth'];
		}
		if ($rs['map_cov'] > $max_map_cov) {
			$max_map_cov = $rs['map_cov'];
		} 
		if ($rs['map_cov'] < $min_map_cov) {
			$min_map_cov = $rs['map_cov'];
		}
		$line_text = implode("\t", $rs)."\n";
		fwrite($dl_rice_file, $line_text);

	}
	if ($item_count != 0){
	$avg_map_dep = $sum_map_dep / $item_count;
	$avg_seq_dep = $sum_seq_dep / $item_count;
	$avg_map_cov = $sum_map_cov / $item_count;
}else{
	$avg_seq_dep = 0;
	$avg_map_cov = 0;
	$avg_map_cov = 0;
	$max_map_cov = 0;
	$max_map_dep = 0;
	$max_seq_dep = 0;
}
	fclose($dl_rice_file);
}

?>
<div class="container">
<div class="page-header">
   <h1>Search result</h1>
	
	<table border=0px align="right" style="float: right">
	<tr>
	<td style="padding-right:10px">
	<form method="post" action="download.php"> 
		<input type="hidden" name="dl_info" value="<?php echo $dl_rice_file_name; ?>">
		<input type="submit" value="download rice detail information">
	</form>
	</td>

	<td>
	<form action="visualization/index.php" method="post" target="_blank">
	<?php 
		foreach ($id_arr as $id) {
			echo '<input type="hidden" name="selection[]" value="'.intval($id).'">';
		}
	 	
	 ?>
	 	<input type="submit" value="  Visualization  " >
	 </form>
	 </td>
	 </tr>
	 </table>


</div>
<h4>Rice Information

</h4>
<?php if($err == 1){echo "<em>No record</em>";} ?>
<table id="ri">
<tr>
	<td>Item count</td>
	<td><?php echo $item_count; ?></td>
</tr>
<tr>
	<td>Type distribution by meta-infomation</td>
	<td>
		<?php 
		foreach ($meta_type as $key => $value) {
			if ($value > 0){
				echo $key.":".strval($value)."&nbsp&nbsp&nbsp";
			}
		}
		 ?>
	</td>
</tr>
<tr>
	<td>Type distribution by SNP</td>
	<td>
		<?php 
		foreach ($snp_type as $key => $value) {
			if ($value > 0){
				echo $key.":".strval($value)."&nbsp&nbsp&nbsp";
			}
		}
		 ?>
	</td>
</tr>
<tr>
	<td>Sub-group of SNP distribution</td>
	<td>
		<?php 
		foreach ($sub_group as $key => $value) {
			if ($value > 0){
				echo $key.":".strval($value)."&nbsp&nbsp&nbsp";
			}
		}
		 ?>
	</td>
</tr>
<tr>
	<td>Region distribution</td>
	<td>
		<?php 
		foreach ($region as $key => $value) {
			if ($value > 0){
				echo $key.":".strval($value)."&nbsp&nbsp&nbsp";
			}
		}
		 ?>
	</td>
</tr>
<tr>
	<td>Biggest sequencing depth</td>
	<td><?php echo number_format($max_seq_dep, 2); ?></td>
</tr>
<tr>
	<td>Average sequencing depth</td>
	<td><?php echo number_format($avg_seq_dep, 2); ?></td>
</tr>
<tr>
	<td>Smallest sequencing depht</td>
	<td><?php echo number_format($min_seq_dep, 2); ?></td>
</tr>
<tr>
	<td>Biggest mapping depth</td>
	<td><?php echo number_format($max_map_dep, 2); ?></td>
</tr>
<tr>
	<td>Average mapping depth</td>
	<td><?php echo number_format($avg_map_dep, 2); ?></td>
</tr>
<tr>
	<td>Smallest mapping depth</td>
	<td><?php echo number_format($min_map_dep, 2); ?></td>
</tr>
<tr>
	<td>Biggest mapping coverage</td>
	<td><?php echo number_format($max_map_cov, 2); ?></td>
</tr>
<tr>
	<td>Average mapping coverage</td>
	<td><?php echo number_format($avg_map_cov, 2); ?></td>
</tr>
<tr>
	<td>Smallest mapping coverage</td>
	<td><?php echo number_format($min_map_cov, 2); ?></td>
</tr>
</table>

<br />
<h4>Conserved Gene Information</h4> 
<p>Finding the genes conserved in at least a certain number of rice lines. You can set the number below. </p>
<p>Please input the minimum number of rice lines containing a gene: </p>
<p>(default value equals to item count.)</p>
<form action="conservedGene.php" method="post" target="_blank">
	<input type="text" name="core_num" value="<?php echo count($id_arr); ?>">
	<?php 
		foreach ($id_arr as $id) {
			echo '<input type="hidden" name="selection[]" value="'.intval($id).'">';
		}	
	 ?>
	 
	<input type="submit" value="Submit">
	<em>The input number should between 1 and <?php echo $item_count; ?>!</em>
</form>

</table>

</div>
</body>
</html>