<?php
final class CZCformGetPartNames extends CZBase
{
	/**
	 * @param object  $form
	 * 
	 * @return array
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($form)
	{
		$names = array();
		$parts = $form->getParts();
		foreach ($parts as $part_name => $part) {
			if (isset($part['parts'])) {
				$names = array_merge($names, array_keys($part['parts']));
			} else {
				$names[] = $part_name;
			}
		}
		
		return $names;
	}
}
?>