<?php
final class CZObjCtrl
{
	// Object
	private $_cz;
	private $_loaded_static_objs  = array();
	private $_loaded_dynamic_objs = array();
	
	private $_load_only = FALSE;
	
	
	/*
	 * #Get
	 */
	
	/**
	 * @param string  $main_type
	 * @param string  $sub_type
	 * @param string  $name
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	private function _getInfo($main_type, $sub_type, $name)
	{
		$real_name = $this->_cz->getUpperStr($name);
		switch ($main_type) {
			case 'static':
				$info = array(
					'search_class_paths' => array(
						$this->_cz->private_dir . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . $real_name . '.php',
					),
					'class_name' => 'CZS' . $real_name,
				);
				break;
			case 'core':
				$info = array(
					'search_class_paths' => array(
						$this->_cz->private_dir . DIRECTORY_SEPARATOR . 'cores' . DIRECTORY_SEPARATOR . $sub_type . DIRECTORY_SEPARATOR . $real_name . '.php',
					),
					'class_name' => 'CZC' . $sub_type . $real_name,
				);
				break;
			case 'module':
				$info = array(
					'search_class_paths' => array(
						$this->_cz->public_dir . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $real_name . '.php',
					),
					'class_name' => 'CZM' . $real_name,
				);
				break;
			case 'user':
				$relative_path = $sub_type . 's' . DIRECTORY_SEPARATOR . $real_name . '.php';
				$info = array(
					'search_class_paths' => array(
						$this->_cz->application_dir . DIRECTORY_SEPARATOR . $relative_path,
						$this->_cz->common_dir      . DIRECTORY_SEPARATOR . $relative_path,
					),
					'class_name' => $sub_type . $real_name,
				);
				$extends_dir = $this->_cz->public_dir . DIRECTORY_SEPARATOR . 'extends';
				switch ($sub_type) {
					case 'config':
						$info['extend_path'] = $extends_dir . DIRECTORY_SEPARATOR . 'Config.php';
						break;
					case 'ctrl':
						$info['extend_path'] = $extends_dir . DIRECTORY_SEPARATOR . 'Ctrl.php';
						break;
					case 'model':
						$info['extend_path'] = $extends_dir . DIRECTORY_SEPARATOR . 'Model.php';
						break;
					case 'form':
						$info['extend_path'] = $extends_dir . DIRECTORY_SEPARATOR . 'Form.php';
						break;
					case 'func':
						$info['extend_path'] = $extends_dir . DIRECTORY_SEPARATOR . 'Func.php';
						break;
					case 'table':
						$info['extend_path'] = $extends_dir . DIRECTORY_SEPARATOR . 'Table.php';
						break;
					default:
						self::_new('core', 'fatal', 'err')->exec(__FILE__, __LINE__, CZ_FATAL_OBJ_INVALID_SUB_TYPE, $sub_type);
				}
				break;
			default:
				self::_new('core', 'fatal', 'err')->exec(__FILE__, __LINE__, CZ_FATAL_OBJ_INVALID_MAIN_TYPE, $main_type);
		}
		
		return $info;
	}
	
	/**
	 * @param string $main_type
	 * @param string $sub_type
	 * @param array  $search_class_paths
	 * @param string $class_name
	 * 
	 * @return string / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	private function _getClassPath($main_type, $sub_type, $search_class_paths, $class_name)
	{
		$class_path = '';
		foreach ($search_class_paths as $search_class_path) {
			if (file_exists($search_class_path)) {
				$class_path = $search_class_path;
				break;
			}
		}
		if (!$class_path) {
			if (($main_type == 'user') && ($sub_type == 'ctrl')) {
				return FALSE;
			} else {
				self::_new('core', 'fatal', 'err')->exec(__FILE__, __LINE__, CZ_FATAL_OBJ_NOT_EXIST_CLASS_FILE, 'Class: ' . $class_name);
			}
		}
		
		return $class_path;
	}
	
	/**
	 * @param string $main_type
	 * @param string $sub_type
	 * @param array  $info
	 * @param array  $construct_params
	 * 
	 * @return object / FALSE
	 *         
	 * @author Shin Uesugi
	 */
	private function _get($main_type, $sub_type, $info, $construct_params)
	{
		if (isset($info['extend_path'])) {
			require_once $info['extend_path'];
		}
		if (!($class_path = self::_getClassPath($main_type, $sub_type, $info['search_class_paths'], $info['class_name']))) {
			return FALSE;
		}
		require_once $class_path;
		$obj = new $info['class_name']();
		$obj->_setCZ($this->_cz);
		if (method_exists($obj, '_setMainClassName')) {
			$obj->_setMainClassName($info['class_name']);
		}
		if (method_exists($obj, '_construct')) {
			call_user_func_array(array($obj, '_construct'), $construct_params);
		}

		return $obj;
	}
	
	
	/*
	 * #Load
	 */
	
