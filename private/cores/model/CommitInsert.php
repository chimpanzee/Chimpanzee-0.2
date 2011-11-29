<?php
final class CZCmodelCommitInsert extends CZBase
{
	/**
	 * @param object $model
	 * @param array  $form_values
	 * @param array  $add_values
	 * 
	 * @return integer / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model, $form_values, $add_values = array())
	{
		$record = $this->_cz->newCore('model', 'get_record_by_form_values')->exec($model, $form_values);
		$record = array_merge($record, $add_values);
		
		return $this->_cz->newCore('model', 'insert')->exec($model, $record);
	}
}
?>