<?php

//加载项目初始化文件
include_once '../init.php';

//接收login.html提交过来的表单 进行登录验证
$user_name = trim($_POST['user_name']);
$user_password = trim($_POST['user_password']);
//验证用户的合法性
if( empty($user_name) || empty($user_password) ){
	jump('./login.php','用户名或密码不能为空');
}

//连接数据库
include_once DIR_CORE . 'mysqlidb.php';

$sql = "SELECT * FROM `user` WHERE `user_name` = '{$user_name}'";
$result = mysqli_query($link,$sql);
if( mysqli_affected_rows($link) == 0 ){
	jump('./login.php','该用户不存在');
}
$row = mysqli_fetch_assoc($result);
$true_password = $row['user_password'];
if( $true_password === md5($user_password) ){
	//为用户建立数据会话区 保存用户登录信息
	session_start();
	$_SESSION['userLoginInfo']['user_id'] = $row['user_id'];
	$_SESSION['userLoginInfo']['user_name'] = $row['user_name'];
	jump('./list_father.php','登录成功 2秒后转跳到帖子列表页');
}else{
	jump('./login.php','密码错误');
}
mysqli_close($link);