<?php 
//初始化session
session_start();
include ('head.php');
// 如果没有登录，提示登录
if(!isset($_SESSION['Adm'])) {
   echo "<p align=center>";
   echo "<font color=#FF0000 size=4><strong><big>";
   echo "您还没有登录,请<a href='adminlogin.php?url=borrow'>登录</a>!";
   echo "</big></strong></font></p>";
   exit();
}
?>
<html>
<head><title>账号管理</title></head>
<body>
<script language="javascript"> 
    function checkreg()
    { 			
		if (form1.name.value=="")
		{
			// 如果真实姓名为空，则显示警告信息
	        alert("真实姓名不能为空！");
			form1.name.focus();
			return false;
	    }
		if (form1.password.value=="" )
		{
			// 如果密码为空，则显示警告信息
	        alert("密码不能为空！");
			form1.password.focus();
			return false;
	    }
		if (form1.pwd.value=="" )
		{
			// 如果密码为空，则显示警告信息
	        alert("确认密码不能为空！");
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
		if (form1.email.value=="")
		{
			// 如果Email为空，则显示警告信息
	        alert("Email不能为空！");
			form1.email.focus();
			return false;
	    }
			// 检查email格式是否正确
		else if (form1.email.value.charAt(0)=="." ||
			form1.email.value.charAt(0)=="@"||
			form1.email.value.indexOf('@', 0) == -1 ||
			form1.email.value.indexOf('.', 0) == -1 ||
			form1.email.value.lastIndexOf("@")==form1.email.value.length-1 ||
			form1.email.value.lastIndexOf(".")==form1.email.value.length-1)
		{
			alert("Email的格式不正确！");
			form1.email.select();
			return false;
		}
		return true;

    }	
</script>

<form name="form" method="post" action="" onsubmit="return checkreg()">
<table width="780" border="0" cellspacing="1" cellpadding="3" align="center">
 <tr> 
      <th colspan="3"><h2 align="center">账 号 管 理 </h2></th>
    </tr>  
<tr>
	<td align="center"><input type="submit" name="reg" value="账号注册"></td>
	<td align="center"><input type="submit" name="del" value="账号删除"></td>
	<td align="center"><input type="submit" name="chang" value="密码修改"></td>
</tr>
</table>
</form>
<?php 
if(@$_POST['reg']){
	
?>
<form name="form1" method="post" action="regok.php" onsubmit="return checkreg()">
<table width="780" border="0" cellspacing="1" cellpadding="3" align="center">
    <tr> 
      <th colspan="2"><h2 align="center">账 号 注 册 </h2></th>
    </tr>  
<tr> 					
	<td width="330" height="32" align="right">用户名:</td>
     <td width="450" height="32"><input type="text" name="name"></td>
</tr>
<tr> 
	<td width="330" height="32" align="right">密 码:</td>
    <td width="450" height="32"><input type="password" name="password"></td>	
</tr>
<tr>
	<td width="330" height="32" align="right">确认密码:</td>
	<td width="450" height="32"><input type="password" name="pwd">       			
</tr>
<tr>
	<!--td align=center> <input type="reset" name="Submit2" value="重 写"></td-->
	<td colspan="2" align="center"> 
		<input type="submit" name="reg" value="注 册">&nbsp;
		<button type="button" onclick="history.go(-1);">返回上一页</button>
	</td>	
</tr>
</table>
</form>
<?php
}
else if(@$_POST['del']){
	
?>
<form name="form1" method="post" action="regok.php" onsubmit="return checkreg()">
<table width="780" border="0" cellspacing="1" cellpadding="3" align="center">
    <tr> 
      <th colspan="2"><h2 align="center">账 号 删 除 </h2></th>
    </tr>  
<tr> 					
	<td width="330" height="32" align="right">用户名:</td>
     <td width="450" height="32"><input type="text" name="name"></td>
</tr>
<td colspan="2" align="center"> 
		<input type="submit" name="del" value="删除用户">&nbsp;
		<button type="button" onclick="history.go(-1);">返回上一页</button>
	</td>
</table>
</form>
<?php
}else if(@$_POST['chang']){
	
?>
<form name="form1" method="post" action="regok.php" onsubmit="return checkreg()">
<table width="780" border="0" cellspacing="1" cellpadding="3" align="center">
    <tr> 
      <th colspan="2"><h2 align="center">密 码 修 改 </h2></th>
    </tr> 
<tr> 					
	<td width="330" height="32" align="right">用户名:</td>
     <td width="450" height="32"><input type="text" name="name"></td>
</tr>	
<tr> 
	<td width="330" height="32" align="right">密 码:</td>
    <td width="450" height="32"><input type="password" name="password"></td>	
</tr>
<tr>
	<td width="330" height="32" align="right">新密码:</td>
	<td width="450" height="32"><input type="password" name="pwd">       			
</tr>
<tr>
	<!--td align=center> <input type="reset" name="Submit2" value="重 写"></td-->
	<td colspan="2" align="center"> 
		<input type="submit" name="chang" value="修 改">&nbsp;
		<button type="button" onclick="history.go(-1);">返回上一页</button>
	</td>	
</tr>
</table>
</form>
<?php
}
?>
</body>
</html>