<?php
/*
 * 项目公共配置
 *
 */
define('PC_NOW_THEME','new');
return array(

	/*加载额外配置文件*/
	'LOAD_EXT_CONFIG' 		=> 'db,version',
	'APP_AUTOLOAD_PATH'     => '@.ORG',

	//'OUTPUT_ENCODE'         => true, 			//页面压缩输出

	/*URL配置*/
	'URL_MODEL' 			=> '0',

	/*分组配置*/
	'APP_GROUP_LIST' 		=> 'Index,Group,Meal,User,Merchant,System,Lottery', 	//项目分组设定
	'DEFAULT_GROUP' 		=> 'Index', 			//默认分组

	/*系统变量名称设置*/
	'VAR_MODULE'  			=> 'c',				//将系统默认的m改为c

	/*Cookie配置*/
	'COOKIE_PATH'           => '/',     		// Cookie路径
    'COOKIE_PREFIX'         => '',      		// Cookie前缀 避免冲突

	/*定义模版标签*/
	'TMPL_L_DELIM'   		=> '{pigcms{',		//模板引擎普通标签开始标记
	'TMPL_R_DELIM'			=> '}',				//模板引擎普通标签结束标记
	'TMPL_TEMPLATE_SUFFIX'	=> '.php',			//默认模板文件后缀

	/*常用文件定义*/
	'JQUERY_FILE' 			=> './static/js/jquery.min.js',				// Jquery 文件


	/*跳转的模板文件*/
	'TMPL_ACTION_SUCCESS'   => TMPL_PATH.'error.php',
	'TMPL_ACTION_ERROR'     => TMPL_PATH.'error.php',

	/*缓存*/
	'DATA_CACHE_SUBDIR'		=> false,
	'DATA_PATH_LEVEL'		=> 2,

	'VAR_FILTERS' => 'arr_htmlspecialchars',

	'TAGLIB_PRE_LOAD' => 'pigcms' ,
	/*调试*/
	//'SHOW_PAGE_TRACE' =>true,
);
?>