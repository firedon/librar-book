<?php
//初始化session
session_start();
include ('head.php');
require ('dbconnect.php');
// 如果没有登录过，提示用户登录
if(!isset($_SESSION['user'])) {
   echo "<p align=center>";
   echo "<font color=#FF0000 size=4><strong><big>";
   echo "您还没有登录,请<a href='login.php?url=browse'>登录</a>!";
   echo "</big></strong></font></p>";
   exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<div class="content">
<table width="782" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="22">
	<?php
	$pagesize=10;//设定每一页显示的记录数
	$sql="select * from book order by id desc";
	$rs=mysqli_query($sql);
	$recordcount=mysqli_num_rows($rs);//取得记录总数$rs
	$pagecount=$recordcount/$pagesize;
	if($pagecount>(int)$pagecount) $pagecount=(int)$pagecount+1;	//总页数
	//echo $pagecount."<br>";
	//echo $recordcount."<br>";
	@$pageno=$_GET["pageno"];
	//判断“当前页码”是否赋值过
	if($pageno=="")
	{
		$pageno=1;
	}
	if($pageno<1)
	{
		$pageno=1;
	}
	if($pageno>$pagecount)
	{
		$pageno=$pagecount;
	}
	$startno=($pageno-1)*$pagesize;
	//echo $startno;
	$sql="select * from book order by id asc limit $startno,$pagesize";
	$rs=mysqli_query($sql);
?>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
		<td width="60" height="30" align="center" bgcolor="#FFFFFF" class="line2">ID</td>
	    <td width="180" align="center" bgcolor="#FFFFFF" class="line2">书名</td>
	    <td width="180" align="center" bgcolor="#FFFFFF" class="line2">作者</td>
	    <td width="120" align="center" bgcolor="#FFFFFF" class="line2">出版社</td>
	    <td width="80" align="center" bgcolor="#FFFFFF" class="line2">出版年份</td>
	    <td width="80" align="center" bgcolor="#FFFFFF" class="line2">现有数量(本)</td>
	    <td width="80" align="center" bgcolor="#FFFFFF" class="line2">备注</td>
	    </tr>
    <?php
	while($rows=mysqli_fetch_assoc($rs))
	{
	?>
	<tr>
	  <td height="30" align="center" bgcolor="#FFFFFF"><?php echo $rows["id"];?></td>
	  <td align="center" bgcolor="#FFFFFF"><?php echo $rows["title"];?></td>
	  <td align="center" bgcolor="#FFFFFF"><?php echo $rows["author"];?></td>
	  <td align="center" bgcolor="#FFFFFF"><?php echo $rows["publisher"];?></td>
	  <td align="center" bgcolor="#FFFFFF"><?php echo $rows["publish_year"];?></td>
	  <td align="center" bgcolor="#FFFFFF"><?php echo $rows["leave_number"];?></td>
	  <td align="center" bgcolor="#FFFFFF"><?php echo $rows["other"];?></td>
	</tr>
	<?php
	}
?>
</table>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
  <td height="35" align="center" bgcolor="#FFFFFF">
  <?php
	if($pageno==1)
	{
	?>
  <a href="browse.php">首页</a> | <a href="browse.php">上一页</a> | <a href="browse.php?pageno=<?php echo $pageno+1?>">下一页</a> | <a href="browse.php?pageno=<?php echo urlencode($pagecount)?>">末页</a>
 <?php
	}
	else if($pageno==$pagecount)
	{
	?>
	<a href="browse.php">首页</a> | <a href="browse.php?pageno=<?php echo $pageno-1?>">上一页</a> | <a href="browse.php?pageno=<?php echo urlencode($pagecount)?>">下一页</a> | <a href="browse.php?pageno=<?php echo urlencode($pagecount)?>">末页</a>
	<?php
	}
	else {
		?>
		<a href="browse.php">首页</a> | <a href="browse.php?pageno=<?php echo $pageno-1?>">上一页</a> | <a href="browse.php?pageno=<?php echo $pageno+1?>">下一页</a> | <a href="browse.php?pageno=<?php echo urlencode($pagecount)?>">末页</a>
	<?php
	}
	?>
    &nbsp;页次：<?php echo $pageno ?>/<?php echo $pagecount ?>页&nbsp;共有<?php echo $recordcount?>条信息</td>
  </tr>
</table></td></tr>
</table>
</div>
</body>
</html>