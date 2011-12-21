<?php
final class CZCforward404 extends CZBase
{
	/**
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		$this->_cz->newCore('forward', 'free_prev_action')->exec();

		header('HTTP/1.0 404 Not Found');
		exit;
	}
}
?>