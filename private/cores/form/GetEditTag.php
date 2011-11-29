<?php
final class CZCformGetEditTag extends CZBase
{
	/**
	 * @param object  $form
	 * @param string  $part_name
	 * @param array   $part
	 * @param scalar  $value / NULL
	 * 
	 * @return scalar
	 * 
	 * @author Shin Uesugi
	 */
	private function _getTagId($form, $part_name, $part, $value)
	{
		if (isset($part['id'])) {
			$id = $part['id'];
		} else {
			$id = $part_name;
		}
		if ($value !== NULL) {
			$id .= ':' . $value;
		}
		
		return $id;
	}
	
	/**
	 * @param object $form
	 * @param string $part_name
	 * @param array  $part
	 * @param scalar $value
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	private function _getTagOption($form, $part_name, $part, $value = NULL)
	{
		$option = ' name="' . $part_name . '"';
		if ($this->_cz->newCore('mobile', 'is_mobile')->exec()) {
			if (isset($part['mobile_option'])) {
				$option .= ' ' . $part['mobile_option'];
			}
		} else {
			$option .= ' id="' . self::_getTagId($form, $part_name, $part, $value) . '"';
			if (isset($part['option'])) {
				$option .=  ' ' . $part['option'];
			}
		}
		
		return $option;
	}
	
	/**
	 * @param object $form
	 * @param string $part_name
	 * @param array  $part
	 * @param scalar $value
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	private function _getInputTag($form, $part_name, $part, $value = NULL)
	{
		$tag  = '<input type="' . $part['type'] . '"';
		$tag .= self::_getTagOption($form, $part_name, $part);
		if ($value !== NULL) {
			$tag .= ' value="' . $value . '"';
		}
		$tag .= ' />';
		
		return $tag;
	}
	
	/**
	 * @param object $form
	 * @param string $part_name
	 * @param array  $part
	 * @param scalar $value
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	private function _getInputCheckboxTag($form, $part_name, $part, $value)
	{
		$tag  = '<input type="checkbox"';
		$tag .= self::_getTagOption($form, $part_name, $part);
		if ($value) {
			$tag .= ' checked="checked"';
		}
		$tag .= ' />';
		if (isset($part['label'])) {
			$tag .= $part['label'];
		}
		
		return $tag;
	}
	
	/**
	 * @param object $form
	 * @param string $part_name
	 * @param array  $part
	 * @param scalar $value
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	private function _getInputRadioTag($form, $part_name, $part, $value)
	{
		$tag = '';
		if (!isset($part['table'])) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_NOT_SET_PART_TABLE, 'Part: ' . $part_name, $form->getMainClassName());
		}
		foreach ($part['table'] as $id => $val) {
			if (isset($part['separator']) && $tag) {
				$tag .= $part['separator'];
			}
			$tag .= '<input type="radio"';
			$tag .= self::_getTagOption($form, $part_name, $part, $id);
			$tag .= ' value="' . $id . '"';
			$tag .= ((string)$id === (string)$value ? ' checked="checked"' : '');
			$tag .= ' />';
			$tag .= $val;
		}
		
		return $tag;
	}
	
	/**
	 * @param object $form
	 * @param string $part_name
	 * @param array  $part
	 * @param scalar $value
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	private function _getSelectTag($form, $part_name, $part, $value)
	{
		$tag = '<select' . self::_getTagOption($form, $part_name, $part) . '>';
		if (isset($part['head_value'])) {
			$tag .= '<option value="' . key($part['head_value']) . '">';
			$tag .= current($part['head_value']);
			$tag .= '</option>';
		}
		if (isset($part['table'])) {
			foreach ($part['table'] as $id => $val) {
				$tag .= '<option value="' . $id . '"' . ((string)$id === $value ? ' selected="selected"' : '') . '>';
				$tag .= $val;
				$tag .= '</option>';
			}
		}
		$tag .= '</select>';
		
		return $tag;
	}
	
	/**
	 * @param object $form
	 * @param string $part_name
	 * @param array  $part
	 * @param scalar $value
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	private function _getTextareaTag($form, $part_name, $part, $value)
	{
		$tag  = '<textarea' . self::_getTagOption($form, $part_name, $part) . '>';
		$tag .= $value;
		$tag .= '</textarea>';
		
		return $tag;
	}
	
	/**
	 * @param object $form
	 * @param string $part_name
	 * @param array  $part
	 * @param scalar $value
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($form, $part_name, $part = array(), $value = NULL)
	{
		if (!$part) {
			$search_child_part_flag = TRUE;
			$part = $this->_cz->newCore('form', 'get_part')->exec($form, $part_name, $search_child_part_flag);
		}
		
		if ($value === NULL) {
			if (!($values = $form->load('values', array()))) {
				$values = $this->_cz->newCore('form', 'init_values')->exec($form);
			}
			$value = $values[$part_name];
		}

		switch ($part['type']) {
			case 'text':
			case 'hidden':
				$tag = self::_getInputTag($form, $part_name, $part, $value);
				break;
			case 'checkbox':
				$tag = self::_getInputCheckboxTag($form, $part_name, $part, $value);
				break;
			case 'radio':
				$tag = self::_getInputRadioTag($form, $part_name, $part, $value);
				break;
			case 'select':
				$tag = self::_getSelectTag($form, $part_name, $part, $value);
				break;
			case 'textarea':
				$tag = self::_getTextareaTag($form, $part_name, $part, $value);
				break;
			case 'password':
			case 'file':
				$tag = self::_getInputTag($form, $part_name, $part);
				break;
			default:
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_INVALID_PART_TYPE, $part['type'], $form->getMainClassName());
		}
		
		return $tag;
	}
}
?>