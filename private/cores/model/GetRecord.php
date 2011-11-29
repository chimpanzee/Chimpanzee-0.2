<?php
final class CZCmodelGetRecord extends CZBase
{
	/**
	 * @param object  $model
	 * @param array   $column_names
	 * @param array   $condition_sentences
	 * @param array   $condition_values
	 * @param boolean $format_flag
	 * @param boolean $mask_flag (Set FALSE by CZClogin)
	 * 
	 * @return array / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model, $column_names = array(), $condition_sentences = array(), $condition_values = array(), $format_flag = TRUE, $mask_flag = TRUE)
	{
		$table_name = $model->getTableName();
		
		if ($mask_flag) {
			list($condition_sentences, $condition_values) = $this->_cz->newCore('model', 'merge_mask')->exec($model, $condition_sentences, $condition_values);
		}
		if (!($record = $this->_cz->newCore('db', 'get_record')->exec($table_name, $column_names, $condition_sentences, $condition_values))) {
			return FALSE;
		}

		if ($format_flag) {
			$record = $this->_cz->newCore('model', 'format')->exec($model, $record);
		}

		return $record;
	}
	
	/**
	 * @param object  $model
	 * @param integer $id
	 * @param array   $column_names
	 * @param boolean $format_flag
	 * 
	 * @return array / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function byId($model, $id, $column_names = array(), $format_flag = TRUE)
	{
		$id_column_name = $model->getIdColumnName();
		
		$condition_sentences = array($id_column_name . '=:' . $id_column_name);
		$condition_values    = array($id_column_name => $id);
		
		return self::exec($model, $column_names, $condition_sentences, $condition_values, $format_flag);
	}
}
?>