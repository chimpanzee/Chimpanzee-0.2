<?php
final class CZCmodelDelete extends CZBase
{
	/**
	 * @param object $model
	 * @param array  $condition_sentences
	 * @param array  $condition_values
	 * 
	 * @return integer
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model, $condition_sentences = array(), $condition_values = array())
	{
		$table_name = $model->getTableName();
		
		list($condition_sentences, $condition_values) = $this->_cz->newCore('model', 'merge_mask')->exec($model, $condition_sentences, $condition_values);
		
		return $this->_cz->newCore('db', 'delete')->exec($table_name, $condition_sentences, $condition_values);
	}
	
	/**
	 * @param object  $model
	 * @param integer $id
	 * 
	 * @return integer
	 * 
	 * @author Shin Uesugi
	 */
	public function byId($model, $id)
	{
		$id_column_name = $model->getIdColumnName();
		
		$condition_sentences = array($id_column_name . '=:' . $id_column_name);
		$condition_values    = array($id_column_name => $id);
		
		return self::exec($model, $condition_sentences, $condition_values);
	}
}
?>