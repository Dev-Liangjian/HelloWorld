<?php
/**
 * 文件上传函数
 * @param array $file 上传的文件信息
 * @param array $allowType 允许上传的文件类型
 * @param string $path 文件的存放目录
 * @param string &$errormsg 上传失败的错误信息
 * @param int $fileMaxSize=1048576 允许上传的最大文件大小
 * @return mixed 上传失败返回FALSE 成功返回文件的新名字
 * 以后修改的思路:移动文件到新目录时 为了便于管理,将当前日期作为文件存放路径
 */
function upload($file, $allowType, $path, &$errormsg, $fileMaxSize = 1048576)
{
	//验证系统级错误
	switch ($file['error']) {
		case 1: $errormsg = '文件大小超出服务器限制'; 
				return false;
		case 2: $errormsg = '文件大小超过HTML表单限制';
				return false;
		case 3: $errormsg = '文件只有部分被上传';
				return false;
		case 4: $errormsg = '没有文件被上传';
				return false;
		case 6: 
		case 7: $errormsg = '服务器繁忙 请重试';
				return false;
	}
	//验证应用程序级错误
	if( $file['size'] > $fileMaxSize ){
		$errormsg = '上传的文件大小大于1M';
		return false;
	}
	if( !in_array($file['type'], $allowType) ){
		$errormsg =  '仅允许上传的文件类型有:'. implode(',', $allowType);
		return false;
	}
	//重命名文件名
	$newFileName = randName($file['name']);
	//移动文件
	$target = $path . '/' . $newFileName;
	$res = move_uploaded_file($file['tmp_name'], $target);
	if( !$res ){
		$errormsg = '上传失败 无法将文件保存到指定位置';
		return false;
	}else{
		return $newFileName;
	}
}
/**
 * 生成一个随机文件名
 * @param string $oldFileName 文件原始名字
 * @return string 返回文件的新名字(包括后缀名)
 */
function randName($oldFileName)
{
	//生成文件的年月日时分秒
	$newFileName = date('YmdHis');
	//拼接上4位随机整数
	for($i = 0; $i < 4; $i++){
		$newFileName .= mt_rand(0,9);
	}
	$newFileName .= strrchr($oldFileName, '.');
	return $newFileName;
}
?>