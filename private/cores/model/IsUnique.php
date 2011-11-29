<?php
final class CZCmodelIsUnique extends CZBase
{
	/**
	 * @param object  $model
	 * @param array   $record
	 * @param integer $ignored_id
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model, $record, $ignored_id = NULL)
	{
		if (!($uniques = $model->getUniques())) {
			return TRUE;
		}
		$unique_err_msgs = $model->getFormUniqueErrMsgs();
		
		$format_flag = FALSE;
		
		if ($ignored_id !== NULL) {
			$id_column_name = $model->getIdColumnName($model);
			$init_condition_sentences = array($id_column_name . '<>:' . $id_column_name);
			$init_condition_values    = array($id_column_name => $ignored_id);
			
			$column_names = array();
			if (!($ignore_record = $this->_cz->newCore('model', 'get_record')->byId($model, $ignored_id, $column_names, $format_flag))) {
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_GET_RECORD, 'ID:' . $ignored_id);
			}
		} else {
			$init_condition_sentences = array();
			$init_condition_values    = array();
			$ignore_record            = array();
		}
		
		$result = TRUE;
		foreach ($uniques as $unique_name => $column_names) {
			$condition_sentences = $init_condition_sentences;
			$condition_values    = $init_condition_values;
			foreach ($column_names as $column_name) {
				if (isset($record[$column_name]) && !is_array($record[$column_name])) {
					$condition_values[$column_name] = $record[$column_name];
				} else if ($ignore_record) {
					if (!array_key_exists($column_name, $ignore_record)) {
						$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_NOT_EXIST_UNIQUE_COLUMN_NAME, $column_name, $model->getMainClassName());
					}
					$condition_values[$column_name] = $ignore_record[$column_name];
				}
				if (array_key_exists($column_name, $condition_values)) {
					if ($condition_values[$column_name] !== NULL) {
						$condition_sentences[] = $column_name . '=:' . $column_name;
					} else {
						$condition_sentences[] = $column_name . ' IS NULL';
						unset($condition_values[$column_name]);
					}
				}
			}
			if ($condition_sentences) {
				if ($this->_cz->newCore('model', 'get_value')->exec($model, 'COUNT(*)', $condition_sentences, $condition_values, $format_flag) > 0) {
					$result = FALSE;
					if (isset($unique_err_msgs[$unique_name])) {
						foreach ($unique_err_msgs[$unique_name] as $form_part_name => $err_msg) {
							$this->_cz->newCore('form', 'save_err')->exec($model->getBoundForm(), $form_part_name, $err_msg);
						}
					} else {
						$this->_cz->newCore('form', 'save_err')->exec($unique_name, 'Please input another content.');
					}
				}
			}
		}

		return $result;	
	}
}
?>