<?php
final class CZCsesGet extends CZBase
{
	/**
	 * @param string $var_name
	 * @param mixed  $default_value
	 * @param string $type
	 * 
	 * @return mixed
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($var_name, $default_value = NULL, $type = 'core')
	{
		$this->_cz->loadStatic('ses');

		$ses_name = $this->_cz->newCore('ses', 'get_name')->exec();
		
		if (!isset($_SESSION[$ses_name][$type][$var_name])) {
			if ($default_value !== NULL) {
				return $default_value;
			}
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_SES_NOT_SET_VAR, $var_name);
		}
		
		return $_SESSION[$ses_name][$type][$var_name];
	}
}
?>