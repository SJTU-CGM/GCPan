<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>expression</title>
	<?php include 'include/libs.php' ?>
	<link rel="stylesheet" href="css/bootstrap-responsive.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/about.css">
	<script>
		function goTop()
		{
		    $(window).scroll(function(e) {
		        if($(window).scrollTop()>100)
		            $("#gotop").fadeIn(100);//0.1 second to display go top
		        else
		            $("#gotop").fadeOut(100);//0.1 second to hide go top
		    });
		};
		$(function(){
		    //back to top
		    $("#gotop").click(function(e) {
		            //1 second to go top
		            $('body,html').animate({scrollTop:0},100);
		    });
		    $("#gotop").mouseover(function(e) {
		        $(this).css("background","url(pic/backtop.png) no-repeat 0px 0px");
		    });
		    $("#gotop").mouseout(function(e) {
		        $(this).css("background","url(pic/backtop.png) no-repeat -70px 0px");
		    });
		    goTop();//display and hide
		});
	</script>
</head>
<body>
	<?php include 'include/header.php' ?>
	<?php include 'include/connect.php' ?>
	<div id="gotop"></div>
	<div class="container">
		<div class="page-header">
			<h1>Pan-genome Gene Expression Profiles</h1>
			<p style="text-indent: 30px">The pan-genome browser provides 226 RNA-seq runs of rice from 8 tissues.</p>
		</div>

		<div class="row">
		  <div class="col-md-3 bs-docs-sidebar">
		    <ul class="nav nav-list bs-docs-sidenav">
		      <li><a href="#leaf"><i class="icon-chevron-right"></i>leaf</a></li>
		      <li><a href="#root"><i class="icon-chevron-right"></i>root</a></li>
		      <li><a href="#shoot"><i class="icon-chevron-right"></i>shoot</a></li>
		      <li><a href="#anther"><i class="icon-chevron-right"></i>anther</a></li>
		      <li><a href="#pistil"><i class="icon-chevron-right"></i>pistil</a></li>
		      <li><a href="#seed"><i class="icon-chevron-right"></i>seed</a></li>
		      <li><a href="#panicle"><i class="icon-chevron-right"></i>panicle</a></li>
		      <li><a href="#other"><i class="icon-chevron-right"></i>other</a></li>
			</ul>
		  </div>
		
		  <div class="col-md-9">
			<div id="leaf">
				<h4>Leaf</h4>
				<table class="table table-bordered table-hover" style="width : 300px">
				<thead><tr><td>Run ID</td><td>Visualization</td></tr></thead>
				<?php 
					$search_sql = "SELECT `run_id` FROM `expression` WHERE `tissue`='leaf'";
					$query = mysql_query($search_sql);
					while ($rs = mysql_fetch_array($query)) {

				 ?>
				 <tr>
				 	<td><a href="http://www.ncbi.nlm.nih.gov/sra/?term=<?php echo $rs['run_id']; ?>"><?php echo $rs['run_id']; ?></a></td>
				 	<td>
				 		<form action="http://cgm.sjtu.edu.cn/3kricedb/visualization/index.php" method="POST" target="_blank">
							<input type="hidden" name="rna" value="<?php echo 'leaf'.'_'.$rs['run_id'];?>">
							<input type="submit" value="Genome Browser">
						</form>
				 	</td>
				 </tr>
				 <?php 
				 }
				  ?>
				</table>
			</div>

			<div id="root">
				<h4>Root</h4>
				<table class="table table-bordered table-hover" style="width : 300px">
				<thead><tr><td>Run ID</td><td>Visualization</td></tr></thead>
				<?php 
					$search_sql = "SELECT `run_id` FROM `expression` WHERE `tissue`='root'";
					$query = mysql_query($search_sql);
					while ($rs = mysql_fetch_array($query)) {

				 ?>
				 <tr>
				 	<td><a href="http://www.ncbi.nlm.nih.gov/sra/?term=<?php echo $rs['run_id']; ?>"><?php echo $rs['run_id']; ?></a></td>
				 	<td>
				 		<form action="http://cgm.sjtu.edu.cn/3kricedb/visualization/index.php" method="POST" target="_blank">
							<input type="hidden" name="rna" value="<?php echo 'root'.'_'.$rs['run_id'];?>">
							<input type="submit" value="Genome Browser">
						</form>
				 	</td>
				 </tr>
				 <?php 
				 }
				  ?>
				</table>
			</div>
			
			<div id="shoot">
				<h4>Shoot</h4>
				<table class="table table-bordered table-hover" style="width : 300px">
				<thead><tr><td>Run ID</td><td>Visualization</td></tr></thead>
				<?php 
					$search_sql = "SELECT `run_id` FROM `expression` WHERE `tissue`='shoot'";
					$query = mysql_query($search_sql);
					while ($rs = mysql_fetch_array($query)) {

				 ?>
				 <tr>
				 	<td><a href="http://www.ncbi.nlm.nih.gov/sra/?term=<?php echo $rs['run_id']; ?>"><?php echo $rs['run_id']; ?></a></td>
				 	<td>
				 		<form action="http://cgm.sjtu.edu.cn/3kricedb/visualization/index.php" method="POST" target="_blank">
							<input type="hidden" name="rna" value="<?php echo 'shoot'.'_'.$rs['run_id'];?>">
							<input type="submit" value="Genome Browser">
						</form>
				 	</td>
				 </tr>
				 <?php 
				 }
				  ?>
				</table>
			</div>

			<div id="anther">
				<h4>Anther</h4>
				<table class="table table-bordered table-hover" style="width : 300px">
				<thead><tr><td>Run ID</td><td>Visualization</td></tr></thead>
				<?php 
					$search_sql = "SELECT `run_id` FROM `expression` WHERE `tissue`='anther'";
					$query = mysql_query($search_sql);
					while ($rs = mysql_fetch_array($query)) {

				 ?>
				 <tr>
				 	<td><a href="http://www.ncbi.nlm.nih.gov/sra/?term=<?php echo $rs['run_id']; ?>"><?php echo $rs['run_id']; ?></a></td>
				 	<td>
				 		<form action="http://cgm.sjtu.edu.cn/3kricedb/visualization/index.php" method="POST" target="_blank">
							<input type="hidden" name="rna" value="<?php echo 'anther'.'_'.$rs['run_id'];?>">
							<input type="submit" value="Genome Browser">
						</form>
				 	</td>
				 </tr>
				 <?php 
				 }
				  ?>
				</table>
			</div>

			<div id="pistil">
				<h4>Pistil</h4>
				<table class="table table-bordered table-hover" style="width : 300px">
				<thead><tr><td>Run ID</td><td>Visualization</td></tr></thead>
				<?php 
					$search_sql = "SELECT `run_id` FROM `expression` WHERE `tissue`='pistil'";
					$query = mysql_query($search_sql);
					while ($rs = mysql_fetch_array($query)) {

				 ?>
				 <tr>
				 	<td><a href="http://www.ncbi.nlm.nih.gov/sra/?term=<?php echo $rs['run_id']; ?>"><?php echo $rs['run_id']; ?></a></td>
				 	<td>
				 		<form action="http://cgm.sjtu.edu.cn/3kricedb/visualization/index.php" method="POST" target="_blank">
							<input type="hidden" name="rna" value="<?php echo 'pistil'.'_'.$rs['run_id'];?>">
							<input type="submit" value="Genome Browser">
						</form>
				 	</td>
				 </tr>
				 <?php 
				 }
				  ?>
				</table>
			</div>

			<div id="seed">
				<h4>Seed</h4>
				<table class="table table-bordered table-hover" style="width : 300px">
				<thead><tr><td>Run ID</td><td>Visualization</td></tr></thead>
				<?php 
					$search_sql = "SELECT `run_id` FROM `expression` WHERE `tissue`='seed'";
					$query = mysql_query($search_sql);
					while ($rs = mysql_fetch_array($query)) {

				 ?>
				 <tr>
				 	<td><a href="http://www.ncbi.nlm.nih.gov/sra/?term=<?php echo $rs['run_id']; ?>"><?php echo $rs['run_id']; ?></a></td>
				 	<td>
				 		<form action="http://cgm.sjtu.edu.cn/3kricedb/visualization/index.php" method="POST" target="_blank">
							<input type="hidden" name="rna" value="<?php echo 'seed'.'_'.$rs['run_id'];?>">
							<input type="submit" value="Genome Browser">
						</form>
				 	</td>
				 </tr>
				 <?php 
				 }
				  ?>
				</table>
			</div>

			<div id="panicle">
				<h4>Panicle</h4>
				<table class="table table-bordered table-hover" style="width : 300px">
				<thead><tr><td>Run ID</td><td>Visualization</td></tr></thead>
				<?php 
					$search_sql = "SELECT `run_id` FROM `expression` WHERE `tissue`='panicle'";
					$query = mysql_query($search_sql);
					while ($rs = mysql_fetch_array($query)) {

				 ?>
				 <tr>
				 	<td><a href="http://www.ncbi.nlm.nih.gov/sra/?term=<?php echo $rs['run_id']; ?>"><?php echo $rs['run_id']; ?></a></td>
				 	<td>
				 		<form action="http://cgm.sjtu.edu.cn/3kricedb/visualization/index.php" method="POST" target="_blank">
							<input type="hidden" name="rna" value="<?php echo 'panicle'.'_'.$rs['run_id'];?>">
							<input type="submit" value="Genome Browser">
						</form>
				 	</td>
				 </tr>
				 <?php 
				 }
				  ?>
				</table>
			</div>

			<div id="other">
				<h4>Other</h4>
				<table class="table table-bordered table-hover" style="width : 300px">
				<thead><tr><td>Run ID</td><td>Visualization</td></tr></thead>
				<?php 
					$search_sql = "SELECT `run_id` FROM `expression` WHERE `tissue`='other'";
					$query = mysql_query($search_sql);
					while ($rs = mysql_fetch_array($query)) {

				 ?>
				 <tr>
				 	<td><a href="http://www.ncbi.nlm.nih.gov/sra/?term=<?php echo $rs['run_id']; ?>"><?php echo $rs['run_id']; ?></a></td>
				 	<td>
				 		<form action="http://cgm.sjtu.edu.cn/3kricedb/visualization/index.php" method="POST" target="_blank">
							<input type="hidden" name="rna" value="<?php echo 'other'.'_'.$rs['run_id'];?>">
							<input type="submit" value="Genome Browser">
						</form>
				 	</td>
				 </tr>
				 <?php 
				 }
				  ?>
				</table>
			</div>


		</div>
	</div>

<?php include 'include/footer.php' ?>
</body>
</html>