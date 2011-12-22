<?php
final class CZCurlGetCss extends CZBase
{
    /**
     * @return string
     *
     * @author Shin Uesugi
     */
    public function exec()
    {
        if (!($url = $this->_cz->newUser('config', 'url')->getValue('css', FALSE))) {
            $url  = $this->_cz->newCore('url', 'get_root')->exec();
            $url .= '/' . $this->_cz->newUser('config', 'url')->getValue('css_relative_path', 'css');
        }

        return $url;
    }
}
?>