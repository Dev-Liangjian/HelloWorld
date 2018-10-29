<?php
//处理用户信息

include_once '../init.php';

//判断用户是否登录
session_start();
if( !isset($_SESSION['userLoginInfo']) ){
	jump('./login.php','编辑个人信息请登录');
}

$user_id = $_SESSION['userLoginInfo']['user_id'];
$user_name = $_SESSION['userLoginInfo']['user_name'];
//读取userinfo表的用户信息
include_once DIR_CORE . 'mysqlidb.php';
$sql = "SELECT `userinfo_sex`,`userinfo_region`,`userinfo_industry`,`userinfo_text`,`userinfo_image`,`userinfo_email`
		 FROM `userinfo`,`user` WHERE `user_id` = `userinfo_id` AND `user_id` = {$user_id};";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);

$province = substr($row['userinfo_region'],0,6);
$city = substr($row['userinfo_region'],6);


include_once DIR_VIEW . 'userinfo.html';