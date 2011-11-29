<?php
final class CZCurlGetParam extends CZBase
{
	/**
	 * @param array $merge_params
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($merge_params = array())
	{
		$url = $this->_cz->newCore('url', 'get_self')->exec();
		
		$url_param = '';
		$params = array_merge($this->_cz->newCore('request', 'get_param')->getGetParams(), $merge_params);
		foreach ($params as $param_name => $param_value) {
			$url_param .= $url_param ? '&' : '?';
			$url_param .= $param_name . '=' . $param_value;
		}
		
		return $url . $url_param;
	}
}
?>