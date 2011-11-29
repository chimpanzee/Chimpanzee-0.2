<?php
final class CZCsesSet extends CZBase
{
	/**
	 * @param string $var_name
	 * @param mixed  $value
	 * @param string $type
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($var_name, $value, $type = 'core')
	{
		$this->_cz->loadStatic('ses');

		$ses_name = $this->_cz->newCore('ses', 'get_name')->exec();
		$_SESSION[$ses_name][$type][$var_name] = $value;
	}
}
?>