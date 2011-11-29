<?php
final class CZCerrSave extends CZBase
{
	/**
	 * @param string $msg
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($msg)
	{
		$this->_cz->newCore('ses', 'set')->exec('err_msg', $msg);
	}
}
?>