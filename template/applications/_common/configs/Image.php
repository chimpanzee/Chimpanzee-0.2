<?php
final class configImage extends CZConfig
{
	public function _construct()
	{
		$this->setValues(array(
			'save_dir' => '',
			
			'server_url' => '',
		));
	}
}
?>