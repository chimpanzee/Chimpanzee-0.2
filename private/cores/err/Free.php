<?php
final class CZCerrFree extends CZBase
{
	/**
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		if ($this->_cz->newCore('ses', 'is_valid')->exec()) {
			$this->_cz->newCore('ses', 'free')->exec('err_msg');
		}
	}
}
?>