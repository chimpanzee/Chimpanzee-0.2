<?php
final class CZCurlIsInternal extends CZBase
{
    /**
     * @param string $url
     * 
     * @return boolean
     * 
     * @author Shin Uesugi
     */
    public function exec($url)
    {
        $url_parts = parse_url($url);
        $base_str = $url_parts['host'] . $url_parts['path'];

        $cmp_str = $_SERVER['HTTP_HOST'] . $this->_cz->newCore('url', 'get_path')->exec();

        return strncmp($base_str, $cmp_str, strlen($cmp_str)) == 0;
    }
}
?>