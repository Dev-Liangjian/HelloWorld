<?php
//处理引用回帖
include_once '../init.php';


//主贴ID
$reply_note_id = $_GET['reply_note_id'];
//被引用的回帖ID
$reply_id = $_GET['reply_id'];
//被引用的回帖所在楼层
$reply_floor = $_GET['reply_floor'];
//引用回帖的内容
$reply_content = escapeString($_POST['reply_content']);

//判断数据的合法性
if( empty($reply_content) ){
	jump("./show.php?note_id=$reply_note_id&action=reply",'回帖内容不能为空');
}

//入库 reply表
session_start();
$reply_user = $_SESSION['userLoginInfo']['user_name'];
$reply_time = time();

include_once DIR_CORE . 'mysqlidb.php';
$sql = "INSERT INTO `reply`(`reply_note_id`,`reply_user`,`reply_content`,`reply_time`,`reply_quote_id`,`reply_floor`)
		 VALUES({$reply_note_id},'{$reply_user}','{$reply_content}',{$reply_time},{$reply_id},{$reply_floor});";
$res = mysqli_query($link,$sql);
if( $res ){
	//入库成功
	jump("./show.php?note_id=$reply_note_id&action=reply");
}else{
	//入库失败
	jump("./show.php?note_id=$reply_note_id",'回帖插入数据库失败');
}
?>