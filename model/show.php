<?php
//帖子详情页面

include_once '../init.php';

session_start();

//接收list_father.php通过GET传递过来的帖子ID
$note_id = $_GET['note_id'];

include_once DIR_CORE . 'mysqlidb.php';

//每次通过帖子列表页请求帖子详情页时 帖子的阅读量note_hits+1
if( !isset($_GET['action']) ){
	$sql = "UPDATE `note` SET `note_hits` = `note_hits` + 1 
			WHERE `note_id` = {$note_id};";
	mysqli_query($link,$sql);
}

//根据帖子ID查询出帖子的详情
$sql = "SELECT * FROM `note`,`user`,`userinfo` 
		WHERE `note`.`note_owner` = `user`.`user_name` AND `user`.`user_id` = `userinfo`.`userinfo_id`  
		AND `note_id` = {$note_id};";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);

//---------------------------分页代码---------------------------

//查询总记录数
$sql = "SELECT count(*) AS sum FROM `reply` WHERE `reply_note_id` = {$note_id};";
$result = mysqli_query($link,$sql);
$rowReplyNum = mysqli_fetch_assoc($result);
$CountRecords = $rowReplyNum['sum'];

include_once DIR_CORE . 'page.php';
//每页显示的记录数
$PerPageRecords = $config['page']['PerPageRecords'];
$strPage = page($CountRecords,$PerPageRecords,$config['page']['pageMaxNumber'],
				"./show.php?note_id={$note_id}&action=reply&");
//---------------------------分页代码---------------------------

//当前页码
$currentPageNum = isset($_GET['pagenum']) ? $_GET['pagenum'] : 1;
//查询本帖的回帖信息
$offset = ($currentPageNum - 1) * $PerPageRecords;
$sql_reply = "SELECT * FROM `reply`,`user`,`userinfo` WHERE `reply_note_id` = {$note_id} 
			AND `reply`.`reply_user` = `user`.`user_name` AND `user`.`user_id` = `userinfo`.`userinfo_id`
			ORDER BY `reply_time` LIMIT {$PerPageRecords} OFFSET {$offset};";
$result_reply = mysqli_query($link,$sql_reply);

//查询本帖的回帖数量
$ReplyCountSql = "SELECT COUNT(*) FROM `reply` WHERE `reply_note_id` = {$note_id};";
$ReplyCountResult = mysqli_query($link,$ReplyCountSql);
$ReplyCountRow = mysqli_fetch_row($ReplyCountResult);


//将帖子详情展示在模板页的合适标签当中
include_once DIR_VIEW . 'show.html';