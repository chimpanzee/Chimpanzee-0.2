<?php
final class CZCerrSave extends CZBase
{
	/**
	 * @param string $msg
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($msg)
	{
		if (!$this->_cz->newCore('ses', 'is_valid')->exec()) {
			return FALSE;
		}

		$this->_cz->newCore('ses', 'set')->exec('err_msg', $msg);

		return TRUE;
	}
}
?>