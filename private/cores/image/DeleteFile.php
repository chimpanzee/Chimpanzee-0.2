<?php
final class CZCimageDeleteFile extends CZBase
{
	/**
	 * @param string $file
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($file)
	{
		$dir = $this->_cz->newCore('image', 'get_save_dir')->exec();
		$path = $dir . DIRECTORY_SEPARATOR . $file;
		if (!@unlink($path)) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_IMAGE_DELETE_FILE, $path);
		}
	}
}
?>