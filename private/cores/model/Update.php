<?php
final class CZCmodelUpdate extends CZBase
{
	/**
	 * @param object  $model
	 * @param array   $record
	 * @param array   $condition_sentences
	 * @param array   $condition_values
	 * @param integer $id (Set by self::byId)
	 * 
	 * @return integer / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model, $record, $condition_sentences = array(), $condition_values = array(), $id = NULL)
	{
		$table_name = $model->getTableName();
		
		if (!$this->_cz->newCore('model', 'is_unique')->exec($model, $record, $id)) {
			return FALSE;
		}
		
		list($condition_sentences, $condition_values) = $this->_cz->newCore('model', 'merge_mask')->exec($model, $condition_sentences, $condition_values);
		
		return $this->_cz->newCore('db', 'update')->exec($table_name, $record, $condition_sentences, $condition_values);
	}
	
	/**
	 * @param object  $model
	 * @param integer $id
	 * @param array   $record
	 * 
	 * @return integer / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function byId($model, $id, $record)
	{
		$id_column_name = $model->getIdColumnName();
		
		$condition_sentences = array($id_column_name . '=:' . $id_column_name);
		$condition_values    = array($id_column_name => $id);
		
		return self::exec($model, $record, $condition_sentences, $condition_values, $id);
	}
}
?>