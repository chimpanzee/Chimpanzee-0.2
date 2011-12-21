<?php
final class CZCurlSetReturn extends CZBase
{
	/**
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	private function _isIgnore()
	{
		$ignore_flags = $this->_cz->newCore('ses', 'get')->exec('set_return_ignore_flags', array());
		$cg_key       = $this->_cz->newCore('url', 'get_CG_key')->exec();
		$prev_cg_key  = $this->_cz->newCore('url', 'get_prev_CG_key')->exec();

		if (isset($ignore_flags[$cg_key][$prev_cg_key])) {
			unset($ignore_flags[$cg_key][$prev_cg_key]);
			$return = TRUE;
		} else {
			$ignore_flags[$prev_cg_key][$cg_key] = TRUE;
			$return = FALSE;
		}

		$this->_cz->newCore('ses', 'set')->exec('set_return_ignore_flags', $ignore_flags);

		return $return;
	}

	/**
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		if (!($internal_referer_url = $this->_cz->newCore('url', 'get_internal_referer')->exec())) {
			return FALSE;
		}
		if (self::_isIgnore()) {
			return FALSE;
		}

		$cg_key = $this->_cz->newCore('url', 'get_CG_key')->exec();

		$return_urls = $this->_cz->newCore('ses', 'get')->exec('return_urls', array());
		$return_urls[$cg_key] = $internal_referer_url;
		$this->_cz->newCore('ses', 'set')->exec('return_urls', $return_urls);

		return TRUE;
	}
}
?>