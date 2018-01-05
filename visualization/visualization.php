<!DOCTYPE html>

<?php include '../include/connect.php'; ?>

<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="renderer" content="webkit"> -->
    <title>Visualization</title>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    <link rel="stylesheet" href="../libs/bootstrap-3.3.6/css/bootstrap.css">
    <script src="../libs/jquery-2.1.4.min.js"></script>
    <script src="../libs/bootstrap-3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/main.css">
    

    <link rel="stylesheet" href="css/main.css">
    <!--script src="YaPTV/js/lib/whiteout.js"></script-->
    <script src="js/toolbar.js"></script>
    <script src="js/main.js"></script>
  </head>
  
  <body onload="init()">
    <?php include '../include/header.php'; ?>
    <div id="container">
      <iframe id="tree"
              src="YaPTV/index.html"></iframe>
      <button id="toggle-tree"
              onclick="toggleTreeVisibility()">&lt;</button>
      <div id="jbrowse-container">
        <div id="toolbar">
          <button onclick="toolbarRemoveTracks()">remove all tracks</button>
          <button onclick="toolbarScreenshot()">screenshot</button>
          <button onclick="toolbarShare()">share</button>
          <!--a href="../about.php#visualization"-->
            <button onclick="toolbarHelp()">help</button>
          <!--/a-->
        </div>
        <!-- <iframe id="browser" src="http://cgm.sjtu.edu.cn:7708/browser/index.html?genome=hg19&datahub=http://localhost/browser/hub.json" height="100%"></iframe> -->
        <iframe id="browser" src="" height="100%"></iframe>
        <!-- <iframe id="browser" src="http://cgm.sjtu.edu.cn:7708/browser/index.html" height="100%"></iframe> -->
      </div>
    </div>
<script>
//检测本页中的所有iframe是否加载完成
var frm=document.getElementById('browser');
$(frm).load(function(){
   console.log("Local iframe is now loaded.");
});

</script>

<script>
      INIT_LOC = <?php
               $load_jbrowser = False;
               if (isset($_POST['loc'])) {
               list($name, $start, $end) = preg_split('/ +/', $_POST['loc']);
               echo "['".$name."', ".strval($start).", ".strval($end)."]";
               } else {
               if (isset($_POST['singlerice'])) {
             echo "['chr01', 21499869, 22405118]";
               } else {
               echo "[]";
               }
               }
                   ?>;
      INIT_CODES = <?php
                 if (isset($_POST['selection'])) {
                 echo "['".implode("','", $_POST['selection'])."']";
                 } else {
                 if (isset($_POST['singlerice'])) {
                 echo "['".strval($_POST['singlerice'])."']";
                 } else {
                 if (isset($_POST['rna'])) {
                 echo "['".strval($_POST['rna'])."']";
                 } else {
                 echo "[]";
                 } 
                 }
                 }
                 ?>;
      INIT_SAMPLES=<?php 
              if(isset($_POST['selection'])){
                  echo "['".implode("','", $_POST['selection'])."']";
              }else{
                  echo 1;
              }
              ?>;

      if(INIT_SAMPLES == 1){
          var srcContent="http://cgm.sjtu.edu.cn:7708/browser/?genome=hg19&datahub=http://localhost/browser/hub.json";
      }else{
          var srcContent="http://cgm.sjtu.edu.cn:7708/browser/?genome=hg19&coordinate=chr1:102000-108000&bigwig="+INIT_SAMPLES[0]+","+"/tmp/"+INIT_SAMPLES[0]+".bw";
          for(var i=1;i<INIT_SAMPLES.length;i++){
            srcContent+=","+INIT_SAMPLES[i]+","+"/tmp/"+INIT_SAMPLES[i]+".bw";
          }
      }
      
      $("#browser").attr('src',srcContent);
      console.log(INIT_SAMPLES);

      var Sys = {};
      var ua = navigator.userAgent.toLowerCase();
      var s;
      (s = ua.match(/msie ([\d.]+)/)) ? Sys.ie = s[1] :
      (s = ua.match(/firefox\/([\d.]+)/)) ? Sys.firefox = s[1] :
      (s = ua.match(/chrome\/([\d.]+)/)) ? Sys.chrome = s[1] :
      (s = ua.match(/opera.([\d.]+)/)) ? Sys.opera = s[1] :
      (s = ua.match(/version\/([\d.]+).*safari/)) ? Sys.safari = s[1] : 0;
      if (!navigator || !navigator.userAgent || Sys.ie ) {
      alert("This page is not compatible with Microsoft Internet Explorer, Please use Chrome, Firefox or others!")
      }

    </script>
  </body>
</html>
