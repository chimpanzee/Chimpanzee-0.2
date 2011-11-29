<?php
final class CZCvarLoad extends CZBase
{
	/**
	 * @param string $main_class_name
	 * @param string $var_name
	 * @param mixed  $default_value
	 * 
	 * @return mixed
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($main_class_name, $var_name, $default_value = NULL)
	{
		$values = $this->_cz->newCore('ses', 'get')->exec($main_class_name, array(), 'var');
		if (!isset($values[$var_name])) {
			if ($default_value !== NULL) {
				return $default_value;
			}
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_VAR_NOT_SAVED_VAR, $var_name, $main_class_name);
		}
		
		return $values[$var_name];
	}
}
?>