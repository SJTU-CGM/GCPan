<?php 
include 'include/connect.php';
error_reporting(0);
header("Content-type: text/html; charset=UTF-8");
// error_reporting(E_ALL^E_NOTICE^E_WARNING);
$paras=$_POST["selectParas"];
// echo json_encode(array('samplesList'=>$paras),JSON_UNESCAPED_UNICODE);
//$paras="subType.1;subType.1";
$paras_elements=explode(";", $paras);
//echo $paras_elements;

$paras_names=array();
$paras_values=array();
$n=count($paras_elements);


for($i=0;$i<$n;$i++){
	//$paras_names[$i]=explode(".", $paras_elements[$i])[0];
    $tmp=$paras_elements[$i];
    $tmp1=explode(".",$tmp);
    $paras_names[$i]=$tmp1[0];
    $paras_values[$i]=$tmp1[1];
//	$paras_values[$i]=explode(".", $paras_elements[$i])[1];
}

$sql="SELECT * FROM `sample_info` WHERE (`".$paras_names[0]."`='".$paras_values[0];

for($i=1;$i<$n;$i++){
	$tmp_name=$paras_names[$i];
	if($paras_names[$i]==$paras_names[$i-1]){
		$sql.="') OR (`".$paras_names[$i]."`='".$paras_values[$i];
	}else{
		$sql.="') AND (`".$paras_names[$i]."`='".$paras_values[$i];
	}
	
}

$sql.="');";

// echo $sql."<br>";

$sql_query=mysqli_query($con,$sql);

$samples=array();
$i=0;
while($rs=mysqli_fetch_array($sql_query,MYSQLI_ASSOC)){
	$samples[$i]=$rs;
	$i++;
}

//echo json_encode(array('samplesList'=>$samples),JSON_UNESCAPED_UNICODE);
echo json_encode(array('samplesList'=>$samples));


?>
