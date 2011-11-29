<?php
final class CZCredirect301 extends CZBase
{
	/**
	 * @param string $url
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($url)
	{
		$this->_cz->newCore('redirect', 'url')->exec($url, 301);
	}
}
?>