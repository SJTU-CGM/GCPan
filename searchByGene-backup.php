<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Gene Information</title>
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
	if (isset($_POST['gname'])) {
		// echo $_POST['gname'];
		$gene_arr = explode(',', $_POST['gname']);
		$id_arr = array();

		foreach ($gene_arr as $gene) {
			$t = trim($gene);
			$tmp_sql = "SELECT `gene_no` from `gene_info` WHERE `gene_id`='".$t."'";
			$query = mysql_query($tmp_sql);
			while ($m = mysql_fetch_row($query)) {
				array_push($id_arr, $m[0]);
			}
		}
		$name_sql = "`gene_no`=".implode(" OR `gene_no`=", $id_arr);
		if (empty($_POST['gname'])) {
			$err = 1;
		}
		$id_count = count($id_arr);
	}

	if (isset($_GET['id'])) {
		$name_sql = "`gene_no`=".$_GET['id'];
		$id_arr = array($_GET['id']);
	}

	if(isset($_POST['core_num'])){
		$core_num = $_POST['core_num'];
	}else{
		$core_num = 1;
	}
	if (isset($_POST['con_gene'])) {
		$name_sql = "`gene_no` IN (".implode(',', $_POST['con_gene']).")";
		$err = 0;	
	}

	if ($err != 1){
		$sql = "SELECT * FROM `gene_info` WHERE ".$name_sql;
		$query = mysql_query($sql);

		// $get_line_no_sql = "SELECT `line_no` from `gene_table` where `gene_no` in (".implode(',', $id_arr).")";
		
		// $q1 = mysql_query($get_line_no_sql);
		// $tmp_array = array();
		// while ($rs = mysql_fetch_assoc($q1)) {
		// 	if (array_key_exists($rs['line_no'], $tmp_array)) {
		// 		$tmp_array[$rs['line_no']] += 1;
		// 	}else{
		// 		$tmp_array[$rs['line_no']] = 1;
		// 	}
		// }
		// $tmp_array2 = array();
		// foreach ($tmp_array as $key => $value) {
		// 	if ($value >= $id_count) {
		// 		array_push($tmp_array2, $key);
		// 	}
		// }
		
		// $conserved_rice_sql = "SELECT * FROM `line_info` WHERE `line_no` IN (".implode(',', $tmp_array2).")";
		
		// $query_rice = mysql_query($conserved_rice_sql);
		// $dl_rice_file_name = "dl_files/".md5(uniqid(rand())).".txt";
// 		$dl_rice_file = fopen($dl_rice_file_name, "w") or die("Unable to open file!");
// 		$rice_file_header = "#ID\tcode\tname\tcategorized by SNP\tcategorized by Pan-genome\tsub-group of Pan-genome\tcountry\tregion\tsequencing depth\tmapping depth\tmapping coverage\n";
// 		fwrite($dl_rice_file, $rice_file_header);
// 		while ($rs = mysql_fetch_assoc($query_rice)){
// 			$rice_text = implode("\t", $rs)."\n";
// 			fwrite($dl_rice_file, $rice_text);
// 		}
// 		fclose($dl_rice_file);
}
?>

<div class="container">
<div class="page-header">
   <h1>Gene Informatioin</h1>

   <!-- <table border=0px align="right" style="float: right">
	<tr><td style="padding-right:10px">
	<form method="post" action="download.php"> 
		<input type="hidden" name="dl_info" value="<?php echo $dl_gene_file_name; ?>">
		<input type="submit" value="download gene detail information">
	</form>
	</td>
	<td style="padding-right:10px">
	<form method="post" action="download.php"> 
		<input type="hidden" name="dl_info" value="<?php echo $dl_rice_file_name; ?>">
		<input type="submit" value="download conserved rice detail information">
	</form>
	</td>
	</tr>
	</table> -->
</div>

<h4>Basic Gene Information</h4>
<?php if ($err == 1) {
	echo "<h3><em>No gene input! </em></h3>";
} ?>


<table class="table table-bordered table-hover">
<thead>
<tr>
	<td>ID</td>
	<td>source</td>
	<td>chrom</td>
	<td>start</td>
	<td>end</tdh>
	<td>strand</td>
	<td>CDS length</td>
	<td>exon number</td>
	<td>gene id</td>
	<td>visualization</td>
</tr>
</thead>

