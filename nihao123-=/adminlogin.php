<?php
//初始化session
session_start();
include ('head.php');
require ('dbconnect.php');
// 如果没有登录，退出
if(1){

}
?>
<html>
<head>
<title>后台登录</title>
</head>
<body>
<script language="javascript"> 
    function checklogin()
    { 
      if ((login.username.value!="") && (login.password.value!=""))
        // 如果昵称和密码均不为空,则返回true
         return true
      else {
        // 如果昵称或密码为空,则显示警告信息
         alert("用户名或密码不能为空!")
         return false
      } 	
    } 
</script>
<form action="chkadmlogin.php" method="post" name="login" onsubmit="return checklogin()">
  <table width="780" border="0" cellspacing="1" cellpadding="3" align="center">
    <tr> 
      <th colspan="2"><h2 align="center">管理员登录</h2></th>
    </tr>
    <tr> 
      <td width="330" height="32" align="right">管理员:</td>
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