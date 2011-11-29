<?php
final class CZCimageGetSaveDir extends CZBase
{
	/**
	 * @param string $file
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		if (!($dir = $this->_cz->newUser('config', 'image')->getValue('save_dir', FALSE))) {
			$dir = $this->_cz->project_dir . DIRECTORY_SEPARATOR . 'images';
		}
		
		return $dir;
	}
}
?>