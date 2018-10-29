<?php
//处理publish.php文件提交过来的表单数据

include_once '../init.php';

//接收表单提交的数据
$note_category_id = $_POST['module_id'];
$note_title = escapeString($_POST['note_title']);
$note_content = escapeString($_POST['note_content']);
$note_time = time();
//判断数据的合法性
if( empty($note_title) || empty($note_content) ){
	jump('./publish.php','帖子标题和内容都不能为空');
}

//在会话数据区中提取用户登录信息
session_start();
$note_owner = $_SESSION['userLoginInfo']['user_name'];

//帖子存入note数据表
include_once  DIR_CORE . 'mysqlidb.php';

$sql = "INSERT INTO `note`(`note_title`,`note_content`,`note_owner`,`note_time`,`note_category_id`)
		VALUES('{$note_title}','{$note_content}','{$note_owner}',{$note_time},{$note_category_id})";
$result = mysqli_query($link,$sql);
if( $result ){
	jump('./list_father.php?category_id='.$note_category_id);
}else{
	jump('./publish.php','发帖失败,写入数据库发生未知错误');
}

mysqli_close($link);