<?php
final class CZCredirectRoot extends CZBase
{
	/**
	 * @param boolean secure_flag <option>
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
	public function exec($secure_flag = FALSE, $params = NULL)
	{
		$url = $this->_cz->newCore('url', 'get_root')->exec($secure_flag, $params);
		$this->_cz->newCore('redirect', 'url')->exec($url);
	}
}
?>