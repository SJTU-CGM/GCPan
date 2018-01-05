<html>
  <head>
    <title>hahaha</title>
    <script>
      function f(x) {alert(x)}
    </script>
</head>
<body>
<h1>hahaha</h1>
<form action="test.php" method="post">
  Message:<input type="text" name="message"/>
  <input type="submit" value=""/>
</form>
<?php
   $m = $_POST["message"];
echo "<script>alert(\"$m\")</script>";
   ?>
<address>
<a href="mailto:kuangchen@localhost-localdomain">Lu</a>
</address>
</body>
</html>
