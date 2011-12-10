<?php
final class CZCerrLoad extends CZBase
{
	/**
	 * @param string $default_msg <option>
	 * 
	 * @return string / FALSE
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($default_msg = NULL)
	{
		if (!$this->_cz->newCore('ses', 'is_valid')->exec()) {
			return FALSE;
		}

		if (($msg = $this->_cz->newCore('ses', 'get')->exec('err_msg', FALSE)) === FALSE) {
			if ($default_msg === NULL) {
				$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_ERR_NOT_SAVED_MSG);
			} else if ($default_msg === FALSE) {
				return FALSE;
			}
			$msg = $default_msg;
		}

		$head_str = $this->_cz->newUser('config', 'err')->getValue('msg_head_str', '');
		$tail_str = $this->_cz->newUser('config', 'err')->getValue('msg_tail_str', '');

		return $head_str . $msg . $tail_str;
	}
}
?>