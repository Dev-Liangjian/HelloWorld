<?php

//加载项目初始化文件
include_once '../init.php';

session_start();
if( !isset($_SESSION['userLoginInfo']) ){
	jump('./login.php','发帖前请先登录');
}

include_once  DIR_CORE . 'mysqlidb.php';
$sql = "SELECT * FROM `category`;";
$result = mysqli_query($link,$sql);

//加载模板文件
include_once DIR_VIEW . 'publish.html';

mysqli_close($link);