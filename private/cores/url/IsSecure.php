<?php
final class CZCurlIsSecure extends CZBase
{
	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		return isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] != 'off');
	}
}
?>