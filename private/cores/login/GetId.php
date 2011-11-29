<?php
final class CZCloginGetId extends CZBase
{
	/**
	 * @return integer / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		return $this->_cz->newCore('ses', 'get')->exec('login_id', FALSE);
	}
}
?>