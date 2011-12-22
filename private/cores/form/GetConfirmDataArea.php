<?php
final class CZCformGetConfirmDataArea extends CZBase
{
    /**
     * @param object  $form
     * @param string  $part_name
     * @param boolean $escape_flag
     * @param array   $part
     * @param array   $values
     *
     * @return string / FALSE
     *
     * @author Shin Uesugi
     */
    private function _getData($form, $part_name, $escape_flag, $part, $values)
    {
        if (isset($part['confirm'])) {
            return FALSE;
        }

        $value = $values[$part_name];

        switch ($part['type']) {
            case 'text':
            case 'textarea':
                if (isset($part['convert'])) {
                    $value = $this->_cz->newCore('filter', 'convert')->exec($part['convert'], $value, $values);
                }
                if ($escape_flag) {
                    $data = $this->_cz->newCore('view', 'convert')->exec($value);
                } else {
                    $data = $value;
                }
                break;
            case 'checkbox':
                if (isset($part['confirm_label'])) {
                    $data = $part['confirm_label'][$value];
                } else if ($value) {
                    $data = isset($part['label']) ? $part['label'] : '*';
                } else {
                    $data = '';
                }
                break;
            case 'radio':
            case 'select':
                $data = isset($part['table'][$value]) ? $part['table'][$value] : '';
                break;
            case 'password':
                $pass_hide_str = $this->_cz->newUser('config', 'form')->getValue('pass_hide_str', FALSE);
                if ($this->_cz->isValidStr($pass_hide_str)) {
                    $data = $pass_hide_str;
                } else {
                    $data = $value;
                }
                break;
            case 'file':
                if ($value) {
                    $uploaded_files = $form->load('uploaded_files');
                    if (isset($part['image_flag']) && $part['image_flag']) {
                        $image_server_url = $this->_cz->newCore('image', 'get_server_url')->exec();
                        $data  = '<img src="' . $image_server_url . '?dt=tmp';
                        $data .= '&fl=' . $uploaded_files[$part_name]['file'];
                        if (isset($part['image_max_width'])) {
                            $data .= '&mw=' . $part['image_max_width'];
                        }
                        if (isset($part['image_max_height'])) {
                            $data .= '&mh=' . $part['image_max_height'];
                        }
                        $data .= '" />';
                    } else {
                        $data = $uploaded_files[$part_name]['name'];
                    }
                } else {
                    $data = FALSE;
                }
                break;
            default:
                $this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_INVALID_PART_TYPE, $part['type'], $form->getMainClassName());
        }

        return $data;
    }

    /**
     * @param object  $form
     * @param string  $part_name
     * @param boolean $escape_flag <Default: TRUE>
     * @param array   $part <Option>
     * @param array   $values <Option>
     *
     * @return string / FALSE (No display)
     *
     * @author Shin Uesugi
     */
    public function exec($form, $part_name, $escape_flag = TRUE, $part = array(), $values = array())
    {
        if (!$part) {
            $part = $this->_cz->newCore('form', 'get_part')->exec($form, $part_name);
        }
        if (isset($part['type']) && ($part == 'hidden')) {
            $this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_USE_PART_TYPE, $part['type'], $form->getMainClassName());
        }

        if (!$values) {
            $values = $form->load('values');
        }

        $data_area = '';
        if (isset($part['parts'])) {
            foreach ($part['parts'] as $child_part_name => $child_part) {
                if (($data = self::_getData($form, $child_part_name, $escape_flag, $child_part, $values)) === FALSE) {
                    continue;
                }
                if (isset($part['separator']) && $data_area) {
                    $data_area .= $part['separator'];
                }
                $data_area .= $this->_cz->newCore('form', 'get_data_area')->exec($form, $child_part, $data);
            }
        } else {
            if (($data = self::_getData($form, $part_name, $escape_flag, $part, $values)) === FALSE) {
                return FALSE;
            }
            $data_area .= $this->_cz->newCore('form', 'get_data_area')->exec($form, $part, $data);
        }

        return $data_area;
    }
}
?>