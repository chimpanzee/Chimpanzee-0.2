<?php
final class CZObj
{
	// Object
	private $_cz;


	/*
	 * #Initialization
	 */
	
	/**
	 * @param object $cz
	 * 
	 * @author Shin Uesugi
	 */
	function __construct($cz)
	{
		$this->_cz = $cz;
	}
	
	
	/*
	 * #Module
	 */

	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function newModule($name)
	{
		return $this->_cz->newModule($name);
	}
	
	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function loadModule($name)
	{
		return $this->_cz->loadModule($name);
	}
	
	/**
	 * @param string $name
	 * 
	 * @author Shin Uesugi
	 */
	public function unloadModule($name)
	{
		$this->_cz->unloadModule($name);
	}
	
	
	/*
	 * #Model
	 */
	
	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function newModel($name)
	{
		$arg_num = func_num_args();
		$args    = func_get_args();
		
		return $this->_cz->newUser('model', $name, $arg_num, $args);
	}
	
	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function loadModel($name)
	{
		$arg_num = func_num_args();
		$args    = func_get_args();
		
		return $this->_cz->loadUser('model', $name, $arg_num, $args);
	}
	
	/**
	 * @param string $name
	 * 
	 * @author Shin Uesugi
	 */
	public function unloadModel($name)
	{
		$this->_cz->unloadUser('model', $name);
	}
	
	
	/*
	 * #Form
	 */
	
	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function newForm($name)
	{
		$arg_num = func_num_args();
		$args    = func_get_args();
		
		return $this->_cz->newUser('form', $name, $arg_num, $args);
	}
	
	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function loadForm($name)
	{
		$arg_num = func_num_args();
		$args    = func_get_args();
		
		return $this->_cz->loadUser('form', $name, $arg_num, $args);
	}
	
	/**
	 * @param string $name
	 * 
	 * @author Shin Uesugi
	 */
	public function unloadForm($name)
	{
		$this->_cz->unloadUser('form', $name);
	}
	
	
	/*
	 * #Func
	 */
	
	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function newFunc($name)
	{
		$arg_num = func_num_args();
		$args    = func_get_args();
		
		return $this->_cz->newUser('func', $name, $arg_num, $args);
	}
	
	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function loadFunc($name)
	{
		$arg_num = func_num_args();
		$args    = func_get_args();
		
		return $this->_cz->loadUser('func', $name, $arg_num, $args);
	}
	
	/**
	 * @param string $name
	 * 
	 * @author Shin Uesugi
	 */
	public function unloadFunc($name)
	{
		$this->_cz->unloadUser('func', $name);
	}
	
	
	/*
	 * #Table
	 */
	
	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function newTable($name)
	{
		$arg_num = func_num_args();
		$args    = func_get_args();
		
		return $this->_cz->newUser('table', $name, $arg_num, $args);
	}
	
	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function loadTable($name)
	{
		$arg_num = func_num_args();
		$args    = func_get_args();
		
		return $this->_cz->loadUser('table', $name, $arg_num, $args);
	}
	
	/**
	 * @param string $name
	 * 
	 * @author Shin Uesugi
	 */
	public function unloadTable($name)
	{
		$this->_cz->newUser('table', $name);
	}
	
	
	/*
	 * #Unload all
	 */
	
	/**
	 * @author Shin Uesugi
	 */
	public function unloadAll()
	{
		$this->_cz->unloadAll();
	}
}
?>