	/**
	 * @param string $main_type
	 * @param string $name
	 * @param string $sub_type
	 * @param array  $construct_params
	 * 
	 * @return object / FALSE
	 *         
	 * @author Shin Uesugi
	 */
	public function load($main_type, $name, $sub_type = '', $construct_params = array())
	{
		$info = self::_getInfo($main_type, $sub_type, $name);

		if ($main_type == 'static') {
			if (isset($this->_loaded_static_objs[$info['class_name']])) {
				return $this->_loaded_static_objs[$info['class_name']];
			}
		} else {
			if (isset($this->_loaded_dynamic_objs[$info['class_name']])) {
				return $this->_loaded_dynamic_objs[$info['class_name']];
			}
		}
		
		if (!($obj = self::_get($main_type, $sub_type, $info, $construct_params))) {
			return FALSE;
		}
		if ($main_type == 'static') {
			$this->_loaded_static_objs[$info['class_name']] = $obj;
		} else {
			$this->_loaded_dynamic_objs[$info['class_name']] = $obj;
		}
		
		return $obj;
	}

	/**
	 * @param string  $main_type
	 * @param string  $name
	 * @param string  $sub_type
	 * 
	 * @author Shin Uesugi
	 */
	public function unload($main_type, $name, $sub_type = '')
	{
		$info = self::_getInfo($main_type, $sub_type, $name);
		if (!isset($this->_loaded_dynamic_objs[$info['class_name']])) {
			self::_new('core', 'fatal', 'err')->exec(__FILE__, __LINE__, CZ_FATAL_OBJ_NOT_LOADED_DYNAMIC_OBJ, 'Class: ' . $info['class_name']);
		}
		unset($this->_loaded_dynamic_objs[$info['class_name']]);
	}
	
	/**
	 * @author Shin Uesugi
	 */
	public function unloadAll()
	{
		$this->_loaded_dynamic_objs = array();
	}
	

	/*
	 * #New
	 */
	
	/**
	 * @param string $main_type
	 * @param string $name
	 * @param string $sub_type
	 * @param array  $construct_params
	 * 
	 * @return object / FALSE
	 *         
	 * @author Shin Uesugi
	 */
	public function _new($main_type, $name, $sub_type = '', $construct_params = array())
	{
		if ($this->_load_only || ($main_type == 'static')) {
			return self::load($main_type, $name, $sub_type);
		}
		
		return self::_get($main_type, $sub_type, self::_getInfo($main_type, $sub_type, $name), $construct_params);
	}
	

	/*
	 * #Initilization
	 */
	
	/**
	 * @param object $cz
	 * 
	 * @author Shin Uesugi
	 */
	function __construct($cz)
	{
		$this->_cz = $cz;
		
		// Global config
		$this->_load_only = self::_new('user', 'CZ', 'config')->getValue('obj_load_only', FALSE);
	}
}
?>