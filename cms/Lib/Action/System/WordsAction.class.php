<?php
class WordsAction extends Action
{
	public function get_firstword()
	{
		$string = $this->stringgetFirstCharter($_GET['str']);

		if (empty($string)) {
			$this->error('转换首字符失败！');
		}
		else {
			$this->success($string);
		}
	}

	protected function stringgetFirstCharter($zh)
	{
		$ret = '';
		$s1 = iconv('UTF-8', 'gb2312', $zh);
		$s2 = iconv('gb2312', 'UTF-8', $s1);

		if ($s2 == $zh) {
			$zh = $s1;
		}

		$i = 0;

		for (; $i < strlen($zh); $i++) {
			$s1 = substr($zh, $i, 1);
			$p = ord($s1);

			if (160 < $p) {
				$s2 = substr($zh, $i++, 2);
				$ret .= $this->wordgetFirstCharter($s2);
			}
			else {
				$ret .= $s1;
			}
		}

		return $ret;
	}

	protected function wordgetFirstCharter($str)
	{
		if (empty($str)) {
			return '';
		}

		$fchar = ord($str[0]);
		if ((ord('A') <= $fchar) && ($fchar <= ord('z'))) {
			return strtoupper($str[0]);
		}

		$s1 = iconv('UTF-8', 'gb2312', $str);
		$s2 = iconv('gb2312', 'UTF-8', $s1);
		$s = ($s2 == $str ? $s1 : $str);
		$asc = ((ord($s[0]) * 256) + ord($s[1])) - 65536;
		if ((-20319 <= $asc) && ($asc <= -20284)) {
			return 'a';
		}

		if ((-20283 <= $asc) && ($asc <= -19776)) {
			return 'b';
		}

		if ((-19775 <= $asc) && ($asc <= -19219)) {
			return 'c';
		}

		if ((-19218 <= $asc) && ($asc <= -18711)) {
			return 'd';
		}

		if ((-18710 <= $asc) && ($asc <= -18527)) {
			return 'e';
		}

		if ((-18526 <= $asc) && ($asc <= -18240)) {
			return 'f';
		}

		if ((-18239 <= $asc) && ($asc <= -17923)) {
			return 'g';
		}

		if ((-17922 <= $asc) && ($asc <= -17418)) {
			return 'h';
		}

		if ((-17417 <= $asc) && ($asc <= -16475)) {
			return 'j';
		}

		if ((-16474 <= $asc) && ($asc <= -16213)) {
			return 'k';
		}

		if ((-16212 <= $asc) && ($asc <= -15641)) {
			return 'l';
		}

		if ((-15640 <= $asc) && ($asc <= -15166)) {
			return 'm';
		}

		if ((-15165 <= $asc) && ($asc <= -14923)) {
			return 'n';
		}

		if ((-14922 <= $asc) && ($asc <= -14915)) {
			return 'o';
		}

		if ((-14914 <= $asc) && ($asc <= -14631)) {
			return 'p';
		}

		if ((-14630 <= $asc) && ($asc <= -14150)) {
			return 'q';
		}

		if ((-14149 <= $asc) && ($asc <= -14091)) {
			return 'r';
		}

		if ((-14090 <= $asc) && ($asc <= -13319)) {
			return 's';
		}

		if ((-13318 <= $asc) && ($asc <= -12839)) {
			return 't';
		}

		if ((-12838 <= $asc) && ($asc <= -12557)) {
			return 'w';
		}

		if ((-12556 <= $asc) && ($asc <= -11848)) {
			return 'x';
		}

		if ((-11847 <= $asc) && ($asc <= -11056)) {
			return 'y';
		}

		if ((-11055 <= $asc) && ($asc <= -10247)) {
			return 'z';
		}

		return NULL;
	}
}

?>
