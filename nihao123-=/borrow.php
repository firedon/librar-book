<?php 
//初始化session
session_start();
include ('head.php');
require ('dbconnect.php');
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
<head>
<title>借阅管理</title>
</head>
<script language="javascript"> 
	function checkall(form){
		var ch=document.getElementsByName("bookbox[]");
if(document.getElementsByName("selectall")[0].checked==true)
{
for(var i=0;i<ch.length;i++)
{
ch[i].checked=true;
}
}else{
for(var i=0;i<ch.length;i++)
{
ch[i].checked=false;
}
}
	}
</script>
<body>
<div class="content">
<form name="form1" method="post" action="" >
  <table width="780" border="3" cellspacing="1" cellpadding="3" align="center" style="background:yellow">
    <tr> 
      <th colspan="2"><h2 align="center">图书查找</h2></th>
    </tr>
    <tr> 
      <td width="330" height="32" align="right">图书名字:</td>
      <td width="450" height="32"> 
        <input type="text" name="book_title" size="15">
        <input type="submit" name="show" value="查询">
      </td>
    </tr>    
  </table>
</form>

<?php
	// 提交前
if(@$_POST["show"]){
	// 如果图书编号没填写，提示用户
		if ($_POST["book_title"]==""){	
			echo "<div align=center><font color=red>请输入所需图书！</font></div>";
			exit();
		}
	else {
		$book_id=$_POST['book_title'];	//需做安全措施
		$book_id=addslashes($book_id);
		
		$booksql="select * from book where title like '%$book_id%';";
		$bookresult=mysqli_query($booksql,$conn);
				// 显示该书详细信息
		echo "<form name='form1' method='post' action=''>";
		echo "<table width='780' border='1' bgcolor='red' align='center'>";
		echo "<th align='left' width='50'><INPUT TYPE='checkbox' NAME='selectall' VALUE='1' onclick='checkall(form1)'>全选</th>";
		echo "<th width='60'>图书编号</th>";
		echo "<th width='180'>书名</th>";
		echo "<th width='180'>作者</th>";
		echo "<th width='120'>出版社</th>";
		echo "<th width='80'>出版年份</th>";
		echo "<th width='100'>现有数量（本）</th>";
		//多条记录
		while($bookinfo=mysqli_fetch_array($bookresult))
		{	//mysqli_fetch_array():如果你的返回结果集不是一条记录的话,需要循环获得
			echo "<tr align='center'><td align='left'><input type='checkbox' name='bookbox[]' value='$bookinfo[id]'></td>";
			echo "<td>$bookinfo[id]</td>";
			echo "<td>$bookinfo[title]</td>";
			echo "<td>$bookinfo[author]</td>";
			echo "<td>$bookinfo[publisher]</td>";
			echo "<td>$bookinfo[publish_year]</td>";
			echo "<td>$bookinfo[leave_number]</td>";
			echo "<input type='hidden' name='book_title[]' value='$bookinfo[title]'>";
			echo "<input type='hidden' name='leave_num[]' value='$bookinfo[leave_number]'>";
			echo "</tr>";
		}
		echo "<tr><td colspan='7' align='center'>借书用户：<input type='text' name='user'><input type='submit' name='lend' value='确认借出'></td></tr>;";
		
		echo "</table></form>";
	}
}
if(@$_POST['lend']){
	$username=$_POST['user'];
	$sql1="select * from user where name='$username'";
	$result=mysqli_query($sql1,$conn);
	$row=mysqli_fetch_array($result);
	//如果已存在，提示用户重新注册
	if(!$row){
		echo "<p align='center'>该用户不存在，请重新输入!</p>";
		exit();
	}
	else{
		$time =date("Y-m-d");
		$title=$_POST['book_title'];
		$bookbox=$_POST['bookbox'];
		$lvnum=$_POST['leave_num'];
		for($i=0;$i<count($bookbox);$i++){
			$book_id=$bookbox[$i];
			$book_title=$title[$i];
			$leave_num=$lvnum[$i];
			if(!$leave_num){
				echo "<div align='center' ><font color=red>编号为:".$book_id."的图书已借完！</font></div>";
				continue;
			}
			$lendsql="insert into lend(book_id,book_title,lend_time,user_name) values('$book_id','$book_title','$time','$username')";
		mysqli_query($lendsql,$conn) or die ("操作失败：".mysqli_error());
		// 还需要在log中记录
		$logsql="insert into lend_log(book_id,book_title,user_name,lend_time) values('$book_id','$book_title','$username','$time')";
		mysqli_query($logsql,$conn) or die ("记录失败：".mysqli_error());
		// 借出后需要在该书记录中库存剩余数减一
		echo "<div align='center' ><font color=red>借阅登记完成！</font></div>";
		$leave_num=$leave_num-1;
		if($leave_num<=0)$leave_num=0;
		mysqli_query("update book set leave_number='$leave_num' where id='$book_id'",$conn);
		}
	}
}

		

?>
</div>
</body>
</html>