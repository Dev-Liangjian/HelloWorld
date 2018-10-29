<?php
//数据库连接文件

// 加载配置文件
$config = include_once DIR_CONFIG . 'config.php';

$link = mysqli_connect($config['db']['host'],$config['db']['user'],$config['db']['password'],
						$config['db']['dbname'],$config['db']['port']);
//相当于 $link = mysqli_connect('localhost','root','123456','forum',3306);
if (!$link) {
    die('数据库连接失败: ' . mysqli_connect_error());
}
// 选择默认字符集
mysqli_set_charset($link,'utf8');

?>