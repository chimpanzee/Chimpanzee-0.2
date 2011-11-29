<?php
final class CZCmodelGetRecords extends CZBase
{
	/**
	 * @param object  $model_records
	 * @param boolean $format_flag
	 * @param boolean $add_id_column_flag (Set TRUE by CZCGetListHtml)
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model_records, $format_flag = TRUE, $add_id_column_flag = FALSE)
	{
		$model = $model_records->getModel();
		
		$table_name          = $model->getTableName();
		$id_column_name      = $model->getIdColumnName();
		$column_names        = $model_records->getColumnNames();
		$condition_sentences = $model_records->getConditionSentences();
		$condition_values    = $model_records->getConditionValues();
		$options             = $model_records->_getOptions();
		$paging              = $model_records->getPaging();
		
		if ($add_id_column_flag && $column_names) {
			$column_names[] = $id_column_name;
		}
		list($condition_sentences, $condition_values) = $this->_cz->newCore('model', 'merge_mask')->exec($model, $condition_sentences, $condition_values);
		list($condition_sentences, $condition_values) = $this->_cz->newCore('model', 'merge_search')->exec($model_records, $condition_sentences, $condition_values);
		if ($paging && !isset($options['limit'])) {
			$current_page_num = $this->_cz->newCore('model', 'get_current_page_num')->exec($model_records);
			$row_num          = $this->_cz->newCore('model', 'get_row_num')->exec($model_records);
			$options['offset'] = ($current_page_num - 1) * $row_num;
			$options['limit']  = $row_num;
		}
		if (!($records = $this->_cz->newCore('db', 'get_records')->exec($table_name, $column_names, $condition_sentences, $condition_values, $options))) {
			return array();
		}

		if ($format_flag) {
			foreach ($records as $num => $record) {
				$records[$num] = $this->_cz->newCore('model', 'format')->exec($model, $record);
			}
		}

		return $records;
	}
}
?>