<?php
final class CZCforward_Forward extends CZBase
{
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
	 * @return array(
	 *   object Controller object
	 *   string Action method name
	 *   array(
	 *     string Routing parameter value <option>
	 *     ...
	 *   )
	 * )
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($action, $params = NULL)
	{
		$this->_cz->unloadAll();
		
		
		if (isset($action[2])) {
			$current_ctrl_name = $action[2];
			$this->_cz->loadStatic('forward')->setCtrlName($current_ctrl_name);
		} else {
			$current_ctrl_name = $this->_cz->loadStatic('forward')->getCtrlName();
		}
		
		if (isset($action[1])) {
			$current_action_group_name = $action[1] !== FALSE ? $action[1] : NULL;
			$this->_cz->loadStatic('forward')->setActionGroupName($current_action_group_name);
		} else {
			$current_action_group_name = $this->_cz->loadStatic('forward')->getActionGroupName();
		}
		
		if (isset($action[0])) {
			$current_action_name = $action[0];
			$this->_cz->loadStatic('forward')->setActionName($current_action_name);
		} else {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_COMMON_NOT_EXIST_ACTION_NAME);
		}
		
		
		$routing_params = isset($params['routing']) ? $params['routing'] : $this->_cz->newCore('routing', 'get_params')->exec();
		
		if (isset($params['get'])) {
			$names = array_keys($_GET);
			foreach ($names as $name) {
				unset($_REQUEST[$name]);
			}
			
			$_GET = array();
			foreach ($params['get'] as $name => $value) {
				$_GET[$name] = $_REQUEST[$name] = $value;
			}
		}
		
		
		if (!($ctrl = $this->_cz->newUser('ctrl', $current_ctrl_name))) {
			$this->_cz->newCore('forward', '404')->exec();
		}
		
		$action_method_name  = ($current_action_group_name !== NULL) ? $current_action_group_name : 'action';
		$action_method_name .= $this->_cz->getUpperStr($current_action_name);
		
		if (!method_exists($ctrl, $action_method_name)) {
			$this->_cz->newCore('forward', '404')->exec();
		}


		if (method_exists($ctrl, '_common')) {
			$ctrl->_common();
		}
		if ($current_action_group_name !== NULL) {
			$method_name = $current_action_group_name . '_common';
			if (method_exists($ctrl, $method_name)) {
				$ctrl->$method_name();
			}
		}
		
		
		if (($prev_ctrl_name = $this->_cz->newCore('ses', 'get')->exec('prev_ctrl_name', FALSE)) === FALSE) {
			$prev_ctrl_name = NULL;
		}
		if (($prev_action_group_name = $this->_cz->newCore('ses', 'get')->exec('prev_action_group_name', FALSE)) === FALSE) {
			$prev_action_group_name = NULL;
		}
		if (($prev_action_name = $this->_cz->newCore('ses', 'get')->exec('prev_action_name', FALSE)) === FALSE) {
			$prev_action_name = NULL;
		}
		
		$this->_cz->loadStatic('forward')->setPrevCtrlName($prev_ctrl_name);
		$this->_cz->loadStatic('forward')->setPrevActionGroupName($prev_action_group_name);
		$this->_cz->loadStatic('forward')->setPrevActionName($prev_action_name);
		
		
		if (($current_ctrl_name !== $prev_ctrl_name) || ($current_action_group_name !== $prev_action_group_name)) {
			if ($this->_cz->newUser('config', 'forward')->getValue('return_flag', FALSE)) {
				$this->_cz->newCore('url', 'set_return')->exec();
			}

			
			if ($current_ctrl_name !== $prev_ctrl_name) {
				$this->_cz->newCore('ses', 'set')->exec('prev_ctrl_name', $current_ctrl_name);
				if (method_exists($ctrl, '_init')) {
					call_user_func_array(array($ctrl, '_init'), $routing_params);
				}
			}

			if ($current_action_group_name !== $prev_action_group_name) {
				$this->_cz->newCore('ses', 'set')->exec('prev_action_group_name', $current_action_group_name);
			}
			if ($current_action_group_name !== NULL) {
				$method_name = $current_action_group_name . '_init';
				if (method_exists($ctrl, $method_name)) {
					call_user_func_array(array($ctrl, $method_name), $routing_params);
				}
			}
		}
		$this->_cz->newCore('ses', 'set')->exec('prev_action_name', $current_action_name);
		
		
		return array($ctrl, $action_method_name, $routing_params);
	}
}
?>