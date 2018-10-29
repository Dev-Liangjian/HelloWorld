<?php
include_once '../init.php';


session_start();

include_once DIR_CORE . 'mysqlidb.php';

//---------------------------分页代码---------------------------

$category_id = isset($_GET['category_id']) ? $_GET['category_id']  : 1;
//查询总记录数
$sql = "SELECT count(*) AS sum FROM `note` WHERE `note_category_id` = {$category_id};";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);
$CountRecords = $row['sum'];

//引入分页文件
include_once DIR_CORE . 'page.php';
//每页显示的记录数
$PerPageRecords = $config['page']['PerPageRecords'];
$strPage = page($CountRecords,$PerPageRecords,$config['page']['pageMaxNumber'],"./list_father.php?category_id={$category_id}&");

//---------------------------分页代码---------------------------

$currentPageNum = isset($_GET['pagenum']) ? $_GET['pagenum'] : 1;
$offset = ($currentPageNum - 1) * $PerPageRecords;
$sql = "SELECT * FROM `note`,`user`,`userinfo`
		WHERE `note`.`note_owner` = `user`.`user_name` AND `user`.`user_id` = `userinfo`.`userinfo_id` 
				AND  `note`.`note_category_id` = {$category_id}
		ORDER BY `note_time` DESC LIMIT {$PerPageRecords} OFFSET {$offset};";
$result = mysqli_query($link,$sql);


//读取category表的信息
$categorySql = "SELECT * FROM `category` WHERE `category_id` = {$category_id};";
$categoryResult = mysqli_query($link,$categorySql);
$categoryRow = mysqli_fetch_assoc($categoryResult);
$category_name = $categoryRow['category_name']; 
mysqli_free_result ($categoryResult);

//读取当日发帖量
$today = date("Y-m-d");
$sql = "SELECT count(*) FROM `note` 
		WHERE `note_category_id` = {$category_id} 
		AND FROM_UNIXTIME(`note_time`,'%Y-%m-%d') = '{$today}';";
$todayNoteRes = mysqli_query($link,$sql);
$todayNoteRow = mysqli_fetch_row($todayNoteRes);
$todayNoteCount = $todayNoteRow[0];
mysqli_free_result($todayNoteRes);

//读取category信息到板块列表中
$sql = "SELECT * FROM `category`;";
$listResult = mysqli_query($link,$sql);



include_once DIR_VIEW . 'list_father.html';

mysqli_close($link);