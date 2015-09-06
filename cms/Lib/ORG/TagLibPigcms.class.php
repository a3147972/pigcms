<?php

class TagLibPigcms extends TagLib
{
	protected $tags = array(
		'one_adver'   => array('attr' => 'cat_key', 'level' => 3),
		'footer_link' => array('attr' => 'var_name,key', 'level' => 3),
		'slider'      => array('attr' => 'cat_key,var_name,limit,key', 'level' => 3),
		'adver'       => array('attr' => 'cat_key,var_name,limit,key', 'level' => 3),
		'near_shop'   => array('attr' => 'limit', 'close' => 0)
		);

	public function _near_shop($attr, $content)
	{
		$tag = $this->parseXmlAttr($attr, 'near_shop');
		$limit = ($tag['limit'] ? $tag['limit'] : '6');
		$x = ($_COOKIE['around_lat'] ? $_COOKIE['around_lat'] : 0);
		$y = ($_COOKIE['around_long'] ? $_COOKIE['around_long'] : 0);
		$adress = $_COOKIE['around_adress'];
		if (empty($x) || (true == empty($y)) || (true == empty($adress))) {
			$parseStr = '<?php $is_near_shop = false;$near_shop_list = D("Merchant_store")->get_hot_list("' . $limit . '");?>';
		}
		else {
			$parseStr = '<?php $is_near_shop = true;$near_shop_list = D("Merchant_store")->get_hot_list("' . $limit . '","' . $x . '","' . $y . '");if(empty($near_shop_list)){$is_near_shop = false;$near_shop_list = D("Merchant_store")->get_hot_list("' . $limit . '");}?>';
		}

		return $parseStr;
	}

	public function _adver($attr, $content)
	{
		static $_iterateParseCache = array();
		$cacheIterateId = md5($attr . $content);

		if (isset($_iterateParseCache[$cacheIterateId])) {
			return $_iterateParseCache[$cacheIterateId];
		}

		$tag = $this->parseXmlAttr($attr, 'adver');
		$name = '$' . $tag['var_name'];
		$key = ($tag['key'] ? $tag['key'] : 'i');
		$limit = ($tag['limit'] ? $tag['limit'] : '3');
		$parseStr = '<?php ';
		$parseStr .= $name . ' = D("Adver")->get_adver_by_key("' . $tag['cat_key'] . '","' . $limit . '");';
		$parseStr .= 'if(is_array(' . $name . ')): $' . $key . ' = 0;';
		$parseStr .= 'if(count(' . $name . ')==0) : echo "列表为空" ;';
		$parseStr .= 'else: ';
		$parseStr .= 'foreach(' . $name . ' as $key=>$vo): ';
		$parseStr .= '++$' . $key . ';?>';
		$parseStr .= $this->tpl->parse($content);
		$parseStr .= '<?php endforeach; endif; else: echo "列表为空" ;endif; ?>';
		$_iterateParseCache[$cacheIterateId] = $parseStr;

		if (!(true == empty($parseStr))) {
			return $parseStr;
		}

		return NULL;
	}

	public function _one_adver($attr, $content)
	{
		$tag = $this->parseXmlAttr($attr, 'one_adver');

		if (empty($tag['cat_key'])) {
			return '<?php echo "标签解析错误"; ?>';
		}

		$parseStr = '<?php $one_adver = D("Adver")->get_one_adver("' . $tag['cat_key'] . '"); if(is_array($one_adver)): ?>';
		$parseStr .= $this->tpl->parse($content);
		$parseStr .= '<?php endif; ?>';

		return $parseStr;
	}

	public function _footer_link($attr, $content)
	{
		static $_iterateParseCache = array();
		$cacheIterateId = md5($attr . $content);

		if (isset($_iterateParseCache[$cacheIterateId])) {
			return $_iterateParseCache[$cacheIterateId];
		}

		$tag = $this->parseXmlAttr($attr, 'footer_link');
		$name = '$' . $tag['var_name'];
		$key = ($tag['key'] ? $tag['key'] : 'i');
		$parseStr = '<?php ';
		$parseStr .= $name . ' = D("Footer_link")->get_list();';
		$parseStr .= 'if(is_array(' . $name . ')): $' . $key . ' = 0;';
		$parseStr .= 'if(count(' . $name . ')==0) : echo "列表为空" ;';
		$parseStr .= 'else: ';
		$parseStr .= 'foreach(' . $name . ' as $key=>$vo): ';
		$parseStr .= '++$' . $key . ';?>';
		$parseStr .= $this->tpl->parse($content);
		$parseStr .= '<?php endforeach; endif; else: echo "列表为空" ;endif; ?>';
		$_iterateParseCache[$cacheIterateId] = $parseStr;

		if (!(true == empty($parseStr))) {
			return $parseStr;
		}

		return NULL;
	}

