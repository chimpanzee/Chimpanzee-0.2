<?php
final class CZCloginGetValues extends CZBase
{
	/**
	 * @param boolean $format_flag
	 * 
	 * @return array / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($format_flag = TRUE)
	{
		if ($format_flag) {
			$values = $this->_cz->newCore('ses', 'get')->exec('login_formatted_values', FALSE);			
		} else {
			$values = $this->_cz->newCore('ses', 'get')->exec('login_values', FALSE);
		}
		
		return $values;
	}
}
?>