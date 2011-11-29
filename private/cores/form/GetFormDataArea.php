<?php
final class CZCformGetFormDataArea extends CZBase
{
	/**
	 * @param object $form
	 * @param string $part_name
	 * @param array  $part
	 * @param array  $values
	 * 
	 * @return scalar
	 * 
	 * @author Shin Uesugi
	 */
	private function _getValue($form, $part_name, $part, $values)
	{
		if (isset($values[$part_name])) {
			return $values[$part_name];
		}
		if (($value = $this->_cz->newCore('request', 'get_param')->getGetParam($part_name, FALSE)) !== FALSE) {
			return $value;
		}
		
		return $this->_cz->newCore('form', 'get_default_value')->exec($form, $part);
	}
	
	/**
	 * @param object $form
	 * @param string $part_name
	 * @param array  $part
	 * @param array  $values
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($form, $part_name, $part = array(), $values = array())
	{
		if (!$part) {
			$part = $this->_cz->newCore('form', 'get_part')->exec($form, $part_name);
		}
		if (isset($part['type']) && ($part['type'] == 'hidden')) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_USE_PART_TYPE, $part['type'], $form->getMainClassName());
		}
		
		if (!$values) {
			$values = $form->load('values', array());
		}
		
		if (isset($part['description'])) {
			$head_str = $this->_cz->newUser('config', 'form')->getValue('description_head_str', '');
			$tail_str = $this->_cz->newUser('config', 'form')->getValue('description_tail_str', '');
			$description = $head_str . $part['description'] . $tail_str . '<br />';
		} else {
			$description = '';
		}
		$data_area = '';
		if (isset($part['parts'])) {
			foreach ($part['parts'] as $child_part_name => $child_part) {
				if (isset($part['separator']) && $data_area) {
					$data_area .= $part['separator'];
				}
				$data = $this->_cz->newCore('form', 'get_edit_tag')->exec($form, $child_part_name, $child_part, self::_getValue($form, $child_part_name, $child_part, $values));
				$data_area .= $this->_cz->newCore('form', 'get_data_area')->exec($form, $child_part, $data);
				if (($err_msg = $this->_cz->newCore('form', 'get_err')->exec($form, $child_part_name)) !== FALSE) {
					$data_area .= $err_msg;
				}
			}
			if (($err_msg = $this->_cz->newCore('form', 'get_err')->exec($form, $part_name)) !== FALSE) {
				$data_area .= $err_msg;
			}
		} else {
			$data = $this->_cz->newCore('form', 'get_edit_tag')->exec($form, $part_name, $part, self::_getValue($form, $part_name, $part, $values));
			$data_area .= $this->_cz->newCore('form', 'get_data_area')->exec($form, $part, $data);
			if (($err_msg = $this->_cz->newCore('form', 'get_err')->exec($form, $part_name)) !== FALSE) {
				$data_area .= $err_msg;
			}
		}
		
		return $description . $data_area;
	}
}
?>