<?php
final class CZCimageDisplay extends CZBase
{
	/**
	 * @param string  $path
	 * @param integer $width
	 * @param integer $height
	 * 
	 * @return resource
	 * 
	 * @author Shin Uesugi
	 */
	private function _getResource($path, $width, $height)
	{
		if (!($info = @getimagesize($path))) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_IMAGE_GET_INFO, 'File: ' . $path);
		}
		list($src_width, $src_height, $image_type) = $info;
		
		switch ($image_type) {
			case IMAGETYPE_GIF:
				if (!($src_image = imagecreatefromgif($path))) {
					$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_IMAGE_READ_GIF_FILE, $path);
				}
				break;
			case IMAGETYPE_JPEG:
				if (!($src_image = imagecreatefromjpeg($path))) {
					$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_IMAGE_READ_JPEG_FILE, $path);
				}
				break;
			case IMAGETYPE_PNG:
				if (!($src_image = imagecreatefrompng($path))) {
					$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_IMAGE_READ_PNG_FILE, $path);
				}
				break;
			default:
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_IMAGE_NOT_SUPPORT_TYPE, 'File: ' . $path);
		}

		if ($width) {
			$dst_width  = $width;
			$dst_height = $src_height * $width / $src_width;
			if ($height && ($height < $dst_height)) {
				$dst_width  = $dst_width * $height / $dst_height;
				$dst_height = $height;
			}
		} else if ($height) {
			$dst_width  = $src_width * $height / $src_height;
			$dst_height = $height;
		} else {
			$dst_width  = $src_width;
			$dst_height = $src_height;
		}
		
		if (($src_width != $dst_width) || ($src_height != $dst_height)) {
			if (!($dst_image = imagecreatetruecolor($dst_width, $dst_height))) {
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_IMAGE_CREATE_RESOURCE);
			}
			if (!imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height)) {
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_IMAGE_RESAMPLE_DATA);
			}
			imagedestroy($src_image);
		} else {
			$dst_image = $src_image;
		}
		
		return $dst_image;
	}
	
	/**
	 * @param string  $dir_type
	 * @param string  $file
	 * @param integer $width
	 * @param integer $height
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($dir_type, $file, $width = NULL, $height = NULL)
	{
		header('Content-Type: image/png');
		switch ($dir_type) {
			case 'save':
				$dir = $this->_cz->newCore('image', 'get_save_dir')->exec();
				break;
			case 'tmp':
				$dir = $this->_cz->tmp_dir;
				break;
			default:
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_IMAGE_INVALID_DIR_TYPE, $dir_type);
				break;
		}
		$path = $dir . DIRECTORY_SEPARATOR . $file;
		if (!imagepng(self::_getResource($path, $width, $height))) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_IMAGE_DISPLAY_PNG, 'File: ' . $path);
		}
		exit;
	}
}
?>