<?php
final class CZCforward403 extends CZBase
{
	/**
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		header('HTTP/1.0 403 Forbidden');
		exit;
	}
}
?>