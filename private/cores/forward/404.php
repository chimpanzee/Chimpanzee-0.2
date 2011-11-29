<?php
final class CZCforward404 extends CZBase
{
	/**
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		header('HTTP/1.0 404 Not Found');
		exit;
	}
}
?>