<?php
/**
 * Chimpanzee(PHP Framework)
 * 
 * PHP 5 >= 5.1.2
 * 
 * @version   0.20a
 * @copyright 2011 Chimpanzee project
 * @license   GPL
 * @link      http://chimpanzee-php.com/
 * 
 * 2011.01.18 Development started by Shin Uesugi.
 */


require_once 'private/Base.php';
require_once 'public/Exception.php';


final class Chimpanzee
{
	// Object
	private $_cz;
	public  $obj;
	

	/**
	 * @param string $project_dir
	 * @param string $application_name
	 * 
	 * @author Shin Uesugi
	 */
	function __construct($project_dir, $application_name)
	{
		require_once 'private/CZ.php';
		$this->_cz = new CZ(dirname(__FILE__), $project_dir, $application_name);
		
		require_once 'public/Obj.php';
		$this->obj = new CZObj($this->_cz);
	}
	
	
	/**
	 * @param string $application_name
	 * 
	 * @author Shin Uesugi
	 */
	public function setApplicationName($application_name)
	{
		$this->_cz->setApplicationName($application_name);
	}


	/**
	 * @param string $default_ctrl_name
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($default_ctrl_name = 'top')
	{
		$this->_cz->newUser('ctrl', '_main');

		$routing_parts = $this->_cz->newCore('routing', 'get_parts')->exec();
		if ($this->_cz->isValidStr($routing_parts['ctrl_name'])) {
			$ctrl_name = $routing_parts['ctrl_name'];
		} else {
			$ctrl_name = $default_ctrl_name;
		}
		if ($this->_cz->isValidStr($routing_parts['action_group_name'])) {
			$this->_cz->loadStatic('forward')->_exec(array($routing_parts['action_name'], $routing_parts['action_group_name'], $ctrl_name));
		} else {
			$this->_cz->loadStatic('forward')->exec(array($routing_parts['action_name'], $ctrl_name));
		}
	}
}
?>