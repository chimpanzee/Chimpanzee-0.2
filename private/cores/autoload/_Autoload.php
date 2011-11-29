<?php
final class CZCautoload_Autoload extends CZBase
{
	/**
	 * @param string $search_dir
	 * @param string $class_name
	 * 
	 * @author Shin Uesugi
	 */
	private function _exec($search_dir, $class_name)
	{
		$search_path = $search_dir . DIRECTORY_SEPARATOR . $class_name . '.php';
		if (file_exists($search_path)) {
			require_once $search_path;
			return TRUE;
		}
		
		if ($dh = @opendir($search_dir)) {
			while (($file = readdir($dh)) !== FALSE) {
				if (($file == '.') || ($file == '..')) {
					continue;
				}
				$path = $search_dir . DIRECTORY_SEPARATOR . $file;
				if (filetype($path) == 'dir') {
					if (self::_exec($path, $class_name)) {
						return TRUE;
					}
				}
			}
		}
		
		return FALSE;
	}	
	
	/**
	 * @param string $class_name
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($class_name)
	{
		$search_dirs = array(
			$this->_cz->extensions_dir,
			$this->_cz->common_dir      . DIRECTORY_SEPARATOR . 'libs',
			$this->_cz->application_dir . DIRECTORY_SEPARATOR . 'libs',
		);
		foreach ($search_dirs as $search_dir) {
			if (self::_exec($search_dir, $class_name)) {
				return TRUE;
			}
		}
		
		return FALSE;
	}
}
?>