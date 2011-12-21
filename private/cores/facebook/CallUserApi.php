<?php
final class CZCfacebookCallUserApi extends CZBase
{
    /**
     * @param string  $path
     * @param string  $method
     * @param string  $params <Option>
     * @param string  $access_token <Option>
     * @param boolean $accesss_token_auto_flag <Option>
     * 
     * @return array / FALSE
     * 
     * @author Shin Uesugi
     */
    public function exec($path, $method, $params = NULL, $access_token = NULL, $accesss_token_auto_flag = FALSE)
    {
        if ($path == '/') {
            return FALSE;
        }

        $url  = 'https://graph.facebook.com';
        $url .= $path;

        if (!($result = $this->_cz->newCore('facebook', 'call_api')->exec($url, $method, $params, $access_token)) && $accesss_token_auto_flag) {
            if (!($access_token = $this->_cz->newCore('facebook', 'get_user_access_token')->exec())) {
                return FALSE;
            }

            $result = $this->_cz->newCore('facebook', 'call_api')->exec($url, $method, $params, $access_token);
        }

        return $result;
    }
}
?>