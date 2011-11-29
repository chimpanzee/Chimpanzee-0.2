<?php
final class CZMSes extends CZBase
{
	/**
	 * @param string $var_name
	 * @param mixed  $value
	 * 
	 * @author Shin Uesugi
	 */
	public function set($var_name, $value)
	{
		$this->_cz->newCore('ses', 'set')->exec($var_name, $value, 'module');
	}

	/**
	 * @param string $var_name
	 * @param mixed  $default_value
	 * 
	 * @return mixed
	 * 
	 * @author Shin Uesugi
	 */
	public function get($var_name, $default_value = NULL)
	{
		return $this->_cz->newCore('ses', 'get')->exec($var_name, $default_value, 'module');
	}

	/**
	 * @param string $var_name
	 * 
	 * @author Shin Uesugi
	 */
	public function free($var_name)
	{
		$this->_cz->newCore('ses', 'free')->exec($var_name, 'module');
	}

	/**
	 * @author Shin Uesugi
	 */
	public function freeAll()
	{
		$this->_cz->newCore('ses', 'freeAll')->exec();
	}
}
?>