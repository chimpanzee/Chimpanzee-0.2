<?php
final class CZCloginLogout extends CZBase
{
	/**
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		$this->_cz->newCore('ses', 'free')->exec('login_id');
		$this->_cz->newCore('ses', 'free')->exec('login_values');
		$this->_cz->newCore('ses', 'free')->exec('login_formatted_values');
	}
}
?>