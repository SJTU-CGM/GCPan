<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Gene Information</title>
	<?php include 'include/libs.php' ?>
	<script src="./js/echarts-2.2.7/build/dist/echarts.js"></script>
	<link rel="stylesheet" href="css/main.css">

</head>
<body>

<?php include 'include/header.php'; ?>
<?php include 'include/connect.php'; ?>

<div class="container">
<div class="page-header">
   <h1>Rice Accessions Shared Genes</h1>
</div>

<?php 
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	if (isset($_POST['gname'])) {
		$geneid_arr = explode(',', $_POST['gname']);
		$err_geneid = array();
		$trim_arr = array();
		foreach ($geneid_arr as $geneid) {
			array_push($trim_arr, trim($geneid));
		}
		$geneid_arr = $trim_arr;
		foreach ($geneid_arr as $geneid) {
			$check_sql = "SELECT EXISTS(SELECT * FROM `gene_info` WHERE `gene_id`='".$geneid."')";
			$check_query = mysql_query($check_sql);
			$check_rs = mysql_fetch_row($check_query);
			if ($check_rs[0] == 0) {
				array_push($err_geneid, $geneid);
			}
		}

		if (!empty($err_geneid)){
			echo "<p>Wrong query input: ".implode(', ', $err_geneid).", please input the gene ID which was showed in the <a href=\"gene-table.php\">gene table</a></p>";
		}
		else{
			$real_sql = "SELECT * FROM `gene_info` WHERE `gene_id` IN ('".implode("','", $geneid_arr)."')";
			$real_query = mysql_query($real_sql);
			$dl_gene_file_name = "dl_files/".md5(uniqid(rand())).".txt";
			$dl_gene_file = fopen($dl_gene_file_name, "w") or die("Unable to open file!");
			$gene_file_header = "#ID\tChromosome\tSource\tStart\tEnd\tStrand\tCDS length\tExon number\tGene ID\n";
			fwrite($dl_gene_file, $gene_file_header);
			while ($rs = mysql_fetch_row($real_query)) {
				$line_text = implode("\t", $rs)."\n";
				fwrite($dl_gene_file, $line_text);
			}
			fclose($dl_gene_file);
			
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
			$gene_feature_sql = "SELECT * FROM `gene_feature` WHERE `gene_id` IN ('".implode("','", $geneid_arr)."')";
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

			$tmp_sql = "SELECT `line_no` from `gene_existence` where `gene_id` IN ('".implode("','", $geneid_arr)."')";

			$q1 = mysql_query($tmp_sql);
			$tmp_array = array();
			while ($rs = mysql_fetch_assoc($q1)) {
				if (array_key_exists($rs['line_no'], $tmp_array)){
					$tmp_array[$rs['line_no']] += 1;
				}else{
					$tmp_array[$rs['line_no']] = 1;
				}
			}
			$tmp_array2 = array();
			foreach ($tmp_array as $key => $value) {
				if ($value >= count($geneid_arr)) {
					array_push($tmp_array2, $key);
				}
			}

			$rice_sql = "SELECT * FROM `line_info` WHERE `line_no` IN (".implode(',', $tmp_array2).")";
			$rice_query = mysql_query($rice_sql);
			$dl_rice_file_name = "dl_files/".md5(uniqid(rand())).".txt";
			$dl_rice_file = fopen($dl_rice_file_name, "w") or die("Unable to open file!");
			$rice_file_header = "#ID\tcode\tname\tmeta-infomation-based subspecies\tSNP-based subspecies\tSNP-based subgroup\tcountry\tregion\tsequencing depth\tmapping depth\tmapping coverage\n";
			fwrite($dl_rice_file, $rice_file_header);
			$rice_distribution_arr = array(0,0,0,0,0);
			$rice_num = 0;
			while ($rs = mysql_fetch_assoc($rice_query)) {
				$line_text = implode("\t", $rs)."\n";
				fwrite($dl_rice_file, $line_text);
				if($rs['snp_type'] == "JAP"){
					$rice_distribution_arr[0] += 1;
				}elseif ($rs['snp_type'] == "IND") {
					$rice_distribution_arr[1] += 1;
				}elseif ($rs['snp_type'] == "AUS") {
					$rice_distribution_arr[2] += 1;
				}elseif ($rs['snp_type'] == "ARO") {
					$rice_distribution_arr[3] += 1;
				}elseif ($rs['snp_type'] == "ADM") {
					$rice_distribution_arr[4] += 1;
				}
				$rice_num += 1;
			}
			fclose($dl_rice_file);
			$rice_distribution_str_arr = array_map("strval", $rice_distribution_arr);
?>
<p>The number of rice accessions where all genes present is <?php echo strval($rice_num); ?>.</p>
<h4>Basic Rice Information</h4>
<table border=0px>
	<tr><td>
	<form method="post" action="download.php"> 
		<input type="hidden" name="dl_info" value="<?php echo $dl_rice_file_name; ?>">
		<input type="submit" value="Download">
	</form>
	</td></tr>
</table>
<br>

<h4>Rice Distribution</h4>
<div id="bar" style="height:300px; width: 500px"></div>

<h1>Statistics of Genes</h1>

<h4>Basic Gene Information</h4>
<table border=0px>
	<tr><td>
	<form method="post" action="download.php"> 
		<input type="hidden" name="dl_info" value="<?php echo $dl_gene_file_name; ?>">
		<input type="submit" value="Download">
	</form>
	</td></tr>
</table>
<br>

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
			<td><?php echo $AUS_sp_gene_num ?></td>
		</tr>
		<tr>
			<th style="text-indent:15px">#ARO-specific genes</th>
			<td><?php echo $ARO_sp_gene_num ?></td>
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
					center:['55%','50%'],
					radius:[0, '50%'],
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
					center:['55%','50%'],
					radius:[0, '50%'],
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

//bar
	require(
			[
				'echarts',
				'echarts/chart/bar'
			],
			function (ec){
				var myChart = ec.init(document.getElementById('bar'));
				var option = {
					tooltip:{
						trigger:'item',
						formatter: "{b} : {c}"
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
					color: ['#97DCF3'],
					xAxis:[{type:'category', data:['JAP','IND','AUS','ARO','ADM']}],
					yAxis:[{type:'value'}],
					series:[
						{
						type: 'bar',
						barCategoryGap: '50%',	
						data:[<?php echo implode(",", $rice_distribution_str_arr);?>]
					}
					]
				};
				myChart.setOption(option);
			}
			
		);
</script>


</div>
<?php include 'include/footer.php' ?>
</body>
</html>