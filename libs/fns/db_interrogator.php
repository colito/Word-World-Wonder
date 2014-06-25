<?php
class DbInterrogator
{
    public function run_sql($query)
    {
        $result = mysql_query($query);

        if(!$result)
        {
            die('Could not retrieve data: ' . mysql_error() . "\n". $query);
        }
        
        $data = array();
        while($row = mysql_fetch_array($result))
        {
            $data[] = $row;
        }
        return $data;
    }

    public function get_data($table, $columns)
    {
        if(empty($columns))
        {
            $sql = 'SELECT * FROM '. $table;
        }
        else
        {
            $comma_separated = implode(', ' . $columns);
            $sql = 'SELECT ' .$comma_separated. ' * FROM '. $table;
        }
        $result = $this->run_sql($sql);
        return $result;
    }
}
?>