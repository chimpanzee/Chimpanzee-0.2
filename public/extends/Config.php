<?php
require_once 'Func.php';
class CZConfig extends CZFunc
{
	private $_main_class_name;
	
	private $_values = array();

	
	/**
	 * @param string $main_class_name
	 * 
	 * @author Shin Uesugi
	 */
	public function _setMainClassName($main_class_name)
	{
		$this->_main_class_name = $main_class_name;
	}
	
	
	/**
	 * @param array $values
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function setValues($values)
	{
		$this->_values = $values;
		
		return $this;
	}
	
	/**
	 * @param string $var_name
	 * @param mixed  $value
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function addValue($var_name, $value)
	{
		if (isset($this->_values[$var_name])) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_CONFIG_SET_VAR, $var_name, $this->_main_class_name);
		}
		$this->_values[$var_name] = $value;
		
		return $this;
	}
	
	/**
	 * @param string $var_name
	 * @param mixed  $defalut_value
	 * 
	 * @return mixed
	 * 
	 * @author Shin Uesugi
	 */
	public function getValue($var_name, $defalut_value = NULL)
	{
		if (!isset($this->_values[$var_name])) {
			if ($defalut_value !== NULL) {
				return $defalut_value;
			}
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_CONFIG_NOT_SET_VAR, $var_name, $this->_main_class_name);
		}
		
		return $this->_values[$var_name];
	}
}
?>