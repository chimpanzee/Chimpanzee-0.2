<?php
final class CZCformInitValues extends CZBase
{
	/**
	 * @param object $form
	 * @param array  $replace_values
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($form, $replace_values = array())
	{
		$set_values = array();
		$parts = $form->getParts();
		foreach ($parts as $part_name => $part) {
			if (isset($part['parts'])) {
				foreach ($part['parts'] as $child_part_name => $child_part) {
					if(isset($replace_values[$child_part_name])) {
	 					$set_values[$child_part_name] = $replace_values[$child_part_name];
					} else {
 						$set_values[$child_part_name] = $this->_cz->newCore('form', 'get_default_value')->exec($form, $child_part);
					}
				}
			} else {
				if (isset($replace_values[$part_name])) {
					$set_values[$part_name] = $replace_values[$part_name];
				} else {
					$set_values[$part_name] = $this->_cz->newCore('form', 'get_default_value')->exec($form, $part);
				}
			}
		}

		$form->save('values', $set_values);
		
		return $set_values;
	}
}
?>