<?php
final class CZCviewGetTemplate extends CZBase
{
    /**
     * @param array   $search_paths
     * @param boolean $required_flag <Default: FALSE>
     *
     * @return string
     *
     * @author Shin Uesugi
     */
    private function _get($search_paths, $required_flag = FALSE)
    {
        $template = FALSE;
        foreach ($search_paths as  $search_path) {
            if (file_exists($search_path)) {
                if (($template = file_get_contents($search_path)) === FALSE) {
                    $this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_VIEW_READ_FILE, $search_path);
                }
                break;
            }
        }
        if ($template === FALSE) {
            if ($required_flag) {
                $this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_VIEW_NOT_EXIST_FILE, implode(', ', $search_paths));
            } else {
                $template = '';
            }
        }

        return $template;
    }

    /**
     * @param string $file
     * @param string $file_extension
     * @param string $views_dir
     * @param string $views_common_dir
     * @param string $ctrl_name
     *
     * @return string
     *
     * @author Shin Uesugi
     */
    private function _getMain($file, $file_extension, $views_dir, $views_common_dir, $ctrl_name)
    {
        if ($file === '') {
            $file = $this->_cz->newCore('forward', 'get_action_name')->exec() . '.' . $file_extension;
        }

        $relative_path = '';
        $action_group_name = $this->_cz->loadStatic('forward')->getActionGroupName();
        if ($action_group_name !== NULL) {
            $relative_path .= $action_group_name . DIRECTORY_SEPARATOR;
        }
        $relative_path .= $file;

        $search_paths = array(
            $views_dir        . DIRECTORY_SEPARATOR . $ctrl_name . DIRECTORY_SEPARATOR . $relative_path,
            $views_common_dir . DIRECTORY_SEPARATOR . $relative_path,
        );

        return self::_get($search_paths, TRUE);
    }

    /**
     * @param string $file_name
     * @param string $file_extension
     * @param string $views_dir
     * @param string $views_common_dir
     * @param string $ctrl_name
     *
     * @return string
     *
     * @author Shin Uesugi
     */
    private function _getSub($file_name, $file_extension, $views_dir, $views_common_dir, $ctrl_name)
    {
        $file = $file_name . '.' . $file_extension;
        $search_paths = array(
            $views_dir        . DIRECTORY_SEPARATOR . $ctrl_name . DIRECTORY_SEPARATOR . $file,
            $views_common_dir . DIRECTORY_SEPARATOR . $file,
        );

        return self::_get($search_paths);
    }

    /**
     * @param string $views_dir
     * @param string $file <Option>
     *
     * @return string
     *
     * @author Shin Uesugi
     */
    public function exec($views_dir, $file = '')
    {
        $file_extension   = $this->_cz->newUser('config', 'view')->getValue('file_extension', 'html');
        $views_common_dir = $views_dir . DIRECTORY_SEPARATOR . '_common';
        $ctrl_name        = $this->_cz->newCore('forward', 'get_ctrl_name')->exec();

        $template  = '';
        $template .= self::_getSub ('_header1', $file_extension, $views_dir, $views_common_dir, $ctrl_name);
        $template .= self::_getSub ('_header2', $file_extension, $views_dir, $views_common_dir, $ctrl_name);
        $template .= self::_getSub ('_header3', $file_extension, $views_dir, $views_common_dir, $ctrl_name);
        $template .= self::_getSub ('_header4', $file_extension, $views_dir, $views_common_dir, $ctrl_name);
        $template .= self::_getSub ('_header5', $file_extension, $views_dir, $views_common_dir, $ctrl_name);
        $template .= self::_getSub ('_header',  $file_extension, $views_dir, $views_common_dir, $ctrl_name);
        $template .= self::_getMain($file,      $file_extension, $views_dir, $views_common_dir, $ctrl_name);
        $template .= self::_getSub ('_footer1', $file_extension, $views_dir, $views_common_dir, $ctrl_name);
        $template .= self::_getSub ('_footer2', $file_extension, $views_dir, $views_common_dir, $ctrl_name);
        $template .= self::_getSub ('_footer3', $file_extension, $views_dir, $views_common_dir, $ctrl_name);
        $template .= self::_getSub ('_footer4', $file_extension, $views_dir, $views_common_dir, $ctrl_name);
        $template .= self::_getSub ('_footer5', $file_extension, $views_dir, $views_common_dir, $ctrl_name);
        $template .= self::_getSub ('_footer',  $file_extension, $views_dir, $views_common_dir, $ctrl_name);

        if ($this->_cz->newCore('mobile', 'is_mobile')->exec()) {
            $template = mb_convert_kana($template, 'ask');
        }

        return $template;
    }
}
?>