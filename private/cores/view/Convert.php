<?php
final class CZCviewConvert extends CZBase
{
    /**
     * @param mixed   $value
     * @param boolean $escape_flag
     * @param array   $ignore_escape_keys
     * @param boolean $mobile_flag
     * 
     * @return mixed
     * 
     * @author Shin Uesugi
     */
    private function _exec($value, $escape_flag, $ignore_escape_keys, $mobile_flag)
    {
        if (is_array($value)) {
            foreach ($value as $key => $val) {
                if ($escape_flag && !in_array($key, $ignore_escape_keys)) {
                    $value[$key] = self::_exec($val, TRUE, $ignore_escape_keys, $mobile_flag);
                } else {
                    $value[$key] = self::_exec($val, FALSE, $ignore_escape_keys, $mobile_flag);
                }
            }
        } else if (is_string($value)) {
            if ($escape_flag) {
                $value = htmlspecialchars($value);
                $value = str_replace(array("\r\n", "\r", "\n"), '<br />', $value);
            }
            if ($mobile_flag) {
                $value = mb_convert_kana($value, 'ask');
            }
        }

        return $value;
    }

    /**
     * @param mixed   $value
     * @param boolean $escape_flag <Default: TRUE>
     * @param array   $ignore_escape_keys <Option>
     * 
     * @return mixed
     * 
     * @author Shin Uesugi
     */
    public function exec($value, $escape_flag = TRUE, $ignore_escape_keys = array())
    {
        $mobile_flag = $this->_cz->newCore('mobile', 'is_mobile')->exec();

        return self::_exec($value, $escape_flag, $ignore_escape_keys, $mobile_flag);
    }
}
?>