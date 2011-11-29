<?php
final class CZCfilterValidateFuncs extends CZBase
{
	/*
	 * #Preg
	 */

	/**
	 * @param object $base
	 * @param array  $params(
	 *          'subject' => string
	 *          'pattern' => string
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
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names, $option_param_names)) {
			return '';
		}
		
		if (!preg_match($params['pattern'], $params['subject'])) {
			return 'It is not corresponding to the pattern.';
		}
		
		return '';
	}
	
	
	/*
	 * #Number
	 */
	
	/**
	 * @param object $base
	 * @param array  $params(
	 *          'subject' => string
	 *          'min'     => integer <option>
	 *          'max'     => integer <option>
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_int($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		if (!is_numeric($params['subject']) || (strpos($params['subject'], '.') !== FALSE)) {
			return 'Please input it by the integer.';
		}

		if (isset($params['min']) && ($params['subject'] < $params['min'])) {
			return 'Please input it by ' . $params['min'] . ' or more.';
		}
		if (isset($params['max']) && ($params['subject'] > $params['max'])) {
			return 'Please input it by ' . $params['max'] . ' or less.';
		}
		
		return '';
	}
	
	/**
	 * @param object $base
	 * @param array  $params(
	 *          'subject' => string
	 *          'min'     => integer <option>
	 *          'max'     => integer <option>
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_float($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		if (!is_numeric($params['subject'])) {
			return 'Please input it by the numerical value.';
		}
		
		if (isset($params['min']) && ($params['subject'] < $params['min'])) {
			return 'Please input it by ' . $params['min'] . ' or more.';
		}
		if (isset($params['max']) && ($params['subject'] > $params['max'])) {
			return 'Please input it by ' . $params['max'] . ' or less.';
		}
		
		return '';
	}
	
	
	/*
	 * #Facebook
	 */

	/**
	 * @param object $base
	 * @param array  $params(
	 *          'subject' => string User name
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_facebook_user_name($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		if (!preg_match('/^[0-9a-zA-Z\.]+$/', $params['subject'])) {
			return 'Please input the user name of the facebook correctly.';
		}
		
		return '';
	}
	
	
	/*
	 * #Twitter
	 */

	/**
	 * @param object $base
	 * @param array  $params(
	 *          'subject' => string User name
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_twitter_user_name($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		if (!preg_match('/^[0-9a-zA-Z_]{1,15}$/', $params['subject'])) {
			return 'Please input the user name of the twitter correctly.';
		}
		
		return '';
	}
	
	
	/*
	 * #Date
	 */
	
	/**
	 * @param object  $base
	 * @param integer $year
	 * @param integer $month
	 * @param integer $day
	 * 
	 * @author Shin Uesugi
	 */
	private function _date($year, $month, $day)
	{
		if (!@checkdate($month, $day, $year)) {
			return 'Please input the date correctly.';
		}

		return '';
	}
	
	/**
	 * @param object $base
	 * @param array  $params(
	 *          'subject' => string Date
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_date($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		if (($timestamp = strtotime($params['subject'])) === FALSE) {
			return 'Please input the form at the date correctly.';
		}
		
		return self::_date(date('Y', $timestamp), date('n', $timestamp), date('j', $timestamp));
	}
	
	/**
	 * @param object $base
	 * @param array  $params(
	 *          'year'    => integer
	 *          'month'   => integer
	 *          'day'     => integer
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_date_parts($base, $params)
	{
		$value_param_names = array(
			'year',
			'month',
			'day',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		return self::_date($params['year'], $params['month'], $params['day']);
	}
	
	
	/*
	 * #URL
	 */

	/**
	 * @param object $base
	 * @param array  $params(
	 *          'subject' => string URL
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_url($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		if (!preg_match('/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $params['subject'])) {
			return 'Please input the URL correctly.';
		}
		
		return '';
	}
	
	
	/*
	 * #Mail address
	 */
	
	/**
	 * @param object $base
	 * @param string $mail_addr
	 * 
	 * @author Shin Uesugi
	 */
	private function _mail_addr($mail_addr)
	{
		if (!preg_match('/^[0-9a-zA-Z][0-9a-zA-Z\._-]*@[0-9a-zA-Z_-][0-9a-zA-Z\._-]+\.[a-zA-Z]+$/', $mail_addr)) {
			return 'Please input the e-mail address correctly.';
		}
		
		return '';
	}
	