<?php 
	while($contents = mysql_fetch_array($query)){
		$id = $contents['gene_no'];
		$source = $contents['source'];
		$chr_id = $contents['chro'];
		$start = $contents['start'];
		$end = $contents['end'];
		$strand = $contents['strand'];
		$cds_len = $contents['cds_len'];
		$exon_num = $contents['exon_num'];
		$gene_id = $contents['gene_id'];

?>

<tr class="trlist">
<td><?php echo $id;?></td>
<td><?php echo $source;?></td>
<td><?php echo $chr_id;?></td>
<td><?php echo $start;?></td>
<td><?php echo $end;?></td>
<td><?php echo $strand;?></td>
<td><?php echo $cds_len;?></td>
<td><?php echo $exon_num;?></td>
<td><?php echo $gene_id;?></td>
<td>
	<form action="http://cgm.sjtu.edu.cn/3kricedb/visualization/index.php" method="POST">
		<input type="hidden" name="loc" value="<?php echo $chr_id." ".$start." ".$end;?>">
		<input type="submit" value="Genome Browser">
	</form>
</td>
</tr>

<?php    
    };
?>
</table>

<h4>Gene Ontology</h4>
<table class="table table-bordered table-hover">
<?php 
	$query = mysql_query($sql);
	while($contents = mysql_fetch_array($query)){
		$gene_id = $contents['gene_id'];
		echo '<tr class="trlist">';
		echo "<td>".$gene_id."</td>";
		$go_sql = "select `go_id` from `gene_go` where `gene_id`='".$gene_id."'";
		$go_query = mysql_query($go_sql);
		echo "<td>";
		if (mysql_num_rows($go_query) != 0){
			while ($rs = mysql_fetch_array($go_query)) {
				echo "<a href='http://amigo.geneontology.org/amigo/term/".$rs['go_id']."' target='_blank'>".$rs['go_id']."</a>";
				echo "\t";
			}
		}else{
			echo "No GO information.";
		}
		echo "</td></tr>";
	}
 ?>
 </table>
 

<h4>CDS Sequence</h4>
<textarea name="content" cols="70" rows="24" readonly="readonly" style="font-family: Courier">
<?php 
	$seq_sql = "select `seq` from `cds_seq` where ".$name_sql;
	$query = mysql_query($seq_sql);
	while ($rs = mysql_fetch_array($query)) {
		echo $rs['seq'];
	}

 ?></textarea>

<h4>Conserved Rice Information</h4>
<table class="table table-bordered table-hover">
<thead>
<tr>
	<td>ID</td>
	<td>code</td>
	<td>name</td>
	<td>meta-infomation based subspecies</td>
	<td>SNP based subspecies</tdh>
	<td>subgroup of SNP based subspecies</td>
	<td>country</td>
	<td>region</td>
	<td>sequencing depth</td>
	<td>mapping depth</td>
	<td>mapping coverage</td>
</tr>
</thead>
<?php 
	$get_line_no_sql = "SELECT `line_no` from `gene_table` where `gene_no` in (".implode(',', $id_arr).")";
		
	$q1 = mysql_query($get_line_no_sql);
	$tmp_array = array();
	while ($rs = mysql_fetch_assoc($q1)) {
		if (array_key_exists($rs['line_no'], $tmp_array)) {
			$tmp_array[$rs['line_no']] += 1;
		}else{
			$tmp_array[$rs['line_no']] = 1;
		}
	}
	$tmp_array2 = array();
	foreach ($tmp_array as $key => $value) {
		if ($value >= $id_count) {
			array_push($tmp_array2, $key);
		}
	}
	
	$conserved_rice_sql = "SELECT * FROM `line_info` WHERE `line_no` IN (".implode(',', $tmp_array2).")";
	
	$query_rice = mysql_query($conserved_rice_sql);
	while($rs = mysql_fetch_array($query_rice)){
		
?>
<tr class = "trlist">
	<td><?php echo $rs['line_no']; ?></td>
	<td><?php echo $rs['line_code']; ?></td>
	<td><?php echo $rs['name']; ?></td>
	<td><?php echo $rs['meta_type']; ?></td>
	<td><?php echo $rs['snp_type']; ?></td>
	<td><?php echo $rs['sub_group']; ?></td>
	<td><?php echo $rs['country']; ?></td>
	<td><?php echo $rs['region']; ?></td>
	<td><?php echo $rs['seq_depth']; ?></td>
	<td><?php echo $rs['map_depth']; ?></td>
	<td><?php echo $rs['map_cov']; ?></td>
</tr>

<?php
	}
?>

</table>

</div>
</body>
</html>