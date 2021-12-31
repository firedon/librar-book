<?php
//初始化session
session_start();
// 包含数据库连接文件和头文件
require ('dbconnect.php');
include ('head.php');
?>
<?php
// 取得网页的参数
$name=$_POST['name'];
$password=@$_POST['password'];
// 加密密码
$password=md5($password);
//注册
if(@$_POST['reg']){
	// 连接数据库，查看是否已存在该用户
	$sql1="select * from user where name='$name'";
	$result=mysqli_query($conn,$sql1);
	$row=mysqli_fetch_array($result);
	//如果已存在，提示用户重新注册
	if($row){
		echo "<p align='center'>该用户已存在，请重新注册!</p>";
		exit();
	}
	else
	{
		$sql="insert into user(name, password) values('$name','$password')";
		mysqli_query($conn,$sql) or die ("注册用户失败: ".mysqli_error($conn));

	// 确认成功注册
	$ck_sql="select * from user where name='$name'";
	$result=mysqli_query($conn,$ck_sql);
	if($re_arr=mysqli_fetch_array($result)){
		$um=$re_arr['name'];
		echo "<table align=center><tr><td align=center>注册成功！</td></tr>";
		echo "<tr><td align=center><font color=red>您的注册账号是：".$um;
		echo "，请您记住，以后用此账号登录！</font></td></tr></table>";
	}
}

}
//修改密码
else if(@$_POST['chang']){
	$sql="update user set password='$password' where name='$name'";
	mysqli_query($sql,$conn) or die ("密码修改失败: ".mysqli_error());
	echo "<p align='center'>密码修改成功!</p>";
}
else {
	$sql="delete from user where name='$name'";
	mysqli_query($sql,$conn) or die ("用户删除失败: ".mysqli_error());
	echo "<p align='center'>用户删除成功!</p>";
}


?>