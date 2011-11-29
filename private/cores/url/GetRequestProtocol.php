<?php
final class CZCurlGetRequestProtocol extends CZBase
{
	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		return isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] != 'off') ? 'https' : 'http';
	}
}
?>