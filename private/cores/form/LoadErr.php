<?php
final class CZCformLoadErr extends CZBase
{
    /**
     * @param object $form
     * @param string $part_name
     * @param string $default_msg <Option>
     *
     * @return string / FALSE
     *
     * @author Shin Uesugi
     */
    public function exec($form, $part_name, $default_msg = NULL)
    {
        $msgs = $form->load('err_msgs', array());
        if (isset($msgs[$part_name])) {
            $msg = $msgs[$part_name];
        } else {
            if ($default_msg === FALSE) {
                return FALSE;
            }
            if ($default_msg !== NULL) {
                $msg = $default_msg;
            } else {
                $this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_NOT_SAVED_ERR_MSG, 'Part: ' . $part_name);
            }
        }

        $head_str = $this->_cz->newUser('config', 'form')->getValue('err_msg_head_str', '');
        $tail_str = $this->_cz->newUser('config', 'form')->getValue('err_msg_tail_str', '');

        return $head_str . $msg . $tail_str;
    }
}
?>