<?php
final class CZCurlGetApi extends CZBase
{
    /**
     * @return string
     * 
     * @author Shin Uesugi
     */
    public function exec()
    {
        if (!($url = $this->_cz->newUser('config', 'url')->getValue('api', FALSE))) {
            $url  = $this->_cz->newCore('url', 'get_root')->exec();
            $url .= '/' . $this->_cz->newUser('config', 'url')->getValue('api_relative_path', 'api');
        }

        return $url;
    }
}
?>