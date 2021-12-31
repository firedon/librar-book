<?php
//初始化session
session_start();
include ('head.php');
require ('dbconnect.php');
// 如果没有登录，提示用户登录
if(!isset($_SESSION['user'])) {
   echo "<p align=center>";
   echo "<font color=#FF0000 size=4><strong><big>";
   echo "您还没有登录,请<a href='login.php?url=borrow'>登录</a>!";
   echo "</big></strong></font></p>";
   exit();
}
else{
	
?>
<html> 
<head> 
<title>个人中心</title>
</head> 
<body>
<?php
		$username=@$_SESSION['user'];
		
		
		$sql="select * from lend where user_name='$username'";
		$result=mysqli_query($conn,$sql);
		$num=mysqli_num_rows($result);
		if(!$num){
			echo "<p align=center>您的借书数量为<font color=red>0</font>！</p>";
			exit();
			}
		echo "<p align=center>您的借书数量为<font color=red>$num</font>！已借书目如下：</p>";
		echo "<form name='form1' method='post' action='returnok.php'>" ;
		echo "<table width='780' border='1' bgcolor='red' align='center'>";
		//echo "<th align='left' width='60'><INPUT TYPE='checkbox' NAME='selectall' VALUE='1' onclick='checkall(form1)'>全选</th>";
		echo "<th width='80'>图书编号</th>";
		echo "<th width='180'>书名</th>";
		echo "<th width='180'>作者</th>";
		echo "<th width='120'>出版社</th>";
		echo "<th width='80'>出版年份</th>";
		echo "<th width='120'>借阅时间</th>";
		while($row=mysqli_fetch_array($result)){
			$bsql="select * from book where id='$row[book_id]'";
			$bresult=mysqli_query($bsql,$conn);
			$binfo=mysqli_fetch_array($bresult);
			//echo "<td><input type='checkbox' name='bookbox[]' value='$row[book_id]'></td>";
			echo "<tr align='center'><td>$row[book_id]</td>";
			echo "<td>$binfo[title]</td>";
			echo "<td>$binfo[author]</td>";
			echo "<td>$binfo[publisher]</td>";
			echo "<td>$binfo[publish_year]</td>";
			echo "<td>$row[lend_time]</td></tr>";
			}
			echo "</table></form>";
		}
?>
</body> 
</html> 
