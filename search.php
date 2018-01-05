<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include 'include/libs.php' ?>
	<title>Search</title>
	
	<link rel="stylesheet" href="css/main.css">
	<script>
	function example1(){
		document.getElementById('mricename').value='B001,B011,IRIS_313-10857,IRIS_313-11289'; 
		document.getElementById('ricenum1').value='1';
	}
	function isNum(id1,id2){
		if (/^[0-9]+$/.test(document.getElementById(id1).value)) {
			return true;
		} else {
			document.getElementById(id2).style.display="inline";
			// alert("Wrong input!");
			return false;
		}
	}
	</script>

</head>
<body>

<?php include 'include/header.php'; ?>
<?php include 'include/connect.php'; ?>

<div class="container">
	<div class="page-header">
	   <h1>SEARCH</h1>
	   <p>Users can search the detailed information for one rice accession, one gene ID and sequences in the left search boxes.</p>
	   <p>If you want to find the genes shared in multiple rice accessions or the rice accessions containing multiple genes, please use the right search boxes.</p>
	</div>


	<div class="search">
	<div class="row">
		<div class="col-md-6">

		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Search by a gene ID</h3>
			</div>
			<div class="panel-body">
				<form action="searchByGene.php" role="form" method="post">
					<div class="form-group">
						<label for="geneid">Please input <strong>ONE</strong> gene ID</label>
						<input type="text" class="form-control" id="geneid" name="gname" placeholder="e.g. Os02g0561500">
					</div>
				  <button type="submit" class="btn btn-default">Search</button>
				  <input type="submit" class="btn btn-default" onclick="document.getElementById('geneid').value='Os02g0561500'" value="example">
				</form>
			</div>
		</div>

		<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">Search by DNA/RNA sequence</h3>
		</div>
		<div class="panel-body">
			<form action="../../cgi-bin/webBlat" method="POST">
			<b> Please input a sequence or multiple sequences in a FASTA format in the text box below. </b><br>

			Database: <select NAME="wb_db">
			  <option SELECTED>Rice Pan-genome</option>
			</select>
			Query Type: <select NAME='wb_qType' class='normalText' >
			<option SELECTED>DNA</option>
			<option>RNA</option>
			</select>
			<br>
			Sort By: <select NAME='wb_sort' class='normalText' >
			<option SELECTED>query,score</option>
			<option>query,start</option>
			<option>chrom,score</option>
			<option>chrom,start</option>
			<option>score</option>
			</select>
			Output: <select NAME='wb_output' class='normalText' >
			<option SELECTED>hyperlink</option>
			<option>psl</option>
			<option>psl no header</option>
			</select>
			<input TYPE=SUBMIT NAME="Submit" VALUE="Submit" ><input type="submit" onclick="document.getElementById('seq').value='>test1\nCCGGCCGGCTTGGAGAGTAACTCAAGAGAGACAGAATGGAAGATAGAGAACAAGAGAGTGAGAGGATAAGGATATAGACCAGACCACACAATTTTCTCTTCTTTTTAACTTTGTATTAAGATCTTTTATGGAACATCTTTTATTGTTGATATCAAAATAACTGAAACTTATACTTTAATATTTTTTGAGACAAAAAGTAACAATCGTAAAAAAAAGTTCCACGAGAGTTACCCCACCACCCATGTCTCGAGCCGACCAGATCTGCCGCCCACGACCCGAGTCATCGTTGGATCCACCACCCACAACCCGCGACCGAGCTACGCCTCCTGTGGATTGATGCCACTGC\n>test2\nAATTATCCTAATACAAATGTAACTTCTATCGTTCGTTAACGAGGTGTCTCGTTTTGGCGTTCGTTAACGTTCGTTTTATCGTTTATATCGTTCATTCACGTTCATTCTACTCATTTTCTATTGTTCTCGTTCGGTCTCTTTCGTTCGTTAACGTACGTCTTATCGTTTCTATCGTTCGTTCCACTCGTTTTCTCGTTCTCGTTCGGTCTCGTTCGTTCTATCGTTTCTATCGTTCGTTCACGTTTGTTCTACTCGTTTTCTATCGTTCTCGTTCATTCATTAACGTATGTTCTAT'" value="example"><br>
			<textarea NAME="wb_seq" ROWS=10 COLS=60 id="seq"></textarea><br>
			<!-- <input type="FILE" name="seqFile">
			<input type="SUBMIT" name="Submit" value="submit file"> <br> -->
			Please copy and paste some sequences in FASTA format in the text box and press submit. You can submit multiple sequences at once if they are in FASTA format (where each sequence has a header line that starts with '>' and contains the name of the sequence)
			</form>
		<!-- <iframe src="http://cgm.sjtu.edu.cn/cgi-bin/webBlat" frameborder="0" height="400" width="460"></iframe> -->
		</div>
		</div>

		<div class="panel panel-success">
			<div class="panel-heading">
	 			<h3 class="panel-title">Search by a rice accession</h3>
			</div>
	   		<div class="panel-body">
			<form action="searchByRice.php" role="form" method="post">
				<div class="form-group">
					<label for="ricename">Please input <strong>ONE</strong> code of the rice accession</label>
					<input type="text" class="form-control" id="ricename" name="rname" placeholder="e.g. B001">
				</div>
				<button type="submit" class="btn btn-default">Search</button>
				<input type="submit" class="btn btn-default" onclick="document.getElementById('ricename').value='B001'" value="example">
			</form>
			</div>
		</div>

		</div>

		<div class="col-md-6">

  		<div class="panel panel-success">
			<div class="panel-heading">
	 			<h3 class="panel-title">Search by rice list (to obtain their shared genes)</h3>
			</div>
	   		<div class="panel-body">
			<form action="sharedGene.php" role="form" method="post" onsubmit="return isNum('ricenum1','err_info1')">
				<div class="form-group">
					<label for="ricename">Please input the code(s) of rice accession(s) each seperated by a comma</label>
					<input type="text" class="form-control" id="mricename" name="rname" placeholder="e.g. B001,B011,IRIS_313-10857,IRIS_313-11289...">
					<label for="ricenum1">Please input the least number of rice accessions sharing each gene </label>
					<p>(the number should be less than or equal to the number of the input rice accessions and greater than or equal to 1)</p>
					N = 
					<input type="text" class="form-control" id="ricenum1" name="rnum" placeholder="e.g. 1" style="width: 100px;display:inline" value="1"> 
					<p id="err_info1" style="color: red; display:none">Wrong input!</p>
				</div>
				<button type="submit" class="btn btn-default" >Search</button>
				<input type="submit" class="btn btn-default" onclick="example1()" value="example">
			</form>
			<br>
			<p><b>NOTE:</b>There will be a long waiting time if the input list is long.</p>
			<hr>
			
			<form action="upload.php" role="form" method="post" enctype="multipart/form-data" onsubmit="return isNum('ricenum2','err_info2')">
				<div class="form-group">
					<label for="inputfile">Or you can upload a file(per code per row), and input the number same with above</label>
					<input type="file" id="inputfile" name="rfile" style="display:inline">
					N = 
					<input type="text" id="ricenum2" name="rnum"  class="form-control" placeholder="e.g. 1" style="width: 100px;display:inline" value="1">
					<p id="err_info2" style="color: red; display:none">Wrong input!</p>
					<button type="submit" class="btn btn-default" style="display:inline">Submit</button>
				</div>
			</form>
			</div>
		</div>

		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Search by gene ID list (to obtain rice accessions where they all present)</h3>
			</div>
			<div class="panel-body">
				<form action="distributedRice.php" role="form" method="post">
					<div class="form-group">
						<label for="geneid">Please input the gene ID(s) each seperated by a comma</label>
						<input type="text" class="form-control" id="mgeneid" name="gname" placeholder="e.g. Os01g0100100,Os01g0100200,Un_maker_32903 ...">
					</div>
				  <button type="submit" class="btn btn-default">Search</button>
				  <input type="submit" class="btn btn-default" onclick="document.getElementById('mgeneid').value='Os01g0100100,Os01g0100200,Un_maker_32903'" value="example">
				</form>
				<hr>
				<form action="upload.php" role="form" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="inputfile">Or you can upload a file(per gene ID per row)</label>
						<input type="file" id="inputfile" name="gfile" style="display:inline">
					
						<button type="submit" class="btn btn-default" style="display:inline">Submit</button>
					</div>
				</form>
			</div>
		</div>

		</div>

	</div>
	</div>
</div>
<?php include 'include/footer.php' ?>
</body>
</html>