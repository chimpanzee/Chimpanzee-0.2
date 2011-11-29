<?php
final class configDb extends CZConfig
{
	public function _construct()
	{
		$this->setValues(array(
			'servers' => array(
				'main' => array(
					'dsn'  => 'mysql:dbname=main_dbname;host=localhost',
					'user' => 'main_user',
					'pass' => 'main_pass',
				),
			),
			
			'persistent_flag' => TRUE,
			
			'table_name_prefix' => '',
		));
	}
}
?>