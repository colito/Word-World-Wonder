<?php
include_lib('db_connect_fns');
class DbInterrogator
{
    public function run_sql($query)
    {
        $result = mysql_query($query);
        if(!$result)
        {
            die('Could not execute query: ' . mysql_error() . "\n". $query);
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
            $sql = 'SELECT ' .$comma_separated. ' FROM '. $table;
        }
        $result = $this->run_sql($sql);
        return $result;
    }

    public function db_tables($db)
    {
        $sql = 'SHOW TABLES FROM ' . $db;
        $result = $this->run_sql($sql);
        foreach($result as $table) {$tables[] = $table[0];}
        return $tables;
    }

    public function table_columns($table)
    {
        $sql = 'DESCRIBE ' . $table;
        $result = $this->run_sql($sql);
        $fields = array();
        foreach($result as $columns) {$fields[] = $columns['Field'];}
        return $fields;
    }

    public function insert_data($user_id, $entry_text)
    {
        $entry_text = mysql_real_escape_string($entry_text);

        $sql = 	"INSERT INTO blog".
            "(user_id, blog_text) ".
            "VALUES($user_id, '$entry_text')";

        $this->run_sql($sql);
        return true;
    }
}
?>