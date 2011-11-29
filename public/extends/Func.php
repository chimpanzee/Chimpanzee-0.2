<?php
class CZFunc extends CZBase
{
	private $_main_class_name;
	
	
	/*
	 * #Set property
	 */
	
	/**
	 * @param string $main_class_name
	 * 
	 * @author Shin Uesugi
	 */
	public function _setMainClassName($main_class_name)
	{
		$this->_main_class_name = $main_class_name;
	}
	
	
	/*
	 * #Get property
	 */
	
	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getMainClassName()
	{
		return $this->_main_class_name;
	}
	
	
	/*
	 * #Get cz property
	 */
	
	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	protected function getApplicationName()
	{
		return $this->_cz->application_name;
	}
	

	/*
	 * #Module object
	 */

	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function newModule($name)
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
	protected function loadModule($name)
	{
		return $this->_cz->loadModule($name);
	}
	
	/**
	 * @param string $name
	 * 
	 * @author Shin Uesugi
	 */
	protected function unloadModule($name)
	{
		$this->_cz->unloadModule($name);
	}
	
	
	/*
	 * #Model Object
	 */
	
	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function newModel($name)
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
	protected function loadModel($name)
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
	protected function unloadModel($name)
	{
		$this->_cz->unloadUser('model', $name);
	}
	
	
	/*
	 * #Form object
	 */
	
	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function newForm($name)
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
	protected function loadForm($name)
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
	protected function unloadForm($name)
	{
		$this->_cz->unloadUser('form', $name);
	}
	
	
	/*
	 * #Func object
	 */
	
	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function newFunc($name)
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
	protected function loadFunc($name)
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
	protected function unloadFunc($name)
	{
		$this->_cz->unloadUser('func', $name);
	}
	
	
	/*
	 * #Table object
	 */
	
	/**
	 * @param string $name
	 * 
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	protected function newTable($name)
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
	protected function loadTable($name)
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
	protected function unloadTable($name)
	{
		$this->_cz->newUser('table', $name, $arg_num, $args);
	}
	
	
	/*
	 * #Unload all object
	 */
	
	/**
	 * @author Shin Uesugi
	 */
	protected function unloadAll()
	{
		$this->_cz->unloadAll();
	}
	
	
	/*
	 * #Save variable
	 */
	
	/**
	 * @param string $var_name
	 * @param mixed  $value
	 * 
	 * @author Shin Uesugi
	 */
	public function save($var_name, $value)
	{
		$this->_cz->newCore('var', 'save')->exec($this->_main_class_name, $var_name, $value);
	}
	
	/**
	 * @param string $var_name
	 * @param mixed  $defalt_value
	 * 
	 * @return mixed
	 * 
	 * @author Shin Uesugi
	 */
	public function load($var_name, $defalt_value = NULL)
	{
		return $this->_cz->newCore('var', 'load')->exec($this->_main_class_name, $var_name, $defalt_value);
	}
	
	/**
	 * @param string $var_name
	 * 
	 * @author Shin Uesugi
	 */
	public function free($var_name)
	{
		$this->_cz->newCore('var', 'free')->exec($this->_main_class_name, $var_name);
	}
	
	/**
	 * @author Shin Uesugi
	 */
	public function freeAll()
	{
		$this->_cz->newCore('var', 'freeAll')->exec($this->_main_class_name);
	}
}
?>