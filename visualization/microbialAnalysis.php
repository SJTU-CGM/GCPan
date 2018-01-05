<!DOCTYPE html>
<?php include '../include/connect.php'; ?>

<html ng-app="GCApp">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Microbiome Analysis</title>
    <link rel="stylesheet" href="../libs/bootstrap-3.3.6/css/bootstrap.css">
    <script src="../libs/jquery-2.1.4.min.js"></script>
    <script src="../libs/bootstrap-3.3.6/js/bootstrap.min.js"></script>
    <script src="../libs/angular.min.js"></script>
    <script src="../libs/echarts.common.min.js"></script>
    <link rel="stylesheet" href="../css/main.css">
    <script src="js/toolbar.js"></script>
    <script src="js/main.js"></script>
    <script>
    	var GCApp=angular.module('GCApp',['GCApp.controllers']);
		angular.module('GCApp.controllers',[])
		.controller('MicrobialAnalysisCtrl',function($scope){
			var sample_ids=new Array();
			sample_ids = <?php
					if (isset($_POST['selection'])) {
						$selected_samples=$_POST['selection'];
						echo "['".implode("','", $_POST['selection'])."']";
					}else{
						echo "0";
					}
                   ?>;
            console.log(sample_ids);

			var url="../db/microbials.txt";
			function LoadFile(url){
				var content;
				$.ajax({
					url:url,
					dataType:'text',
					async : false,
					success:function(data){
						content=data;
					}
				});
				return content;
			}

			var content=LoadFile(url);
			var lines=new Array();
			lines=content.split("\n");
			var levels=lines[0].split("\t");
			var names=lines[1].split("\t");
			var row=lines.length;
			var col=levels.length;
			var samples_count=sample_ids.length;
			var level="phylum";
			var legend=new Array();
			var index=new Array();
			var series_data=new Array();
			

			for(i=1;i<col;i++){
				if(levels[i]==level){
					legend.push(names[i]);
					index.push(i);
				}
			}

			var sample_index=new Array();
			for(i=0;i<sample_ids.length;i++){
				for(j=2;j<row;j++){
					var tmp=lines[j].split("\t");
					if(tmp[0]==sample_ids[i]){
						sample_index.push(j);
						break;
					}

				}
			}

			var level_sum=new Array();

			for(i=0;i<index.length;i++){
				var series_one=new Array();
				var series_obj={};
				series_obj.name=names[index[i]];
				series_obj.type='line';
				series_obj.stack='total';
				series_obj.areaStyle={normal:{}};
				var s=0;
				for(j=0;j<sample_index.length;j++){
					tmp=lines[sample_index[j]].split("\t");
					series_one.push(tmp[index[i]]);
					s=s+parseFloat(tmp[index[i]]);
				}
				level_sum.push(s);
				series_obj.data=series_one;
				series_data.push(series_obj);

			}

			var sortedIndex=sortIndex(level_sum).indexs;

			var sortedLegend=new Array();
			var sortedSeries_data=new Array();
			for(i=sortedIndex.length-1;i>=0;i--){
				sortedLegend.push(legend[sortedIndex[i]]);
				sortedSeries_data.push(series_data[sortedIndex[i]]);
			}

			function sortIndex(myArray){
				var c= new Array(); 
				var s=new Array();
				var orderdatatmp = myArray;
				var orderdata= new Array();
				var orderLength = orderdatatmp.length;
				for(var i=0;i<orderLength;i++){
					if(orderdatatmp[i]=="N"){
						orderdata[i]=0.01;
					}
					else{
						orderdata[i]=parseFloat(orderdatatmp[i]);
					}
				}
				

				
				var temp,tp;
				for(var l =0;l<orderLength ;l++) c[l]=l;
				for (var i=0;i<orderLength ;i++)
				{
					for (var j = 0; j < orderLength - i-1; j++)
					{
						if(orderdata[j] > orderdata[j+1])
						{ 
							temp = orderdata[j];
							orderdata[j] = orderdata[j+ 1];
							orderdata[j + 1] = temp;
							tp = c [j];
							c[j] = c[j+1];
							c[j+1] = tp;
						}
					}
				}

				for(var i=0;i<c.length;i++){
					s[i]=orderdata[c[i]];
				}
				var sortResult={};
				sortResult.indexs=c;
				sortResult.values=orderdata;
				return sortResult;
			}

			var myChart=echarts.init(document.getElementById('main'));
			myChart.clear();
			var option={
				title:{text:''},
				tooltip:{trigger:'axis'},
				toolbox:{feature:{saveAsImage:{}}},
				grid:{top:'20%',left:'3%',right:'4%',bottom:'3%',containLabel:true},
				legend:{
					top:'5%',
					data:sortedLegend,
				},
				xAxis:[
					{
						type:'category',
						boundaryGap:false,
						data:sample_ids
					}
				],
				yAxis:[
					{
						type:'value'
					}
				],
				series:sortedSeries_data
			};
			myChart.setOption(option);
		})
    </script>
  </head>

  <body ng-controller="MicrobialAnalysisCtrl">
  	<?php include '../include/header.php' ?>
	  <div class="container">
	  	<h1>Microbiome Analysis</h1>
	    <!-- <div class="col-sm-4">
	      <select ng-model="selectedPara" class="btn btn-default col-sm-8">
	        <option ng-repeat="x in paras" value="{{x.index}}">{{x.name}}</option>
	      </select>
	      <label>{{selectedPara}}</label>
	      
	    </div>
	    <div class="col-sm-4">
	      <a class="btn btn-primary" ng-click="selectParaFun(selectedPara)">plot</a>
	    </div>  --> 
	    
	  </div>
	  
	  <div id="main" style="width:1000px;height:600px;">
	  </div>  
	    
	  <!-- <script src="./js/my.js"></script> -->
	  
	</body>
</html>
