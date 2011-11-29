<?php
final class CZMFilter extends CZBase
{
	/**
	 * @param array  $info
	 * @param string $subject
	 * @param array  $ref_values
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function convert($info, $subject, $ref_values = array())
	{
		return $this->_cz->newCore('filter', 'convert')->exec($info, $subject, $ref_values);
	}
	
	
	/**
	 * @param array  $info
	 * @param string $subject
	 * @param array  $ref_values
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function validate($info, $subject, $ref_values = array())
	{
		return $this->_cz->newCore('filter', 'validate')->exec($info, $subject, $ref_values);
	}
}
?>