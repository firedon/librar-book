<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<?php
//初始化session
session_start();
// 如果已经登录过，直接退出
if(isset($_SESSION['user'])) {
	//重定向到管理留言
	header("Location:browse.php");
	// 登录过的话，立即结束
   exit;
}
require ('dbconnect.php');
// 获得参数
$nickname=addslashes($_POST['username']);
$password=addslashes($_POST['password']);
$password=md5($password);
//获取跳转页面url
$url=$_POST['url'];
// 检查帐号和密码是否正确,
$sql="select * from user where name='$nickname' and password='$password'";
$re=mysqli_query($conn,$sql);
$result=mysqli_fetch_array($re);
// 如果用户登录正确
if( !empty($result)) {
	//注册session变量，保存当前会话用户的昵称
	$_SESSION['user']=$nickname;

	// 登录成功重定向到管理页面
	header("Location:$url.php");
}
else { 
	// 包含头文件
	include('head.php');
    // 管理员登录失败
	echo "<table width='100%' align=center><tr><td align=center>";
	echo "用户ID或密码错误<br>";
    echo "<font color=red>登录失败！</font><br><a href='login.php?url=$url'>请重试</a>";
    echo "</td></tr></table>";
}

?>
</body>
</html>