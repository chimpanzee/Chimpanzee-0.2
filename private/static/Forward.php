<?php
final class CZSForward extends CZBase
{
	// Object
	private $_ctrl = NULL;
	
	private $_ctrl_name         = NULL;
	private $_action_group_name = NULL;
	private $_action_name       = NULL;
	
	private $_prev_ctrl_name         = NULL;
	private $_prev_action_group_name = NULL;
	private $_prev_action_name       = NULL;
	

	/**
	 * @param array $action(
	 *   string Action name
	 *   string Action group name / FALSE <option>
	 *   string Controller name           <option>
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
	public function _exec($action, $params = NULL)
	{
		list($this->_ctrl, $method_name, $routing_params) = $this->_cz->newCore('forward', '_forward')->exec($action, $params);
		if (call_user_func_array(array($this->_ctrl, $method_name), $routing_params) === NULL) {
			$this->_cz->newCore('view', 'display')->exec();
		}
		exit;
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
	public function exec($action, $params = NULL)
	{
		if (isset($action[1])) {
			$action[2] = $action[1];
		}
		$action[1] = FALSE;
		self::_exec($action, $params);
	}
	
	
	/*
	 * #Set property
	 */

	/**
	 * @param string $name
	 * 
	 * @author Shin Uesugi
	 */
	public function setCtrlName($name)
	{
		$this->_ctrl_name = $name;
	}
	
	/**
	 * @param string $name
	 * 
	 * @author Shin Uesugi
	 */
	public function setActionGroupName($name)
	{
		$this->_action_group_name = $name;
	}

	/**
	 * @param string $name
	 * 
	 * @author Shin Uesugi
	 */
	public function setActionName($name)
	{
		$this->_action_name = $name;
	}

	/**
	 * @param string $name
	 * 
	 * @author Shin Uesugi
	 */
	public function setPrevCtrlName($name)
	{
		$this->_prev_ctrl_name = $name;
	}
	
	/**
	 * @param string $name
	 * 
	 * @author Shin Uesugi
	 */
	public function setPrevActionGroupName($name)
	{
		$this->_prev_action_group_name = $name;
	}

	/**
	 * @param string $name
	 * 
	 * @author Shin Uesugi
	 */
	public function setPrevActionName($name)
	{
		$this->_prev_action_name = $name;
	}
	
	
	/*
	 * #Get property
	 */
	
	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getCtrlName()
	{
		return $this->_ctrl_name;
	}
	
	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getActionGroupName()
	{
		return $this->_action_group_name;
	}
	
	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getActionName()
	{
		return $this->_action_name;
	}
	
	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getPrevCtrlName()
	{
		return $this->_prev_ctrl_name;
	}
	
	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getPrevActionGroupName()
	{
		return $this->_prev_action_group_name;
	}
	
	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getPrevActionName()
	{
		return $this->_prev_action_name;
	}
}
?>