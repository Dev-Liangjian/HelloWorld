<?php
/**
 * 项目初始化文件
 */

//设置响应头
header('Content_type:text/html;charset=utf-8;');

//定义目录常量
//定义网站根目录常量
define('DIR_ROOT', str_replace('\\', '/', __DIR__) . '/');
//定义配置文件目录常量
define('DIR_CONFIG', DIR_ROOT . 'config/');
//定义核心文件目录常量
define('DIR_CORE', DIR_ROOT . 'core/');
//定义业务逻辑处理文件目录常量
define('DIR_MODEL', DIR_ROOT . 'model/');
//定义模板文件目录常量
define('DIR_VIEW', DIR_ROOT . 'view/');
//定义上传文件uploads目录常量
define('DIR_UPLOADS', DIR_ROOT . 'uploads/' );
//定义公开文件目录常量 因css js引用该常量不能为绝对路径
define('DIR_PUBLIC', '/public');	//利用相对路径'/'表示网站根目录 


//设置时区
date_default_timezone_set('Asia/Hong_Kong');
/**
 * 跳转函数
 * @param  string  $url  间接跳转的URL
 * @param  string  $msg  提示信息
 * @param  integer $time 跳转时的等候时间
 * @return void        
 */	
function jump($url, $msg = NULL, $time = 2)
{
	if( $msg == NULL ){
	//没有提示信息说明是直接跳转URL
		header("location:{$url}");
		die();
	}else{
	//刷新跳转
		header("refresh:{$time};url={$url}");
		exit("{$msg}");
	}
}
/**
 * 封装用户的输入字符串
 * @param string $inputString 用户提交的输入字符串
 * @return string 返回经过转义去除tags的字符串
 */
function escapeString($inputString)
{
	return addslashes( strip_tags( trim($inputString) ) );
}