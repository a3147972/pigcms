<?php

header('Content-type: text/html; charset=utf-8');
$_GET['g'] = 'Wap';
$_GET['c'] = 'Pay';
$_GET['a'] = 'return_url';
$_GET['pay_type'] = 'yeepay';
define('APP_NAME', 'cms');
define('APP_PATH', '../cms/');
define('CONF_PATH', '../conf/');
define('RUNTIME_PATH', '../runtime/');
define('TMPL_PATH', '../tpl/');
define('APP_DEBUG', true);
define('MEMORY_LIMIT_ON', function_exists('memory_get_usage'));
$runtime = (defined('MODE_NAME') ? '~' . strtolower(MODE_NAME) . '_runtime.php' : '~runtime.php');
define('RUNTIME_FILE', RUNTIME_PATH . $runtime);
$runtime_file = RUNTIME_PATH . '~runtime.php';
if (!APP_DEBUG && is_file($runtime_file)) {
	require $runtime_file;
}
else {
	define('THINK_PATH', dirname(__FILE__) . '/../core/');
	require THINK_PATH . 'Common/runtime.php';
}

?>
