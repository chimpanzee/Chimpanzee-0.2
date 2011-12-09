<?php
final class configUrl extends CZConfig
{
	public function _construct()
	{
		$this->setValues(array(
			'secure_ignore_flag' => FALSE,

			'images' => '',
			'css'    => '',
			'js'     => '',
			'api'    => '',
		
			'images_relative_path' => 'images',
			'css_relative_path'    => 'css',
			'js_relative_path'     => 'js',
			'api_relative_path'    => 'api',
		));
	}
}
?>