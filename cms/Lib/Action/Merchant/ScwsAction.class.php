<?php
class ScwsAction extends BaseAction
{
	public function ajax_getKeywords($title, $num = 5)
	{
		import('ORG.Pscws.Pscws4');
		$pscws = new PSCWS4();
		$pscws->set_dict(LIBRARY_PATH . 'ORG/Pscws/dict.utf8.xdb');
		$pscws->set_rule(LIBRARY_PATH . 'ORG/Pscws/rules.utf8.ini');
		$pscws->set_ignore(true);
		$pscws->send_text($title);
		$words = $pscws->get_tops($num);
		$pscws->close();
		$list = array();

		foreach ($words as $value) {
			$list[] = $value['word'];
		}

		echo json_encode(array('num' => count($list), 'list' => $list));
	}
}

?>
