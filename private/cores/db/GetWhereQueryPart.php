<?php
final class CZCdbGetWhereQueryPart extends CZBase
{
	/**
	 * @param array $condition_sentences
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($condition_sentences)
	{
		if ($condition_sentences) {
			$str = '';
			foreach ($condition_sentences as $condition_sentence) {
				if ($str) {
					if (is_array($condition_sentence)) {
						list($operator, $condition_sentence) = each($condition_sentence);
					} else {
						$operator = 'AND';
					}
					$str .= ' ' . $operator . ' ';
				}
				$str .= '(' . $condition_sentence . ')';
			}
		} else {
			$str = '1';
		}

		return ' WHERE ' . $str;
	}
}
?>