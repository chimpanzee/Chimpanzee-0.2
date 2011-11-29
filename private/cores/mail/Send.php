<?php
final class CZCmailSend extends CZBase
{
	/**
	 * @param array $to_addrs(
	 *          string Address
	 *          ...
	 *        )
	 * @param string $subject
	 * @param string $msg
	 * @param string $from_addr / array(string Name, string Address)
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($to_addrs, $subject, $msg, $from_addr)
	{
		$to_addr = implode(',', $to_addrs);
		
		if (is_array($from_addr)) {
			$from_addr = $from_addr[0] . '<' . $from_addr[1] . '>';
		}
		
		$add_headers = 'From: ' . $from_addr;

		return @mb_send_mail($to_addr, $subject, $msg, $add_headers);
	}
}
?>