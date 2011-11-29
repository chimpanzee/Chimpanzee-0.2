<?php
final class CZMErr extends CZBase
{
	/**
	 * @param string $msg
	 * 
	 * @author Shin Uesugi
	 */
	public function save($msg)
	{
		$this->_cz->newCore('err', 'save')->exec($msg);
	}
	
	/**
	 * @param string $default_msg / FALSE
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function load($default_msg = '')
	{
		return $this->_cz->newCore('err', 'load')->exec($default_msg);
	}
	
	/**
	 * @author Shin Uesugi
	 */
	public function free()
	{
		$this->_cz->newCore('err', 'free')->exec();
	}
}
?>