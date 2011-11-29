<?php
final class CZCmodelGetValue extends CZBase
{
	/**
	 * @param object  $model
	 * @param string  $column_name
	 * @param array   $condition_sentences
	 * @param array   $condition_values
	 * @param boolean $format_flag
	 * 
	 * @return scalar / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model, $column_name, $condition_sentences = array(), $condition_values = array(), $format_flag = TRUE)
	{
		$table_name = $model->getTableName($model);

		list($condition_sentences, $condition_values) = $this->_cz->newCore('model', 'merge_mask')->exec($model, $condition_sentences, $condition_values);
		if (($value = $this->_cz->newCore('db', 'get_value')->exec($table_name, $column_name, $condition_sentences, $condition_values)) === FALSE) {
			return FALSE;
		}

		if ($format_flag) {
			list($value) = $this->_cz->newCore('model', 'format')->exec($model, array($value));
		}

		return $value;
	}
	
	/**
	 * @param object  $model
	 * @param integer $id
	 * @param string  $column_name
	 * @param boolean $format_flag
	 * 
	 * @return scalar / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function byId($model, $id, $column_name, $format_flag = TRUE)
	{
		$id_column_name = $model->getIdColumnName();
		$condition_sentences = array($id_column_name . '=:' . $id_column_name);
		$condition_values    = array($id_column_name => $id);
		
		return self::exec($model, $column_name, $condition_sentences, $condition_values, $format_flag);
	}
}
?>