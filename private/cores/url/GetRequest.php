<?php
final class CZCurlGetRequest extends CZBase
{
    /**
     * @return string
     *
     * @author Shin Uesugi
     */
    public function exec()
    {
        $url  = $this->_cz->newCore('url', 'get_protocol')->exec();
        $url .= '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        return $url;
    }
}
?>