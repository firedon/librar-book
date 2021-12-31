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
	@$return=$_POST['return'];
	@$renew=$_POST['renew'];
	$username=$_POST['user_name'];
	@$bookbox=$_POST['bookbox'];
	// 还书
	if ($return){
		// 查看哪些书本需要归还
		for($i=0;$i<count($bookbox);$i++){
			$book_id=$bookbox[$i];
			// 如果该book没有选上，执行下一循环
			$returnsql="delete from lend where book_id='$book_id' and user_name='$username'";
			mysqli_query($returnsql,$conn) or die ("删除借书记录失败：".mysqli_error());
			// 获得当前日期,在lend_log表中记录还书时间
			$now = date("Y-m-d");
			$logsql="update lend_log set return_time='$now' where book_id='$book_id' and user_name='$username'";
			mysqli_query($logsql,$conn) or die ("记录还书时间失败：".mysqli_error());
				// 在book表中增加一本现存书数量
			$booksql="update book set leave_number=leave_number+1 where id='$book_id'";
			mysqli_query($booksql,$conn) or die ("增加剩余书数量失败：".mysqli_error());
?>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center"><font color="red">还书登记完成！</p>
<?php			
	}
}
?>





































