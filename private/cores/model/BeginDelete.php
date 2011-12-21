<?php
final class CZCmodelBeginDelete extends CZBase
{
    /**
     * @param object  $model
     * @param integer $id
     * 
     * @return array / FALSE
     * 
     * @author Shin Uesugi
     */
    public function exec($model, $id)
    {
        if (!($record = $this->_cz->newCore('model', 'get_record')->byId($model, $id))) {
            $model->free('delete_id');
            return FALSE;
        }

        $model->save('delete_id', $id);

        return $record;
    }
}
?>