<?php
final class CZCerrFree extends CZBase
{
	/**
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		$this->_cz->newCore('ses', 'free')->exec('err_msg');
	}
}
?>