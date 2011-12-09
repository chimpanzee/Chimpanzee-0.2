<?php
final class CZMUrl extends CZBase
{
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