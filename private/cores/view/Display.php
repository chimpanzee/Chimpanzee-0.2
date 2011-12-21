<?php
final class CZCviewDisplay extends CZBase
{
    /**
     * @param string $file <Option>
     * 
     * @return Exit
     * 
     * @author Shin Uesugi
     */
    public function exec($file = '')
    {
        $_vars = $this->_cz->loadStatic('view')->getVars();
        foreach ($_vars as $_var_name => $_value) {
            $$_var_name = $_value;
        }
        unset($_vars);
        unset($_var_name);
        unset($_value);

        $_err_msg = $this->_cz->newCore('err', 'load')->exec(FALSE);
        $this->_cz->newCore('err', 'free')->exec();

        $_ctrl_name         = $this->_cz->newCore('forward', 'get_ctrl_name')->exec();
        $_action_group_name = $this->_cz->newCore('forward', 'get_action_group_name')->exec();
        $_action_name       = $this->_cz->newCore('forward', 'get_action_name')->exec();

        if (!($_views_dir = $this->_cz->newUser('config', 'view')->getValue('views_dir', FALSE))) {
            $_views_dir = $this->_cz->application_dir . DIRECTORY_SEPARATOR . 'views';
        }

        $_self_url         = $this->_cz->newCore('url', 'get_self')->exec();
        $_images_url       = $this->_cz->newCore('url', 'get_images')->exec();
        $_css_url          = $this->_cz->newCore('url', 'get_css')->exec();
        $_js_url           = $this->_cz->newCore('url', 'get_js')->exec();
        $_api_url          = $this->_cz->newCore('url', 'get_api')->exec();
        $_return_url       = $this->_cz->newCore('url', 'get_return')->exec();
        $_image_server_url = $this->_cz->newCore('image', 'get_server_url')->exec();

        eval('?>' . $this->_cz->newCore('view', 'get_template')->exec($_views_dir, $file) . '<?;');
        exit;
    }


    /*
     * #Get methods
     */

    /**
     * @param boolean $secure_flag <Option>
     * 
     * @return string
     * 
     * @author Shin Uesugi
     */
    private function root_url($secure_flag = NULL)
    {
        return $this->_cz->newCore('url', 'get_root')->exec($secure_flag);
    }

    /**
     * @param array   $action(
     *            string Action name
     *            string Action group name <Option>
     *            string Controller name   <Option>
     *        )
     * @param boolean $secure_flag <Option>
     * 
     * @return string
     * 
     * @author Shin Uesugi
     */
    private function _url($action, $secure_flag = NULL)
    {
        return $this->_cz->newCore('url', 'get_action')->_exec($action, $secure_flag);
    }

    /**
     * @param array   $action(
     *            string Action name
     *            string Controller name <Option>
     *        )
     * @param boolean $secure_flag <Option>
     * 
     * @return string
     * 
     * @author Shin Uesugi
     */
    private function url($action, $secure_flag = NULL)
    {
        return $this->_cz->newCore('url', 'get_action')->exec($action, $secure_flag);
    }

    /**
     * @param string $name
     * 
     * @return object
     * 
     * @author Shin Uesugi
     */
    private function func($name)
    {
        $arg_num = func_num_args();
        $args    = func_get_args();

        return $this->_cz->newUser('func', $name, $arg_num, $args);
    }
}
?>