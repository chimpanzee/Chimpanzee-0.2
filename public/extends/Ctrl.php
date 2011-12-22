<?php
require_once 'Func.php';
class CZCtrl extends CZFunc
{
    /*
     * #Forward
     */

    /**
     * @param array $action(
     *            string Action name
     *            string Action group name <Option>
     *            string Controller name   <Option>
     *        )
     * @param array $params(
     *            'routing' => array(
     *                string Parameter value
     *                ...
     *            ) <Option>
     *            'get' => array(
     *                string Parameter name => string Parameter value
     *                ...
     *            ) <Option>
     *        ) <Option>
     * 
     * @return Exit
     * 
     * @author Shin Uesugi
     */
    protected function _forward($action, $params = NULL)
    {
        $this->_cz->loadStatic('forward')->_exec($action, $params);
    }

    /**
     * @param array $action(
     *            string Action name
     *            string Controller name <Option>
     *        )
     * @param array $params(
     *            'routing' => array(
     *                string Parameter value
     *                ...
     *            ) <Option>
     *            'get' => array(
     *                string Parameter name => string Parameter value
     *                ...
     *            ) <Option>
     *        ) <Option>
     * 
     * @return Exit
     * 
     * @author Shin Uesugi
     */
    protected function forward($action, $params = NULL)
    {
        $this->_cz->loadStatic('forward')->exec($action, $params);
    }

    /**
     * @reutrn Exit
     * 
     * @author Shin Uesugi
     */
    protected function forward403()
    {
        $this->_cz->newCore('forward', '403')->exec();
    }

    /**
     * @return Exit
     * 
     * @author Shin Uesugi
     */
    protected function forward404()
    {
        $this->_cz->newCore('forward', '404')->exec();
    }


    /*
     * #Redirect
     */

    /**
     * @param array   $action(
     *            string Action name
     *            string Action group name <Option>
     *            string Controller name   <Option>
     *        )
     * @param boolean $secure_flag <Option>
     * @param array   $params(
     *            'routing' => array(
     *                string Parameter value
     *                ...
     *            ) <Option>
     *            'get' => array(
     *                string Parameter name => string Parameter value
     *                ...
     *            ) <Option>
     *        ) <Option>
     * 
     * @return Exit
     * 
     * @author Shin Uesugi
     */
    protected function _redirect($action, $secure_flag = NULL, $params = NULL)
    {
        $this->_cz->newCore('redirect', 'action')->_exec($action, $secure_flag, $params);
    }
    
    /**
     * @param array   $action(
     *            string Action name
     *            string Controller name <Option>
     *        )
     * @param boolean $secure_flag <Option>
     * @param array   $params(
     *            'routing' => array(
     *                string Parameter value
     *                ...
     *            ) <Option>
     *            'get' => array(
     *                string Parameter name => string Parameter value
     *                ...
     *            ) <Option>
     *        ) <Option>
     * 
     * @return Exit
     * 
     * @author Shin Uesugi
     */
    protected function redirect($action, $secure_flag = NULL, $params = NULL)
    {
        $this->_cz->newCore('redirect', 'action')->exec($action, $secure_flag, $params);
    }

    /**
     * @param boolean $secure_flag <Option>
     * @param array   $params(
     *            'routing' => array(
     *                string Parameter value
     *                ...
     *            ) <Option>
     *            'get' => array(
     *                string Parameter name => string Parameter value
     *                ...
     *            ) <Option>
     *        ) <Option>
     * 
     * @return Exit
     * 
     * @author Shin Uesugi
     */
    protected function redirectRoot($secure_flag = NULL, $params = NULL)
    {
        $this->_cz->newCore('redirect', 'root')->exec($secure_flag, $params);
    }

    /**
     * @param array   $default_action <Option>
     *        array(
     *            string Controller name
     *            string Action group name <Option>
     *            string Action name <Option>
     *        )
     * @param boolean $secure_flag <Option>
     * @param array   $params <Option>
     *        array(
     *            'routing' => array(
     *                string Parameter value
     *                ...
     *            ) <Option>
     *            'get' => array(
     *                string Parameter name => string Parameter value
     *                ...
     *            ) <Option>
     *        )
     * 
     * @return Exit / FALSE
     * 
     * @author Shin Uesugi
     */
    protected function _redirectReturn($default_action = NULL, $secure_flag = NULL, $params = NULL)
    {
        return $this->_cz->newCore('redirect', 'return')->_exec($default_action, $secure_flag, $params);
    }
    
