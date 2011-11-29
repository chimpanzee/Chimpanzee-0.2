<?php
final class CZCimageSaveFile extends CZBase
{
	/**
	 * @param string $uploaded_path
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($uploaded_path)
	{
		$save_dir = $this->_cz->newCore('image', 'get_save_dir')->exec();
		if (!($save_path = tempnam($save_dir, 'CZ'))) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_IMAGE_CREATE_TMP_FILE, 'Directory: ', $images_dir);
		}
		if (!rename($uploaded_path, $save_path)) {
			@unlink($save_path);
			$this->_cz->newCore('err', 'fatal')->exec(__FILE, __LINE__, CZ_FATAL_IMAGE_WRITE_FILE, $save_path);
		}
		
		return basename($save_path);
	}
}
?>