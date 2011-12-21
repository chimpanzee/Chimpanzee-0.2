<?php
final class CZCurlGetInternalReferer extends CZBase
{
	/**
	 * @return string / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		if (!isset($_SERVER['HTTP_REFERER'])) {
			return FALSE;
		}
		if (!$this->_cz->newCore('url', 'is_internal')->exec($_SERVER['HTTP_REFERER'])) {
			return FALSE;
		}

		return $_SERVER['HTTP_REFERER'];
	}
}
?>