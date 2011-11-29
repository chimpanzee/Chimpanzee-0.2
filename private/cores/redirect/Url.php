<?php
final class CZCredirectUrl extends CZBase
{
	/**
	 * @param string  $url
	 * @param integer $code
	 * 
	 * @author Shin Uesugi
	 */
	private function _external($url, $code)
	{
		$str = 'Location: ' . $url;
		if ($code !== NULL) {
			header($str, TRUE, $code);
		} else {
			header($str);
		}
		exit;
	}
	
	/**
	 * @param string  $url
	 * @param integer $code
	 * 
	 * @author Shin Uesugi
	 */
	private function _internal($url, $code)
	{
		if (ini_get('session.use_trans_sid')) {
			$url .= (preg_match('/\?/', $url) ? '&' : '?') . session_name() . '=' . session_id();
		}
		self::_external($url, $code);
	}
	
	/**
	 * @param string  $url
	 * @param integer $code
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($url, $code = NULL)
	{
		if ($this->_cz->newCore('url', 'is_internal')->exec($url)) {
			self::_internal($url, $code);
		} else {
			self::_external($url, $code);
		}
	}
}
?>