<?php
final class CZCurlGetAction extends CZBase
{
	/**
	 * @param array $action(
	 *   string Action name
	 *   string Action group name / FALSE <option>
	 *   string Controller name           <option>
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
	 * @return string URL
	 * 
	 * @author Shin Uesugi
	 */
	public function _exec($action, $secure_flag = FALSE, $params = NULL)
	{
		if (isset($action[2])) {
			$ctrl_name = $action[2];
		} else {
			$ctrl_name = $this->_cz->newCore('forward', 'get_ctrl_name')->exec();
		}
		if (isset($action[1])) {
			$action_group_name = $action[1] !== FALSE ? $action[1] : NULL;
		} else {
			$action_group_name = $this->_cz->newCore('forward', 'get_action_group_name')->exec();
		}
		if (isset($action[0])) {
			$action_name = $action[0];
		} else {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_COMMON_NOT_EXIST_ACTION_NAME);
		}
		
		$routing_params = array($ctrl_name);
		if ($action_group_name !== NULL) {
			$routing_params[] = $action_group_name;
		}
		if ($action_name != 'index') {
			$routing_params[] = $action_name;
		}
		
		$params['routing'] = isset($params['routing']) ? array_merge($routing_params, $params['routing']) : $routing_params;
		
		return $this->_cz->newCore('url', 'get_root')->exec($secure_flag, $params);
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
	 * @return string URL
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($action, $secure_flag = FALSE, $params = NULL)
	{
		if (isset($action[1])) {
			$action[2] = $action[1];
		}
		$action[1] = FALSE;
		
		return self::_exec($action, $secure_flag, $params);
	}
}
?>