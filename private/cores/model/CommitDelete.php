<?php
final class CZCmodelCommitDelete extends CZBase
{
	/**
	 * @param object $model
	 * @param array  $relation_models
	 * 
	 * @return integer / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model, $relation_models = array())
	{
		if (($id = $model->load('delete_id', FALSE)) === FALSE) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MODEL_NOT_BEGUN_DELETE, '', $model->getMainClassName());
		}
		foreach ($relation_models as $values) {
			$condition_sentences = array(
				$values[1] . '= :id',
			);
			$condition_values = array(
				'id' => $id,
			);
			if ($values[0]->getValue('COUNT(*)', $condition_sentences, $condition_values)) {
				return FALSE;
			}
		}
		
		$record_num = $this->_cz->newCore('model', 'delete')->byId($model, $id);
		
		$model->freeAll();
		
		return $record_num;
	}
}
?>