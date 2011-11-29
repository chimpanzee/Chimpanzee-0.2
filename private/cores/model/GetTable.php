<?php
final class CZCmodelGetTable extends CZBase
{
	/**
	 * @param object  $model_records
	 * @param string  $id_column_name
	 * @param string  $id_column_name
	 * @param boolean $format_flag
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model_records, $id_column_name, $value_column_name, $format_flag = TRUE)
	{
		$model = $model_records->getModel();
		
		if (!($records = $this->_cz->newCore('model', 'get_records')->exec($model_records, $format_flag))) {
			return array();
		}
		
		$record = current($records);
		if (!isset($record[$id_column_name])) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_INVALID_COLUMN_NAME, $id_column_name, $model->getMainClassName());
		}
		if (!isset($record[$value_column_name])) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_INVALID_COLUMN_NAME, $value_column_name, $model->getMainClassName());
		}
		
		$table = array();
		foreach ($records as $record) {
			$table[$record[$id_column_name]] = $record[$value_column_name];
		}
		
		return $table;
	}
}
?>