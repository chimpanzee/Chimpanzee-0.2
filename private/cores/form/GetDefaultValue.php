<?php
final class CZCformGetDefaultValue extends CZBase
{
	/**
	 * @param object $form
	 * @param array  $part
	 * 
	 * @return scalar
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($form, $part)
	{
		switch ($part['type']) {
			case 'text':
			case 'radio':
			case 'select':
			case 'textarea':
			case 'hidden':
				$value = isset($part['default_value']) ? $part['default_value'] : '';
				break;
			case 'checkbox':
				$value = isset($part['default_value']) ? $part['default_value'] : FALSE;
				break;
			case 'password':
			case 'file':
				$value = '';
				break;
			default:
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_INVALID_PART_TYPE, $part['type'], $form->getMainClassName());
		}
		
		return $value;
	}
}
?>