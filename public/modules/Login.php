<?php
final class CZMLogin extends CZBase
{
	/*
	 * #Login
	 */
	
	/**
	 * @param object $model
	 * @param array  $values
	 * @param array  $auth_column_names
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function login($model, $values, $auth_column_names)
	{
		return $this->_cz->newCore('login', 'login')->exec($model, $values, $auth_column_names);
	}
	
	/**
	 * @param array $condition_values
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function isLoggedIn($condition_values = array())
	{
		return $this->_cz->newCore('login', 'is_logged_in')->exec($condition_values);
	}
	
	/**
	 * @author Shin Uesugi
	 */
	public function redirectSrcUrl()
	{
		$this->_cz->newCore('login', 'redirect_src_url')->exec();
	}

	
	/*
	 * #Get value
	 */

	/**
	 * @return integer / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function getId()
	{
		return $this->_cz->newCore('login', 'get_id')->exec();
	}
	
	/**
	 * @param boolean $format_flag
	 * 
	 * @return array / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function getValues($format_flag = TRUE)
	{
		return $this->_cz->newCore('login', 'get_values')->exec($format_flag);
	}

	
	/*
	 * #Logout
	 */
	
	/**
	 * @author Shin Uesugi
	 */
	public function logout()
	{
		$this->_cz->newCore('login', 'logout')->exec();
	}
}
?>