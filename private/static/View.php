<?php
final class CZSView extends CZBase
{
	private $_vars = array();


	/**
	 * @param array $vars
	 * 
	 * @author Shin Uesugi
	 */
	public function setVars($vars)
	{
		$this->_vars = $vars;
	}
	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getVars()
	{
		return $this->_vars;
	}
}
?>