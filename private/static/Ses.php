<?php
final class CZSSes extends CZBase
{
	/**
	 * @author Shin Uesugi
	 */
	public function _construct()
	{
		if ($this->_cz->newUser('config', 'ses')->getValue('secure_flag', TRUE)) {
			if (!$this->_cz->newCore('url', 'is_secure')->exec()) {
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_SES_NOT_SECURE);
			}
		}

		session_start();
	}
}
?>