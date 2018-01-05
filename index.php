<?php
	session_start();
	$pagestartime=microtime();
	if(!isset($_SESSION['userid'])){
		header("Location:login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include 'include/libs.php' ?>
	<title>GCPAN</title>
	
	<script src="./js/echarts-2.2.7/build/dist/echarts.js"></script>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<script>
	    var Sys = {};
        var ua = navigator.userAgent.toLowerCase();
        var s;
        (s = ua.match(/msie ([\d.]+)/)) ? Sys.ie = s[1] :
        (s = ua.match(/firefox\/([\d.]+)/)) ? Sys.firefox = s[1] :
        (s = ua.match(/chrome\/([\d.]+)/)) ? Sys.chrome = s[1] :
        (s = ua.match(/opera.([\d.]+)/)) ? Sys.opera = s[1] :
        (s = ua.match(/version\/([\d.]+).*safari/)) ? Sys.safari = s[1] : 0;
        if (!navigator || !navigator.userAgent || Sys.ie ) {
        	alert("This site is not compatible with Microsoft Internet Explorer, Please use Chrome, Firefox or others!")
        }
   // var nav = navigator.userAgent;
	  // if (! navigator ||
	  //     ! navigator.userAgent ||
	  //     /msie/i.test(nav) ||
	  //     /edge/i.test(nav) ||
	  //     /safari/i.test(nav)) {
	  //   alert("The database is not compatible with Microsoft Internet Explorer or Microsoft Edge, Please use Chrome, Firefox or others!")
	  // }

	</script>
	<?php include 'include/header.php' ?>
	<div class="container">
	      <div class="jumbotron">
       		<div class="container">
		     <h1>GCPAN: Gastric Carcinoma Pan-genome Browser</h1>
		     <p>Lab of Computational Genomics and Metagenomics, Shanghai Jiao Tong University</p>
		     <p>Ruijin Hospital, Shanghai Jiao Tong University School of Medicine</p>
		     <!-- <p>Institute of Crop Sciences, Chinese Academy of Agricultural Sciences</p> -->
		    </div>
		  </div>

		<div class="intro">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Introduction</h3>
				</div>
				<div class="panel-body">
	  Gastric cancer (or Stomach cancer) is the third leading cause of death from cancers globally. It occurs most commonly in East Asia and it occurs twice as often in males as in females. This Gastric cancer pan-genome, the genome of many gastric cancer genomes rather than the cancer genome from one individual, has been constructed from about 200 individuals with deep sequencing coverages. The whole genome sequencing data contains genome sequence from cancer and normal genome as well as those genomic sequences from symbiomes. Up to date, this pan-genome browser provide a framework with Home, Sample table and help (About & Manual) functions available. The other menus are still under construction. If you don't know how to start, please click <a href="http://cgm.sjtu.edu.cn/test/yyqiao/GCPan/about1.php">About & Manual</a>. 
    		
			<!-- <p>The cultivated rice, <i>Oryza sativa</i> L., is one of the major food sources for the world and a model organism in plant biology. The rice pan-genome, the genome of rice species rather than an individual, has been constructed from 3K rice genomes with a medium sequencing coverage about 15X. This pan-genome contains ~370Mbp IRGSP genome and ~260Mbp novel sequences, which are almost the same size as an individual rice genome. </p>
					<p>This database provides: </p>
					<ol>
						<li>Basic information of 3,010 rice accessions</li>
						<li>Sequences and gene annotations for the rice pan-genome</li>
						<li>Gene presence-absence variations (PAVs) of rice accessions</li>
						<li>Expression profiles for rice pan-genome</li>
					</ol>
					<p>This database also provides:</p>
					<ol>
						<li>Basic search functions:</li>
						<ul>
							<li>Search a single gene to obtain its basic information, distributions, PAVs and gene functions</li>
							<li>Search a single rice to obtain its sequencing landscape and meta-information (source, classification, etc.) </li>
							<li>Search sequence(s) against pan-genome sequences</li>
						</ul>
						<li>Advanced search functions:</li>
						<ul>
							<li>Search multiple rice accessions to obtain their shared genes</li>
							<li>Search multiple genes to obtain rice accessions where they all present</li>
						</ul>
						<li>Visualization  functions:</li>
						<ul>
							<li>A tree browser to view the phylogeny of 3K rice accessions</li>
							<li>A genome browser to view gene annotation and presence-absence variations (PAVs)</li>
						</ul>
					</ol> -->
					

				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="panel panel-success">
				<div class="panel-heading">
 		 			<h3 class="panel-title">Heatmap of Gene PAVs</h3>
				</div>
		   		<div class="panel-body">
					<img src="pic/GeneHeat-example.png" alt="heatmap" width="100%">
				</div> This figure is from sketch map, to be replaced soon....<br>

			</div>
			
			<div class="panel panel-success">
				<div class="panel-heading">
 		 			<h3 class="panel-title">Microbiom composition analysis pipline</h3>
				</div>
		   		<div class="panel-body">
					<!-- <a href="sample-table.php"> select samples and draw microbial genome composition structure for these samples </a> -->
					<img src="pic/MetaBinG2.png" alt="MetaBinG2">
					<br>
					<br>
					<p>Fig. MetaBinG2 is designed to analysis microbiom composition structure.</p>
				</div>
			</div>
	<div class="panel panel-success">
				<div class="panel-heading">
 		 			<h3 class="panel-title">Genome composition</h3>
				</div>
		   		<div class="panel-body">
					<img src="pic/" alt="pie charts" width="100%">
				</div>
			</div>

			<div class="panel panel-success">
				<div class="panel-heading">
 		 			<h3 class="panel-title">Geographical distribution</h3>
				</div>
		   		<div class="panel-body">
					<img src="pic/" alt="tree_geo.svg" width="100%">
				</div>
			</div>
		</div>
		

		<div class="col-md-7">
			<div class="panel panel-success">
				<div class="panel-heading">
 		 			<!-- <h3 class="panel-title">Statistics</h3> -->
 		 			<h3 class="panel-title">Microbiom composition analysis</h3>
				</div>
		   		<div class="panel-body">
		   			<img src="pic/Microbial composition structure.png" alt="Microbial_composition_structure" width="100%"><br><br>
		   			<p>Fig. The Nightingale rose diagram illustrate the composition structure of samples with two different sampling methods.</p>
				<a href="sample-table.php"> Select samples and draw microbial genome composition structure for these samples </a>
				<!-- <table class="table table-striped table-hover table-bordered">
				<tr>
					<td style="width:70%"><strong>#Total sequencing bases</strong></td>
					<td style="width:30%">16.6Tbps</td>
				</tr>
				<tr>
					<td><strong>#Pan-genome size</strong></td>
					<td>641Mbps</td>
				</tr>
				<tr>
					<td><strong>#Total rice accessions</strong></td>
					<td>3,010</td>
				</tr>
				<tr>
					<td style="text-indent:15px">#<i>Indica</i></td>
					<td>1,764</td>
				</tr>
				<tr>
					<td style="text-indent:15px">#<i>Japonica</i></td>
					<td>801</td>
				</tr>
				<tr>
					<td style="text-indent:15px">#AUS</td>
					<td>221</td>
				</tr>
				<tr>
					<td style="text-indent:15px">#ARO</td>
					<td>101</td>
				</tr>
				<tr>
					<td style="text-indent:15px">#ADM</td>
					<td>123</td>
				</tr>
				<tr>
					<td><strong>#High-quality accessions</strong></td>
					<td>453</td>
				</tr>
				<tr>
					<td><strong>#RNA-seq runs</strong></td>
					<td>226</td>
				</tr>
				</table>

				<table class="table table-striped table-hover table-bordered">
				<tr>
					<td style="width:70%"><strong>#Total genes</strong></td>
					<td style="width:30%">50,995</td>
				</tr>
				<tr>
					<td style="text-indent:15px">#Core genes</td>
					<td>23,914</td>
				</tr>
				<tr>
					<td style="text-indent:15px">#Candidate Core genes</td>
					<td>4,986</td>
				</tr>
				<tr>
					<td style="text-indent:15px">#Distributed genes</td>
					<td>22,095</td>
				</tr>
				</table>
				
				<table class="table table-striped table-hover table-bordered">
				<tr>
					<td style="width:70%"><strong>#Subspecies-unbalanced genes</strong></td>
					<td style="width:30%">13,617</td>
				</tr>
				<tr>
					<td style="text-indent:15px">#<i>Indica</i>-dominant genes</td>
					<td>5,579</td>
				</tr>
				<tr>
					<td style="text-indent:15px">#<i>Japonica</i>-dominant genes</td>
					<td>6,038</td>
				</tr>
				</table>
				<table class="table table-striped table-hover table-bordered">
				<tr>
					<td style="width:70%"><strong>#Subspecies-specific genes</strong></td>
					<td style="width:30%">853</td>
				</tr>
				<tr>
					<td style="text-indent:15px">#<i>Indica</i>-specific genes</td>
					<td>587</td>
				</tr>
				<tr>
					<td style="text-indent:15px">#<i>Japonica</i>-specific genes</td>
					<td>147</td>
				</tr>
				<tr>
					<td style="text-indent:15px">#AUS-specific genes</td>
					<td>67</td>
				</tr>
				<tr>
					<td style="text-indent:15px">#ARO-specific genes</td>
					<td>52</td>
				</tr>
				</table>
				<table class="table table-striped table-hover table-bordered">
				<tr>
					<td style="width:70%"><strong>#Subgroup-unbalanced genes</strong></td>
					<td style="width:30%">11,581</td>
				</tr>
				<tr>
					<td style="text-indent:15px">#<i>Indica</i>-subgroup-unbalanced genes</td>
					<td>9,816</td>
				</tr>
				<tr>
					<td style="text-indent:15px">#<i>Japonica</i>-subgroup-unbalanced genes</td>
					<td>3,418</td>
				</tr>
				</table>
				<table class="table table-striped table-hover table-bordered">
				<tr>
					<td style="width:70%"><strong>#Random genes</strong></td>
					<td style="width:30%">5,316</td>
				</tr>
				</table>
				<p><a href="about.php#geneCate">Terminology specification</a></p> -->
		   		</div>

			</div>
		</div>
	<!-- <div id="map" style="height: 600px" class="col-md-12"></div> -->
	
	

	<script>
		require.config({
			paths:{
				echarts: './js/echarts-2.2.7/build/dist'
			}
		});
		require(
		[
			'echarts',
			'echarts/chart/map'
		],
		function (ec){
			var myChart = ec.init(document.getElementById('map'));
			option = {
			    title : {
			        text: '3K Rice Distribution Map',
			        x:'center',
			        y:'top'
			    },
			    tooltip : {
			        trigger: 'item',
			        formatter: "{b} : {c} "
			    },
			    toolbox: {
			        show : true,
			        orient : 'vertical',
			        x: 'right',
			        y: 'center',
			        feature : {
			            dataView : {show: true, readOnly: false, title:'Data view', lang:['Data View', 'Close','Refresh']},
			            restore : {show: true, title:'Restore'},
			            saveAsImage : {show: true, title:'Save image'}
			        }
			    },
			    dataRange: {
			        min: 0,
			        max: 50,
			        text:['High','Low'],
			        realtime: false,
			        calculable : true,
			        color: ['orangered','yellow','lightskyblue']
			    },
			    series : [
			        {
			            type: 'map',
			            mapType: 'world',
			            roam: true,
			            mapLocation: {
			                y : 60
			            },
			            itemStyle:{
			                emphasis:{label:{show:true}}
			            },
			            data:[
							{name : 'Afghanistan', value : 1},
			                {name : 'Albania', value : 1},
			                {name : 'Argentina', value : 11},
			                {name : 'Australia', value : 13},
			                {name : 'Austria', value : 1},
			                {name : 'Burundi', value : 3},
			                {name : 'Belgium', value : 1},
			                {name : 'Benin', value : 1},
			                {name : 'Burkina Faso', value : 8},
			                {name : 'Bangladesh', value : 186},
			                {name : 'Bulgaria', value : 10},
			                {name : 'Bolivia', value : 1},
			                {name : 'Brazil', value : 29},
			                {name : 'Brunei', value : 2},
			                {name : 'Bhutan', value : 18},
			                {name : 'Chile', value : 1},
			                {name : 'China', value : 515},
			                {name : 'Ivory Coast', value : 25},
			                {name : 'Cameroon', value : 2},
			                {name : 'Colombia', value : 23},
			                {name : 'Cuba', value : 6},
			                {name : 'Dominican Republic', value : 1},
			                {name : 'Ecuador', value : 4},
			                {name : 'Egypt', value : 8},
			                {name : 'Spain', value : 10},
			                {name : 'Fiji', value : 1},
			                {name : 'France', value : 10},
			                {name : 'Georgia', value : 2},
			                {name : 'Ghana', value : 5},
			                {name : 'Guinea', value : 8},
			                {name : 'Gambia', value : 7},
			                {name : 'Guinea Bissau', value : 4},
			                {name : 'Greece', value : 4},
			                {name : 'Guatemala', value : 3},
			                {name : 'French Guiana', value : 1},
			                {name : 'Guyana', value : 3},
			                {name : 'Haiti', value : 1},
			                {name : 'Hungary', value : 7},
			                {name : 'Indonesia', value : 248},
			                {name : 'India', value : 434},
			                {name : 'Iran', value : 10},
			                {name : 'Italy', value : 38},
			                {name : 'Japan', value : 54},
			                {name : 'Kenya', value : 8},
			                {name : 'Cambodia', value : 59},
			                {name : 'South Korea', value : 35},
			                {name : 'Laos', value : 126},
			                {name : 'Liberia', value : 20},
			                {name : 'Sri Lanka', value : 54},
			                {name : 'Madagascar', value : 66},
			                {name : 'Mexico', value : 6},
			                {name : 'Mali', value : 7},
			                {name : 'Myanmar', value : 75},
			                {name : 'Mozambique', value : 1},
			                {name : 'Malawi', value : 1},
			                {name : 'Malaysia', value : 75},
			                {name : 'Niger', value : 1},
			                {name : 'Nigeria', value : 12},
			                {name : 'Nicaragua', value : 1},
			                {name : 'Netherlands', value : 1},
			                {name : 'Norway', value : 1},
			                {name : 'Nepal', value : 44},
			                {name : 'New Zealand', value : 1},
			                {name : 'Pakistan', value : 34},
			                {name : 'Panama', value : 1},
			                {name : 'Peru', value : 6},
			                {name : 'Philippines', value : 229},
			                {name : 'North Korea', value : 7},
			                {name : 'Portugal', value : 24},
			                {name : 'Paraguay', value : 1},
			                {name : 'Romania', value : 3},
			                {name : 'Russia', value : 2},
			                {name : 'Senegal', value : 22},
			                {name : 'Solomon Islands', value : 1},
			                {name : 'Sierra Leone', value : 19},
			                {name : 'Suriname', value : 9},
			                {name : 'Chad', value : 1},
			                {name : 'Thailand', value : 147},
			                {name : 'Turkey', value : 1},
			                {name : 'United Republic of Tanzania', value : 6},
			                {name : 'Uganda', value : 1},
			                {name : 'Uruguay', value : 2},
			                {name : 'United States of America', value : 49},
			                {name : 'Venezuela', value : 4},
			                {name : 'Vietnam', value : 55},
			                {name : 'Zambia', value : 2},
			                {name : 'Zimbabwe', value : 1}
			            ]
			        }
			    ]
			};
			myChart.setOption(option);
		}
	);
	</script>
</div> <!-- end for container -->
<?php include 'include/footer.php' ?>
</body>
</html>