	public function _slider($attr, $content)
	{
		static $_iterateParseCache = array();
		$cacheIterateId = md5($attr . $content);

		if (isset($_iterateParseCache[$cacheIterateId])) {
			return $_iterateParseCache[$cacheIterateId];
		}

		$tag = $this->parseXmlAttr($attr, 'slider');
		$name = '$' . $tag['var_name'];
		$key = ($tag['key'] ? $tag['key'] : 'i');
		$parseStr = '<?php ';
		$parseStr .= $name . ' = D("Slider")->get_slider_by_key("' . $tag['cat_key'] . '","' . $tag['limit'] . '");';
		$parseStr .= 'if(is_array(' . $name . ')): $' . $key . ' = 0;';
		$parseStr .= 'if(count(' . $name . ')==0) : echo "列表为空" ;';
		$parseStr .= 'else: ';
		$parseStr .= 'foreach(' . $name . ' as $key=>$vo): ';
		$parseStr .= '++$' . $key . ';?>';
		$parseStr .= $this->tpl->parse($content);
		$parseStr .= '<?php endforeach; endif; else: echo "列表为空" ;endif; ?>';
		$_iterateParseCache[$cacheIterateId] = $parseStr;

		if (!(true == empty($parseStr))) {
			return $parseStr;
		}

		return NULL;
	}

	public function _volist($attr, $content)
	{
		static $_iterateParseCache = array();
		$cacheIterateId = md5($attr . $content);

		if (isset($_iterateParseCache[$cacheIterateId])) {
			return $_iterateParseCache[$cacheIterateId];
		}

		$tag = $this->parseXmlAttr($attr, 'volist');
		$name = $tag['name'];
		$id = $tag['id'];
		$empty = (isset($tag['empty']) ? $tag['empty'] : '');
		$key = (!(true == empty($tag['key'])) ? $tag['key'] : 'i');
		$mod = (isset($tag['mod']) ? $tag['mod'] : '2');
		$parseStr = '<?php ';

		if (!(0 !== strpos($name, ':'))) {
			$parseStr .= '$_result=' . substr($name, 1) . ';';
			$name = '$_result';
		}
		else {
			$name = $this->autoBuildVar($name);
		}

		$parseStr .= 'if(is_array(' . $name . ')): $' . $key . ' = 0;';
		if (isset($tag['length']) && ( '' != $tag['length'])) {
			$parseStr .= ' $__LIST__ = array_slice(' . $name . ',' . $tag['offset'] . ',' . $tag['length'] . ',true);';
		}
		else if (isset($tag['offset']) && ( '' != $tag['offset'])) {
			$parseStr .= ' $__LIST__ = array_slice(' . $name . ',' . $tag['offset'] . ',null,true);';
		}
		else {
			$parseStr .= ' $__LIST__ = ' . $name . ';';
		}

		$parseStr .= 'if( count($__LIST__)==0 ) : echo "' . $empty . '" ;';
		$parseStr .= 'else: ';
		$parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';
		$parseStr .= '$mod = ($' . $key . ' % ' . $mod . ' );';
		$parseStr .= '++$' . $key . ';?>';
		$parseStr .= $this->tpl->parse($content);
		$parseStr .= '<?php endforeach; endif; else: echo "' . $empty . '" ;endif; ?>';
		$_iterateParseCache[$cacheIterateId] = $parseStr;

		if (!(true == empty($parseStr))) {
			return $parseStr;
		}

		return NULL;
	}

	public function _foreach($attr, $content)
	{
		static $_iterateParseCache = array();
		$cacheIterateId = md5($attr . $content);

		if (isset($_iterateParseCache[$cacheIterateId])) {
			return $_iterateParseCache[$cacheIterateId];
		}

		$tag = $this->parseXmlAttr($attr, 'foreach');
		$name = $tag['name'];
		$item = $tag['item'];
		$key = (!(true == empty($tag['key'])) ? $tag['key'] : 'key');
		$name = $this->autoBuildVar($name);
		$parseStr = '<?php if(is_array(' . $name . ')): foreach(' . $name . ' as $' . $key . '=>$' . $item . '): ?>';
		$parseStr .= $this->tpl->parse($content);
		$parseStr .= '<?php endforeach; endif; ?>';
		$_iterateParseCache[$cacheIterateId] = $parseStr;

		if (!(true == empty($parseStr))) {
			return $parseStr;
		}

		return NULL;
	}

