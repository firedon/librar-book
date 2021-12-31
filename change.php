<?php
//初始化session
session_start();
include ('head.php');
require ('dbconnect.php');
// 如果没有登录过，提示用户登录
if(!isset($_SESSION['user'])) {
   echo "<p align=center>";
   echo "<font color=#FF0000 size=4><strong><big>";
   echo "您还没有登录,请<a href='login.php?url=browse'>登录</a>!";
   echo "</big></strong></font></p>";
   exit();
}
?>
<html>
<head>
<title>密码修改</title>
<body>
<script language="javascript"> 
    function checkreg()
    { 			
		if (form1.old.value=="")
		{
			// 如果真实姓名为空，则显示警告信息
	        alert("旧密码不能为空！");
			form1.name.focus();
			return false;
	    }
		if (form1.password.value=="" )
		{
			// 如果密码为空，则显示警告信息
	        alert("请输入新密码！");
			form1.password.focus();
			return false;
	    }
		if (form1.pwd.value=="" )
		{
			// 如果密码为空，则显示警告信息
	        alert("请确认新密码！");
			form1.pwd.focus();
			return false;
	    }
		// 两次密码应一样
		if (form1.password.value!=form1.pwd.value && form1.password.value!="")
		{
			alert("两次密码不一样，请确认！");
			form1.password.focus();
			return false;
		}
		return true;

    }	
</script>
<form name="form1" method="post" action="" onsubmit="return checkreg()">
<table width="780" border="0" cellspacing="1" cellpadding="3" align="center">
    <tr> 
      <th colspan="2"><h2 align="center">密 码 修 改 </h2></th>
    </tr> 
<tr> 					
	<td width="330" height="32" align="right">旧密码:</td>
     <td width="450" height="32"><input type="text" name="old"></td>
</tr>	
<tr> 
	<td width="330" height="32" align="right">新密码:</td>
    <td width="450" height="32"><input type="password" name="password"></td>	
</tr>
<tr>
	<td width="330" height="32" align="right">请确认:</td>
	<td width="450" height="32"><input type="password" name="pwd">       			
</tr>
<tr>
	<!--td align=center> <input type="reset" name="Submit2" value="重 写"></td-->
	<td colspan="2" align="center"> 
		<input type="submit" name="chang" value="修 改">&nbsp;
	</td>	
</tr>
</table>
</form>
<?php
if(@$_POST['chang']){
$name=@$_SESSION['user'];
$oldpw=md5(@$_POST['old']);
$newpw=md5(@$_POST['password']);
$cksql="select * from user where name='$name' and password='$oldpw'";
$result=mysqli_query($cksql,$conn);
$row=mysqli_fetch_array($result);
if(!$row){
	echo "<p align='center'>旧密码不正确，请重新输入!</p>";
	exit();
}
else{
	$sql="update user set password='$newpw' where name='$name'";
	mysqli_query($sql,$conn) or die ("密码修改失败: ".mysqli_error());
	echo "<p align='center'>密码修改成功!</p>";
}
	
}

?>
</body>
</html>