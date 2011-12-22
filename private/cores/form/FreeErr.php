<?php
final class CZCformFreeErr extends CZBase
{
    /**
     * @param object $form
     * @param string $part_name
     *
     * @author Shin Uesugi
     */
    public function exec($form, $part_name)
    {
        if ($msgs = $form->load('err_msgs', array())) {
            unset($msgs[$part_name]);
            $form->save('err_msgs', $msgs);
        }
    }
}
?>