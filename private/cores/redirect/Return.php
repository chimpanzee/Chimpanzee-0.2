<?php
final class CZCredirectReturn extends CZBase
{
	/**
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		if (!($url = $this->_cz->newCore('url', 'get_return')->exec())) {
			return FALSE;
		}
		$this->_cz->newCore('redirect', 'url')->exec($url);
	}
}
?>