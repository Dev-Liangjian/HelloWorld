<?php

//加载项目初始化文件
include_once '../init.php';

session_start();
if( isset($_SESSION['userLoginInfo']) ){
	jump('./list_father.php');
}

//加载模板文件
include_once DIR_VIEW . 'login.html';