	/**
	 * @param object $base
	 * @param array  $params(
	 * 			'subject' => string Mail address
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_mail_addr($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		return self::_mail_addr($params['subject']);
	}
	
	/**
	 * @param object $base
	 * @param array  $params(
	 *          'account' => string
	 *          'domain'  => string
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_mail_addr_parts($base, $params)
	{
		$value_param_names = array(
			'account',
			'domain',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		return self::_mail_addr($params['account'] . '@' . $params['domain']);
	}
	

	/*
	 * #Telephone number of general
	 */
	
	/**
	 * @param object $base
	 * @param string $tel_num
	 * 
	 * @author Shin Uesugi
	 */
	private function _tel_num($tel_num)
	{
		if (!preg_match('/^0[0-9]{1,3}\-?[0-9]{2,4}\-?[0-9]{3,4}$/', $tel_num)) {
			return 'Please input the telephone number correctly.';
		}
		
		return '';
	}
	
	/**
	 * @param object $base
	 * @param array  $params(
	 *          'subject' => string Telephone number
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_tel_num($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		return self::_tel_num($params['subject']);
	}
	
	/**
	 * @param object $base
	 * @param array  $params(
	 *          'area' => string
	 *          'city' => string
	 *          'rest' => string
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_tel_num_parts($base, $params)
	{
		$value_param_names = array(
			'area',
			'city',
			'rest',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		return self::_tel_num($params['area'] . '-' . $params['city'] . '-' . $params['rest']);
	}
	
	
	/*
	 * #Telephone number of mobile
	 */
	
	/**
	 * @param object $base
	 * @param string $tel_num
	 * 
	 * @author Shin Uesugi
	 */
	private function _mobile_tel_num($tel_num)
	{
		if (!preg_match('/^0(9|8|7)0\-?[0-9]{4}\-?[0-9]{4}$/', $tel_num)) {
			return 'Please input the mobile telephone number correctly.';
		}
		
		return '';
	}
	
	/**
	 * @param object $base
	 * @param array  $params(
	 *          'subject' => string Telephone number
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_mobile_tel_num($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		return self::_mobile_tel_num($params['subject']);
	}
	
	/**
	 * @param object $base
	 * @param array  $params(
	 *          'area' => string
	 *          'city' => string
	 *          'rest' => string
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_mobile_tel_num_parts($base, $params)
	{
		$value_param_names = array(
			'area',
			'city',
			'rest',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		return self::_mobile_tel_num($params['area'] . '-' . $params['city'] . '-' . $params['rest']);
	}
	
	
	/*
	 * #Zip code
	 */
	
	/**
	 * @param object $base
	 * @param string $zip_code
	 * 
	 * @author Shin Uesugi
	 */
	private function _zip_code($zip_code)
	{
		if (!preg_match('/^[0-9]{3}\-?[0-9]{4}$/', $zip_code)) {
			return 'Please input the zip code correctly.';
		}
		
		return '';
	}
	
	/**
	 * @param object $base
	 * @param array  $params(
	 *          'subject' => string Zip code
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
		
		return self::_zip_code($params['subject']);
	}
	
	/**
	 * @param object $base
	 * @param array  $params(
	 *          'head' => string
	 *          'tail' => string
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_zip_code_parts($base, $params)
	{
		$value_param_names = array(
			'head',
			'tail',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		return self::_zip_code($params['head'] . '-' . $params['tail']);
	}
	
	
	/*
	 * #Credit card
	 */
	
	/**
	 * @param object $base
	 * @param array  $params(
	 *          'subject' => string Credit card number
	 *        )
	 * 
	 * @author Shin Uesugi
	 */
	public function cz_credit_card_num($base, $params)
	{
		$value_param_names = array(
			'subject',
		);
		if (!$base->isExecFunc(__METHOD__, $params, $value_param_names)) {
			return '';
		}
		
		if (!preg_match('/^[13456][0-9]{13,15}$/', $params['subject'])) {
			return 'Please input the credit card number correctly.';
		}
		
		return '';
	}
}
?>