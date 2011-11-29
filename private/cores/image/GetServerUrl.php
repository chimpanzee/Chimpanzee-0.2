<?php
final class CZCimageGetServerUrl extends CZBase
{
	/**
	 * @return string URL
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		if (!($url = $this->_cz->newUser('config', 'image')->getValue('server_url', FALSE))) {
			$url = $this->_cz->newCore('url', 'get_root')->exec() . '/image.php';
		}
		
		return $url;
	}
}
?>