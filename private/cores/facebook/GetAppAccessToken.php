<?php
final class CZCfacebookGetAppAccessToken extends CZBase
{
    /**
     * @param string $app_id <Option>
     * @param string $app_secret <Option>
     * 
     * @return string / boolean
     * 
     * @author Shin Uesugi
     */
    public function exec($app_id = NULL, $app_secret = NULL)
    {
        if (!$app_id) {
            $app_id = $this->_cz->newUser('config', 'facebook')->getValue('app_id');
        }
        if (!$app_secret) {
            $app_secret = $this->_cz->newUser('config', 'facebook')->getValue('app_secret');
        }

        $url  = 'https://graph.facebook.com/oauth/access_token';
        $url .= '?client_id='     . $app_id;
        $url .= '&client_secret=' . $app_secret;
        $url .= '&grant_type=client_credentials';

        if (!($result = @file_get_contents($url))) {
            return FALSE;
        }

        $values = NULL;
        parse_str($result, $values);

        return $values['access_token'];
    }
}
?>