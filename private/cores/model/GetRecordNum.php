<?php
final class CZCmodelGetRecordNum extends CZBase
{
    /**
     * @param object $model_records
     *
     * @return integer
     *
     * @author Shin Uesugi
     */
    public function exec($model_records)
    {
        $model = $model_records->getModel();

        $table_name          = $model_records->getModel()->getTableName();
        $column_names        = $model_records->getColumnNames();
        $condition_sentences = $model_records->getConditionSentences();
        $condition_values    = $model_records->getConditionValues();
        $options             = $model_records->_getOptions();

        list($condition_sentences, $condition_values) = $this->_cz->newCore('model', 'merge_mask')->exec($model, $condition_sentences, $condition_values);
        list($condition_sentences, $condition_values) = $this->_cz->newCore('model', 'merge_search')->exec($model_records, $condition_sentences, $condition_values);

        $sub_query = '(' . $this->_cz->newCore('db', 'get_select_query')->exec($table_name, $column_names, $condition_sentences, $options) . ') sub';
        $condition_sentences = NULL;

        return $this->_cz->newCore('db', 'get_value')->exec($sub_query, 'COUNT(*)', $condition_sentences, $condition_values);
    }
}
?>