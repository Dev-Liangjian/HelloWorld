<?php
include_once '../init.php';

//接受register.html提交的表单
$user_name = trim($_POST['user_name']);
$user_password1 = trim($_POST['user_password1']);
$user_password2 = trim($_POST['user_password2']);
$vcode = trim($_POST['vcode']);

//使用正则表达式判断数据的合法性
session_start();
if( strcasecmp($vcode, $_SESSION['captcha']) != 0){
	jump('./register.php','验证码不正确');
}
if( preg_match('/^[\w]{6,20}$/',$user_name) == 0 ){
	jump('./register.php','用户名应为6-12位的英文或数字及下划线');
}
if($user_password1 !== $user_password2){
	jump('./register.php','两次输入的密码不一致');
}
if( preg_match('/^[\w]{6,20}$/',$user_password1) == 0 ){
	jump('./register.php','密码应为6-12位的英文或数字及下划线');
}

//连接数据库
include_once DIR_CORE . 'mysqlidb.php';
$sql = "SELECT * FROM `user` WHERE `user_name` = '{$user_name}'";
mysqli_query($link,$sql);
if( mysqli_affected_rows($link) > 0 ){
	jump('./register.php','该用户名已存在!请重新注册');
}

//注册信息入库
$user_pwd = md5($user_password1);
$sql = "INSERT INTO `user`(`user_name`,`user_password`) VALUES('{$user_name}','{$user_pwd}');";
$result = mysqli_query($link,$sql);
if( $result ){
	//为新注册的用户设置默认头像
	$userinfo_id = mysqli_insert_id($link);
	$sql = "INSERT INTO `userinfo`(`userinfo_id`,`userinfo_image`) VALUES({$userinfo_id},DEFAULT);";
	mysqli_query($link,$sql);
	jump('./login.php','注册成功');
}else{
	jump('./register.php','注册失败' . mysqli_error($link));
}

mysqli_close($link);