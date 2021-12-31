<?php
//初始化session
session_start();
include ('head.php');
require ('dbconnect.php');
// 如果没有登录，提示登录
if(!isset($_SESSION['Adm'])) {
   echo "<p align=center>";
   echo "<font color=#FF0000 size=4><strong><big>";
   echo "您还没有登录,请<a href='adminlogin.php?url=return'>登录</a>!";
   echo "</big></strong></font></p>";
   exit();
}
?>

<html> 
<head> 
<title>还书续借</title> 
</head> 
<body>

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
<form name="form1" method="post" action="" >
 <table width="780" border="3" cellspacing="1" cellpadding="3" align="center" bgcolor="yellow">
    <tr> 
      <th colspan="2"><h2 align="center">还书登记</h2></th>
    </tr>
    <tr> 
      <td width="330" height="32" align="right">还书用户：</td>
      <td width="450" height="32"> 
        <input type="text" name="username">
        <input type="submit" name="send" value="搜索">
      </td>
    </tr>    
  </table>
</form>
<?php
if(@$_POST['send'])
{
	if(@$_POST['username']==""){
		echo "<div align=center><font color=red>请输入用户名称！</font></div>";
		exit();
		}
	else{
		$username=@$_POST['username'];
		
		
		$sql="select * from lend where user_name='$username'";
		$result=mysqli_query($sql,$conn);
		$num=mysqli_num_rows($result);
		if(!$num){
			echo "<p align=center>您的借书数量为<font color=red>0</font>！</p>";
			exit();
			}
}


echo "<p align=center>您的借书数量为<font color=red>$num</font>！已借书目如下：</p>";
echo "<form name='form1' method='post' action='returnok.php'>" ;
echo "<table width='780' border='1' bgcolor='red' align='center'>";
echo "<th align='left' width='60'><INPUT TYPE='checkbox' NAME='selectall' VALUE='1' onclick='checkall(form1)'>全选</th>";
// 隐含变量传递参数
echo "<input type=hidden name=user_name value='$username'>";
echo "<th >图书编号</th>";
echo "<th >书名</th>";
echo "<th >作者</th>";
echo "<th >出版社</th>";
echo "<th >年份</th>";
echo "<th >借阅时间</th>";
while($row=mysqli_fetch_array($result)){
	$bsql="select * from book where id='$row[book_id]'";
	$bresult=mysqli_query($bsql,$conn);
	$binfo=mysqli_fetch_array($bresult);
	echo "<tr><td><input type='checkbox' name='bookbox[]' value='$row[book_id]'></td>";
	echo "<td>$row[book_id]</td>";
	echo "<td>$binfo[title]</td>";
	echo "<td>$binfo[author]</td>";
	echo "<td>$binfo[publisher]</td>";
	echo "<td>$binfo[publish_year]</td>";
	echo "<td>$row[lend_time]</td></tr>";
}
?>
</table>
			<br>
			<table width='50%' align=center><tr><td align=center>
				<input type="submit" name="return" value="还书">
				</td><td align=center>
		        <input type="submit" name="renew" value="续借">
				</td></tr>
			</table>
			</form>
<?php
		
}	
?>
</body> 
</html> 
