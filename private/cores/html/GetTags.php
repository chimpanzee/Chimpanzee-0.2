<?php
final class CZChtmlGetTags extends CZBase
{
	/**
	 * @param array  $info
	 * @param string $tag_name
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	private function _getTagOption($info, $tag_name)
	{
		if (!isset($info['tag_options'][$tag_name]) || !$this->_cz->isValidStr($info['tag_options'][$tag_name])) {
			return '';
		}
		
		return ' ' . $info['tag_options'][$tag_name];
	}
	
	/**
	 * @param array $info
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($info)
	{
		$mobile_flag = $this->_cz->newCore('mobile', 'is_mobile')->exec();
		
		if ($mobile_flag) {
			$info['html_type'] = 'br';
		}
		
		$tags = array();
		switch($info['html_type']) {
			case 'table':
				$tags['table_head']   = '<table' . self::_getTagOption($info, 'table') . '>';
				$tags['table_tail']   = '</table>';
				$tags['row_head']     = '<tr' . self::_getTagOption($info, 'tr') . '>';
				$tags['row_tail']     = '</tr>';
				$tags['caption_head'] = '<th' . self::_getTagOption($info, 'th') . '>';
				$tags['caption_tail'] = '</th>';
				$tags['data_head']    = '<td' . self::_getTagOption($info, 'td') . '>';
				$tags['data_tail']    = '</td>';
				break;
			case 'dl':
				$tags['table_head']   = '<dl' . self::_getTagOption($info, 'dl') . '>';
				$tags['table_tail']   = '</dl>';
				$tags['row_head']     = '';
				$tags['row_tail']     = '';
				$tags['caption_head'] = '<dt' . self::_getTagOption($info, 'dt') . '>';
				$tags['caption_tail'] = '</dt>';
				$tags['data_head']    = '<dd' . self::_getTagOption($info, 'dd') . '>';
				$tags['data_tail']    = '</dd>';
				break;
			case 'br':
				if ($mobile_flag) {
					$tags['table_head'] = '';
					$tags['table_tail'] = '';
				} else {
					$tags['table_head'] = '<p' . self::_getTagOption($info, 'p') . '>';
					$tags['table_tail'] = '</p>';
				}
				$tags['row_head']     = '';
				$tags['row_tail']     = '';
				$tags['caption_head'] = '';
				$tags['caption_tail'] = '<br />';
				$tags['data_head']    = '';
				$tags['data_tail']    = '<br />';
				break;
			default:
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_HTML_INVALID_HTML_TYPE, $info['html_type']);
		}
		
		return $tags;
	}
}
?>