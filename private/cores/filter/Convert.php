<?php
final class CZCfilterConvert extends CZBase
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
	public function exec($info, $subject, $ref_values = array())
	{
		return $this->_cz->newCore('filter', 'base')->exec($info, $subject, $ref_values, $this, $this->_cz->newCore('filter', 'convert_funcs'));
	}
}
?>