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
		             ?>

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
        <iframe id="jbrowse"></iframe>
      </div>
    </div>
  </body>
</html>
