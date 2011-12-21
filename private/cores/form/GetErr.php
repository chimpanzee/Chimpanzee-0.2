<?php
final class CZCformGetErr extends CZBase
{
    /**
     * @param object $form
     * @param string $part_name
     * 
     * @return string / FALSE
     * 
     * @author Shin Uesugi
     */
    public function exec($form, $part_name)
    {
        if (($msg = $this->_cz->newCore('form', 'load_err')->exec($form, $part_name, FALSE)) !== FALSE) {
            $this->_cz->newCore('form', 'free_err')->exec($form, $part_name);
            if ($this->_cz->newCore('mobile', 'is_mobile')->exec()) {
                $msg = '<br />' . $msg;
            }
            return $msg;
        }

        return FALSE;
    }
}
?>