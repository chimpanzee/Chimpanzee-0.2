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
		return $this->_cz->newCore('url', 'is_secure')->exec() ? 'https' : 'http';
	}
}
?>