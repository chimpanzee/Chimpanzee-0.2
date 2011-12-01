<?php
final class configSes extends CZConfig
{
	public function _construct()
	{
		$this->setValues(array(
			'secure_flag'      => TRUE,
			'cookie_only_flag' => TRUE,
			'lifetime'         => 0,
			'path'             => '/',
			'domain'           => NULL,
		));
	}
}
?>