<?php
//处理编辑回帖页提交的数据

include_once '../init.php';

$note_id = $_POST['note_id'];
$reply_content = escapeString($_POST['reply_content']);
$reply_time = time();
//检查回帖内容的合法性
if( empty($reply_content) ){
	jump("./reply.php?note_id={$note_id}",'回帖内容不能为空');
}
//在会话数据区中提取用户登录信息
session_start();
$reply_user = $_SESSION['userLoginInfo']['user_name'];

//将回帖内容存入reply数据表
include_once DIR_CORE . 'mysqlidb.php';

$sql = "INSERT INTO `reply`(`reply_note_id`,`reply_user`,`reply_content`,`reply_time`,`reply_quote_id`,`reply_floor`)
		VALUES({$note_id},'{$reply_user}','{$reply_content}',{$reply_time},DEFAULT,DEFAULT);";
$res = mysqli_query($link,$sql);

//回帖成功 跳转到主贴详情页
if( $res ){
	jump("./show.php?note_id={$note_id}&action=reply");
}else{
	jump("./reply.php?note_id={$note_id}",'回帖发生未知错误 请重试');
}

mysqli_close($link);
