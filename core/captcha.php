<?php
//验证码生成文件

/**
 * 产生随机字符串
 * @param int $len 输出的随机字符串的长度 默认为4
 * @return string 返回包含字母以及数字2-9的随机字符串
 */
function randstring($len = 4)
{
	// 生成码值数组,不需要0，避免与字母o冲突
	$char = array_merge(range('A', 'Z'), range('a', 'z'), range(2, 9));
	//随机获取$len个码值的键，并保证是数组
	$rand_keys = (array) array_rand($char, $len);
	// 打乱随机获取的码值键的数组
	shuffle($rand_keys);
	//根据键获取对应的码值，并拼接成验证码字符串
	$VerificationCode = '';
	foreach ($rand_keys as $key) {
		$VerificationCode .= $char[$key];
	}
	unset($key);
	return $VerificationCode;
}
//1. 创建画布
$img = imagecreatetruecolor(120,50);

//2. 填充背景色
$bgcolor = imagecolorallocate($img, mt_rand(180,255), mt_rand(180,255), mt_rand(180,255));
imagefill($img, 0, 0, $bgcolor);
//3. 产生随机字符串
$str = randstring();

//将验证码字符串保存到session中
session_start();
$_SESSION['captcha'] = $str;
//4. 绘制文字
$span  = floor(100/4);	//计算字符间距
for($i = 0; $i< 5; $i++){
	$textcolor = imagecolorallocate($img, mt_rand(0,100), mt_rand(0,120), mt_rand(0,120));
	imagestring($img, 5, ($i+1)*$span, 20, $str[$i], $textcolor);
}
//5. 添加干扰线
for($i = 0; $i< 5; $i++){
	$linecolor = imagecolorallocate($img, mt_rand(0,100), mt_rand(0,120), mt_rand(0,120));
	imageline($img, mt_rand(0,119), mt_rand(0,49), mt_rand(0,119), mt_rand(0,49), $linecolor);
}
//6. 添加干扰点
for($i = 0; $i < 120*50*0.02; $i++){
	$pixelcolor = imagecolorallocate($img, mt_rand(0,100), mt_rand(0,120), mt_rand(0,120));
	imagesetpixel($img, mt_rand(0,119), mt_rand(0,49), $pixelcolor);
}
//7. 输出图像
header('Content-Type:image/png;');
ob_clean();
imagepng($img);
//8. 销毁图像
imagedestroy($img);
?>