<?php
final class CZCmodelBeginUpdate extends CZBase
{
	/**
	 * @param object  $model
	 * @param integer $id
	 * 
	 * @return array / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	private function _getFormValues($model, $id)
	{
		$set_values = $model->getFormSetValues();

		$column_names = array();
		$format_flag  = FALSE;
		if (!($record = $this->_cz->newCore('model', 'get_record')->byId($model, $id, $column_names, $format_flag))) {
			return FALSE;
		}

		$form_values = array();

		foreach ($record as $column_name => $value) {
			if (isset($set_values[$column_name])) {
				continue;
			}
			$form_values[$column_name] = $value;
		}

		foreach ($set_values as $form_part_name => $set_value) {
			if (is_array($set_value)) {
				if (isset($set_value['ref'])) {
					if (!isset($record[$set_value['ref']])) {
						$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_NOT_SET_FORM_SET_VALUE_REF_VALUE, $set_value['ref'], $model->getMainClassName());
					}
					$form_values[$form_part_name] = $record[$set_value['ref']];
				} else if (isset($set_value['convert'])) {
					$subject = isset($record[$form_part_name]) ? $record[$form_part_name] : '';
					$form_values[$form_part_name] = $this->_cz->newCore('filter', 'convert')->exec($set_value['convert'], $subject, $record);
				} else {
					$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_INVALID_FORM_SET_VALUE_KEY, key($set_value), $model->getMainClassName());
				}
			} else {
				$form_values[$form_part_name] = $set_value;
			}
		}

		return $form_values;
	}

	/**
	 * @param object  $model
	 * @param integer $id
	 * 
	 * @return array / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model, $id)
	{
		if (!($form_values = self::_getFormValues($model, $id))) {
			$model->free('update_id');
			return FALSE;
		}

		$model->save('update_id', $id);

		return $form_values;
	}
}
?>