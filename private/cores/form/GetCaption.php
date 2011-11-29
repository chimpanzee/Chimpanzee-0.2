<?php
final class CZCformGetCaption extends CZBase
{
	/**
	 * @param object $form
	 * @param string $part_name
	 * @param array  $part
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($form, $part_name, $part = array())
	{
		if (!$part) {
			$part = $this->_cz->newCore('form', 'get_part')->exec($form, $part_name);
		}
		
		return isset($part['caption']) ? $part['caption'] : $part_name;
	}
}
?>