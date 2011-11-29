<?php
final class CZCforwardGetCtrlName extends CZBase
{
	/**
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec()
	{
		return $this->_cz->loadStatic('forward')->getCtrlName();
	}
}
?>