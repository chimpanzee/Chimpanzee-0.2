<?php
final class CZCsesFreeAll extends CZBase
{
	/**
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		$this->_cz->loadStatic('ses');

		$ses_name = $this->_cz->newCore('ses', 'get_name')->exec();
		unset($_SESSION[$ses_name]);
	}
}
?>