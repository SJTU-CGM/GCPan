
<?php 
error_reporting(E_ALL^E_NOTICE^E_WARNING);
echo "<p>Preparing screenshot ...</p>";

if (isset($_GET['url'])) {
    $url = $_GET['url'];
}
if (isset($_GET['height']) and isset($_GET['width'])) {
    $size = $_GET['width']."px*".$_GET['height']."px";
}

$pdf = "phantomjs/screenshot/".md5(uniqid(rand())).".pdf";
$cmd = "./phantomjs/phantomjs ./phantomjs/myrasterize.js '".$url."' ".$pdf." '".$size."' >/dev/null";
$a = system($cmd,$result);
$file_loc = "visualization/".$pdf;
header("Location: http://cgm.sjtu.edu.cn/3kricedb/".$file_loc);
exit; 
 ?>
<p> screenshot in PDF format: </p>
<form method="post" action="../download.php"> 
        <input type="hidden" name="dl_info" value="<?php echo $file_loc; ?>">
        <input type="submit" value="Download">
</form>


