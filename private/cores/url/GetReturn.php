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
		if (!($internal_referer_url = $this->_cz->newCore('url', 'get_internal_referer'))) {
			return FALSE;
		}
		if (!$this->_cz->newCore('ses', 'is_valid')->exec()) {
			return $internal_referer_url;
		}

		$return_urls = $this->_cz->newCore('ses', 'get')->exec('return_urls', array());
		$cg_key      = $this->_cz->newCore('url', 'get_CG_key')->exec();
		if (!isset($return_urls[$cg_key])) {
			return $internal_referer_url;
		}

		return $return_urls[$cg_key];
	}
}
?>