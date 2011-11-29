<?php
final class CZCmailSendTemplate extends CZBase
{
	/**
	 * @param string $to_addrs
	 * @param string $subject
	 * @param string $template_file
	 * @param array  $vars
	 * @param string $from_addr
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($to_addrs, $subject, $template_file, $vars, $from_addr)
	{
		$template_path = $this->_cz->project_dir . DIRECTORY_SEPARATOR . 'mail_templates' . DIRECTORY_SEPARATOR . $template_file;
		if (!($msg = file_get_contents($template_path))) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_MAIL_READ_TEMPLATE_FILE, $template_path);
		}
		
		foreach ($vars as $var_name => $value) {
			$msg = str_replace('{' . $var_name . '}', $value, $msg);
		}
		
		return $this->_cz->newCore('mail', 'send')->exec($to_addrs, $subject, $msg, $from_addr);
	}
}
?>