var Data={
	name:"data",
	value:[],
	TreeJson: {},
	key:'',
	getData:function(data){
		this.value=data;
	},
	getPieData:function(data,key){
		var PieObj={};
		var PieData=new Array();
		var selectedKey=new Array();
		for(var i in data){
			var c=data[i];
			for(var j in c){
				if(j==key){
					selectedKey.push(c[j]);
				}
			}
		}
		var UniqueKey=new Array();
		UniqueKey=selectedKey.unique3();
		for(var i=0; i<UniqueKey.length;i++){
			PieObj[UniqueKey[i]]=0;
		}
		for(var i=0;i<selectedKey.length;i++){
			PieObj[selectedKey[i]]++;
		}
		for(var i in PieObj){
			PieData.push([i,PieObj[i]]);
		}

		this.value=PieData;
		this.key=key;

	},
	getTree:function(data){
		var dataTree = {};
		dataTree.name = "Sample";
		dataTree.children = new Array();
		var keyArr = new Array();
		for (var i in data[0]) {
			keyArr.push(i);
		}

		for (var i = 0; i < data.length; i++) {
			var o = {};
			var obj = data[i];
			var keyCount = keyArr.length;
			o.level=keyArr[keyCount - 1];
			o.name = obj[keyArr[keyCount - 1]];
			keyCount = keyCount - 1;
			while (keyCount > 0) {
				var o1 = {};
				var k = keyArr[keyCount - 1];
				o1.level=k;
				o1.name = data[i][k];
				o1.children = new Array();
				o1.children.push(o);
				o = o1;
				keyCount = keyCount - 1;
			}
			dataTree.children.push(o);
		}
		this.TreeJson=dataTree;
	}
};

// var width=300;
// var height=300;
// var svg1=d3.select("#one_prototype")
// 		.append("svg")
// 		.attr("width",width)
// 		.attr("height",height);

// var p=d3.select("p");

// plotPie(data,"gender",svg1,width,height);

// var width = 450;
// var height = 500;
// var svg2 = d3.select("#total")
// 	.append("svg")
// 	.attr("width", width)
// 	.attr("height", height)

