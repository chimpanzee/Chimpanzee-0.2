<?php
final class CZSDb extends CZBase
{
	// Object
	private $_pdo_tran   = NULL;
	private $_pdo_select = NULL;
	
	
	/**
	 * @param object $pdo
	 * 
	 * @author Shin Uesugi
	 */	
	public function setPDOTran($pdo)
	{
		$this->_pdo_tran = $pdo;
	}
	
	/**
	 * @return object / NULL
	 * 
	 * @author Shin Uesugi
	 */
	public function getPDOTran()
	{
		return $this->_pdo_tran;
	}
	
	
	/**
	 * @param object $pdo / NULL
	 * 
	 * @author Shin Uesugi
	 */	
	public function setPDOSelect($pdo)
	{
		$this->_pdo_select = $pdo;
	}
	
	/**
	 * @return object / NULL
	 * 
	 * @author Shin Uesugi
	 */
	public function getPDOSelect()
	{
		return $this->_pdo_select;
	}
}
?>