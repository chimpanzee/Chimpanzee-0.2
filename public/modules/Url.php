<?php
final class CZMUrl extends CZBase
{
	/**
	 * @param array $action(
	 *   string Action name
	 *   string Action group name / NULL <option>
	 *   string Controller name          <option>
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
	public function _get($action, $secure_flag = NULL, $params = NULL)
	{
		return $this->_cz->newCore('url', 'get_action')->_exec($action, $secure_flag, $params);
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
	public function get($action, $secure_flag = NULL, $params = NULL)
	{
		return $this->_cz->newCore('url', 'get_action')->exec($action, $secure_flag, $params);
	}


	/**
	 * @param boolean $secure_flag <option>
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getProtocol($secure_flag = NULL)
	{
		return $this->_cz->newCore('url', 'get_protocol')->exec($secure_flag);
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
	 * @return string URL
	 * 
	 * @author Shin Uesugi
	 */
	public function getRoot($secure_flag = NULL, $params = NULL)
	{
		return $this->_cz->newCore('url', 'get_root')->exec($secure_flag, $params);
	}


	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getSelf()
	{
		return $this->_cz->newCore('url', 'get_self')->exec();
	}


	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function getImages()
	{
		return $this->_cz->newCore('url', 'get_images')->exec();
	}
}
?>