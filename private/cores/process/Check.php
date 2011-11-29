<?php
final class CZCprocessCheck extends CZBase
{
	/**
	 * @param string / array $process_name <option>
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($process_name = NULL)
	{
		if (is_array($process_name)) {
			$process_names = $process_name;
		} else {
			if ($process_name === NULL) {
				$process_name = $this->_cz->newCore('process', 'get_default_name')->exec();
			}
			
			$process_names = array($process_name);
		}
		
		$current_process_name = $this->_cz->newCore('ses', 'get')->exec('process_name', FALSE);
		
		$hit_flag = FALSE;
		foreach ($process_names as $process_name) {
			if ($process_name === $current_process_name) {
				$hit_flag = TRUE;
				break;
			}
		}
		
		if (!$hit_flag) {
			$this->_cz->newCore('forward', '403')->exec();
		}
	}
}
?>