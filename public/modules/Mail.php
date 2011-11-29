<?php
final class CZMMail extends CZBase
{
	/**
	 * @param array  $to_addrs
	 * @param string $subject
	 * @param string $msg
	 * @param string $from_addr
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function send($to_addrs, $subject, $msg, $from_addr)
	{
		return $this->_cz->newCore('mail', 'send')->exec($to_addrs, $subject, $msg, $from_addr);
	}

	/**
	 * @param array  $to_addrs
	 * @param string $subject
	 * @param string $template_file
	 * @param array  $vars
	 * @param string $from_addr
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function sendTemplate($to_addrs, $subject, $template_file, $vars, $from_addr)
	{
		return $this->_cz->newCore('mail', 'send_template')->exec($to_addrs, $subject, $template_file, $vars, $from_addr);
	}
}
?>