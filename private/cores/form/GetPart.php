<?php
final class CZCformGetPart extends CZBase
{
	/**
	 * @param object  $form
	 * @param string  $part_name
	 * @param boolean $search_child_part_flag
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($form, $part_name, $search_child_part_flag = FALSE)
	{
		$part = array();
		$parts = $form->getParts();
		if (isset($parts[$part_name])) {
			$part = $parts[$part_name];
		} else if ($search_child_part_flag) {
			foreach ($parts as $values) {
				if (isset($values['parts'][$part_name])) {
					$part = $values['parts'][$part_name];
					break;
				}
			}
		}
		if (!$part) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_NOT_SET_PART, $part_name, $form->getMainClassName());
		}
		
		return $part;
	}
}
?>