	public function _if($attr, $content)
	{
		$tag = $this->parseXmlAttr($attr, 'if');
		$condition = $this->parseCondition($tag['condition']);
		$parseStr = '<?php if(' . $condition . '): ?>' . $content . '<?php endif; ?>';
		return $parseStr;
	}

	public function _elseif($attr, $content)
	{
		$tag = $this->parseXmlAttr($attr, 'elseif');
		$condition = $this->parseCondition($tag['condition']);
		$parseStr = '<?php elseif(' . $condition . '): ?>';
		return $parseStr;
	}

	public function _else($attr)
	{
		$parseStr = '<?php else: ?>';
		return $parseStr;
	}

	public function _switch($attr, $content)
	{
		$tag = $this->parseXmlAttr($attr, 'switch');
		$name = $tag['name'];
		$varArray = explode('|', $name);
		$name = array_shift($varArray);
		$name = $this->autoBuildVar($name);

		if (0 < count($varArray)) {
			$name = $this->tpl->parseVarFunction($name, $varArray);
		}

		$parseStr = '<?php switch(' . $name . '): ?>' . $content . '<?php endswitch;?>';
		return $parseStr;
	}

	public function _case($attr, $content)
	{
		$tag = $this->parseXmlAttr($attr, 'case');
		$value = $tag['value'];

		if ('$' == substr($value, 0, 1)) {
			$varArray = explode('|', $value);
			$value = array_shift($varArray);
			$value = $this->autoBuildVar(substr($value, 1));

			if (0 < count($varArray)) {
				$value = $this->tpl->parseVarFunction($value, $varArray);
			}

			$value = 'case ' . $value . ': ';
		}
		else if (strpos($value, '|')) {
			$values = explode('|', $value);
			$value = '';

			foreach ($values as $val) {
				$value .= 'case "' . addslashes($val) . '": ';
			}
		}
		else {
			$value = 'case "' . $value . '": ';
		}

		$parseStr = '<?php ' . $value . ' ?>' . $content;
		$isBreak = (isset($tag['break']) ? $tag['break'] : '');
		if (('' == $isBreak) || $isBreak) {
			$parseStr .= '<?php break;?>';
		}

		return $parseStr;
	}

	public function _default($attr)
	{
		$parseStr = '<?php default: ?>';
		return $parseStr;
	}

	public function _compare($attr, $content, $type = 'eq')
	{
		$tag = $this->parseXmlAttr($attr, 'compare');
		$name = $tag['name'];
		$value = $tag['value'];
		$type = (isset($tag['type']) ? $tag['type'] : $type);
		$type = $this->parseCondition(' ' . $type . ' ');
		$varArray = explode('|', $name);
		$name = array_shift($varArray);
		$name = $this->autoBuildVar($name);

		if (0 < count($varArray)) {
			$name = $this->tpl->parseVarFunction($name, $varArray);
		}

		if ('$' == substr($value, 0, 1)) {
			$value = $this->autoBuildVar(substr($value, 1));
		}
		else {
			$value = '"' . $value . '"';
		}

		$parseStr = '<?php if((' . $name . ') ' . $type . ' ' . $value . '): ?>' . $content . '<?php endif; ?>';
		return $parseStr;
	}

	public function _eq($attr, $content)
	{
		return $this->_compare($attr, $content, 'eq');
	}

	public function _equal($attr, $content)
	{
		return $this->_compare($attr, $content, 'eq');
	}

	public function _neq($attr, $content)
	{
		return $this->_compare($attr, $content, 'neq');
	}

	public function _notequal($attr, $content)
	{
		return $this->_compare($attr, $content, 'neq');
	}

	public function _gt($attr, $content)
	{
		return $this->_compare($attr, $content, 'gt');
	}

	public function _lt($attr, $content)
	{
		return $this->_compare($attr, $content, 'lt');
	}

	public function _egt($attr, $content)
	{
		return $this->_compare($attr, $content, 'egt');
	}

	public function _elt($attr, $content)
	{
		return $this->_compare($attr, $content, 'elt');
	}

	public function _heq($attr, $content)
	{
		return $this->_compare($attr, $content, 'heq');
	}

	public function _nheq($attr, $content)
	{
		return $this->_compare($attr, $content, 'nheq');
	}