// plotTreePie(data,svg2);
var selectedSamples="";
function plotPie(data,key,svg,width,height,selectedSamplesName,pairedSamplesName){
	Data.getPieData(data,key);
	var pie=d3.layout.pie()
		  .value(function(d){
		  	return d[1];
		  });
	var piedata=pie(Data.value);
	var outerRadius=width/3;
	var innerRadius=width/6;

	var tooltip=d3.select("body")
				  .append("div")
				  .attr("class","tooltip")
				  .style("opacity",0.0);

	var selectedSamplesArea=d3.select("#selectButton");

	// var selectButton=d3.select("body")
	// 				   .append("div")
	// 				   .attr("class","selectButton")
	// 				   .attr("opacity",0.0)

	var arc=d3.svg.arc()
			  .innerRadius(innerRadius)
			  .outerRadius(outerRadius);

	var arc1=d3.svg.arc()
			   .innerRadius(innerRadius)
			   .outerRadius(outerRadius+10);

	var color=d3.scale.category20();

	var arcs=svg.selectAll("g")
				.data(piedata)
				.enter()
				.append("g")
				.attr("transform","translate("+(width/2)+","+(height/2)+")");

	arcs.append("path")
		.attr("fill",function(d,i){
			return color(i);
		})
		.attr("d",function(d){
			return arc(d);
		}).on("mouseover",function(d,i){

			d3.select(this)
			  .style("opacity",0.2)
			  .attr("d",arc1);
			var percent=Number(d.value)/d3.sum(Data.value,function(d){
				return d[1];
			})*100;
			var percent_text=d.data[0]+":"+percent.toFixed(1)+"%";

			tooltip.html(percent_text)
				   .style("left",(d3.event.pageX)+"px")
				   .style("top",(d3.event.pageY+20+"px"))
				   .style("opacity",1.0);

		}).on("mousemove",function(d,i){
			d3.select(this)
			  .style("opacity",0.2)
			  .attr("d",arc1);
			var percent=Number(d.value)/d3.sum(Data.value,function(d){
				return d[1];
			})*100;
			var percent_text=d.data[0]+":"+percent.toFixed(1)+"%";

			tooltip.html(percent_text)
				   .style("left",(d3.event.pageX)+"px")
				   .style("top",(d3.event.pageY+20+"px"))
				   .style("opacity",1.0);

		}).on("mouseout",function(d,i){
			d3.select(this)
			  // .style("fill",color(i))
			  .style("opacity",1.0)
			  .attr("d",arc);
			tooltip.style("opacity",0.0);
		}).on("click",function(d,i){
			var current_key=Data.key;
			for(var i in selectedSamplesName){
				selectedSamplesName[i]=0;
			}
			var pairedSamplesArr=pairedSamplesName.split(",");
			var pairedSamplesName_obj={};
			for(var i=0; i<pairedSamplesArr.length-1;i++){
				var tmp=pairedSamplesArr[i].split(":");
				pairedSamplesName_obj[tmp[0]]=tmp[1];
			}
			// console.log(pairedSamplesName_obj);

			selectedSamples="<p>Sample:</p>";
			for(var i=0;i<data.length;i++){
				if(data[i][current_key]===d.data[0]){
					data[i]['checked']=1;
					selectedSamplesName[data[i]["WGC_ID"]]=1;
					selectedSamples+="<input type=\"checkbox\" checked=\"true\" name=\"selectedCheckbox\" value=\""+data[i]["WGC_ID"]+"\"/><label>"+data[i]["WGC_ID"]+"</label>";
				}
			}

			selectedSamples+="<br><br><p>select control sample:<\/p>";
			selectedSamples+="<label><input type=\"radio\" name=\"control\" value=\"\"\/>yes<\/label>";
			selectedSamples+="<label><input type=\"radio\" name=\"control\" value=\"\" checked=\"checked\" \/>no<\/label>";
			selectedSamples+="<br><input type=\"submit\" class=\"btn btn-success selectedBtn\" value=\"selected\"/>";

			selectedSamplesArea.html(selectedSamples)
				   		.style("left",(d3.event.pageX)+"px")
				   		.style("top",(d3.event.pageY+20+"px"))
				   		.style("opacity",1.0);

			//是否同时选中对照组
			var isSelectControl=document.getElementsByName("control")[0].checked;
			$('input:radio[name="control"]').change(function(){
				isSelectControl=document.getElementsByName("control")[0].checked;
				if(isSelectControl){
					$('input:checkbox[name="selectedCheckbox"]').each(function(){
						if($(this).get(0).checked){
							selectedSamplesName[$(this).val()]=1;
							if(isSelectControl){
								selectedSamplesName[pairedSamplesName_obj[$(this).val()]]=1;
							}
						}else{
							selectedSamplesName[$(this).val()]=0;
							selectedSamplesName[pairedSamplesName_obj[$(this).val()]]=0;
						}
					});
				}
			});

			$('input:checkbox[name="selectedCheckbox"]').change(function(){
				if($(this).get(0).checked){
					selectedSamplesName[$(this).val()]=1;
					if(isSelectControl){
						selectedSamplesName[pairedSamplesName_obj[$(this).val()]]=1;
					}
				}else{
					selectedSamplesName[$(this).val()]=0;
					selectedSamplesName[pairedSamplesName_obj[$(this).val()]]=0;
				}
			});

			$(".selectedBtn").click(function(){
				var paraIndex='';
				for(var i in selectedSamplesName){
					paraIndex+=i+":"+selectedSamplesName[i]+";";
				}
				$("#paraIndex").val(paraIndex);
				// $("#selectSamplesNameForm").action="sss.php";
				// $("#selectSamplesNameForm").submit();
				
			});
		});

	arcs.append("text")
		.attr("transform",function(d){
			var x=arc.centroid(d)[0]*1;
			var y=arc.centroid(d)[1]*1;
			return "translate("+x+","+y+")";
		})
		.attr("text-anchor","middle")
		.text(function(d){
			var percent=Number(d.value)/d3.sum(Data.value,function(d){
				return d[1];
			})*100;
			var percent_text=d.data[0]+":"+percent.toFixed(1)+"%";
			if(percent>10){
				return percent_text;
			}else if(percent>1){
				return d.data[0];
			}else{
				return '';
			}
			
		});
}

