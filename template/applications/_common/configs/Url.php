<?php
final class configUrl extends CZConfig
{
	public function _construct()
	{
		$this->setValues(array(
			'server_name' => '',
			'path'        => '',

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