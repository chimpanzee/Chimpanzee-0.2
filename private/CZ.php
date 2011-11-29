<?php
final class Cz
{
	// Object
	private $_obj_ctrl;
	
	// CZ directories
	public $cz_dir;
	public $private_dir;
	public $public_dir;
	public $extensions_dir;
	
	// User directories
	public $project_dir;
	public $applicatoins_dir;
	public $common_dir;
	public $application_dir;
	public $tmp_dir;
	
	public $application_name;
	
	public $develop_flag = TRUE;

	
	/*
	 * #Static object
	 */
	
	/**
	 * @param string $name
	 *
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function loadStatic($name)
	{
		return $this->_obj_ctrl->load('static', $name);
	}

	
	/*
	 * #Core object
	 */
	
	/**
	 * @param string $type
	 * @param string $name
	 *
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function newCore($type, $name)
	{
		return $this->_obj_ctrl->_new('core', $name, $type);
	}
	
	/**
	 * @param string $type
	 * @param string $name
	 *
	 * @return object
	 * 
	 * @author Shin Uesugi
	 */
	public function loadCore($type, $name)
	{
		return $this->_obj_ctrl->load('core', $name, $type);
	}
	
	/**
	 * @param string $type
	 * @param string $name
	 * 
	 * @author Shin Uesugi
	 */
	public function unloadCore($type, $name)
	{
		$this->_obj_ctrl->unload('core', $name, $type);
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
	public function newModule($name)
	{
		return $this->_obj_ctrl->_new('module', $name);
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
		return $this->_obj_ctrl->load('module', $name);
	}

	/**
	 * @param string $name
	 * 
	 * @author Shin Uesugi
	 */
	public function unloadModule($name)
	{
		$this->_obj_ctrl->unload('module', $name);
	}
	
	
	/*
	 * #User object
	 */
	
	/**
	 * @param integer $arg_num
	 * @param array   $args
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	private function _getConstructParams($arg_num, $args)
	{
		$params = array();
		if ($arg_num > 1) {
			for ($i = 1; $i < $arg_num; $i++) {
				$params[] = $args[$i];
			}
		}
		
		return $params;
	}
	
	/**
	 * @param string  $type
	 * @param string  $name
	 * @param integer $arg_num
	 * @param array   $args
	 * 
	 * @return object / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function newUser($type, $name, $arg_num = 0, $args = array())
	{
		return $this->_obj_ctrl->_new('user', $name, $type, self::_getConstructParams($arg_num, $args));
	}

	/**
	 * @param string  $type
	 * @param string  $name
	 * @param integer $arg_num
	 * @param array   $args
	 * 
	 * @return object / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function loadUser($type, $name, $arg_num = 0, $args = array())
	{
		return $this->_obj_ctrl->load('user', $name, $type, self::_getConstructParams($arg_num, $args));
	}

	/**
	 * @param string $type
	 * @param string $name
	 * 
	 * @author Shin Uesugi
	 */
	public function unloadUser($type, $name)
	{
		$this->_obj_ctrl->unload('user', $name, $type);
	}
	
	
	/*
	 * #Unload all dynamic object
	 */
	
	/**
	 * @author Shin Uesugi
	 */
	public function unloadAll()
	{
		$this->_obj_ctrl->unloadAll();
	}
	
	
	/*
	 * #Set application name
	 */
	
	/**
	 * @param string $application_name
	 */
	public function setApplicationName($application_name = '')
	{
		if ($application_name !== '') {
			$this->application_dir = $this->applicatoins_dir . DIRECTORY_SEPARATOR . $application_name;
		} else {
			$this->application_dir = '';
		}
		$this->application_name = $application_name;
	}
	
	
	/*
	 * #Initialization
	 */
	
	/**
	 * @param string $cz_dir
	 * @param string $project_dir
	 * @param string $application_name
	 * 
	 * @author Shin Uesugi
	 */
	function __construct($cz_dir, $project_dir, $application_name = '')
	{
		$this->cz_dir         = $cz_dir;
		$this->private_dir    = $cz_dir . DIRECTORY_SEPARATOR . 'private';
		$this->public_dir     = $cz_dir . DIRECTORY_SEPARATOR . 'public';
		$this->extensions_dir = $cz_dir . DIRECTORY_SEPARATOR . 'extensions';

		$this->project_dir = $project_dir;
		
		$this->applicatoins_dir = $this->project_dir . DIRECTORY_SEPARATOR . 'applications';
		
		$this->common_dir = $this->applicatoins_dir . DIRECTORY_SEPARATOR . '_common';
		self::setApplicationName($application_name);
		
		require_once 'ObjCtrl.php';
		$this->_obj_ctrl = new CZObjCtrl($this);
		
		self::loadStatic('autoload');
		

		/*
		 * Global config
		 */ 
		$this->develop_flag = self::newUser('config', 'CZ')->getValue('develop_flag', TRUE);
		if ($this->develop_flag) {
			ini_set('display_errors', 'On');
			error_reporting(E_ALL);
		} else {
			ini_set('display_errors', 'Off');
		}
		
		$this->tmp_dir = self::newUser('config', 'CZ')->getValue('tmp_dir', FALSE);
		if (!$this->tmp_dir) {
			$this->tmp_dir = $this->project_dir . DIRECTORY_SEPARATOR . 'tmp';
		}
	}


	/*
	 * #Other cz methods
	 */
	
	/**
	 * @param string $value
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function isValidStr($value)
	{
		return ($value !== NULL) && !is_bool($value) && !is_array($value) && ($value !== '');
	}
	
	/**
	 * ex: '_xxx_yyy...' => '_XxxYyy...'
	 * 
	 * @param string $str
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getUpperStr($str)
	{
		$upper_str = '';
		$parts = explode('_', $str);
		foreach ($parts as $part) {
			$upper_str .= ($part !== '') ? ucfirst($part) : '_';
		}
		
		return $upper_str;
	}
}
?>