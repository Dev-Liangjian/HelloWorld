<?php
//编辑回帖页
include_once '../init.php';

//判断用户是否登录
session_start();
if( !isset($_SESSION['userLoginInfo']) ){
	jump('./login.php','回帖前请先登录');
}


include_once DIR_CORE . 'mysqlidb.php';
$note_id = $_GET['note_id'];
$sql = "SELECT * FROM `note` WHERE `note_id` = {$note_id};";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);


include_once  DIR_VIEW . 'reply.html';

mysqli_close($link);