    /**
     * @param array   $default_action <Option>
     *        array(
     *            string Controller name
     *            string Action name <Option>
     *        )
     * @param boolean $secure_flag <Option>
     * @param array   $params <Option>
     *        array(
     *            'routing' => array(
     *                string Parameter value
     *                ...
     *            ) <Option>
     *            'get' => array(
     *                string Parameter name => string Parameter value
     *                ...
     *            ) <Option>
     *        )
     * 
     * @return Exit / FALSE
     * 
     * @author Shin Uesugi
     */
    protected function redirectReturn($default_action = NULL, $secure_flag = NULL, $params = NULL)
    {
        return $this->_cz->newCore('redirect', 'return')->exec($default_action, $secure_flag, $params);
    }

    /**
     * @param string $url
     * 
     * @return Exit
     * 
     * @author Shin Uesugi
     */
    protected function redirect301($url)
    {
        $this->_cz->newCore('redirect', '301')->exec($url);
    }

    /**
     * @param string $url
     * 
     * @return Exit
     * 
     * @author Shin Uesugi
     */
    protected function redirect302($url)
    {
        $this->_cz->newCore('redirect', '302')->exec($url);
    }


    /*
     * #Process
     */

    /**
     * @param string $process_name <Option>
     * 
     * @author Shin Uesugi
     */
    protected function beginProcess($process_name = NULL)
    {
        $this->_cz->newCore('process', 'begin')->exec($process_name);
    }

    /**
     * @param string $process_name <Option>
     *        array(
     *            string Process name
     *            ...
     *        )
     * 
     * @return Void / Forward 403
     * 
     * @author Shin Uesugi
     */
    protected function checkProcess($process_name = NULL)
    {
        $this->_cz->newCore('process', 'check')->exec($process_name);
    }

    /**
     * @author Shin Uesugi
     */
    protected function endProcess()
    {
        $this->_cz->newCore('process', 'end')->exec();
    }


    /*
     * #Get previous
     */

    /**
     * @return string / NULL
     * 
     * @author Shin Uesugi
     */
    protected function getPrevCtrlName()
    {
        return $this->_cz->loadStatic('forward')->getPrevCtrlName();
    }

    /**
     * @return string / NULL
     * 
     * @author Shin Uesugi
     */
    protected function getPrevActionGroupName()
    {
        return $this->_cz->loadStatic('forward')->getPrevActionGroupName();
    }

    /**
     * @return string / NULL
     * 
     * @author Shin Uesugi
     */
    protected function getPrevActionName()
    {
        return $this->_cz->loadStatic('forward')->getPrevActionName();
    }


    /*
     * #Check previous action
     */

    /**
     * @param array $actions
     * 
     * @return Void / Forward 403
     * 
     * @author Shin Uesugi
     */
    protected function _checkPrevActions($actions)
    {
        $this->_cz->newCore('forward', 'check_prev_actions')->_exec($actions);
    }

    /**
     * @param array $actions
     * 
     * @return Void / Forward 403
     * 
     * @author Shin Uesugi
     */
    protected function checkPrevActions($actions)
    {
        $this->_cz->newCore('forward', 'check_prev_actions')->exec($actions);
    }


    /*
     * #View
     */

    /**
     * @param string  $var_name
     * @param mixed   $value
     * @param boolean $escape_flag <Default: TRUE>
     * @param array   $ignore_escape_keys <Option>
     * 
     * @author Shin Uesugi
     */
    protected function addViewVar($var_name, $value, $escape_flag = TRUE, $ignore_escape_keys = array())
    {
        $this->_cz->newCore('view', 'add_var')->exec($var_name, $value, $escape_flag, $ignore_escape_keys);
    }

    /**
     * @param string $file <Option>
     * 
     * @author Shin Uesugi
     */
    protected function display($file = '')
    {
        $this->_cz->newCore('view', 'display')->exec($file);
    }
}
?>