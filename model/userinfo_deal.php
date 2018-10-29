<?php

include_once '../init.php';

include_once DIR_CORE . 'mysqlidb.php';

include_once DIR_CORE . 'upload.php';

$file = $_FILES['userinfoImage'];
$allowType = array('image/jpg','image/jpeg','image/png');
$path = DIR_UPLOADS . 'images';

$up = upload($file, $allowType, $path, $errormsg);

//判断是否上传成功
if( $up ){
	//根据当前登录用户
	session_start();
	$user_id = $_SESSION['userLoginInfo']['user_id'];

	//提取旧头像名
	$sql = "SELECT `userinfo_image` FROM `userinfo` WHERE `userinfo_id` = {$user_id};";
	$res = mysqli_query($link,$sql);
	$row = mysqli_fetch_assoc($res);
	$imageName = $row['userinfo_image'];

	$sql = "UPDATE `userinfo` SET `userinfo_image` = '$up' WHERE `userinfo_id` = {$user_id};";
	$res = mysqli_query($link,$sql);
	//判断是否入库成功
	if( $res ){
		//删除旧头像文件
		if( $imageName != 'default.jpg' ){
			unlink($path . '/' . $imageName);
		}
		jump('./list_father.php','头像上传并入库成功');
	}else{
		jump('./userinfo.php','更新头像数据库失败');
	}
}else{
	jump('./userinfo.php','上传图片失败');
}
?>