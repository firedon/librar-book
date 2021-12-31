<?php 
//初始化session
session_start();
include ('head.php');
require ('dbconnect.php');
// 如果没有登录，退出
if(!isset($_SESSION['Adm'])) {
   echo "<p align=center>";
   echo "<font color=#FF0000 size=5><strong><big>";
   echo "管理员没有登录,请<a href='AdminLogin.php'>登录</a>!";
   echo "</big></strong></font></p>";
   exit();
}

?>

<?php 
// 获得上一页传递参数
$title=$_POST['title'];
$author=$_POST['author'];
$publisher=$_POST['publisher'];
$publish_year=$_POST['publish_year'];
$number=$_POST['total'];
$other=$_POST['other'];
$storage_time=date('Y-m-d h:i:s',time());
// 检测是否已经存在该书
// 需要同时检测该书的书名，作者，出版社，年份
$checksql="select * from book where title='$title' and publisher='$publisher' and author='$author' and publish_year='$publish_year'";
$checkresult=mysqli_query($checksql,$conn);
$checkrow=mysqli_fetch_array($checkresult);
if(!empty($checkrow)){
	// 书库中已存在该书，获取书库中当前数量
	$leave_number=$checkrow['leave_number']+$number;
	$total=$leave_number+$number;
	$sql="update book set total='$total',leave_number='$leave_number',storage_time='$storage_time' where title='$title' and publisher='$publisher' and author='$author' and publish_year='$publish_year'";
	echo $sql;
	mysqli_query($sql,$conn) or die("操作失败1：".mysqli_error());
	echo "<table align=center><tr><td align=center>库存数量更新成功！</td></tr>";
	echo "<tr><td align=center><font color=red>最新入库时间是：".$storage_time."</font>";
	}
else {
// 可以直接入库
$sql="insert into book(title, author, publisher, publish_year, total, leave_number,storage_time,other) values('$title','$author','$publisher','$publish_year','$number','$number','$storage_time','$other')";
mysqli_query($sql,$conn) or die("操作失败：".mysqli_error());

// 获得注册用户的自动id，以后使用此id才可登录
$result=mysqli_query("select last_insert_id()",$conn);
$re_arr=mysqli_fetch_array($result);
$id=$re_arr[0];
echo "<table align=center><tr><td align=center>新书入库成功！</td></tr>";
echo "<tr><td align=center><font color=red>该书的ID是：".$id."</font>";
echo "<br><a href='addbook.php'>继续添加新书</a></td></tr></table>";
}
?>