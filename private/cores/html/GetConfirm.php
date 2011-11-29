<?php
final class CZChtmlGetConfirm extends CZBase
{
	/**
	 * @param array $caption_areas
	 * @param array $data_areas
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($caption_areas, $data_areas)
	{
		$info = $this->_cz->newUser('config', 'html')->getValue('confirm', array('html_type' => 'table'));
		if (!isset($info['html_type'])) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_HTML_NOT_SET_HTML_TYPE);
		}
		
		$tags = $this->_cz->newCore('html', 'get_tags')->exec($info);
		
		return $this->_cz->newCore('html', 'get_not_list')->exec($caption_areas, $data_areas, $info, $tags);
	}
}
?>