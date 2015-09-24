<?php
class clickEventReply 
{
	private $_config = '';
	
	public $data = array();
	
	/**
	 * @param array $config
	 * config 数组包含 appid appsercet token encodingaeskey
	 * 即 $config = array('wechat_appid' => '', 'wechat_appsecret' => '', 'wechat_token' => '', 'wechat_encodingaeskey' => '');
	 * @param array $data
	 * data是微信发给服务 xml信息，进过解析的数组信息
	 */
	public function __construct($config, $data)
	{
		$this->_config = $config;
		
		$this->data = $data;
	}
	
	
	/**
	 * @return 
	 * 
	 * isuse = 0:使用系统的回复，您的回复无效，1：使用您的回复，系统回复处理无效
	 */
	public function index()
	{
    	//多(单)图文的返回形式   
		//$return[] = array('title（图文消息标题）', 'Description(图文消息描述)', 'PicUrl（图片链接）', 'url（点击图文消息跳转链接）'); 按这个顺序填写相应的内容，无需下标
		//demo
		$return[] = array('例子1', '这是例子的描述1', C('config.site_logo'), C('config.site_url'));
		$return[] = array('例子2', '这是例子的描述2', C('config.site_logo'), C('config.site_url'));
		$return[] = array('例子3', '这是例子的描述3', C('config.site_logo'), C('config.site_url'));
		$return[] = array('例子4', '这是例子的描述4', C('config.site_logo'), C('config.site_url'));
		$return[] = array('例子5', '这是例子的描述5', C('config.site_logo'), C('config.site_url'));
		$return[] = array('例子6', '这是例子的描述6', C('config.site_logo'), C('config.site_url'));
		$return[] = array('例子7', '这是例子的描述7', C('config.site_logo'), C('config.site_url'));
		$return[] = array('例子8', '这是例子的描述8', C('config.site_logo'), C('config.site_url'));
		$return[] = array('例子9', '这是例子的描述9', C('config.site_logo'), C('config.site_url'));
		$return[] = array('例子10', '这是例子的描述10', C('config.site_logo'), C('config.site_url'));
		return array('data' => array($return, 'news'), 'isuse' => 0);
		
		//文本返回形式
    	return array('data' => array('我回复的是纯文本格式', 'text'), 'isuse' => 0);
	}
}