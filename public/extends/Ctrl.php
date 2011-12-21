<?php
require_once 'Func.php';
class CZCtrl extends CZFunc
{
	/*
	 * #Forward
	 */

	/**
	 * @param array $action(
	 *   string Action name
	 *   string Action group name <option>
	 *   string Controller name   <option>
	 * )
	 * @param array $params(
	 *   'routing' => array(
	 *     string Parameter value
	 *     ...
	 *   ) <option>
	 *   'get' => array(
	 *     string Parameter name => string Parameter value
	 *     ...
	 *   ) <option>
	 * ) <option>
	 * 
	 * @return exit
	 * 
	 * @author Shin Uesugi
	 */
	protected function _forward($action, $params = NULL)
	{
		$this->_cz->loadStatic('forward')->_exec($action, $params);
	}

	/**
	 * @param array $action(
	 *   string Action name
	 *   string Controller name <option>
	 * )
	 * @param array $params(
	 *   'routing' => array(
	 *     string Parameter value
	 *     ...
	 *   ) <option>
	 *   'get' => array(
	 *     string Parameter name => string Parameter value
	 *     ...
	 *   ) <option>
	 * ) <option>
	 * 
	 * @return exit
	 * 
	 * @author Shin Uesugi
	 */
	protected function forward($action, $params = NULL)
	{
		$this->_cz->loadStatic('forward')->exec($action, $params);
	}

	/**
	 * @author Shin Uesugi
	 */
	protected function forward403()
	{
		$this->_cz->newCore('forward', '403')->exec();
	}

	/**
	 * @author Shin Uesugi
	 */
	protected function forward404()
	{
		$this->_cz->newCore('forward', '404')->exec();
	}


	/*
	 * #Redirect
	 */

	/**
	 * @param array $action(
	 *   string Action name
	 *   string Action group name <option>
	 *   string Controller name   <option>
	 * )
	 * @param boolean $secure_flag <option>
	 * @param array   $params(
	 *   'routing' => array(
	 *     string Parameter value
	 *     ...
	 *   ) <option>
	 *   'get' => array(
	 *     string Parameter name => string Parameter value
	 *     ...
	 *   ) <option>
	 * ) <option>
	 * 
	 * @return exit
	 * 
	 * @author Shin Uesugi
	 */
	protected function _redirect($action, $secure_flag = NULL, $params = NULL)
	{
		$this->_cz->newCore('redirect', 'action')->_exec($action, $secure_flag, $params);
	}
	
	/**
	 * @param array $action(
	 *   string Action name
	 *   string Controller name <option>
	 * )
	 * @param boolean $secure_flag <option>
	 * @param array   $params(
	 *   'routing' => array(
	 *     string Parameter value
	 *     ...
	 *   ) <option>
	 *   'get' => array(
	 *     string Parameter name => string Parameter value
	 *     ...
	 *   ) <option>
	 * ) <option>
	 * 
	 * @return exit
	 * 
	 * @author Shin Uesugi
	 */
	protected function redirect($action, $secure_flag = NULL, $params = NULL)
	{
		$this->_cz->newCore('redirect', 'action')->exec($action, $secure_flag, $params);
	}

	/**
	 * @param boolean $secure_flag <option>
	 * @param array   $params(
	 *   'routing' => array(
	 *     string Parameter value
	 *     ...
	 *   ) <option>
	 *   'get' => array(
	 *     string Parameter name => string Parameter value
	 *     ...
	 *   ) <option>
	 * ) <option>
	 * 
	 * @return exit
	 * 
	 * @author Shin Uesugi
	 */
	protected function redirectRoot($secure_flag = NULL, $params = NULL)
	{
		$this->_cz->newCore('redirect', 'root')->exec($secure_flag, $params);
	}

	/**
	 * @return exit
	 * 
	 * @author Shin Uesugi
	 */
	protected function redirectReturn()
	{
		$this->_cz->newCore('redirect', 'return')->exec();
	}

	/**
	 * @param string $url
	 * 
	 * @return exit
	 * 
	 * @author Shin Uesugi
	 */
	protected function redirect301($url)
	{
		$this->_cz->newCore('redirect', '301')->exec($url);
	}

	/**
	 * @param string $url
	 * 
	 * @return exit
	 * 
	 * @author Shin Uesugi
	 */
	protected function redirect302($url)
	{
		$this->_cz->newCore('redirect', '302')->exec($url);
	}


	/*
	 * #Process
	 */

	/**
	 * @param string $process_name <option>
	 * 
	 * @author Shin Uesugi
	 */
	protected function beginProcess($process_name = NULL)
	{
		$this->_cz->newCore('process', 'begin')->exec($process_name);
	}

	/**
	 * @param string / array $process_name <option>
	 * 
	 * @author Shin Uesugi
	 */
	protected function checkProcess($process_name = NULL)
	{
		$this->_cz->newCore('process', 'check')->exec($process_name);
	}

	/**
	 * @author Shin Uesugi
	 */
	protected function endProcess()
	{
		$this->_cz->newCore('process', 'end')->exec();
	}


	/*
	 * #Get previous
	 */

	/**
	 * @return string / NULL
	 * 
	 * @author Shin Uesugi
	 */
	protected function getPrevCtrlName()
	{
		return $this->_cz->loadStatic('forward')->getPrevCtrlName();
	}

	/**
	 * @return string / NULL
	 * 
	 * @author Shin Uesugi
	 */
	protected function getPrevActionGroupName()
	{
		return $this->_cz->loadStatic('forward')->getPrevActionGroupName();
	}

	/**
	 * @return string / NULL
	 * 
	 * @author Shin Uesugi
	 */
	protected function getPrevActionName()
	{
		return $this->_cz->loadStatic('forward')->getPrevActionName();
	}


	/*
	 * #Check previous action
	 */

	/**
	 * @param array $actions
	 * 
	 * @author Shin Uesugi
	 */
	protected function _checkPrevActions($actions)
	{
		$this->_cz->newCore('forward', 'check_prev_actions')->_exec($actions);
	}

	/**
	 * @param array $actions
	 * 
	 * @author Shin Uesugi
	 */
	protected function checkPrevActions($actions)
	{
		$this->_cz->newCore('forward', 'check_prev_actions')->exec($actions);
	}


	/*
	 * #View
	 */

	/**
	 * @param string  $var_name
	 * @param mixed   $value
	 * @param boolean $escape_flag
	 * @param array   $ignore_escape_keys
	 * 
	 * @author Shin Uesugi
	 */
	protected function addViewVar($var_name, $value, $escape_flag = TRUE, $ignore_escape_keys = array())
	{
		$this->_cz->newCore('view', 'add_var')->exec($var_name, $value, $escape_flag, $ignore_escape_keys);
	}

	/**
	 * @param string $file
	 * 
	 * @author Shin Uesugi
	 */
	protected function display($file = '')
	{
		$this->_cz->newCore('view', 'display')->exec($file);
	}
}
?>