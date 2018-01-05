<?php
	session_start();
	$pagestartime=microtime();
	if(!isset($_SESSION['userid'])){
		header("Location:login.php");
		exit();
	}
	if($_POST["paraIndex"]){
		$paraIndex=$_POST["paraIndex"];
	}else{
		$paraIndex="init";
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
	<script src="libs/angular.min.js"></script>
	
</head>
<body ng-controller="SampleCtrl">
	<?php include 'include/header.php' ?>
		<div class="container">
			<div class="page-header">
				<h1>Gastric Carcinoma Accessions Information Table</h1>
			</div>
			<h4>Browse options:</h4>
			<p style="margin-left:1%"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NOTE:</strong><em> the browsed result is the intersection of all the different options!</em></p>
			<p style="text-indent:30px">Users should check the filters and click <b>"Refresh table"</b> to acquire the needed accessions. After selecting some accessions, please click <b>"Visualization"</b> or <b>"Summary"</b> button below.</p>
		</div>
		<!-- <p style="margin-left:1%"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NOTE:</strong><em> the browsed result is the intersection of all the different options!</em></p>
		<p style="text-indent:30px">Users should check the filters and click <b>"Refresh table"</b> to acquire the needed accessions. After selecting some accessions, please click <b>"Visualization"</b> or <b>"Summary"</b> button below.</p> -->
		<form style="margin-left:5%">
		<!-- <form> -->
			<table>
				<tr ng-repeat="para in paras">
					<td><strong>{{para.name}}</strong><br>&nbsp;&nbsp;&nbsp;&nbsp;
						<!-- <input type="checkbox" name="{{para.allLabel}}" checked='checked' onclick="check_all(this,para.para_array)"> ALL
						<input type="checkbox" ng-repeat="p in para.para_array" checked='checked' value="{{p}}"> p -->
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
								<!-- <td style="border:0px !important;" width=80 align="right"><input type="submit" value="Visualization" onclick="vs()"></td>
								<td style="border:0px !important;" width=80 align="right"><input type = "submit" value = "Summary" onclick="sm()"></td> -->
								<td style="border:0px !important;" width=80 align="right"><input type = "submit" value = "Summary" onclick="sm()"></td>
								<td style="border:0px !important;" width=80 align="right"><input type = "submit" value = "Visualization" ng-click="visual()">
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
							<td class = "center"><input type="checkbox" name="selection[]" value="{{r.WGC_ID}}" ng-click="selectOne()" ng-checked="r.isChecked"></td>
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
		</div>
		<div>
			<input type="text" name="paraIndex" id="paraIndex" value="<?php echo $paraIndex?>" style="display:none">
		</div>

<script>
		var GCApp=angular.module('GCApp',['GCApp.controllers']);
		angular.module('GCApp.controllers',[])
		.controller('SampleCtrl',function($scope,RequestData){
			// $scope.paras=[{name:'Type',array:type[],all:"ALL_t"},'subType','Gender','Location','Borrman','Grade','Lauren','Meta','Vessel','TNM_stage','Radical_cure','status','Blood_Type','CEA','CA724','AFP26'];
			$scope.all="true";
			var paras=new Array();
			var para_data=new Array();
			var para={};
			para.name='Type';
			para.para_data=['N','T'];
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
			$scope.visual=visual;

			firstLoad();

			function firstLoad(){
				//paraInit
				var paraIndexContext=$("#paraIndex").val();
				var paraIndexTmp=paraIndexContext.split(";");
				var paraIndex={};
				for(var i=0;i<(paraIndexTmp.length-1);i++){
					var tmp=paraIndexTmp[i].split(":");
					paraIndex[tmp[0]]=tmp[1];
				}
				
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
						var sumcheck=0;
						for(var i=0;i<$scope.results.length;i++){
							if(paraIndex[$scope.results[i].WGC_ID]){
								$scope.results[i].isChecked=parseInt(paraIndex[$scope.results[i].WGC_ID]);
								if($scope.results[i].isChecked){
									sumcheck++;
								}
							}else{
								$scope.results[i].isChecked=0;
							}
						}
						var itembox = document.getElementById("sumitems");
						itembox.innerHTML=sumcheck + ' items selected ';
					});
				});
				

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
			function visual(){
				document.getElementById("sum_form").action="visualization/visualization.php";
				document.getElementById("sum_form").submit();
			}
			
			
			

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
</body>
</html>
