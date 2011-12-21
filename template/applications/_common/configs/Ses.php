<?php
final class configSes extends CZConfig
{
	public function _construct()
	{
		$this->setValues(array(
			'secure_flag' => FALSE,

			'server_lifetime' => 86400,

			'cookie_only_flag' => TRUE,
			'cookie_lifetime'  => 0,
			'cookie_path'      => '/',
			'cookie_domain'    => NULL,
		));
	}
}
?>