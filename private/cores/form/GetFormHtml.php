<?php
final class CZCformGetFormHtml extends CZBase
{
	/**
	 * @param object $form
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($form)
	{
		$parts = $form->getParts();
		
		if (!($values = $form->load('values', array()))) {
			$values = $this->_cz->newCore('form', 'init_values')->exec($form);
		}
		
		$hidden_tags   = '';
		$caption_areas = array();
		$data_areas    = array();
		foreach ($parts as $part_name => $part) {
			if (isset($part['type']) && ($part['type'] == 'hidden')) {
				$hidden_tags .= $this->_cz->newCore('form', 'get_edit_tag')->exec($form, $part_name, $part, $values[$part_name]);
			} else {
				$caption_areas[$part_name] = $this->_cz->newCore('form', 'get_caption')->exec($form, $part_name, $part);
				$data_areas[$part_name]    = $this->_cz->newCore('form', 'get_form_data_area')->exec($form, $part_name, $part, $values);
			}
		}
		
		return $hidden_tags . $this->_cz->newCore('html', 'get_form')->exec($caption_areas, $data_areas);
	}
}
?>