<?php
final class CZCurlGetJs extends CZBase
{
    /**
     * @return string
     * 
     * @author Shin Uesugi
     */
    public function exec()
    {
        if (!($url = $this->_cz->newUser('config', 'url')->getValue('js', FALSE))) {
            $url  = $this->_cz->newCore('url', 'get_root')->exec();
            $url .= '/' . $this->_cz->newUser('config', 'url')->getValue('js_relative_path', 'js');
        }

        return $url;
    }
}
?>