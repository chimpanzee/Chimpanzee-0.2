<?php
final class configView extends CZConfig
{
    public function _construct()
    {
        $this->setValues(array(
            'views_dir' => '',

            'file_extension' => 'html',
        ));
    }
}
?>