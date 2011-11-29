<?php
final class CZSAutoload extends CZBase
{
	/**
	 * @param string $class_name
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	private function _autoload($class_name)
	{
		return $this->_cz->newCore('autoload', '_autoload')->exec($class_name);
	}
	
	/**
	 * @author Shin Uesugi
	 */
	function __construct()
	{
		if (function_exists('__autoload')) {
			spl_autoload_register('__autoload');
		}
		spl_autoload_register(array($this, '_autoload'));
	}
}
?>