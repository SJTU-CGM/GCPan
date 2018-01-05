<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Conserved Gene</title>
	<link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.css">
	<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/search.css">

</head>
<body>

<?php include 'include/header.php'; ?>
<?php include 'include/connect.php'; ?>

<?php 
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	if(isset($_POST['core_num'])){
		$core_num = $_POST['core_num'];
	}else{
		$core_num = 1;
	}
	if (isset($_POST['selection'])) {
		$search_sql = "SELECT `gene_info`.* FROM `gene_info` INNER JOIN `line_gene` ON `gene_info`.`id`=`line_gene`.`id` AND `line_gene`.`line_id` IN (".implode(',', $_POST['selection']).") GROUP BY `gene_info`.`id` HAVING COUNT(`gene_info`.`id`)>=$core_num";
		// echo $search_sql;
		
		$err = 0;	
	}else{
		$err = 1;
	}

	if($err == 0){
	$query = mysql_query($search_sql);
	$num_chr = array("chr01"=>0,"chr02"=>0,"chr03"=>0,"chr04"=>0,"chr05"=>0,"chr06"=>0,"chr07"=>0,"chr08"=>0,"chr09"=>0,"chr10"=>0,"chr11"=>0,"chr12"=>0,"unaln_ind1"=>0,"unaln_ind2"=>0,"unaln_ind3"=>0,"unaln_ind4"=>0,"unaln_ind5"=>0,"unaln_aus"=>0,"unaln_jap1"=>0,"unaln_jap2"=>0,"unaln_jap3"=>0,"unaln_jap4"=>0,"unaln_aro"=>0,"unaln_admixture"=>0);
	$item_count = 0;
	$sum_cds_len = 0;
	$min_cds_len = 30000;
	$max_cds_len = 0;
	$sum_exon_num = 0;
	$min_exon_num = 100;
	$max_exon_num = 0;

	$dl_gene_file_name = "dl_files/".md5(uniqid(rand())).".txt";
	$dl_gene_file = fopen($dl_gene_file_name, "w") or die("Unable to open file!");
	$gene_file_header = "#ID\tChromosome\tSource\tStart\tEnd\tStrand\tCDS length\tExon number\tGene ID\n";
	fwrite($dl_gene_file, $gene_file_header);
	while ($rs = mysql_fetch_assoc($query)) {
		$item_count += 1;
		$num_chr[$rs['chro']] += 1;
		$sum_cds_len += $rs['cds_len'];
		$sum_exon_num += $rs['exon_num'];
		if ($rs['cds_len'] > $max_cds_len) {
			$max_cds_len = $rs['cds_len'];
		}
		if ($rs['cds_len'] < $min_cds_len) {
			$min_cds_len = $rs['cds_len'];
		}
		if ($rs['exon_num'] > $max_exon_num) {
			$max_exon_num = $rs['exon_num'];
		}
		if ($rs['exon_num'] < $min_exon_num) {
			$min_exon_num = $rs['exon_num'];
		}
		$line_text = implode("\t", $rs)."\n";
		fwrite($dl_gene_file, $line_text);
	}
	if ($item_count > 0){
	$avg_cds_len = $sum_cds_len / $item_count;
	$avg_exon_num = $sum_exon_num / $item_count;
	}else{
		$avg_exon_num = 0;
		$avg_cds_len = 0;
		$min_exon_num = 0;
		$min_cds_len = 0;
	}
	fclose($dl_gene_file);
}
 ?>

<div class="container">
<div class="page-header">
   <h1>Conserved Gene Informatioin</h1>

   <table border=0px align="right" style="float: right">
	<tr><td style="padding-right:10px">
	<form method="post" action="download.php"> 
		<input type="hidden" name="dl_info" value="<?php echo $dl_gene_file_name; ?>">
		<input type="submit" value="download conserved gene detail information">
	</form>
	</td></tr>
	</table>
</div>

<h4>Gene Information</h4>
<?php if ($err == 1) {
	echo "<h3><em>No rice line selected! </em></h3>";
} ?>
<table id="ri">
<tr>
	<td>Item count</td>
	<td><?php echo $item_count; ?></td>
</tr>
<tr>
	<td>Maximum CDS length</td>
	<td><?php echo $max_cds_len; ?></td>
</tr>
<tr>
	<td>Average CDS length</td>
	<td><?php echo number_format($avg_cds_len, 2); ?></td>
</tr>
<tr>
	<td>Minimum CDS length</td>
	<td><?php echo $min_cds_len; ?></td>
</tr>
<tr>
	<td>Maximum exon number</td>
	<td><?php echo $max_exon_num; ?></td>
</tr>
<tr>
	<td>Average exon number</td>
	<td><?php echo number_format($avg_exon_num, 2); ?></td>
</tr>
<tr>
	<td>Minimum exon number</td>
	<td><?php echo $min_exon_num ?></td>
</tr>
</table>

<h4>Gene Distribution</h4>
<table id="ri">
<tr>
	<th>Chromosome Id</th>
	<th>Gene number</th>
</tr>

<?php 
foreach ($num_chr as $key => $value) {
	echo "<tr><td>$key</td><td>$value</td></tr>";
}
 ?>

</table>