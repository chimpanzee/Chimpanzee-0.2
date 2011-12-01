<?php
final class CZSSes extends CZBase
{
	/**
	 * @author Shin Uesugi
	 */
	public function _construct()
	{
		if (!$this->_cz->newCore('ses', 'is_valid')->exec()) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_SES_NOT_SECURE);
		}

		$secure_flag      = $this->_cz->newUser('config', 'ses')->getValue('secure_flag', TRUE);
		$cookie_only_flag = $this->_cz->newUser('config', 'ses')->getValue('cookie_only_flag', TRUE);
		$lifetime         = $this->_cz->newUser('config', 'ses')->getValue('lifetime', 0);
		$path             = $this->_cz->newUser('config', 'ses')->getValue('path', '/');
		if (($domain = $this->_cz->newUser('config', 'ses')->getValue('domain', FALSE)) === FALSE) {
			$domain = NULL;
		}

		ini_set('session.use_only_cookies', $cookie_only_flag);
		ini_set('session.gc_maxlifetime',   $lifetime);
		
		session_set_cookie_params($lifetime, $path, $domain, $secure_flag, TRUE);

		session_start();
		session_regenerate_id(TRUE);
	}
}
?>