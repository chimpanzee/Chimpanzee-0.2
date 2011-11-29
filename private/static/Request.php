<?php
final class CZSRequest extends CZBase
{
	private $_encoding;

	
	/**
	 * @author Shin Uesugi
	 */
	function __construct()
	{
		$this->_encoding = mb_internal_encoding();
	}

	
	/**
	 * @param string $encoding
	 * 
	 * @author Shin Uesugi
	 */
	public function setEncoding($encoding)
	{
		$this->_encoding = $encoding;
	}
	
	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getEncoding()
	{
		return $this->_encoding;
	}
}
?>