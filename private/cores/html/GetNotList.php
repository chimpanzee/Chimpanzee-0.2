<?php
final class CZChtmlGetNotList extends CZBase
{
	/**
	 * @param array $caption_areas
	 * @param array $data_areas
	 * @param array $info
	 * @param array $tags
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($caption_areas, $data_areas, $info, $tags)
	{
		$html = '';
		$html .= $tags['table_head'];
		foreach ($data_areas as $name => $data_area) {
			$html .= $tags['row_head'];

			$html .= $tags['caption_head'];
			if (isset($info['caption_head_str'])) {
				$html .= $info['caption_head_str'];
			}
			$html .= $caption_areas[$name];
			if (isset($info['caption_tail_str'])) {
				$html .= $info['caption_tail_str'];
			}
			$html .= $tags['caption_tail'];

			$html .= $tags['data_head'];
			$html .= $data_area;
			$html .= $tags['data_tail'];

			if ($info['html_type'] != 'br') {
				$html .= $tags['row_tail'];
			}
		}
		$html .= $tags['table_tail'];
		
		return $html;
	}
}
?>