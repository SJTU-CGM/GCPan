<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Gene Information</title>
	<?php include 'include/libs.php' ?>
	<link rel="stylesheet" href="css/main.css">

</head>
<body>

<?php include 'include/header.php'; ?>
<?php include 'include/connect.php'; ?>

<div class="container">
<div class="page-header">
   <h1>Gene Information</h1>
</div>

<?php 
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	if (isset($_POST['gname']) or isset($_GET['gene_id'])) {
		if (isset($_POST['gname'])) {
			$gene_id = trim($_POST['gname']);
		}
		if (isset($_GET['gene_id'])) {
			$gene_id = $_GET['gene_id'];
		}

		$check_sql = "SELECT EXISTS(SELECT * FROM `gene_info` WHERE `gene_id`='".$gene_id."')";
		$check_query = mysql_query($check_sql);
		$check_rs = mysql_fetch_row($check_query);
		if ($check_rs[0] == 0) {
			echo "<p>Wrong query input: ".$gene_id.", please input the gene ID which was showed in the <a href=\"gene-table.php\">gene table</a></p>";
		}
		else{
			$real_sql = "SELECT * FROM `gene_info` WHERE `gene_id`='".$gene_id."'";
			$real_query = mysql_query($real_sql);
			while ($rs = mysql_fetch_array($real_query)) {
				$id = $rs['gene_no'];
				$source = $rs['source'];
				$chr_id = $rs['chro'];
				$start = $rs['start'];
				$end = $rs['end'];
				$strand = $rs['strand'];
				$cds_len = $rs['cds_len'];
				$exon_num = $rs['exon_num'];
				$gene_id = $rs['gene_id'];
			}
?>
<div>
<h4>Basic Gene Information</h4>
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
	<td>gene ID</td>
	<td>visualization</td>
</tr>
</thead>
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
	<form action="http://cgm.sjtu.edu.cn/3kricedb/visualization/index.php" method="POST" target="_blank">
		<input type="hidden" name="loc" value="<?php echo $chr_id." ".$start." ".$end;?>">
		<input type="submit" value="Genome Browser">
	</form>
</td>
</tr>
</table>
</div>


<div>
<h4>Gene Categorization (<a href="about.php#geneCate">Help</a>)</h4>

<?php 
	$feature_sql = "SELECT * FROM `gene_feature` WHERE gene_id='".$gene_id."'";
	$feature_query = mysql_query($feature_sql);
	$rs = mysql_fetch_array($feature_query);
	if (intval($rs['SP_IND'])==1 or intval($rs['SP_JAP'])==1 or intval($rs['SP_AUS'])==1 or intval($rs['SP_ARO'])==1){
		$subspecies_specific_flag = 1;
	}else{
		$subspecies_specific_flag = 0;
	}
 ?>
<table class="table table-striped table-hover table-bordered" style="width:350px">
<tr>
	<td style="width:80%"><b>Core gene</b></td>
	<td style="width:20%"><?php if(intval($rs['CoreFlag'])==1){echo "Yes";}else{echo "No";} ?></td>
</tr>
<tr>
	<td><b>Candidate core gene</b></td>
	<td><?php if(intval($rs['canCore_flag'])==1){echo "Yes";}else{echo "No";} ?></td>
</tr>
<tr>
	<td><b>Distributed gene</b></td>
	<td><?php if(intval($rs['CoreFlag'])==1 || intval($rs['canCore_flag'])==1){echo "No";}else{echo "Yes";} ?></td>
</tr>
<tr>
	<td><b>Subspecies-unbalanced gene</b></td>
	<td><?php if(intval($rs['GroupDependent_flag'])==1){echo "Yes";}else{echo "No";} ?></td>
</tr>
<tr>
	<td style="text-indent:15px"><i>Indica</i>-dominant gene</td>
	<td><?php if(intval($rs['GroupDependent_flagX'])==1){echo "Yes";}else{echo "No";} ?></td>
</tr>
<tr>
	<td style="text-indent:15px"><i>Japonica</i>-dominant gene</td>
	<td><?php if(intval($rs['GroupDependent_flagG'])==1){echo "Yes";}else{echo "No";} ?></td>
</tr>
<tr>
	<td><b>Subspecies-specific gene</b></td>
	<td><?php if($subspecies_specific_flag==1){echo "Yes";}else{echo "No";} ?></td>
</tr>
<tr>
	<td style="text-indent:15px"><i>Indica</i>-specific gene</td>
	<td><?php if(intval($rs['SP_IND'])==1){echo "Yes";}else{echo "No";} ?></td>
</tr>
<tr>
	<td style="text-indent:15px"><i>Japonica</i>-specific gene</td>
	<td><?php if(intval($rs['SP_JAP'])==1){echo "Yes";}else{echo "No";} ?></td>
</tr>
<tr>
	<td style="text-indent:15px">AUS-specific gene</td>
	<td><?php if(intval($rs['SP_AUS'])==1){echo "Yes";}else{echo "No";} ?></td>
</tr>
<tr>
	<td style="text-indent:15px">ARO-specific gene</td>
	<td><?php if(intval($rs['SP_ARO'])==1){echo "Yes";}else{echo "No";} ?></td>
</tr>
<tr>
	<td><b>Subgroup-unbalanced gene</b></td>
	<td><?php if(intval($rs['subgroup_dominant'])==1){echo "Yes";}else{echo "No";} ?></td>
</tr>
<tr>
	<td style="text-indent:15px"><i>Indica</i>-subgroup-unbalanced gene</td>
	<td><?php if(intval($rs['IndDependent_flag'])==1){echo "Yes";}else{echo "No";} ?></td>
</tr>
<tr>
	<td style="text-indent:15px"><i>Japonica</i>-subgroup-unbalanced gene</td>
	<td><?php if(intval($rs['JapDependent_flag'])==1){echo "Yes";}else{echo "No";} ?></td>
</tr>
<tr>
	<td><b>Random gene</b></td>
	<td><?php if(intval($rs['random_flag'])==1){echo "Yes";}else{echo "No";} ?></td>
</tr>
<tr>
	<td><b>Gene age</b></td>
	<td><a href="about.php#gene_age" target="_blank"><?php echo $rs['Age']; ?></a></td>
</tr>
</table>
</div>

<h4>Gene Family</h4>
<?php
	$gf_sql = "SELECT * FROM `gene_fam` WHERE gene_id='".$gene_id."'";
	$gf_query = mysql_query($gf_sql);
	$gf_rs = mysql_fetch_array($gf_query);

?>
<table class="table table-striped table-hover table-bordered" style="width:350px">
<tr>
	<td><?php echo $gf_rs['gf_id'];?></td>
	<td><?php echo $gf_rs['gf_att']." Gene Family";?></td>
</tr>
</table>

<!-- <div class="col-md-4"> -->
<h4>Gene Distribution (<a href="about.php#tree">Help</a>)</h4>
<?php 
	if (intval($rs['ALL'])>0 and intval($rs['CoreFlag'])==0){
 ?>

<div id="genetree">
	<img src="./pic/genefig/<?php echo $rs['gene_id']; ?>.svg" style="height: 400px">
	<!-- <p>(Presence:<b style="color:red">red</b>/Absence:<b style="color:black">black</b>)</p> -->
</div>
<?php 
}else{
	if ($rs['CoreFlag']==1) {
		echo "<p>This gene presents in all high-quality rice accessions.</p>";
	}
	if ($rs['ALL'] == 0){
		echo "<p>This gene can not be found in the 453 high-quality rice accessions but can be found in the 3,010 rice accessions.</p>";
	}
}
?>
<!-- </div> -->

<!-- <div class="col-md-8"> -->
<h4>Gene Presence Frequency </h4>
<?php 
	if (intval($rs['ALL'])>0){
 ?>
<div id="heatmap1">
	<img src="./pic/subspecies_heatmap/<?php echo $rs['gene_id']; ?>.svg" style="margin-left: -32px">
</div>
<div id="heatmap2">
	<img src="./pic/subgroup_heatmap/<?php echo $rs['gene_id']; ?>.svg" style="margin-left: -40px; height:90px">
</div>

<?php 
}else{
	echo "<p>This gene can not be found in the 453 high-quality rice accessions but can be found in the 3,010 rice accessions.</p>";
}
 ?>
<p>The information about <a href="about.php#ref">subspecies and subgroups</a>.</p>
<!-- </div> -->



<div class="col-md-12">
<h4>Gene Ontology</h4>
<table class="table table-bordered table-striped table-hover">

<?php
	$go_sql = "select `go_id` from `gene_go` where `gene_id`='".$gene_id."'";
	$go_query = mysql_query($go_sql);
	
	if (mysql_num_rows($go_query) != 0){
		while ($rs = mysql_fetch_array($go_query)) {
			echo "<tr class='trlist'><td>";
			echo "<a href='http://amigo.geneontology.org/amigo/term/".$rs['go_id']."' target='_blank'>".$rs['go_id']."</a></td><td>";
			$name_sql = "select `name` from `term` where `acc`='".$rs['go_id']."'";
			$name_query = mysql_query($name_sql);
			while ($rs1 = mysql_fetch_array($name_query)) {
				echo $rs1['name'];
			}
			echo "</td></tr>";
		}
	}else{
		echo "No GO information.";
	}
?>



</table>


<h4>CDS(Coding DNA Sequence)</h4>
<textarea name="content" cols="70" rows="10" readonly="readonly" style="font-family: Courier">
<?php 
	$seq_sql = "select `seq` from `cds_seq` where `gene_no`=".$id;
	$query = mysql_query($seq_sql);
	while ($rs = mysql_fetch_array($query)) {
		echo $rs['seq'];
	}
 ?>
 </textarea>

<h4>Protein Sequence</h4>
<textarea name="content" cols="70" rows="10" readonly="readonly" style="font-family: Courier">
<?php 
	$seq_sql = "select `pep` from `pep_seq` where `gene_no`=".$id;
	$query = mysql_query($seq_sql);
	while ($rs = mysql_fetch_array($query)) {
		echo $rs['pep'];
	}
 ?>
 </textarea>
 </div>

<?php    
	    }
	}
    else{
    	echo "No input!";
    }
?>

</div>
<?php include 'include/footer.php' ?>


</body>
</html>