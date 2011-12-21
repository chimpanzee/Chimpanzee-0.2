<?php
final class CZCformIsErr extends CZBase
{
	/**
	 * @param object $form
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($form)
	{
		$err_msgs = $form->load('err_msgs', array());

		return count($err_msgs) > 0;
	}
}
?>