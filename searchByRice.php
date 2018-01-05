<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Rice Information</title>
	<?php include 'include/libs.php' ?>
	<script src="./js/echarts-2.2.7/build/dist/echarts.js"></script>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/search.css">


</head>
<body>

<?php include 'include/header.php'; ?>
<?php include 'include/connect.php'; ?>

<div class="container">
<div class="page-header">
   <h1>Rice Information</h1>
</div>

<?php 
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	if (isset($_POST['rname']) or isset($_GET['code'])) {
		if (isset($_POST['rname'])) {
			$code = $_POST['rname'];
		} 
		if (isset($_GET['code'])){
			$code = $_GET['code'];
		}
		

		
		$check_sql = "SELECT EXISTS(SELECT * FROM `line_info` WHERE `line_code`='".$code."')";
		$check_query = mysql_query($check_sql);
		$check_rs = mysql_fetch_row($check_query);
		if ($check_rs[0] == 0) {
			echo "<p>Wrong query input: ".$code.", please input the rice code which was showed in the <a href=\"rice-table.php\">rice table</a></p>";
		}
		else{
			$real_sql = "SELECT * FROM `line_info` WHERE `line_code`='".$code."'";
			$real_query = mysql_query($real_sql);
			while ($rs = mysql_fetch_array($real_query)) {
				$id = $rs['line_no'];
				$line_code = $rs['line_code'];
				$name = $rs['name'];
				$meta_type = $rs['meta_type'];
				$snp_type = $rs['snp_type'];
				$sub_group = $rs['sub_group'];
				$country = $rs['country'];
				$region = $rs['region'];
				$seq_depth = $rs['seq_depth'];
				$map_depth = $rs['map_depth'];
				$map_cov = $rs['map_cov'];
				$high_quality = $rs['high_quality'];
			}

?>
<h4>Basic Rice Information</h4>
<table class="table table-bordered table-hover">
<thead>
<tr>
	<td>ID</td>
	<td>code</td>
	<td>name</td>
	<td>meta-infomation-based subspecies</td>
	<td>SNP-based subspecies</tdh>
	<td>SNP-based subgroup</td>
	<td>country</td>
	<td>region</td>
	<td>sequencing depth</td>
	<td>mapping depth</td>
	<td>mapping coverage</td>
	<td>high quality</td>
	<td>Genome Browser</td>
</tr>
</thead>

<tr class="trlist">
<td><?php echo $id;?></td>
<td><?php echo $line_code;?></td>
<td><?php echo $name;?></td>
<td><?php echo $meta_type;?></td>
<td><?php echo $snp_type;?></td>
<td><?php echo $sub_group;?></td>
<td><?php echo $country;?></td>
<td><?php echo $region;?></td>
<td><?php echo $seq_depth;?></td>
<td><?php echo $map_depth;?></td>
<td><?php echo $map_cov;?></td>
<td><?php if($high_quality == 1){echo "Yes";}else{echo "No";}?></td>
<td>
	<form action="http://cgm.sjtu.edu.cn/3kricedb/visualization/index.php" method="POST" target ="_blank">
		<input type="hidden" name="singlerice" value="<?php echo $line_code;?>">
		<input type="submit" value="Genome Browser">
	</form>
</td>
</tr>
</table>


<?php 
	$gene_no_list = array();
	$gene_no_sql = "select `gene_no` from `gene_existence` where `line_no`=".$id;
	$gene_no_query = mysql_query($gene_no_sql);
	while ($rs = mysql_fetch_array($gene_no_query)) {
		array_push($gene_no_list, $rs['gene_no']);
	}

	$total_gene_num = 0;
	$core_gene_num = 0;
	$can_core_gene_num = 0;
	$distributed_gene_num = 0;
	$ss_dom_gene_num = 0;
	$IND_dom_gene_num = 0;
	$JAP_dom_gene_num = 0;
	$ss_sp_gene_num = 0;
	$IND_sp_gene_num = 0;
	$JAP_sp_gene_num = 0;
	$AUS_sp_gene_num = 0;
	$ARO_sp_gene_num = 0;
	$sg_dom_gene_num = 0;
	$IND_sg_dom_gene_num = 0;
	$JAP_sg_dom_gene_num = 0;
	$random_gene_num = 0;
	$gene_feature_sql = "SELECT * FROM `gene_feature` WHERE `gene_no` IN (".implode(',', $gene_no_list).")";
	$gene_feature_query = mysql_query($gene_feature_sql);
	while ($rs = mysql_fetch_array($gene_feature_query)) {
		$total_gene_num += 1;
		if (intval($rs['CoreFlag']) == 1) {
			$core_gene_num += 1;
		}elseif (intval($rs['canCore_flag']) == 1) {
			$can_core_gene_num += 1;
		}else{
			$distributed_gene_num += 1;
		}
		if (intval($rs['GroupDependent_flag'])==1) {
			$ss_dom_gene_num += 1;
		}
		if (intval($rs['GroupDependent_flagX'])==1) {
			$IND_dom_gene_num += 1;
		}
		if (intval($rs['GroupDependent_flagG'])==1) {
			$JAP_dom_gene_num += 1;
		}
		if (intval($rs['SP_IND'])==1) {
			$IND_sp_gene_num += 1;
			$ss_sp_gene_num += 1;
		}
		if (intval($rs['SP_JAP'])==1) {
			$JAP_sp_gene_num += 1;
			$ss_sp_gene_num += 1;
		}
		if (intval($rs['SP_AUS'])==1) {
			$AUS_sp_gene_num += 1;
			$ss_sp_gene_num += 1;
		}
		if (intval($rs['SP_ARO'])==1) {
			$ARO_sp_gene_num += 1;
			$ss_sp_gene_num += 1;
		}
		if (intval($rs['subgroup_dominant'])==1) {
			$sg_dom_gene_num += 1;
		}
		if (intval($rs['IndDependent_flag'])==1) {
			$IND_sg_dom_gene_num += 1;
		}
		if (intval($rs['JapDependent_flag'])==1) {
			$JAP_sg_dom_gene_num += 1;
		}
		if (intval($rs['random_flag'])==1) {
			$random_gene_num += 1;
		}
	}
	$shared_gene_num = $total_gene_num - $ss_sp_gene_num - $core_gene_num - $can_core_gene_num;
	$sg_and_sd_dominant = $total_gene_num - $random_gene_num - $core_gene_num - $can_core_gene_num;

 ?>
<div id="stat">
	<h4>Gene Statistics</h4>
	<table class="table table-striped table-hover table-bordered" style="width:400px">
		<tr>
			<th style="width:80%">#Total genes</th>
			<td style="width:20%"><?php echo $total_gene_num; ?> </td>
		</tr>
		<tr>
			<th style="text-indent:15px">#Core genes</th>
			<td><?php echo $core_gene_num; ?></td>
		</tr>
		<tr>
			<th style="text-indent:15px">#Candidate core genes</th>
			<td><?php echo $can_core_gene_num; ?></td>
		</tr>
		<tr>
			<th style="text-indent:15px">#Distributed genes</th>
			<td><?php echo $distributed_gene_num; ?></td>
		</tr>
		<tr>
			<th>#Subspecies-unbalanced genes</th>
			<td><?php echo $ss_dom_gene_num; ?></td>
		</tr>
		<tr>
			<th style="text-indent:15px">#<i>Indica</i>-dominant genes</th>
			<td><?php echo $IND_dom_gene_num; ?></td>
		</tr>
		<tr>
			<th style="text-indent:15px">#<i>Japonica</i>-dominant genes</th>
			<td><?php echo $JAP_dom_gene_num; ?></td>
		</tr>
		<tr>
			<th>#Subspecies-specific genes</th>
			<td><?php echo $ss_sp_gene_num; ?></td>
		</tr>
		<tr>
			<th style="text-indent:15px">#<i>Indica</i>-specific genes</th>
			<td><?php echo $IND_sp_gene_num; ?></td>
		</tr>
		<tr>
			<th style="text-indent:15px">#<i>Japonica</i>-specific genes</th>
			<td><?php echo $JAP_sp_gene_num; ?></td>
		</tr>
		<tr>
			<th style="text-indent:15px">#AUS-specific genes</th>
			<td><?php echo $AUS_sp_gene_num; ?></td>
		</tr>
		<tr>
			<th style="text-indent:15px">#ARO-specific genes</th>
			<td><?php echo $ARO_sp_gene_num; ?></td>
		</tr>
		<tr>
			<th>#Subgroup-unbalanced genes</th>
			<td><?php echo $sg_dom_gene_num; ?></td>
		</tr>
		<tr>
			<th style="text-indent:15px">#<i>Indica</i>-subgroup-unbalanced genes</th>
			<td><?php echo $IND_sg_dom_gene_num; ?></td>
		</tr>
		<tr>
			<th style="text-indent:15px">#<i>Japonica</i>-subgroup-unbalanced genes</th>
			<td><?php echo $JAP_sg_dom_gene_num ?></td>
		</tr>
		<tr>
			<th>#Random genes</th>
			<td><?php echo $random_gene_num; ?></td>
		</tr>
	</table>
</div>

<div id="pie_1" style="height:300px"></div>
<div id="pie_2" style="height:300px" class="col-md-6"></div>
<div id="pie_3" style="height:300px" class="col-md-6"></div>
<?php    
		}
	}
