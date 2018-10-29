<?php
//删除回帖
include_once '../init.php';
$delreply_id = $_POST["reply_id"];
$note_id = $_POST['note_id'];
//从数据库中删除本回贴
include_once DIR_CORE . 'mysqlidb.php';

$sql = "DELETE FROM `reply` WHERE `reply_id`={$delreply_id};";

$res = mysqli_query($link,$sql);

//删除成功 回到删除前的页面
if( $res ){
	jump("./show.php?note_id={$note_id}&action=reply");

}else{
	jump("./reply.php?note_id={$note_id}",'删除回帖发生未知错误 请重试');
}

mysqli_close($link);