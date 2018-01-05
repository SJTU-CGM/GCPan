<?php
	session_start();
	$pagestartime=microtime();
	if(!isset($_SESSION['userid'])){
		header("Location:login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en" ng-app="GCApp">
<head>
	<meta charset="UTF-8">
	<?php include 'include/libs.php' ?>
	<title>Gastric Carcinoma table</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/rice_table.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<style>
	.tooltip{
		position:absolute;
		width:200;
		height:auto;
		font-family: simsun;
		font-size:10px;
		text-align: center;
		border-style:solid;
		border-width: 2px;
		background-color: white;
		border-radius: 5px;
	}
	.selectButton{
		position:absolute;
		width:200;
		height:auto;
		font-family: simsun;
		font-size:10px;
		text-align: center;
		padding: 15px;
		border-style:solid;
		border-width: 1px;
		background-color: white;
		border-radius: 5px;
		opacity:0.0;
	}
	</style>
	<script src="libs/angular.min.js"></script>
	<script>
		var GCApp=angular.module('GCApp',['GCApp.controllers']);
		angular.module('GCApp.controllers',[])
		.controller('SampleNewCtrl',function($scope,RequestData){
			$scope.all="true";
			var paras=new Array();
			var para_data=new Array();
			var para={};
			para.name='Type';
			// para.para_data=['N','T'];
			para.para_data=['T'];
			para.allLabel='ALL_Type';
			paras.push(para);
			var para={};
			para.name='subType';
			para.para_data=['','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18'];
			para.allLabel='ALL_subType';
			paras.push(para);
			$scope.paras=paras;
			$scope.Refresh=Refresh;
			$scope.checkALL=checkALL;
			$scope.selectOne=selectOne;
			$scope.selectAll=selectAll;
			$scope.ma=ma;
			$scope.all="true";
			$scope.checkChange=checkChange;
			// $scope.goToSampleTable=goToSampleTable;


			firstLoad();

			function firstLoad(){
				var selectParas=$scope.paras[0].name+"."+$scope.paras[0].para_data[0];
				for(var i=0;i<$scope.paras.length;i++){
					for(var j=1;j<$scope.paras[i].para_data.length;j++){
						selectParas=selectParas+";"+$scope.paras[i].name+"."+$scope.paras[i].para_data[j];
					}
				}
				var para={'selectParas':selectParas};
				$scope.results="";
				RequestData.operateData('selectSamples.php',para,function(data){
					$scope.$apply(function(){
						$scope.results=data.samplesList;
						var width=300;
						var height=300;
						var svg1=d3.select("#one_prototype")
								.append("svg")
								.attr("width",width)
								.attr("height",height);

						var p=d3.select("p");

						plotPie($scope.results,"gender",svg1,width,height);

						var width = 450;
						var height = 500;
						var svg2 = d3.select("#total")
							.append("svg")
							.attr("width", width)
							.attr("height", height)

						var items=new Array();
						for(i in $scope.results[0]){
							if(i!='WGC_ID'){
								items.push(i);
							}
							
						}
						$scope.items=items;
						var selectedSamplesName={};
						var pairedSamplesName="";
						for(var i=0;i<$scope.results.length;i++){
							var ele=$scope.results[i]['WGC_ID'];
							var ele_pair=$scope.results[i]['paired_ID'];
							selectedSamplesName[ele]=0;
							pairedSamplesName+=ele+":"+ele_pair+",";
							// selectedSamplesName.push({name:ele,checked:1});
						}

						plotTreePie($scope.results,svg2,selectedSamplesName,pairedSamplesName);

					});
				});

			}

			function checkChange(){
				var items=new Array();
				$('input[class="checkbox"]:checked').each(function(){
						items.push($(this).val());
				});

				var update_results=new Array();
				for(var i=0;i<$scope.results.length;i++){
					var item={};
					var result=$scope.results[i];
					item['WGC_ID']=result['WGC_ID'];
					for(var j=0;j<items.length;j++){
						item[items[j]]=result[items[j]];
					}
					update_results.push(item);
				}

				var width=300;
				var height=300;
				var svg1=d3.select("#one_prototype")
							.append("svg")
							.attr("width",width)
							.attr("height",height);

				var p=d3.select("p");

				// plotPie(update_results,"gender",svg1,width,height);

				var width = 450;
				var height = 500;
				d3.select("#total").html("");
				var svg2 = d3.select("#total")
							.append("svg")
							.attr("width", width)
							.attr("height", height)

				// var items=new Array();
				// 	for(i in $scope.results[0]){
				// 		if(i!='WGC_ID'){
				// 			items.push(i);
				// 		}
							
				// }
				// $scope.items=items;

				plotTreePie(update_results,svg2);
			}

			function checkALL(){
			}

			function Refresh(){
				console.log(paras);
				var selectedElement=new Array();
				var selectParas='';
				selectedElement=$("input[name='paras_v']");
				console.log(selectedElement.length);
				for(var i=0;i<selectedElement.length;i++){
					if(selectedElement[i].checked){
						if(selectParas.length==0){
							selectParas=selectedElement[i].value;
						}
						selectParas=selectParas+";"+selectedElement[i].value;
					}
				}
				var para={'selectParas':selectParas};
				$scope.results="";
				RequestData.operateData('selectSamples.php',para,function(data){
					$scope.$apply(function(){
						$scope.results=data.samplesList;
						console.log(data.samplesList);
					});
				});
				
				
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
			function ma(){
				document.getElementById("sum_form").action="visualization/microbialAnalysis.php";
				document.getElementById("sum_form").submit();
			}
			
			// function goToSampleTable(){
			// 	console.log("ok");
			// 	// var samplesCheckBoxs=$(".selectedCheckbox");
			// 	// console.log(samplesCheckBoxs);
			// }

		}).factory('RequestData',['$http',function(){
			var service={
				operateData:operateData,
			};

			return service;

			function operateData(url,para,succFn){
				$.ajax({
					url:url,
					type:'post',
					data:para,
					dataType: 'json',
					success:function(data,status){
						succFn(data);
					},
					error:function(data,status,e){
						console.log(e);
					}
				})
			}
		}]);
	</script>
</head>
<body ng-controller="SampleNewCtrl" style="background:#F5F5F5">
	<?php include 'include/header.php' ?>
		<!-- <div class="container">
			<div class="page-header">
				<h1>Gastric Carcinoma Accessions Information Table</h1>
			</div>
			<h4>Browse options:</h4>
			<p style="margin-left:1%"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NOTE:</strong><em> the browsed result is the intersection of all the different options!</em></p>
			<p style="text-indent:30px">Users should check the filters and click <b>"Refresh table"</b> to acquire the needed accessions. After selecting some accessions, please click <b>"Visualization"</b> or <b>"Summary"</b> button below.</p>
		</div> -->
		<!-- <form style="margin-left:5%">
			<table>
				<tr ng-repeat="para in paras">
					<td><strong>{{para.name}}</strong><br>&nbsp;&nbsp;&nbsp;&nbsp;
						<div style="float:left">
							<input type="checkbox" ng-model="all" ng-checked="true" ng-click="checkALL()"> ALL&nbsp;
						</div>
						<div style="float:left" ng-repeat="p in para.para_data">
							<input type="checkbox" ng-checked="all" value="{{para.name+'.'+p}}" name="paras_v"> 
							<span ng-show="p.length==0">
								normal
							</span>
							<span ng-show="p.length>0">
								{{p}}
							</span>
							&nbsp;
						</div>
					</td>
				</tr>
			</table>
			<input type="submit" value=" Refresh table " id="submit_option" ng-click="Refresh()">
		</form>
		<hr />
		<div id="sselist" class=tablelist style="margin-left:5%">
			<form method = "post" action="" id="sum_form" name = "summary" target ="_blank">
				<div id="sumbox">
					<table cellspacing="0" cellpadding="0" style="width:100%;border:0px !important;" align="right">
						<tbody>
							<tr>
								<td style="border:0px !important;" id="sumitems" align="right">0 items selected</td>
								<td style="border:0px !important;" width=10 align="right">&nbsp;&nbsp;</td>
								<td style="border:0px !important;" width=80 align="right"><input type = "submit" value = "microbiome analysis" ng-click="ma()">
								<td width="50" style="border:0px !important;" align="right">&nbsp;&nbsp;</td>
							</tr>
						</tbody>
					</table>
				</div>

				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td width=100>
							<input type=checkbox ng-click="selectAll()" name="controlAll" id="controlAll"> Check All
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
					<tbody>
						<tr class = "trlist" ng-repeat="r in results">
							<td class = "center"><input type="checkbox" name="selection[]" value="{{r.WGC_ID}}" ng-click="selectOne()"></td>
							<td>{{r.WGC_ID}}</td>
							<td>{{r.Original_Sample_Name}}</td>
							<td>{{r.Type}}</td>
							<td>{{r.RNASeq_ID}}</td>
							<td>{{r.subType}}</td>
							<td>{{r.Gender}}</td>
							<td>{{r.Age}}</td>
							<td>{{r.Location}}</td>
							<td>{{r.Borrman}}</td>
							<td>{{r.Diameter}}</td>
							<td>{{r.Grade}}</td>
							<td>{{r.Lauren}}</td>
							<td>{{r.Node}}</td>
							<td>{{r.Node_positive}}</td>
							<td>{{r.Depth}}</td>
							<td>{{r.Meta}}</td>
							<td>{{r.Vessel}}</td>
							<td>{{r.TNM_stage}}</td>
							<td>{{r.Radical_cure}}</td>
							<td>{{r.status}}</td>
							<td>{{r.Time}}</td>
							<td>{{r.Blood_type}}</td>
							<td>{{r.CEA}}</td>
							<td>{{r.CA199}}</td>
							<td>{{r.CA724}}</td>
							<td>{{r.AFP26}}</td>
						</tr>
					</tbody>
					
				</table>
			</form>
		</div> -->
	<div class="row">
		<div class="col-sm-2" style="margin-left:20px">
			<br>
			<input type="checkbox" ng-model="all" ng-checked="true"/><label>Check all</label>
			<div class="item" ng-repeat="i in items">
				<input type="checkbox" ng-checked="all" ng-click="checkChange()" class="checkbox" value="{{i}}"/><label>{{i}}</label></div>
		</div>
		<div class="col-sm-2">
			<div id="one_sample"></div>
		</div>
		<div class="col-sm-5">
			<div id="total"></div>
		</div>
		<div class="col-sm-2" style="margin-left:-150px">
			<div id="one_prototype">
				<p></p>
			</div>
		</div>
		
	</div>
	<form id="selectSamplesNameForm" method="post" action="sample-table.php">
		<!-- <label>select control sample:</label>
		<label><input type="radio" name="control" value=""/>yes</label>
		<label><input type="radio" name="control" value="" checked="checked" />no</label>
		<input type="button" name="" id="test" class="btn btn-success" value="button"/> -->
		<div class="selectButton" id="selectButton">
		</div>
		<input type="text" name="paraIndex" id="paraIndex" value="" style="display:none">
	</form>
	<script>
		$("#test").click(function(){
			if(document.getElementsByName("control")[0].checked){
				console.log(1);
			}else{
				console.log(2);
			}
		});
	</script>
	
	<script src="libs/jquery.min.js"></script>
	<script src="libs/bootstrap.min.js"></script>
	<script src="libs/d3.v3.min.js">
	</script>
	<script src="js/myFun.js">
	</script>
	<script src="js/myD3.js">
	</script>



</body>
</html>