?>

<script>
	var core_gene_num = <?php echo $core_gene_num; ?>;
	var can_core_gene_num = <?php echo $can_core_gene_num; ?>;
	var dispensable_gene_num = <?php echo $distributed_gene_num; ?>;
	var ind_sp = <?php echo $IND_sp_gene_num; ?>;
	var jap_sp = <?php echo $JAP_sp_gene_num; ?>;
	var aus_sp = <?php echo $AUS_sp_gene_num; ?>;
	var aro_sp = <?php echo $ARO_sp_gene_num; ?>;
	var shared_gene_num = <?php echo $shared_gene_num; ?>;
	var random_gene_num = <?php echo $random_gene_num; ?>;
	var sg_and_sd_dominant = <?php echo $sg_and_sd_dominant; ?>;

	
	require.config({
		paths:{
			echarts: './js/echarts-2.2.7/build/dist'
		}
	});

	//pie 1
	require(
		[
			'echarts',
			'echarts/chart/pie'
		],
		function (ec){
			var myChart = ec.init(document.getElementById('pie_1'));
			var option = {
				tooltip:{
					trigger: 'item',
					formatter: "{b} : {c} ({d}%)"
				},
				toolbox: {
			        show : true,
			        orient : 'vertical',
			        feature : {
			            mark : {show: true, title:{mark:'Auxiliary line switch', markUndo: 'Undo line', markClear:'Clear lines'}},
			            dataView : {show: true, readOnly: false, title:'Data view', lang:['Data View', 'Close','Refresh']},
			            restore : {show: true, title:'Restore'},
			            saveAsImage : {show: true, title:'Save image'}
			        }
			    },
				calculable: true,
				color: ['#FF0000','#F675E0','#000000'],
				series:[
				{
					type: 'pie',
					itemStyle:{
						normal:{
							label : {
								textStyle : {
									fontSize : 15
								}
							}
						}
					},
					data:[
						{value: core_gene_num, name:'Core genes'},
						{value: can_core_gene_num, name:"Candidate core genes"},
						{value: dispensable_gene_num, name:'Distributed genes'}
						]
				}]
			};
			myChart.setOption(option);
		}
	);

