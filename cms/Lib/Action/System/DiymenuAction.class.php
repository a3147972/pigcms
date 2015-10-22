<?php
class DiymenuAction extends BaseAction
{
	public function index()
	{
		$class = M('Diymenu_class')->where(array('pid' => 0, 'mer_id' => -1))->order('sort desc')->select();

		foreach ($class as $key => $vo) {
			$c = M('Diymenu_class')->where(array('pid' => $vo['id'], 'mer_id' => -1))->order('sort desc')->select();
			$class[$key]['class'] = $c;
		}

		$this->assign('class', $class);
		$this->display();
	}

	public function class_add()
	{
		if (IS_POST) {
			$data = array();
			$data['pid'] = isset($_POST['pid']) ? intval($_POST['pid']) : 0;
			$count = M('Diymenu_class')->where(array('pid' => $data['pid'], 'mer_id' => -1))->count();
			if (($data['pid'] == 0) && (3 <= $count)) {
				$this->error('1级菜单最多只能开启3个');
			}
			else {
				if ($data['pid'] && (5 <= $count)) {
					$this->error('2级子菜单最多开启5个');
				}
			}

			$data['is_show'] = isset($_POST['is_show']) ? intval($_POST['is_show']) : 1;
			$data['sort'] = isset($_POST['sort']) ? intval($_POST['sort']) : 0;
			$data['title'] = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
			$data['keyword'] = isset($_POST['keyword']) ? htmlspecialchars($_POST['keyword']) : '';
			$data['url'] = isset($_POST['url']) ? htmlspecialchars_decode($_POST['url']) : '';
			$data['wxsys'] = isset($_POST['wxsys']) ? htmlspecialchars($_POST['wxsys']) : '';
			if (($_POST['menu_type'] == 1) && ($_POST['keyword'] != '')) {
				$data['url'] = $data['wxsys'] = '';
			}
			else {
				if (($_POST['menu_type'] == 2) && ($_POST['url'] != '')) {
					$data['keyword'] = $data['wxsys'] = '';
				}
				else {
					if (($_POST['menu_type'] == 3) && ($_POST['wxsys'] != '')) {
						$data['keyword'] = $data['url'] = '';
					}
				}
			}

			$data['mer_id'] = -1;

			if (D('Diymenu_class')->add($data)) {
				$this->success('添加成功');
			}
		}
		else {
			$this->assign('bg_color', '#F3F3F3');
			$class = M('Diymenu_class')->where(array('pid' => 0, 'mer_id' => -1))->order('sort desc')->select();
			$this->assign('class', $class);
			$this->assign('wxsys', $this->_get_sys());
			$this->display();
		}
	}

	public function class_edit()
	{
		$this->assign('bg_color', '#F3F3F3');
		$this->assign('wxsys', $this->_get_sys());

		if (IS_POST) {
			$set['pid'] = isset($_POST['pid']) ? intval($_POST['pid']) : 0;
			$set['keyword'] = isset($_POST['keyword']) ? htmlspecialchars($_POST['keyword']) : '';
			$set['url'] = isset($_POST['url']) ? htmlspecialchars_decode($_POST['url']) : '';
			$set['wxsys'] = isset($_POST['wxsys']) ? htmlspecialchars($_POST['wxsys']) : '';
			if (($_POST['menu_type'] == 1) && ($_POST['keyword'] != '')) {
				$set['url'] = $set['wxsys'] = '';
			}
			else {
				if (($_POST['menu_type'] == 2) && ($_POST['url'] != '')) {
					$set['keyword'] = $set['wxsys'] = '';
				}
				else {
					if (($_POST['menu_type'] == 3) && ($_POST['wxsys'] != '')) {
						$set['keyword'] = $set['url'] = '';
					}
				}
			}

			$set['is_show'] = isset($_POST['is_show']) ? intval($_POST['is_show']) : 1;
			$set['sort'] = isset($_POST['sort']) ? intval($_POST['sort']) : 0;
			$set['title'] = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
			$set['mer_id'] = -1;
			D('Diymenu_class')->where(array('id' => $_POST['id']))->save($set);
			$this->success('更新成功');
		}
		else {
			$data = M('Diymenu_class')->where(array('id' => $this->_get('id')))->find();

			if ($data == false) {
				$this->error('您所操作的数据对象不存在！');
			}
			else {
				$class = M('Diymenu_class')->where(array('pid' => 0, 'mer_id' => -1))->order('sort desc')->select();
				$this->assign('class', $class);
				$this->assign('show', $data);
			}

			if ($data['keyword'] != '') {
				$type = 1;
			}
			else if ($data['url'] != '') {
				$type = 2;
			}
			else if ($data['wxsys'] != '') {
				$type = 3;
			}

			$this->assign('type', $type);
			$this->display();
		}
	}

	public function class_del()
	{
		$id = (isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0);
		$count = M('Diymenu_class')->where(array('pid' => $id, 'mer_id' => -1))->count();

		if (empty($count)) {
			$back = D('Diymenu_class')->where(array('id' => $id))->delete();

			if ($back == true) {
				$this->success('删除成功');
			}
			else {
				$this->error('删除失败' . $this->_get('id'));
			}
		}
		else {
			$this->error('请删除该分类下的子分类');
		}
	}

