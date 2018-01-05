<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include 'include/libs.php' ?>
	<title>Download</title>
	
	<link rel="stylesheet" href="css/main.css">

</head>
<body>

<?php include 'include/header.php'; ?>
<?php include 'include/connect.php'; ?>

<div class="container">
	<div class="page-header">
	   <h1>DOWNLOAD</h1>
	   
	</div>
	<h3>Pan-genome reference</h3>
	<a href="data/pan.fa">pan.fa (647Mb)</a>

	<h3>Pan-genome annotation</h3>
	<a href="data/pan.gff">pan.gff (18Mb)</a>

	<h3>Pan-genome protein sequences</h3>
	<a href="data/pep.fa">pep.fa (15Mb)</a>


	<hr>

	<h3>Files to build local version of visualization page</h3>
	<a href="data/visualization.tar.gz">visualization.tar.gz</a><br>
	<!-- <a href="data/browser.tar.gz">browser.tar.gz</a><br> -->
	<!-- <a href="data/data.tar.gz">data.tar.gz</a><br> -->
	<a href="data/README">README</a>

</div>
<?php include 'include/footer.php' ?>
</body>
</html>