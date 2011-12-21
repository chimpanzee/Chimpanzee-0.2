<?php
final class CZCformGetConfirmHtml extends CZBase
{
    /**
     * @param object  $form
     * @param boolean $escape_flag
     * 
     * @return string
     * 
     * @author Shin Uesugi
     */
    public function exec($form, $escape_flag = TRUE)
    {
        $parts  = $form->getParts();
        $values = $form->load('values');

        $caption_areas = array();
        $data_areas    = array();
        foreach ($parts as $part_name => $part) {
            if (!isset($part['type']) || ($part['type'] != 'hidden')) {
                if (($data_area = $this->_cz->newCore('form', 'get_confirm_data_area')->exec($form, $part_name, $escape_flag, $part, $values)) !== FALSE) {
                    $caption_areas[$part_name] = $this->_cz->newCore('form', 'get_caption')->exec($form, $part_name, $part);
                    $data_areas[$part_name]    = $data_area;
                }
            }
        }

        return $this->_cz->newCore('html', 'get_confirm')->exec($caption_areas, $data_areas);
    }
}
?>