<?php
final class CZCurlGetPath extends CZBase
{
    /**
     * @return string
     *
     * @author Shin Uesugi
     */
    public function exec()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            if (strpos($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']) !== FALSE) {
                $path = $_SERVER['SCRIPT_NAME'];
            } else {
                if (($path = dirname($_SERVER['SCRIPT_NAME'])) == '/') {
                    $path = '';
                }
            }
        } else {
            $path = '';
        }

        return $path;
    }
}
?>