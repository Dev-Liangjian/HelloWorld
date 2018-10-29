<?php
//引用回帖
include_once '../init.php';

//判断用户是否登录
session_start();
if( !isset($_SESSION['userLoginInfo']) ){
	jump('./login.php','回帖前请先登录');
}


//主贴ID
$reply_note_id = $_GET['reply_note_id'];
//被引用的回帖ID
$reply_id = $_GET['reply_id'];
//被引用的回帖所在楼层
$reply_floor = $_GET['reply_floor'];

//连接数据库
include_once DIR_CORE . 'mysqlidb.php';

//获取主贴的楼主名以及主贴标题
$sql = "SELECT `note_owner`,`note_title` FROM `note` WHERE `note_id` = {$reply_note_id};";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);

//获取引用回帖的作者 引用回帖内容
$sql = "SELECT `reply_user`,`reply_content` FROM `reply` WHERE `reply_id` = {$reply_id};";
$RepResult = mysqli_query($link,$sql);
$RepRow = mysqli_fetch_assoc($RepResult);

include_once DIR_VIEW . 'quote.html';