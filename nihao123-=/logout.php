<?php
session_start();

//注销session

session_destroy();
include('head.php');
?>
<html>
<head>
<title>注销登录</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<p align="center">你已经成功注销登录！</p>
<p align="center">欢迎您的再次登录管理！</p>
<p align="center"><a href="login.php">重新登录</a></p>
</body>
</html>
