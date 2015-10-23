<?php
header("Content-type: text/html; charset=utf-8");

if(get_magic_quotes_gpc()){
	function stripslashes_deep($value){
		$value = is_array($value) ? array_map('stripslashes_deep',$value) : stripslashes($value);
		return $value;
	}
	$_POST = array_map('stripslashes_deep',$_POST);
	$_GET = array_map('stripslashes_deep',$_GET);
	$_COOKIE = array_map('stripslashes_deep',$_COOKIE);
}

define('APP_NAME', 'cms');	//��Ŀ����
define('APP_PATH','./cms/');	//��ĿĿ¼
define('CONF_PATH','./conf/');	//�����ļ���ַ
define('RUNTIME_PATH','./runtime/');	//�����ļ���ַ
define('TMPL_PATH','./tpl/');	//ģ��Ŀ¼
define('APP_DEBUG',true);	//����DEBUG
define('MEMORY_LIMIT_ON',function_exists('memory_get_usage'));

$_GET['g'] = 'Merchant';
if(empty($_GET['c'])){
	$_GET['c'] = 'Store';
}

$runtime = '~Store_runtime.php';
define('RUNTIME_FILE',RUNTIME_PATH.$runtime);
if(!APP_DEBUG && is_file(RUNTIME_FILE)){
    require RUNTIME_FILE;
}else{
    define('THINK_PATH', dirname(__FILE__).'/core/');
    require THINK_PATH.'Common/runtime.php';
}
?>