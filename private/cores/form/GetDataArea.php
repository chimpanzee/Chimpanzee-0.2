<?php
final class CZCformGetDataArea extends CZBase
{
	/**
	 * @param object $form
	 * @param array  $part
	 * @param string $data
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($form, $part, $data)
	{
		$data_area = '';
		if (isset($part['head_str']) && $this->_cz->isValidStr($data)) {
			$data_area .= $part['head_str'];
		}
		$data_area .= $data;
		if (isset($part['tail_str']) && $this->_cz->isValidStr($data)) {
			$data_area .= $part['tail_str'];
		}
		
		return $data_area;
	}
}
?>