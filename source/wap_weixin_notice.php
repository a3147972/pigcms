<?php

header('Content-type: text/html; charset=utf-8');

if (get_magic_quotes_gpc()) {
	function stripslashes_deep($value)
	{
		$value = (is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value));
		return $value;
	}
	$_POST = array_map('stripslashes_deep', $_POST);
	$_GET = array_map('stripslashes_deep', $_GET);
	$_COOKIE = array_map('stripslashes_deep', $_COOKIE);
}

define('APP_NAME', 'cms');
define('APP_PATH', '../cms/');
define('CONF_PATH', '../conf/');
define('RUNTIME_PATH', '../runtime/');
define('TMPL_PATH', '../tpl/');
define('APP_DEBUG', false);
define('MEMORY_LIMIT_ON', function_exists('memory_get_usage'));
$_GET['g'] = 'Wap';
$_GET['c'] = 'Pay';
$_GET['a'] = 'return_url';
$_GET['pay_type'] = 'weixin';
$runtime = '~Wap_source_runtime.php';
define('RUNTIME_FILE', RUNTIME_PATH . $runtime);
if (!APP_DEBUG && is_file(RUNTIME_FILE)) {
	require RUNTIME_FILE;
}
else {
	define('THINK_PATH', dirname(__FILE__) . '/../core/');
	require THINK_PATH . 'Common/runtime.php';
}

?>
