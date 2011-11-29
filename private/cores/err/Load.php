<?php
final class CZCerrLoad extends CZBase
{
	/**
	 * @param string $default_msg
	 * 
	 * @return string / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($default_msg = '')
	{
		if (!$this->_cz->isValidStr($msg = $this->_cz->newCore('ses', 'get')->exec('err_msg', ''))) {
			if ($default_msg === FALSE) {
				return FALSE;
			}
			if ($this->_cz->isValidStr($default_msg)) {
				$msg = $default_msg;
			} else {
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_ERR_NOT_SAVED_MSG);
			}
		}
		
		$head_str = $this->_cz->newUser('config', 'err')->getValue('msg_head_str', '');
		$tail_str = $this->_cz->newUser('config', 'err')->getValue('msg_tail_str', '');
		
		return $head_str . $msg . $tail_str;
	}
}
?>