<?php
final class CZCurlGetRequest extends CZBase
{
	/**
	 * @return string URL
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		$url  = $this->_cz->newCore('url', 'get_request_protocol')->exec();
		$url .= '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		
		return $url;
	}
}
?>