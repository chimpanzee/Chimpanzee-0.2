<?php
final class CZCroutingGetParams extends CZBase
{
	/**
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		$parts = $this->_cz->newCore('routing', 'get_parts')->exec();
		
		return $parts['params'];
	}
}
?>