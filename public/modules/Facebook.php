<?php
final class CZMFacebook extends CZBase
{
    /*
     * #Get access token
     */

    /**
     * @param string $app_id <Option>
     * @param string $app_secret <Option>
     *
     * @return string / boolean
     *
     * @author Shin Uesugi
     */
    public function getAppAccessToken($app_id = NULL, $app_secret = NULL)
    {
        return $this->_cz->newCore('facebook', 'get_app_access_token')->exec($app_id, $app_secret);
    }

    /**
     * @param $expires_return_flag <Option>
     *
     * @return array / FALSE
     *         array(
     *             'access_token' => string
     *             'expires'      => string
     *         )
     *
     * @author Shin Uesugi
     */
    public function getUserAccessToken($expires_return_flag = FALSE)
    {
        return $this->_cz->newCore('facebook', 'get_user_access_token')->exec($expires_return_flag);
    }


    /*
     * #Call API
     */

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
    public function callAppApi($path, $method, $params = NULL, $access_token = NULL, $accesss_token_auto_flag = FALSE)
    {
        return $this->_cz->newCore('facebook', 'call_app_api')->exec($path, $method, $params, $access_token, $accesss_token_auto_flag);
    }

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
    public function callUserApi($path, $method, $params = NULL, $access_token = NULL, $accesss_token_auto_flag = FALSE)
    {
        return $this->_cz->newCore('facebook', 'call_user_api')->exec($path, $method, $params, $access_token, $accesss_token_auto_flag);
    }
}
?>