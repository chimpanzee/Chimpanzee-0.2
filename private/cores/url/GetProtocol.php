<?php
final class CZCurlGetProtocol extends CZBase
{
	/**
	 * @param $secure_flag <option>
	 * 
	 * @return string
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($secure_flag = NULL)
	{
		if ($secure_flag === NULL) {
			$secure_flag = $this->_cz->newCore('url', 'is_secure')->exec();
		} else if ($secure_flag && $this->_cz->newUser('config', 'url')->getValue('secure_ignore_flag', FALSE)) {
			$secure_flag = FALSE;
		}

		return $secure_flag ? 'https' : 'http';
	}
}
?>