	public function _range($attr, $content, $type = 'in')
	{
		$tag = $this->parseXmlAttr($attr, 'range');
		$name = $tag['name'];
		$value = $tag['value'];
		$varArray = explode('|', $name);
		$name = array_shift($varArray);
		$name = $this->autoBuildVar($name);

		if (0 < count($varArray)) {
			$name = $this->tpl->parseVarFunction($name, $varArray);
		}

		$type = (isset($tag['type']) ? $tag['type'] : $type);

		if ('$' == substr($value, 0, 1)) {
			$value = $this->autoBuildVar(substr($value, 1));
			$str = 'is_array(' . $value . ')?' . $value . ':explode(\',\',' . $value . ')';
		}
		else {
			$value = '"' . $value . '"';
			$str = 'explode(\',\',' . $value . ')';
		}

		if ($type == 'between') {
			$parseStr = '<?php $_RANGE_VAR_=' . $str . ';if(' . $name . '>= $_RANGE_VAR_[0] && ' . $name . '<= $_RANGE_VAR_[1]):?>' . $content . '<?php endif; ?>';
		}
		else if ($type == 'notbetween') {
			$parseStr = '<?php $_RANGE_VAR_=' . $str . ';if(' . $name . '<$_RANGE_VAR_[0] || ' . $name . '>$_RANGE_VAR_[1]):?>' . $content . '<?php endif; ?>';
		}
		else if ($type == 'in') {
			$fun = 'in_array';
			$parseStr = '<?php if(' . $fun . '((' . $name . '), ' . $str . ')): ?>' . $content . '<?php endif; ?>';
		}
		else {
			$fun = '!in_array';
			$parseStr = '<?php if(' . $fun . '((' . $name . '), ' . $str . ')): ?>' . $content . '<?php endif; ?>';
		}

		return $parseStr;
	}

	public function _in($attr, $content)
	{
		return $this->_range($attr, $content, 'in');
	}

	public function _notin($attr, $content)
	{
		return $this->_range($attr, $content, 'notin');
	}

	public function _between($attr, $content)
	{
		return $this->_range($attr, $content, 'between');
	}

	public function _notbetween($attr, $content)
	{
		return $this->_range($attr, $content, 'notbetween');
	}

	public function _present($attr, $content)
	{
		$tag = $this->parseXmlAttr($attr, 'present');
		$name = $tag['name'];
		$name = $this->autoBuildVar($name);
		$parseStr = '<?php if(isset(' . $name . ')): ?>' . $content . '<?php endif; ?>';
		return $parseStr;
	}

	public function _notpresent($attr, $content)
	{
		$tag = $this->parseXmlAttr($attr, 'notpresent');
		$name = $tag['name'];
		$name = $this->autoBuildVar($name);
		$parseStr = '<?php if(!isset(' . $name . ')): ?>' . $content . '<?php endif; ?>';
		return $parseStr;
	}

	public function _empty($attr, $content)
	{
		$tag = $this->parseXmlAttr($attr, 'empty');
		$name = $tag['name'];
		$name = $this->autoBuildVar($name);
		$parseStr = '<?php if(empty(' . $name . ')): ?>' . $content . '<?php endif; ?>';
		return $parseStr;
	}

	public function _notempty($attr, $content)
	{
		$tag = $this->parseXmlAttr($attr, 'notempty');
		$name = $tag['name'];
		$name = $this->autoBuildVar($name);
		$parseStr = '<?php if(!empty(' . $name . ')): ?>' . $content . '<?php endif; ?>';
		return $parseStr;
	}

	public function _defined($attr, $content)
	{
		$tag = $this->parseXmlAttr($attr, 'defined');
		$name = $tag['name'];
		$parseStr = '<?php if(defined("' . $name . '")): ?>' . $content . '<?php endif; ?>';
		return $parseStr;
	}

	public function _notdefined($attr, $content)
	{
		$tag = $this->parseXmlAttr($attr, '_notdefined');
		$name = $tag['name'];
		$parseStr = '<?php if(!defined("' . $name . '")): ?>' . $content . '<?php endif; ?>';
		return $parseStr;
	}

