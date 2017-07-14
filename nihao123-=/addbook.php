<?php 
//初始化session
session_start();
include ('head.php');
require ('dbconnect.php');
// 如果没有登录，提示登录
if(!isset($_SESSION['Adm'])) {
   echo "<p align=center>";
   echo "<font color=#FF0000 size=4><strong><big>";
   echo "您还没有登录,请<a href='adminlogin.php?url=addbook'>登录</a>!";
   echo "</big></strong></font></p>";
   exit();
}
?>

<script language="javascript"> 
    function checkadd()
    { 	
		if (form1.title.value=="")
		{
			// 如果书名名为空，则显示警告信息
	        alert("书名不能为空！");
			form1.title.focus();
			return false;
	    }
		if (form1.author.value=="" )
		{
			// 如果作者为空，则显示警告信息
	        alert("作者不能为空！");
			form1.author.focus();
			return false;
	    }
		if (form1.publisher.value=="" )
		{
			// 如果出版社为空，则显示警告信息
	        alert("出版社不能为空！");
			form1.publisher.focus();
			return false;
	    }
		if (form1.publish_year.value=="")
		{
			// 如果出版年份为空，则显示警告信息
	        alert("出版年份不能为空！");
			form1.publish_year.focus();
			return false;
	    }
		if (form1.publish_year.value <1880 || form1.publish_year.value >2018)
		{
			// 如果出版年份不正确，则显示警告信息
	        alert("出版年份不正确！");
			form1.publish_year.focus();
			return false;
	    }
		if (form1.total.value=="")
		{
			// 如果入库数量为空，则显示警告信息
	        alert("入库数量不能为空！");
			form1.total.focus();
			return false;
	    }
								
		return true;

    }	
</script>

<html>
<head>
<title>新书入库</title> 
</head>
<body>
<form name="form1" method="post" action="addbookok.php" onsubmit="return checkadd()">
  <table width="780" border="3" cellspacing="1" cellpadding="3" align="center" bgcolor="">
    <tr> 
      <th colspan="2"><h2 align="center">新书入库</h2></th>
    </tr>
    <tr> 
      <td width="300" height="32" align="right">书名：</td>
      <td width="480" height="32"> 
		<input type="text" name="title" size="50" maxlength="100">
      </td>
    </tr>
    <tr> 
      <td width="350" align="right">作者：</td>
      <td width="430"> 
        <input type="text" name="author" size="50" maxlength="100">
      </td>
    </tr>
    <tr> 
      <td width="350" align="right">出版社：</td>
      <td width="430"> 
        <input type="text" name="publisher" size="50" maxlength="50">
      </td>
    </tr>
    <tr> 
      <td width="350" align="right">出版年份：</td>
      <td width="430"> 
        <input type="text" name="publish_year" size="10" maxlength="10">
        年 </td>
    </tr>
    <tr> 
      <td width="350" align="right">入库数量：</td>
      <td width="430"> 
        <input type="text" name="total" size="10" maxlength="10">
        册</td>
    </tr>
    <tr> 
      <td width="350" align="right">备注：</td>
      <td width="430"> 
        <textarea name="other" cols="50"></textarea>
      </td>
    </tr>
    <tr> 
      <td width="350" align="right"> 
        <input type="submit" name="Submit" value="提交">
      </td>
      <td width="430"> 
        <input type="reset" name="Reset" value="重置">
      </td>
    </tr>
  </table>
</form>



</body>
</html>