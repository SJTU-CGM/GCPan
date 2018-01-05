<?php

	$con=mysqli_connect('localhost', "cgpan","cgpan2017!")or die("Mysql Access Error!");
	mysqli_select_db($con,"gcpan");
	mysqli_set_charset($con,"utf8");

	$myfile=fopen("table.txt","r") or die("Unable to open file!");
	while(!feof($myfile)){
		$line=fgets($myfile);
		$T=explode("\t",$line);
		if($T[2]=='N'){
			$sql="INSERT INTO `sample_info` (`WGC_ID`, `Original_Sample_Name`, `Type`, `RNASeq_ID`, `subType`, `Gender`, `Age`, `Location`, `Borrman`, `Diameter`, `Grade`, `Lauren`, `Node`, `Node_positive`, `Depth`, `Meta`, `Vessel`, `TNM_stage`, `Radical_cure`, `status`, `Time`, `Blood_type`, `CEA`, `CA199`, `CA724`, `AFP26`) VALUES ('$T[0]', '$T[1]', '$T[2]', '$T[3]', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');";
		}else{
			$sql="INSERT INTO `sample_info` (`WGC_ID`, `Original_Sample_Name`, `Type`, `RNASeq_ID`, `subType`, `Gender`, `Age`, `Location`, `Borrman`, `Diameter`, `Grade`, `Lauren`, `Node`, `Node_positive`, `Depth`, `Meta`, `Vessel`, `TNM_stage`, `Radical_cure`, `status`, `Time`, `Blood_type`, `CEA`, `CA199`, `CA724`, `AFP26`) VALUES ('$T[0]', '$T[1]', '$T[2]', '$T[3]', '$T[4]', '$T[5]', '$T[6]', '$T[7]', '$T[8]', '$T[9]', '$T[10]', '$T[11]', '$T[12]', '$T[13]', '$T[14]', '$T[15]', '$T[16]', '$T[17]', '$T[18]', '$T[19]', '$T[20]', '$T[21]', '$T[22]', '$T[23]', '$T[24]', '$T[25]');";
		}
		if(!mysqli_query($con,$sql)){
			echo mysqli_error($con);
		}

	}


	// $con=mysqli_connect('localhost', "cgpan","cgpan2017!")or die("Mysql Access Error!");
	// mysqli_select_db($con,"gcpan");
	// mysqli_set_charset($con,"utf8");

	// $sql="INSERT INTO `sample_info` (`WGC_ID`, `Original_Sample_Name`, `Type`, `RNASeq_ID`, `subType`, `Gender`, `Age`, `Location`, `Borrman`, `Diameter`, `Grade`, `Lauren`, `Node`, `Node_positive`, `Depth`, `Meta`, `Vessel`, `TNM_stage`, `Radical_cure`, `status`, `Time`, `Blood_type`, `CEA`, `CA199`, `CA724`, `AFP26`) VALUES ('WGC013273', '952T-L', 'T', '', '9', '1', '59', '3', '2', '5.0', '3', '3', '4', '17', '4', '1', '1', '8', '1', '0', '6', '0', '0', '0', '0', '0');"

	// if(!mysqli_query($con,$sql)){
	// 	echo mysqli_error($con);
	// }


?>