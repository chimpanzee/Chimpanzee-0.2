<?php
final class CZCmodelMergeSearch extends CZBase
{
	/**
	 * @param object $model_records
	 * @param array  $condition_sentences
	 * @param array  $condition_values
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model_records, $condition_sentences = array(), $condition_values = array())
	{
		$search_condition_sentences = $model_records->getSearchConditionSentences();
		$search_condition_values    = $model_records->getSearchConditionValues();
		
		$condition_sentences = array_merge($condition_sentences, $search_condition_sentences);
		$condition_values    = array_merge($condition_values, $search_condition_values);
		
		return array($condition_sentences, $condition_values);
	}
}
?>