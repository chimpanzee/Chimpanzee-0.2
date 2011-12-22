<?php
final class CZCurlGetSelf extends CZBase
{
    /**
     * @param $secure_flag <Option>
     *
     * @return string
     *
     * @author Shin Uesugi
     */
    public function exec($secure_flag = NULL)
    {
        $url  = $this->_cz->newCore('url', 'get_protocol')->exec($secure_flag);
        $url .= '://' . $_SERVER['HTTP_HOST'];
        $url .= $this->_cz->newCore('url', 'get_path')->exec();

        $routing_parts = $this->_cz->newCore('routing', 'get_parts')->exec();

        $url .= '/' . $routing_parts['ctrl_name'];
        if ($routing_parts['action_group_name']) {
            $url .= '/' . $routing_parts['action_group_name'];
        }
        if ($routing_parts['action_name'] != 'index') {
            $url .= '/' . $routing_parts['action_name'];
        }
        foreach ($routing_parts['params'] as $param) {
            $url .= '/' . $param;
        }

        return $url;
    }
}
?>