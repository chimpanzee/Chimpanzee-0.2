<?php
final class CZCdbGetValuesQueryPart extends CZBase
{
	/**
	 * @param array $param_list
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($param_list)
	{
		$records_str = '';
		foreach ($param_list as $param_values) {
			if ($records_str) {
				$records_str .= ',';
			}
			$record_str = '';
			foreach ($param_values as $colon_param_name => $param_value) {
				if ($record_str) {
					$record_str .= ',';
				}
				if (is_array($param_value)) {
					if (!isset($param_value['sql'])) {
						$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_DB_INVALID_SET_VALUE_KEY, key($param_value));
					}
					$record_str .= $param_value['sql'];
				} else {
					$record_str .= $colon_param_name;
				}
			}
			$records_str .= '(' . $record_str . ')';
		}
		
		return ' VALUES ' . $records_str;
	}
}
?>