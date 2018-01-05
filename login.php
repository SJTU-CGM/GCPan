<?php
session_start();
// unset($_SESSION['userid']);
ini_set("display_errors", "On");
if(isset($_POST['submit'])){
  $username = htmlspecialchars($_POST['username']);
  $password = MD5($_POST['password']);
  include("include/connect.php");
  $check_query = mysqli_query($con,"SELECT uid FROM user WHERE username='$username' and password='$password' LIMIT 1");
  if($result = mysqli_fetch_array($check_query)){
    $_SESSION['userid'] = $result['uid'];
    header("Location:index.php");
    exit;
  }else{
    exit('ERROR！click here <a href="javascript:history.back(-1);">Go back</a> Retry');
  }
  
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8_decode" />
<title>Gastric Carcinoma Pan-genome</title>
<link href="./style/style.css" rel="stylesheet" type="text/css">
<script language=JavaScript>
<!--

function InputCheck(LoginForm)
{
  if (LoginForm.username.value == "")
  {
    alert("请输入用户名!");
    LoginForm.username.focus();
    return (false);
  }
  if (LoginForm.password.value == "")
  {
    alert("请输入密码!");
    LoginForm.password.focus();
    return (false);
  }
}

//-->
</script>
</head>

<body>
<tfont>Gastric Carcinoma Pan-genome Browser</tfont><br>
<br>
<div style="width:300px;">
<fieldset>
<legend>User Login</legend>
<form name="LoginForm" method="post" action="login.php" onSubmit="return InputCheck(this)">
<p>
<label for="username" class="label">username:</label>
<input id="username" name="username" type="text" class="input" />
<p/>
<p>
<label for="password" class="label">password:</label>
<input id="password" name="password" type="password" class="input" />
<p/>
<p>
<input type="submit" name="submit" value="  login  " class="left" />
<!-- <input type="button" name="register" value="  注 册  " class="right" onclick ="window.location.href='reg.php'" /> -->
</p>
</form>
</fieldset>
</div>
</body>
</html>
