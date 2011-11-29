<?php
final class CZCprocessEnd extends CZBase
{
	/**
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		$this->_cz->newCore('ses', 'free')->exec('process_name');
	}
}
?>