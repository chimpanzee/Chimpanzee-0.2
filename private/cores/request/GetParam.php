<?php
final class CZCrequestGetParam extends CZBase
{
    /**
     * @author Shin Uesugi
     */
    private function _convertEncoding($value, $internal_encoding, $request_encoding)
    {
        if (is_array($value)) {
            foreach ($value as $key => $val) {
                $value[$key] = self::_convertEncoding($val, $internal_encoding, $request_encoding);
            }
        } else {
            $value = mb_convert_encoding($value, $internal_encoding, $request_encoding);
        }

        return $value;
    }

    /**
     * @author Shin Uesugi
     */
    private function _getParams($value)
    {
        $internal_encoding = mb_internal_encoding();
        $request_encoding  = $this->_cz->loadStatic('request')->getEncoding();
        if ($internal_encoding == $request_encoding) {
            return $value;
        }

        return self::_convertEncoding($value, $internal_encoding, $request_encoding);
    }

    /**
     * @author Shin Uesugi
     */
    private function _getParam($var, $var_name, $default_value = NULL)
    {
        if (!isset($var[$var_name])) {
            if ($default_value !== NULL) {
                return $default_value;
            }
            $this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_REQUEST_INVALID_VAR_NAME, $var_name);
        }

        return self::_getParams($var[$var_name]);
    }


    /**
     * @return array
     *
     * @author Shin Uesugi
     */
    public function getParams()
    {
        return self::_getParams($_REQUEST);
    }

    /**
     * @param string $var_name
     * @param mixed  $default_value <Option>
     *
     * @return mixed
     *
     * @author Shin Uesugi
     */
    public function getParam($var_name, $default_value = NULL)
    {
        return self::_getParam($_REQUEST, $var_name, $default_value);
    }


    /**
     * @param string $var_name
     *
     * @return array
     *
     * @author Shin Uesugi
     */
    public function getGetParams()
    {
        return self::_getParams($_GET);
    }

    /**
     * @param string $var_name
     * @param mixed  $default_value <Option>
     *
     * @return mixed
     *
     * @author Shin Uesugi
     */
    public function getGetParam($var_name, $default_value = NULL)
    {
        return self::_getParam($_GET, $var_name, $default_value);
    }


    /**
     * @param string $var_name
     *
     * @return array
     *
     * @author Shin Uesugi
     */
    public function getPostParams()
    {
        return self::_getParams($_POST);
    }

    /**
     * @param string $var_name
     * @param mixed  $default_value <Option>
     *
     * @return mixed
     *
     * @author Shin Uesugi
     */
    public function getPostParam($var_name, $default_value = NULL)
    {
        return self::_getParam($_POST, $var_name, $default_value);
    }
}
?>