//pie 2
	require(
		[
			'echarts',
			'echarts/chart/pie'
		],
		function (ec){
			var myChart = ec.init(document.getElementById('pie_2'));
			var option = {
				tooltip:{
					trigger: 'item',
					formatter: "{b} : {c} ({d}%)"
				},
				toolbox: {
			        show : true,
			        orient : 'vertical',
			        feature : {
			            mark : {show: true, title:{mark:'Auxiliary line switch', markUndo: 'Undo line', markClear:'Clear lines'}},
			            dataView : {show: true, readOnly: false, title:'Data view', lang:['Data View', 'Close','Refresh']},
			            restore : {show: true, title:'Restore'},
			            saveAsImage : {show: true, title:'Save image'}
			        }
			    },
				calculable: true,
				color: ['#FF0000','#F675E0','#000079','#006000','#0080FF','#00EC00','#0000E3'],
				series:[
				{
					type: 'pie',
					center:['60%','50%'],
					radius:[0, '55%'],
					itemStyle:{
						normal:{
							label : {
								textStyle : {
									fontSize : 15
								}
							}
						}
					},
					data:[
						{value: core_gene_num, name:'Core genes'},
						{value: can_core_gene_num, name:"Candidate\ncore genes"},
						{value: ind_sp, name:'Indica-specific\ngenes'},
						{value: jap_sp, name:'Japonica-specific\ngenes'},
						{value: aro_sp, name:'ARO-specific\ngenes'},
						{value: aus_sp, name:'AUS-specific\ngenes'},
						{value: shared_gene_num, name:'Shared genes'}
						]
				}]
			};
			myChart.setOption(option);
		}
	);

//pie 3
	require(
		[
			'echarts',
			'echarts/chart/pie'
		],
		function (ec){
			var myChart = ec.init(document.getElementById('pie_3'));
			var option = {
				tooltip:{
					trigger: 'item',
					formatter: "{b} : {c} ({d}%)"
				},
				toolbox: {
			        show : true,
			        orient : 'vertical',
			        feature : {
			            mark : {show: true, title:{mark:'Auxiliary line switch', markUndo: 'Undo line', markClear:'Clear lines'}},
			            dataView : {show: true, readOnly: false, title:'Data view', lang:['Data View', 'Close','Refresh']},
			            restore : {show: true, title:'Restore'},
			            saveAsImage : {show: true, title:'Save image'}
			        }
			    },
				calculable: true,
				color: ['#FF0000','#F675E0','#0578FC','#8302F8'],
				series:[
				{
					type: 'pie',
					center:['64%','50%'],
					radius:[0, '55%'],
					itemStyle:{
						normal:{
							label : {
								textStyle : {
									fontSize : 15
								}
							}
						}
					},
					data:[
						{value: core_gene_num, name:'Core genes'},
						{value: can_core_gene_num, name:"Candidate\ncore genes"},
						{value: random_gene_num, name:'Random genes'},
						{value: sg_and_sd_dominant, name:'Subspecies/Subgroup\nunbalanced genes'}
						]
				}]
			};
			myChart.setOption(option);
		}
	);
</script>


</div>
<?php include 'include/footer.php' ?>
</body>
</html>