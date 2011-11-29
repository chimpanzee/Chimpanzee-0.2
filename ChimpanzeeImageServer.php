<?php
require_once 'private/Base.php';
require_once 'public/Exception.php';


final class ChimpanzeeImageServer
{
	// Object
	private $_cz;
	
	
	/**
	 * @author Shin Uesugi
	 */
	private function _display()
	{
		$dir_type = $this->_cz->newCore('request', 'get_param')->getGetParam('dt', 'save');
		
		$file = $this->_cz->newCore('request', 'get_param')->getGetParam('fl');

		$mw = $this->_cz->newCore('request', 'get_param')->getGetParam('mw', FALSE);
		$width  = $mw ? $mw : NULL;
		
		$mh = $this->_cz->newCore('request', 'get_param')->getGetParam('mh', FALSE);
		$height = $mh ? $mh : NULL;
		
		$this->_cz->newCore('image', 'display')->exec($dir_type, $file, $width, $height);
	}
	
	
	/**
	 * @param string $project_dir
	 */
	function __construct($project_dir)
	{
		require_once 'private/CZ.php';
		$this->_cz = new CZ(dirname(__FILE__), $project_dir);
		
		self::_display();
	}
}
?>