<?php
final class CZCmodelCommitUpdate extends CZBase
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
		if (($id = $model->load('update_id', FALSE)) === FALSE) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_NOT_BEGUN_UPDATE, '', $model->getMainClassName());
		}
		
		$record = $this->_cz->newCore('model', 'get_record_by_form_values')->exec($model, $form_values);
		$record = array_merge($record, $add_values);
		
		if (($record_num = $this->_cz->newCore('model', 'update')->byId($model, $id, $record)) === FALSE) {
			return FALSE;
		}
		
		$model->freeAll();

		return $record_num;
	}
}
?>