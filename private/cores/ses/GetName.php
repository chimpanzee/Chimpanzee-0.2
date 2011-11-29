<?php
final class CZCsesGetName extends CZBase
{
	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		return basename($this->_cz->project_dir) . ':' . $this->_cz->application_name;
	}
}
?>