<?php
final class CZCurlIsInternal extends CZBase
{
	/**
	 * @param string $url
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($url)
	{
		return parse_url($url, PHP_URL_HOST) == $_SERVER['HTTP_HOST'];
	}
}
?>