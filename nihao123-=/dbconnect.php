<?php
$conn=mysqli_connect("127.0.0.1","root","123qwe") 
        or die("不能连接数据库服务器： ".mysqli_error($conn));
mysqli_select_db($conn,"book") or die ("不能选择数据库: ".mysqli_error($conn));
mysqli_query($conn,'set names utf8 ');
?>