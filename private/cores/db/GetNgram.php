<?php
final class CZCdbGetNgram extends CZBase
{
	/**
	 * @param integer $n
	 * @param string  $str
	 * @param strint  $prefix
	 * @param boolean $encode_flag
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($n, $str, $prefix = '', $encode_flag = FALSE)
	{
		$str = str_replace(array(" ", "　", "\t", "\r", "\n", ""), '', $str);
		if ($encode_flag) {
			$str = mb_convert_kana($str, 'AHcV');
		}
		
		$ngram = '';
		$len = mb_strlen($str) - $n + 1;
		for ($i = 0; $i < $len; ++$i) {
			if ($ngram) {
				$ngram .= ' ';
			}
			if ($prefix) {
				$ngram .= $prefix;
			}
			$part = mb_substr($str, $i, $n);
			$ngram .= $encode_flag ? bin2hex($part) : $part;
		}
		
		return $ngram;
	}
}
?>