<?php
final class CZCurlGetImages extends CZBase
{
	/**
	 * @return string URL
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		if (!($url = $this->_cz->newUser('config', 'url')->getValue('images', FALSE))) {
			$url  = $this->_cz->newCore('url', 'get_root')->exec();
			$url .= '/' . $this->_cz->newUser('config', 'url')->getValue('images_relative_path', 'images');
		}

		return $url;
	}
}
?>