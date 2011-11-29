<?php
final class CZCfilterConvertFuncs extends CZBase
{
	/*
	 * #Preg
	 */
	
	/**
	 * @param object $base
	 * 
	 * @param array $params(
	 * 			'subject'   => scalar
	 *          'pattern'   => string
	 *          'match_num' => integer
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_preg_match($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		$option_param_names = array(
			'pattern',
			'match_num',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names, $option_param_names)) {
			return '';
		}
		
		if (!preg_match($params['pattern'], $params['subject'], $matches)) {
			return '';
		}
		if (!isset($matches[$params['match_num']])) {
			return '';
		}
		
		return $matches[$params['match_num']];
	}

	/**
	 * @param object $base
	 * 
	 * @param array $params(
	 *          'subject'     => scalar
	 *          'pattern'     => string
	 *          'replacement' => scalar
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_preg_replace($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		$option_param_names = array(
			'pattern',
			'replacement',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names, $option_param_names)) {
			return '';
		}
		
		return preg_replace($params['pattern'], $params['replacement'], $params['subject']);
	}
	
	
	/*
	 * #Date and Time
	 */

	/**
	 * @param object $base
	 * 
	 * @param array $params(
	 *          'subject' => string Date and Time
	 *          'format'  => string
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_date($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		$option_param_names = array(
			'format',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names, $option_param_names)) {
			return '';
		}
		
		if (($timestamp = @strtotime($params['subject'])) === FALSE) {
			return '';
		}
		
		return date($params['format'], $timestamp);
	}
	
	/**
	 * @param object $base
	 * 
	 * @param array $params(
	 *          'year'  => integer
	 *          'month' => integer
	 *          'day'   => integer
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_date_join($base, $params)
	{
		$value_param_names = array(
			'year',
			'month',
			'day',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		return $params['year'] . '-' . $params['month'] . '-' . $params['day'];
	}
	
	/**
	 * @param object $base
	 * 
	 * @param array $params(
	 *          'hour' => integer
	 *          'min'  => integer
	 *          'sec'  => integer
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_time_join($base, $params)
	{
		$value_param_names = array(
			'hour',
			'min',
			'sec',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		return $params['hour'] . ':' . $params['min'] . ':' . $params['sec'];
	}
	
	
	/*
	 * #Mail address
	 */
	
	/**
	 * @param object $base
	 * 
	 * @param array $params(
	 *          'subject' => string Mail address
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_mail_addr_account($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		$parts = explode('@', $params['subject']);
		if (count($parts) != 2) {
			return '';
		}
		
		return $parts[0];
	}
	
	/**
	 * @param object $base
	 * 
	 * @param array $params(
	 *          'subject' => string Mail address
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_mail_addr_domain($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		$parts = explode('@', $params['subject']);
		if (count($parts) != 2) {
			return '';
		}
		
		return $parts[1];
	}
	
	/**
	 * @param object $base
	 * 
	 * @param array $params(
	 *          'account' => string
	 *          'domain'  => string
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_mail_addr_join($base, $params)
	{
		$value_param_names = array(
			'account',
			'domain',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		return $params['account'] . '@' . $params['domain'];
	}
	
	
	/*
	 * #Telephone number
	 */
	
	/**
	 * @param object $base
	 * 
	 * @param array $params(
	 *          'subject' => string Telephone number
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_tel_num_area($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		$parts = explode('-', $params['subject']);
		if (count($parts) != 3) {
			return '';
		}
		
		return $parts[0];
	}
	
	/**
	 * @param object $base
	 * 
	 * @param array $params(
	 *          'subject' => string Telephone number
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_tel_num_city($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		$parts = explode('-', $params['subject']);
		if (count($parts) != 3) {
			return '';
		}
		
		return $parts[1];
	}
	
	/**
	 * @param object $base
	 * 
	 * @param array $params(
	 *          'subject' => string Telephone number
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_tel_num_rest($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		$parts = explode('-', $params['subject']);
		if (count($parts) != 3) {
			return '';
		}
		
		return $parts[2];
	}
	
	/**
	 * @param object $base
	 * 
	 * @param array $params(
	 *          'area'           => string
	 *          'city'           => string
	 *          'rest'           => string
	 *          'separator_flag' => boolean <Default: TRUE>
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_tel_num_join($base, $params)
	{
		$value_param_names = array(
			'area',
			'city',
			'rest',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		if (!isset($params['separator_flag']) || $params['separator_flag']) {
			$separator = '-';
		} else {
			$separator = '';
		}
		
		return $params['area'] . $separator . $params['city'] . $separator . $params['rest'];
	}
	
	
	/*
	 * #Zip code
	 */
	
	/**
	 * @param object $base
	 * 
	 * @param array $params(
	 *          'subject'        => string Zip code
	 *          'separator_flag' => boolean <Default: TRUE>
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_zip_code($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		if (strlen($params['subject']) == 7) {
			$head = substr($params['subject'], 0, 3);
			$tail = substr($params['subject'], 3, 4);
		} else {
			$head = substr($params['subject'], 0, 3);
			$tail = substr($params['subject'], 4, 4);
		}
		
		return !isset($params['separator_flag']) || $params['separator_flag'] ? $head . '-' . $tail : $head . $tail;
	}
	
	/**
	 * @param object $base
	 * 
	 * @param array $params(
	 *          'subject' => string Zip code
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_zip_code_head($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		$parts = explode('-', $params['subject']);
		if (count($parts) == 2) {
			$result = $parts[0];
		} else {
			$result = substr($params['subject'], 0, 3);
		}
		
		return $result;
	}
	
	/**
	 * @param object $base
	 * 
	 * @param array $params(
	 *          'subject' => string Zip code
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_zip_code_tail($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		$parts = explode('-', $params['subject']);
		if (count($parts) == 2) {
			$result = $parts[1];
		} else {
			$result = substr($params['subject'], 3, 4);
		}
		
		return $result;
	}
	
	/**
	 * @param object $base
	 * 
	 * @param array $params(
	 *          'head'           => string
	 *          'tail'           => string
	 *          'separator_flag' => boolean <Default: TRUE>
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_zip_code_join($base, $params)
	{
		$value_param_names = array(
			'head',
			'tail',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		if (!isset($params['separator_flag']) || $params['separator_flag']) {
			$separator = '-';
		} else {
			$separator = '';
		}
		
		return $params['head'] . $separator . $params['tail'];
	}
}
?>