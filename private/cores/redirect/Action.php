<?php
final class CZCredirectAction extends CZBase
{
	/**
	 * @param array $action(
	 *   string Action name
	 *   string Action group name / FALSE <option>
	 *   string Controller name           <option>
	 * )
	 * @param boolean $secure_flag <option>
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
	public function _exec($action, $secure_flag = FALSE, $params = NULL)
	{
		$url = $this->_cz->newCore('url', 'get_action')->_exec($action, $secure_flag, $params);
		$this->_cz->newCore('redirect', 'url')->exec($url);
	}
	
	/**
	 * @param array $action(
	 *   string Action name
	 *   string Controller name <option>
	 * )
	 * @param boolean $secure_flag <option>
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
	public function exec($action, $secure_flag = FALSE, $params = NULL)
	{
		if (isset($action[1])) {
			$action[2] = $action[1];
		}
		$action[1] = FALSE;
		self::_exec($action, $secure_flag, $params);
	}
}
?>