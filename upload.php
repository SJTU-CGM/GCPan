<!DOCTYPE html>
<html lang="en">
<head>
	<script>
	function ss(){
		document.getElementsByTagName("form")[0].submit();
	}
</script>
</head>
<body onload="ss()">
	


<?php 
error_reporting(E_ALL^E_NOTICE^E_WARNING);
if ($_FILES["rfile"]){
	$file = $_FILES["rfile"];
}
elseif ($_FILES["gfile"]) {
	$file = $_FILES["gfile"];
}



if ($file["size"] < 200000) {
	if ($file["error"] > 0){
	    echo "Return Code: " . $file["error"] . "<br />";
    }else{
    	// print_r($_FILES);
    	// print_r($_FILES["rfile"]);
    	echo "<b>NOTE:</b> The waiting time would be long if the list is long.\n";
	    echo "Upload: " . $file["name"] . "<br />";
	    // echo "Type: " . $file["type"] . "<br />";
	    echo "Size: " . ($file["size"] / 1024) . " Kb<br />";
	    // echo "Temp file: " . $file["tmp_name"] . "<br />";

	    $filename = date("YmdHis").rand(100, 900);
	    move_uploaded_file($file["tmp_name"], "ul_files/" . $filename);
	    // echo "Stored in: " . "ul_files/" . $filename;
    }
?>


<?php
    if ($_FILES["rfile"]) {
    	echo '<form action="sharedGene.php" method="post">';
		$handle = fopen("ul_files/".$filename, "r");
		if ($handle){
			$rice_arr = array();
			while (!feof($handle)) {
				$buffer = fgets($handle, 4096);
				if (strlen($buffer) > 0){
					array_push($rice_arr, $buffer);
				}
			}
			$text = implode(",", $rice_arr);
			echo '<input type="hidden" name="rname" value="'.$text.'">';
			echo '<input type="hidden" name="rnum" value="'.$_POST['rnum'].'">';
			echo "</form>";
		}
	}
	elseif ($_FILES['gfile']) {
		echo '<form action="distributedRice.php" method="post">';
		$handle = fopen("ul_files/".$filename, "r");
		if ($handle){
			$rice_arr = array();
			while (!feof($handle)) {
				$buffer = trim(fgets($handle, 4096));
				// echo trim($buffer).strlen(trim($buffer))."<br />";

				if (strlen($buffer) > 0){
					array_push($rice_arr, trim($buffer));
				}
			}
			$text = implode(",", $rice_arr);
			// echo $text;
			echo '<input type="hidden" name="gname" value="'.$text.'">';
			echo "</form>";
		}
	}

}else{
  echo "Invalid file";
}
 ?>


</body>
</html>