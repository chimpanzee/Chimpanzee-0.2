<?php
final class CZCloginLogin extends CZBase
{
	/**
	 * @param object $model
	 * @param array  $values
	 * @param array  $auth_column_names
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($model, $values, $auth_column_names)
	{
		$condition_sentences = array();
		$condition_values    = array();
		if (count($auth_column_names) < 1) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_LOGIN_NOT_SET_AUTH_COLUMN_NAMES);
		}
		foreach ($auth_column_names as $column_name) {
			if (!isset($values[$column_name])) {
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_LOGIN_NOT_SET_AUTH_VALUE, 'Column: ' . $column_name);
			}
			$condition_sentences[]          = $column_name . '=:' . $column_name;
			$condition_values[$column_name] = $values[$column_name];
		}
		
		return $this->_cz->newCore('login', 'auth')->exec($model, $condition_sentences, $condition_values);
	}
}
?>