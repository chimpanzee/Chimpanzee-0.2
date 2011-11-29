<?php
final class CZCdbGetSetQueryPart extends CZBase
{
	/**
	 * @param array $record
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($record)
	{
		$str = '';
		foreach ($record as $column_name => $value) {
			if ($str) {
				$str .= ',';
			}
			if (is_array($value)) {
				if (!isset($value['sql'])) {
					$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_DB_INVALID_SET_VALUE_KEY, key($value));
				}
				$str .= $column_name . '=' . $value['sql'];
			} else {
				$str .= $column_name . '=:' . $column_name;
			}
		}
		
		return ' SET ' . $str;
	}
}
?>