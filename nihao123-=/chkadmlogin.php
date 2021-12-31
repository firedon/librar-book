<?php
//初始化session
session_start();
include('head.php');
// $_SESSION['UserName'] 不能用$UserName变量代替
/*if(isset($_SESSION['Adm'])) {
	//重定向到管理留言
	header("Location:borrow.php");
	// 登录过的话，立即结束
   exit;
}*/
$url=$_POST['url'];
// 获得参数
$nickname=$_POST['username'];
$password=$_POST['password'];
// 检查管理员帐号和密码是否正确,
// 这里采用直接检测，不需要连接数据库
if( $nickname=="admin" and $password=="123qwe,.") {
	//注册session变量，保存当前会话用户的昵称
	$_SESSION['Adm']=$nickname;
	
	// 登录成功重定向到管理页面
	header("Location:$url.php");
	
}
else { 
	// 包含头文件
	//include('head.php');
    // 管理员登录失败
	echo "<table width='100%' align=center><tr><td align=center>";
	echo "帐号或密码错误，或者不是管理员帐号<br>";
    echo "<font color=red>管理员登录失败！</font><br><a href='AdminLogin.php?url=$url'>请重试</a>";
    echo "</td></tr></table>";
}

?>

