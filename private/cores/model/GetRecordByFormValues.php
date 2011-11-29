<?php
final class CZCmodelGetRecordByFormValues extends CZBase
{
	/**
	 * @param object $model
	 * @param array  $form_values
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model, $form_values)
	{
		if (!$form_values) {
			return array();
		}
		
		$set_values             = $model->getFormModelSetValues();
		$ignore_form_part_names = $model->getFormIgnorePartNames();
		
		$record = array();

		foreach ($form_values as $form_part_name => $form_value) {
			if (in_array($form_part_name, $ignore_form_part_names) || isset($set_values[$form_part_name])) {
				continue;
			}
			$record[$form_part_name] = $form_value;
		}

		foreach ($set_values as $column_name => $set_value) {
			if (is_array($set_value)) {
				if (isset($set_value['ref'])) {
					if (isset($form_values[$set_value['ref']])) {
						$record[$column_name] = $form_values[$set_value['ref']];
					}
				} else if (isset($set_value['convert'])) {
					$subject = isset($form_values[$column_name]) ? $form_values[$column_name] : '';
					if (($converted_value = $this->_cz->newCore('filter', 'convert')->exec($set_value['convert'], $subject, $form_values)) !== '') {
						$record[$column_name] = $converted_value;
					}
				} else {
					$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_INVALID_MODEL_SET_VALUE_KEY, key($set_value), $model->getMainClassName());
				}
			} else {
				$record[$column_name] = $set_value;
			}
		}
		
		return $record;
	}
}
?>