<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Gene table</title>
	<?php include 'include/libs.php' ?>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/rice_table.css">
</head>
<body>
<?php include 'include/header.php' ?>
<?php include 'include/connect.php' ?>
<div class="container">
<div class="page-header">
   <h1>Basic Gene Information Table</h1>
</div>

<?php 
	if(!empty($_GET['pos'])){
		$pos = $_GET['pos'];
		$w = 1;
		if (preg_match("/^(chr\w{2}|unaln\w+)/",$pos,$result)){
			$chrom = strtolower($result[1]);
			$w = "`chro` = '$chrom'";

			if (preg_match_all("/\w+:(\d+)-(\d+)/",$pos,$result)){
				$num1 = $result[1][0];
				$num2 = $result[2][0];
				if ($num2 > $num1){
					$posstart = $num1;
					$posend = $num2;
				}else{
					$posstart = $num2;
					$posend = $num1;
				}
				$w = "(`chro` = '$chrom') AND (`start` BETWEEN $posstart AND $posend OR `end` BETWEEN $posstart AND $posend)";
			}

		}else{
			$err = "Error pattern!";
		}
	}else{
		$w = 1;
	}
	// echo $w;
?>
<form action="" method="get">
<h4>Position Search:
<input type="text" name="pos" id="pos_search" size="45" placeholder="e.g. chr01:2000-40000 or unaln_IG1:10000-100000" value = "<?php 
		if (isset($chrom)){
			echo "$chrom";
			if (isset($posstart) and isset($posend)){
				echo ":$posstart-$posend";
			}
		} ?>">
<input type = "submit" value = " Search ">
<input type="button" onclick="document.getElementById('pos_search').value='chr03'" value="example1">
<input type="button" onclick="document.getElementById('pos_search').value='unaln_IG2:100000-800000'" value="example2">
<?php 
if (isset($err)) {
	echo "<em>".$err."</em>";
}
 ?>
</h4>
</form>
<br />
<?php
    $perpagenum = 100;
    // $total = mysql_fetch_array(mysql_query("select count(*) from `gene_info` where $w"));
    $sql="select count(*) from `gene_info` where $w";
    $total=mysqli_fetch_array(mysqli_query($con,$sql));
    $Total = $total[0];
 ?>
    <p>Total number: <?php echo $Total; ?></p>
 <?php
    $Totalpage = ceil($Total/$perpagenum);
    if(!isset($_GET['page'])||!intval($_GET['page'])||$_GET['page']>$Totalpage)    
    {   
        $page=1;
    }
    else
    {    
        $page=$_GET['page'];
    }
    // echo $page;
    $startnum = ($page-1)*$perpagenum;
    $sql = "select * from `gene_info` where $w limit $startnum,$perpagenum";

    $rs = mysqli_query($con,$sql);    
 
?>

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
	<!-- <td>CDS sequence</td> -->
	<td>visualization</td>
</tr>
</thead>

<?php 
	if($total){
		while($contents = mysqli_fetch_array($rs)){
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
<td><a href="searchByGene.php?gene_id=<?php echo $gene_id; ?>"><?php echo $gene_id;?></a></td>
<!-- <td><a href="sequence.php?id=<?php echo $id; ?>" target="view_seq">CDS</a></td> -->
<td>
	<!-- <form action="http://cgm.sjtu.edu.cn/3kricedb/visualization/index.php" method="POST" target ="_blank"> -->
	<form action="visualization/visualization.php" method="POST" target ="_blank">
		<input type="hidden" name="loc" value="<?php echo $chr_id." ".$start." ".$end;?>">
		<input type="submit" value="Genome Browser">
	</form>
</td>
</tr>

<?php    
    };
?>
</table>

<?php
		$per = $page - 1;
		$next = $page + 1;
		echo "<center>".$Total." records total. Each page has ".$perpagenum." records, ".$Totalpage." pages total<br />";
		
		if($page != 1){
			echo "<a href='".$_SERVER['PHP_SELF']."'>First page</a>&nbsp&nbsp&nbsp&nbsp&nbsp";
			echo "<a href='".$_SERVER['PHP_SELF'].'?pos='.$pos.'&page='.$per."'> Previous</a>&nbsp&nbsp&nbsp&nbsp&nbsp";
		}
		if($page != $Totalpage){
			if (isset($pos)){
				echo "<a href='".$_SERVER['PHP_SELF'].'?pos='.$pos.'&page='.$next."'> Next</a>&nbsp&nbsp&nbsp&nbsp&nbsp";
				echo "<a href='".$_SERVER['PHP_SELF'].'?pos='.$pos.'&page='.$Totalpage."'> Last page</a></center>";
			}else{
				echo "<a href='".$_SERVER['PHP_SELF'].'?page='.$next."'> Next</a>&nbsp&nbsp&nbsp&nbsp&nbsp";
				echo "<a href='".$_SERVER['PHP_SELF'].'?page='.$Totalpage."'> Last page</a></center>";
			}
		}
	}
	else
	{
		echo "<center>No record</center>";
	}
?>
</div>
<?php include 'include/footer.php' ?>
</body>
</html>