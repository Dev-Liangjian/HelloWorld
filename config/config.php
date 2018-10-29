<?php
//项目配置文件

return  array(
	//数据库配置信息
	'db' => array(
		'host' => 'localhost',
		'port' => '3306',
		'user' => 'root',
		'password' => '123456',
		'charset' => 'utf8',
		'dbname' => 'forum',
		),
	//其他配置信息
	'page' => array(
			'PerPageRecords' => 5, //每页显示的记录数
			'pageMaxNumber' => 5,	//每页显示的页码数量
		),
	 );