function plotTreePie(data,svg,selectedSamplesName,pairedSamplesName){
	for(var i=0;i<data.length;i++){
		data[i]['checked']=0;
	}
	Data.getTree(data);
	var dataTree = {};
	dataTree = Data.TreeJson;
	// console.log(dataTree);
	
	var partition=d3.layout.partition()
					.sort(null)
					.size([2*Math.PI,200*200])
					.value(function(d){return 1;});
	
	
	var nodes = partition.nodes(dataTree);
	var links = partition.links(nodes);
	var color = d3.scale.category20();
	var tooltip=d3.select("body")
				  .append("div")
				  .attr("class","tooltip")
				  .style("opacity",0.0);

	var One_sample=d3.select("#one_sample");
	
	var arc=d3.svg.arc()
			  .startAngle(function(d){return d.x;})
			  .endAngle(function(d){return d.x+d.dx;})
			  .innerRadius(function(d) {return Math.sqrt(d.y);})
			  .outerRadius(function (d) { return Math.sqrt(d.y+d.dy);});
	
	var arc1=d3.svg.arc()
			  .startAngle(function(d){return d.x;})
			  .endAngle(function(d){return d.x+d.dx;})
			  .innerRadius(function(d) {return Math.sqrt(d.y);})
			  .outerRadius(function (d) { return Math.sqrt(d.y+d.dy)+20;})
	
	var gArcs=svg.selectAll("g")
				  .data(nodes)
				  .enter()
				  .append("g")
				  .attr("transform","translate("+230+","+250+")");
				  
	
	gArcs.append("path")
		 .attr("display",function(d){
			 return d.depth?null:"none";
		 })
		 .attr("d",arc)
		 .style("stroke","#fff")
		 .style("fill",function(d,i){
			return color(i);
		 }).on("mouseover",function(d,i){
			d3.select(this)
			  .style("fill","yellow")
			  .attr("d",arc1);
			tooltip.html(d.level+":"+d.name)
				   .style("left",(d3.event.pageX)+"px")
				   .style("top",(d3.event.pageY+20+"px"))
				   .style("opacity",1.0);

			var tmpObj=d;
			while(tmpObj.level!="WGC_ID"){
				tmpObj=tmpObj.parent;
			}
			var id=tmpObj.name;
			
			for(var i=0;i<data.length;i++){
				if(id==data[i].WGC_ID){
					var one_sample_data=data[i];
					break;
				}		
			}

			var one_sample_content='<br>';

			for(var i in one_sample_data){
				one_sample_content+=i+':'+one_sample_data[i]+"<br>";
			}
			one_sample_content+='<br>';
			One_sample.html(one_sample_content);
			One_sample.style("background","#F5F5F5")
					  .style("border-radius","25px")
					  .style("font-size","14px");

			// d3.select("#one_prototype").html("");
			// var width=300;
			// var height=300;
			// var p_offset=height/2;

			// var p_left=p_offset-20;
			// var p_top=p_offset-10;
			// p_left=p_left+"px";
			// p_top=p_top+"px";
			
			// var p=d3.select("#one_prototype")
			// 		.append("p")
			// 		.style("position","absolute")
			// 		.style("margin-left",p_left)
			// 		.style("margin-top",p_top);

			
			// var svg1=d3.select("#one_prototype")
			// 		.append("svg")
			// 		.attr("width",width)
			// 		.attr("height",height);

			// plotPie(data,d.level,svg1,width,height,selectedSamplesName);
			// p.html(d.level);			

		}).on("mouseout",function(d,i){
			d3.select(this)
			  .style("fill",color(i))
			  .attr("d",arc);
			tooltip.style("opacity",0.0);
		}).on("click",function(d,i){

			d3.select("#one_prototype").html("");
			var width=300;
			var height=300;
			var p_offset=height/2;

			var p_left=p_offset-20;
			var p_top=p_offset-10;
			p_left=p_left+"px";
			p_top=p_top+"px";
			
			var p=d3.select("#one_prototype")
					.append("p")
					.style("position","absolute")
					.style("margin-left",p_left)
					.style("margin-top",p_top);

			
			var svg1=d3.select("#one_prototype")
					.append("svg")
					.attr("width",width)
					.attr("height",height);
			plotPie(data,d.level,svg1,width,height,selectedSamplesName,pairedSamplesName);

			p.html(d.level);	
		});
}



	
















