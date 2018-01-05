<?php 
$dl_rice_file_name = $_POST['dl_info'];

if(file_exists($dl_rice_file_name)){
	header('Content-Description: File Download');
	header('Content-type: application.octet-stream');
  	header('Content-Disposition: attachment; filename='.basename($dl_rice_file_name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($dl_rice_file_name));
    ob_clean();
    flush();
    readfile($dl_rice_file_name);
}
 ?>