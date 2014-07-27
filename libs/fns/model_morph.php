<?php
include_lib('db_interrogator');
class model_morph extends DbInterrogator
{
    public $columns = array();
    public $check_column;
    public $check_value;

    function __construct($table, $check_column = null, $check_value = null)
    {
        $this->db_table = $table;
        $columns = $this->table_columns($this->db_table);
        $this->check_column = $check_column;
        $this->check_value = $check_value;

        foreach($columns as $col)
            $this->columns[$col] = null;
    }

    public function columns_to_save()
    {
        $columns = $this->columns;

        $columns_to_save = array();

        foreach($columns as $key => $column)
        {
            if(!empty($column))
            {
                $columns_to_save[$key] = $column;
            }
        }

        return $columns_to_save;
    }

    public function save($check = 0)
    {
        $table = $this->db_table;
        $columns = $this->columns_to_save();

        if($check == 1)
        {
            $where = $this->check_column .' = "' . $this->check_value.'"';
            $exists = $this->record_exists($where);
            if($exists) { return false; }
        }

        $this->insert_data($table, $columns);

        return true;
    }
}