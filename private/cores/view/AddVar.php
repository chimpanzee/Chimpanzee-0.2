<?php
final class CZCviewAddVar extends CZBase
{
	/**
	 * @param string  $var_name
	 * @param mixed   $value
	 * @param boolean $escape_flag
	 * @param array   $ignore_escape_keys
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($var_name, $value, $escape_flag = TRUE, $ignore_escape_keys = array())
	{
		$vars = $this->_cz->loadStatic('view')->getVars();
		if (isset($vars[$var_name])) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_VIEW_ADDED_VAR, $var_name);
		}
		
		if (!is_object($value)) {
			$value = $this->_cz->newCore('view', 'convert')->exec($value, $escape_flag, $ignore_escape_keys);
		}
		$vars[$var_name] = $value;
		$this->_cz->loadStatic('view')->setVars($vars);
	}
}
?>