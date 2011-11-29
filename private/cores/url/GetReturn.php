<?php
final class CZCurlGetReturn extends CZBase
{
	/**
	 * @return string / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		$return_urls = $this->_cz->newCore('ses', 'get')->exec('return_urls', array());
		$cg_key      = $this->_cz->newCore('url', 'get_CG_key')->exec();
		if (!isset($return_urls[$cg_key])) {
			return FALSE;
		}
		
		return $return_urls[$cg_key];
	}
}
?>