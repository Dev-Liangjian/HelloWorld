<?php
//分页函数
/**
 * 分页函数
 * @param  int $CountRecords    总记录数
 * @param  int $PerPageRecords  每页显示的记录数
 * @param  int $pageMaxNumber 	每页显示的页码数量
 * @param  string $url        	换页时转跳的URL(该URL末尾带?)
 * @return string             	生成的页码字符串
 */
function page($CountRecords, $PerPageRecords, $pageMaxNumber, $url)
{
	//当前页码
	$currentPageNum = isset($_GET['pagenum']) ? $_GET['pagenum'] : 1;
	//计算总页数
	$pages = ceil($CountRecords / $PerPageRecords);
	//拼凑出页码字符串
	$strPage = '';
	$strPage .= "<a href='{$url}pagenum=1'>首页</a>";

	$preNum = ($currentPageNum == 1) ? 1 : $currentPageNum - 1;
	if( $currentPageNum != 1 ){
		$strPage .= "<a href='{$url}pagenum={$preNum}'><<上一页</a>";
	}

	//确定显示的第一个页码$startNum的值
	if($currentPageNum <= 3){
		$startNum = 1;
	}else{
		$startNum = $currentPageNum - 2;
	}
	if($startNum > $pages - ($pageMaxNumber - 1)){
		//界定$startNum的上限
		$startNum = $pages - ($pageMaxNumber - 1);
	}
	if($startNum <= 1){
		//界定$startNum的下限
		$startNum = 1;
	}
	//确定显示的最后一个页码$endNum的值
	$endNum = $startNum + ($pageMaxNumber - 1);
	if($endNum > $pages){
		$endNum = $pages;
	}

	//拼凑出中间的页码
	for($i = $startNum; $i <= $endNum; $i++){
		if( $i == $currentPageNum ){
			$strPage .= "<a href='{$url}pagenum={$i}' style='background: #488fcf;'>{$i}</a>";
		}else{
			$strPage .= "<a href='{$url}pagenum={$i}'>{$i}</a>";
		}
	}
	$nextNum = ($currentPageNum == $pages) ? $pages : $currentPageNum + 1;
	if( $currentPageNum != $pages ){
		$strPage .= "<a href='{$url}pagenum={$nextNum}'>下一页>></a>";
	}

	$strPage .= "<a href='{$url}pagenum={$pages}'>尾页</a>";
	return $strPage;
}
?>