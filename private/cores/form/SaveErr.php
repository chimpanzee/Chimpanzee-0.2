<?php
final class CZCformSaveErr extends CZBase
{
	/**
	 * @param object $form
	 * @param string $part_name
	 * @param string $msg
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($form, $part_name, $msg)
	{
		$msgs = $form->load('err_msgs', array());
		$msgs[$part_name] = $msg;
		$form->save('err_msgs', $msgs);
	}
}
?>