	public function _import($attr, $content, $isFile = false, $type = '')
	{
		$tag = $this->parseXmlAttr($attr, 'import');
		$file = (isset($tag['file']) ? $tag['file'] : $tag['href']);
		$parseStr = '';
		$endStr = '';

		if (isset($tag['value'])) {
			$varArray = explode('|', $tag['value']);
			$name = array_shift($varArray);
			$name = $this->autoBuildVar($name);

			if (!(true == empty($varArray))) {
				$name = $this->tpl->parseVarFunction($name, $varArray);
			}
			else {
				$name = 'isset(' . $name . ')';
			}

			$parseStr .= '<?php if(' . $name . '): ?>';
			$endStr = '<?php endif; ?>';
		}

		if ($isFile) {
			$type = ($type ? $type : (!(true == empty($tag['type'])) ? strtolower($tag['type']) : NULL));
			$array = explode(',', $file);

			foreach ($array as $val) {
				if (($type == false) || (true == isset($reset))) {
					$type = $reset = strtolower(substr(strrchr($val, '.'), 1));
				}

				switch ($type) {
				case 'js':
					$parseStr .= '<script type="text/javascript" src="' . $val . '"></script>';
					break;
				case 'css':
					$parseStr .= '<link rel="stylesheet" type="text/css" href="' . $val . '" />';
					break;
				case 'php':
					$parseStr .= '<?php require_cache("' . $val . '"); ?>';
				}
			}
		}
		else {
			$type = ($type ? $type : (!(true == empty($tag['type'])) ? strtolower($tag['type']) : 'js'));
			$basepath = (!(true == empty($tag['basepath'])) ? $tag['basepath'] : __ROOT__ . '/Public');
			$array = explode(',', $file);

			foreach ($array as $val) {
				list($val, $version) = explode('?', $val);

				switch ($type) {
				case 'js':
					$parseStr .= '<script type="text/javascript" src="' . $basepath . '/' . str_replace(array('.', '#'), array('/', '.'), $val) . '.js' . ($version ? '?' . $version : '') . '"></script>';
					break;
				case 'css':
					$parseStr .= '<link rel="stylesheet" type="text/css" href="' . $basepath . '/' . str_replace(array('.', '#'), array('/', '.'), $val) . '.css' . ($version ? '?' . $version : '') . '" />';
					break;
				case 'php':
					$parseStr .= '<?php import("' . $val . '"); ?>';
				}
			}
		}

		return $parseStr . $endStr;
	}

	public function _load($attr, $content)
	{
		return $this->_import($attr, $content, true);
	}

	public function _css($attr, $content)
	{
		return $this->_import($attr, $content, true, 'css');
	}

	public function _js($attr, $content)
	{
		return $this->_import($attr, $content, true, 'js');
	}

	public function _assign($attr, $content)
	{
		$tag = $this->parseXmlAttr($attr, 'assign');
		$name = $this->autoBuildVar($tag['name']);

		if ('$' == substr($tag['value'], 0, 1)) {
			$value = $this->autoBuildVar(substr($tag['value'], 1));
		}
		else {
			$value = '\'' . $tag['value'] . '\'';
		}

		$parseStr = '<?php ' . $name . ' = ' . $value . '; ?>';
		return $parseStr;
	}

	public function _define($attr, $content)
	{
		$tag = $this->parseXmlAttr($attr, 'define');
		$name = '\'' . $tag['name'] . '\'';

		if ('$' == substr($tag['value'], 0, 1)) {
			$value = $this->autoBuildVar(substr($tag['value'], 1));
		}
		else {
			$value = '\'' . $tag['value'] . '\'';
		}

		$parseStr = '<?php define(' . $name . ', ' . $value . '); ?>';
		return $parseStr;
	}

	public function _for($attr, $content)
	{
		$start = 0;
		$end = 0;
		$step = 1;
		$comparison = 'lt';
		$name = 'i';
		$rand = rand();

		foreach ($this->parseXmlAttr($attr, 'for') as $key => $value) {
			$value = trim($value);

			if (':' == substr($value, 0, 1)) {
				$value = substr($value, 1);
			}
			else {
				if ('$' == substr($value, 0, 1)) {
					$value = $this->autoBuildVar(substr($value, 1));
				}
			}

			switch ($key) {
			case 'start':
				$start = $value;
				break;
			case 'end':
				$end = $value;
				break;
			case 'step':
				$step = $value;
				break;
			case 'comparison':
				$comparison = $value;
				break;
			case 'name':
				$name = $value;
			}
		}

		$parseStr = '<?php $__FOR_START_' . $rand . '__=' . $start . ';$__FOR_END_' . $rand . '__=' . $end . ';';
		$parseStr .= 'for($' . $name . '=$__FOR_START_' . $rand . '__;' . $this->parseCondition('$' . $name . ' ' . $comparison . ' $__FOR_END_' . $rand . '__') . ';$' . $name . '+=' . $step . '){ ?>';
		$parseStr .= $content;
		$parseStr .= '<?php } ?>';
		return $parseStr;
	}
}



?>
