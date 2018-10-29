<?php

include_once '../init.php';

session_start();

include_once DIR_CORE . 'mysqlidb.php';


//接收用户提交的搜素关键字
if( !isset($_GET['keyword'])  || empty($_GET['keyword']) ){
	die('请输入关键词进行查询');
}
$keyword = escapeString($_GET['keyword']);
//---------------------------分页代码---------------------------
//当前页码
$currentPageNum = isset($_GET['pagenum']) ? $_GET['pagenum'] : 1;
//每页显示的记录数
$rowsPerPage = 5;
//查询总记录数
$sql = "SELECT count(*) AS sum FROM `note` WHERE `note_title` LIKE '%{$keyword}%';";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);
$rowCount = $row['sum'];

//如果查询的结果为0 即找不到关键字
if( $rowCount == 0 ){
	die('找不到关键字' . $keyword);
}
//计算总页数
$pages = ceil($rowCount / $rowsPerPage);
//拼凑出页码字符串
$strPage = '';

$strPage .= "<a href='./list_son.php?keyword={$keyword}&pagenum=1'>首页</a>";

$preNum = ($currentPageNum == 1) ? 1 : $currentPageNum - 1;
$strPage .= "<a href='./list_son.php?keyword={$keyword}&pagenum={$preNum}'><<上一页</a>";


//确定显示的第一个页码$startNum的值
if($currentPageNum <= 3){
	$startNum = 1;
}else{
	$startNum = $currentPageNum - 2;
}
if($startNum > $pages - 4){
	//界定$startNum的上限
	$startNum = $pages - 4;
}
if($startNum <= 1){
	//界定$startNum的下限
	$startNum = 1;
}
//确定显示的最后一个页码$endNum的值
$endNum = $startNum + 4;
if($endNum > $pages){
	$endNum = $pages;
}
//拼凑出中间的页码
for($i = $startNum; $i <= $endNum; $i++){
	if( $i == $currentPageNum ){
		$strPage .= "<a href='./list_son.php?keyword={$keyword}&pagenum={$i}' style='background: #488fcf;'>{$i}</a>";
	}else{
		$strPage .= "<a href='./list_son.php?keyword={$keyword}&pagenum={$i}'>{$i}</a>";
	}
}

$nextNum = ($currentPageNum == $pages) ? $pages : $currentPageNum + 1;
$strPage .= "<a href='./list_son.php?keyword={$keyword}&pagenum={$nextNum}'>下一页>></a>";

$strPage .= "<a href='./list_son.php?keyword={$keyword}&pagenum={$pages}'>尾页</a>";
//---------------------------分页代码---------------------------

$offset = ($currentPageNum - 1) * $rowsPerPage;
$sql = "SELECT * FROM `note`,`user`,`userinfo` 
		WHERE `note`.`note_owner` = `user`.`user_name` AND `user`.`user_id` = `userinfo`.`userinfo_id`  
		AND `note_title` LIKE '%{$keyword}%' 
		ORDER BY `note_time` DESC LIMIT {$rowsPerPage} OFFSET {$offset};";
$result = mysqli_query($link,$sql);


include_once DIR_VIEW . 'list_son.html';

mysqli_close($link);