	public function class_send()
	{
		if (IS_GET) {
			$access_token_array = D('Access_token_expires')->get_access_token();

			if ($access_token_array['errcode']) {
				$this->error('获取access_token发生错误：错误代码' . $access_token_array['errcode'] . ',微信返回错误信息：' . $access_token_array['errmsg']);
			}

			$data = '{"button":[';
			$class = M('Diymenu_class')->where(array('pid' => 0, 'is_show' => 1, 'mer_id' => -1))->limit(3)->order('sort asc')->select();
			$kcount = M('Diymenu_class')->where(array('pid' => 0, 'is_show' => 1, 'mer_id' => -1))->count();
			$k = 1;

			foreach ($class as $key => $vo) {
				$data .= '{"name":"' . $vo['title'] . '",';
				$c = M('Diymenu_class')->where(array('pid' => $vo['id'], 'is_show' => 1, 'mer_id' => -1))->limit(5)->order('sort asc')->select();
				$count = M('Diymenu_class')->where(array('pid' => $vo['id'], 'is_show' => 1, 'mer_id' => -1))->count();

				if ($c != false) {
					$data .= '"sub_button":[';
				}
				else if ($vo['keyword']) {
					$data .= '"type":"click","key":"' . $vo['keyword'] . '"';
				}
				else if ($vo['url']) {
					$data .= '"type":"view","url":"' . $vo['url'] . '"';
				}
				else if ($vo['wxsys']) {
					$data .= '"type":"' . $this->_get_sys('send', $vo['wxsys']) . '","key":"' . $vo['wxsys'] . '"';
				}

				$i = 1;

				foreach ($c as $voo) {
					if ($i == $count) {
						if ($voo['keyword']) {
							$data .= '{"type":"click","name":"' . $voo['title'] . '","key":"' . $voo['keyword'] . '"}';
						}
						else if ($voo['url']) {
							$data .= '{"type":"view","name":"' . $voo['title'] . '","url":"' . $voo['url'] . '"}';
						}
						else if ($voo['wxsys']) {
							$data .= '{"type":"' . $this->_get_sys('send', $voo['wxsys']) . '","name":"' . $voo['title'] . '","key":"' . $voo['wxsys'] . '"}';
						}
					}
					else if ($voo['keyword']) {
						$data .= '{"type":"click","name":"' . $voo['title'] . '","key":"' . $voo['keyword'] . '"},';
					}
					else if ($voo['url']) {
						$data .= '{"type":"view","name":"' . $voo['title'] . '","url":"' . $voo['url'] . '"},';
					}
					else if ($voo['wxsys']) {
						$data .= '{"type":"' . $this->_get_sys('send', $voo['wxsys']) . '","name":"' . $voo['title'] . '","key":"' . $voo['wxsys'] . '"},';
					}

					$i++;
				}

				if ($c != false) {
					$data .= ']';
				}

				if ($k == $kcount) {
					$data .= '}';
				}
				else {
					$data .= '},';
				}

				$k++;
			}

			$data .= ']}';
			file_get_contents('https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=' . $access_token_array['access_token']);
			$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . $access_token_array['access_token'];
			$rt = $this->api_notice_increment($url, $data);

			if ($rt['rt'] == false) {
				import('@.ORG.GetErrorMsg');
				$errmsg = GetErrorMsg::wx_error_msg($rt['errorno']);
				$this->error('操作失败,' . $rt['errorno'] . ':' . $errmsg);
			}
			else {
				$this->success('操作成功');
			}

			exit();
		}
		else {
			$this->error('非法操作');
		}
	}

	public function api_notice_increment($url, $data)
	{
		$ch = curl_init();
		$header[] = 'Accept-Charset: utf-8';
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		$errorno = curl_errno($ch);

		if ($errorno) {
			return array('rt' => false, 'errorno' => $errorno);
		}
		else {
			$js = json_decode($tmpInfo, 1);

			if ($js['errcode'] == '0') {
				return array('rt' => true, 'errorno' => 0);
			}
			else {
				$errmsg = GetErrorMsg::wx_error_msg($js['errcode']);
				$this->error('发生错误：错误代码' . $js['errcode'] . ',微信返回错误信息：' . $errmsg);
			}
		}
	}

	public function curlGet($url)
	{
		$ch = curl_init();
		$header = 'Accept-Charset: utf-8';
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}

	private function _get_sys($type = '', $key = '')
	{
		$wxsys = array('扫码带提示', '扫码推事件', '系统拍照发图', '拍照或者相册发图', '微信相册发图', '发送位置');

		if ($type == 'send') {
			$wxsys = array('扫码带提示' => 'scancode_waitmsg', '扫码推事件' => 'scancode_push', '系统拍照发图' => 'pic_sysphoto', '拍照或者相册发图' => 'pic_photo_or_album', '微信相册发图' => 'pic_weixin', '发送位置' => 'location_select');
			return $wxsys[$key];
			exit();
		}

		return $wxsys;
	}
}

?>
