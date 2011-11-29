<?php
final class CZCsesFree extends CZBase
{
	/**
	 * @param string $var_name
	 * @param string $type
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($var_name, $type = 'core')
	{
		$this->_cz->loadStatic('ses');

		$ses_name = $this->_cz->newCore('ses', 'get_name')->exec();
		unset($_SESSION[$ses_name][$type][$var_name]);
	}
}
?>