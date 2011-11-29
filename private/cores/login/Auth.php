<?php
final class CZCloginAuth extends CZBase
{
	/**
	 * @param object $model
	 * @param array  $condition_sentences
	 * @param array  $condition_values
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model, $condition_sentences, $condition_values)
	{
		if (($login_id = $this->_cz->newCore('ses', 'get')->exec('login_id', FALSE))) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_AUTHORIZED_LOGIN, 'ID: ' . $login_id);
		}
		
		$column_names = array();
		$format_flag  = FALSE;
		$mask_flag    = FALSE;
		if (!($record = $model->getRecord($column_names, $condition_sentences, $condition_values, $format_flag, $mask_flag))) {
			return FALSE;
		}

		$id_column_name = $model->getIdColumnName();
		$this->_cz->newCore('ses', 'set')->exec('login_id',               $record[$id_column_name]);
		$this->_cz->newCore('ses', 'set')->exec('login_values',           $record);
		$this->_cz->newCore('ses', 'set')->exec('login_formatted_values', $model->format($record));
		
		return TRUE;
	}
}
?>