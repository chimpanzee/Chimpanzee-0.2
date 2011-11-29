<?php
final class CZChtmlGetList extends CZBase
{
	/**
	 * @param array $caption_areas
	 * @param array $data_areas_list
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($caption_areas, $data_areas_list)
	{
		$info = $this->_cz->newUser('config', 'html')->getValue('list', array('html_type' => 'table'));
		if (!isset($info['html_type'])) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_HTML_NOT_SET_HTML_TYPE);
		}
		
		$tags = $this->_cz->newCore('html', 'get_tags')->exec($info);
		
		$html = $tags['table_head'];
		if ($info['html_type'] != 'br') {
			$html .= $tags['row_head'];
			foreach ($caption_areas as $caption_area) {
				$html .= $tags['caption_head'];
				if (isset($info['caption_head_str'])) {
					$html .= $info['caption_head_str'];
				}
				$html .= $caption_area;
				if (isset($info['caption_tail_str'])) {
					$html .= $info['caption_tail_str'];
				}
				$html .= $tags['caption_tail'];
			}
			$html .= $tags['row_tail'];
		}
		$row_count = 0;
		$row_num   = count($data_areas_list);
		foreach ($data_areas_list as $data_areas) {
			$html .= $tags['row_head'];
			foreach ($data_areas as $column_name => $data_area) {
				if ($info['html_type'] == 'br') {
					$html .= $tags['caption_head'];
					if (isset($info['caption_head_str'])) {
						$html .= $info['caption_head_str'];
					}
					$html .= $caption_areas[$column_name];
					if (isset($info['caption_tail_str'])) {
						$html .= $info['caption_tail_str'];
					}
					$html .= $tags['caption_tail'];
				}
				$html .= $tags['data_head'];
				$html .= $data_area;
				$html .= $tags['data_tail'];
			}
			$row_count++;
			if (($info['html_type'] != 'br') || ($row_count < $row_num)) {
				$html .= $tags['row_tail'];
			}
		}
		$html .= $tags['table_tail'];
		
		return $html;
	}
}
?>