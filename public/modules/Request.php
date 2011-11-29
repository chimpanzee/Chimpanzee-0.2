<?php
final class CZMRequest extends CZBase
{
	/**
	 * @param string $encoding
	 * 
	 * @author Shin Uesugi
	 */
	public function setEncoding($encoding)
	{
		$this->_cz->loadStatic('request')->setEncoding($encoding);
	}
	
	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getParams()
	{
		return $this->_cz->newCore('request', 'get_param')->getParams();
	}
	
	/**
	 * @param string $var_name
	 * @param mixed  $default_value
	 * 
	 * @return mixed
	 * 
	 * @author Shin Uesugi
	 */
	public function getParam($var_name, $default_value = NULL)
	{
		return $this->_cz->newCore('request', 'get_param')->getParam($var_name, $default_value);
	}

	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getGetParams()
	{
		return $this->_cz->newCore('request', 'get_param')->getGetParams();
	}
	
	/**
	 * @param string $var_name
	 * @param mixed  $default_value
	 * 
	 * @return mixed
	 * 
	 * @author Shin Uesugi
	 */
	public function getGetParam($var_name, $default_value = NULL)
	{
		return $this->_cz->newCore('request', 'get_param')->getGetParam($var_name, $default_value);
	}

	
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function getPostParams()
	{
		return $this->_cz->newCore('request', 'get_param')->getPostParams();
	}
	
	/**
	 * @param string $var_name
	 * @param mixed  $default_value
	 * 
	 * @return mixed
	 * 
	 * @author Shin Uesugi
	 */
	public function getPostParam($var_name, $default_value = NULL)
	{
		return $this->_cz->newCore('request', 'get_param')->getPostParam($var_name, $default_value);
	}
}
?>