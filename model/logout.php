<?php
include_once '../init.php';



//删除SESSION数据
session_start();
$_SESSION = array();
session_destroy();

//删除用户登录的数据 注销后跳转到首页
jump('../index.php','注销成功 2秒钟后跳转到首页');