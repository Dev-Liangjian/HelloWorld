<?php

//加载项目初始化文件
include_once './init.php';

session_start();

//从数据库中读取相应栏目信息到首页中
include_once  DIR_CORE . 'mysqlidb.php';
$sql = "SELECT * FROM `category`;";
$result = mysqli_query($link,$sql);


//加载模板文件
include_once DIR_VIEW . 'index.html';
