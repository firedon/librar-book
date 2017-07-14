<?php
include('head.php');
session_start();
if(@$_SESSION['user']){
	echo "<p align=center>";
	echo "<font color=#FF0000 size=4><strong><big>";
	echo "您已登录!";
	echo "</big></strong></font></p>";
	exit();
}
?>
<html>
<head>
<title>用户登录</title>
</head>
<body>
<form action="checklogin.php" method="post" name="login" onsubmit="return checklogin()">
  <table width="780" border="0" cellspacing="1" cellpadding="3" align="center">
    <tr> 
      <th colspan="2"><h2 align="center">用户登录</h2></th>
    </tr>
    <tr> 
      <td width="330" height="32" align="right">用户名:</td>
      <td width="450" height="32"> <input type="text" name="username"></td>
    </tr> 
	<tr> 
      <td width="330" height="32" align="right">密 码:</td>
      <td width="450" height="32"><input type="password" name="password"></td>
    </tr> 
	<tr>
<?php 
if(@$_GET['url']){$url=@$_GET['url'];}
else $url="index";
echo "<input type='hidden' name='url' value='$url'>";
?>
	  <td colspan="2" align="center"><input type="submit" value="登录"></td>
	</tr>
  </table>
</form>
</body>
</html>