<?php
final class CZCmodelMergeMask extends CZBase
{
	/**
	 * @param object $model
	 * @param array  $condition_sentences
	 * @param array  $condition_values
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model, $condition_sentences = array(), $condition_values = array())
	{
		$mask_condition_sentences = $model->getMaskConditionSentences();
		$mask_condition_values    = $model->getMaskConditionValues();
		
		$condition_sentences = array_merge($condition_sentences, $mask_condition_sentences);
		$condition_values    = array_merge($condition_values, $mask_condition_values);
		
		return array($condition_sentences, $condition_values);
	}
}
?>