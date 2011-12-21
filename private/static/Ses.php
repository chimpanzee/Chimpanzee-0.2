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
		$server_lifetime  = $this->_cz->newUser('config', 'ses')->getValue('server_lifetime', 86400);
		$cookie_only_flag = $this->_cz->newUser('config', 'ses')->getValue('cookie_only_flag', TRUE);
		$cookie_lifetime  = $this->_cz->newUser('config', 'ses')->getValue('cookie_lifetime', 0);
		$cookie_path      = $this->_cz->newUser('config', 'ses')->getValue('cookie_path', '/');
		$cookie_domain    = $this->_cz->newUser('config', 'ses')->getValue('cookie_domain', FALSE);

		if ($cookie_domain === FALSE) {
			$cookie_domain = NULL;
		}

		ini_set('session.gc_maxlifetime',   $server_lifetime);
		ini_set('session.use_only_cookies', $cookie_only_flag);

		session_set_cookie_params($cookie_lifetime, $cookie_path, $cookie_domain, $secure_flag, TRUE);

		session_start();
		session_regenerate_id(TRUE);
	}
}
?>