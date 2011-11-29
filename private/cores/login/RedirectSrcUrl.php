<?php
final class CZCloginRedirectSrcUrl extends CZBase
{
	/**
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		$src_url = $this->_cz->newCore('ses', 'get')->exec('auto_redirect_src_url');
		$this->_cz->newCore('ses', 'free')->exec('auto_redirect_src_url');
		
		$this->_cz->newCore('redirect', 'url')->exec($src_url);
	}
}
?>