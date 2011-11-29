<?php
final class CZMImage extends CZBase
{
	/**
	 * @param string $uploaded_path
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function saveFile($uploaded_path)
	{
		return $this->_cz->newCore('image', 'save_file')->exec($uploaded_path);
	}

	/**
	 * @param string $file
	 * 
	 * @author Shin Uesugi
	 */
	public function deleteFile($file)
	{
		$this->_cz->newCore('image', 'delete_file')->exec($file);
	}
}
?>