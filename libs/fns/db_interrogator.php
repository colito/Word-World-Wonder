<?php
class DbInterrogator
{
    /*-----------=============CONNECT TO DATABASE===============----------------*/
    public function db_connect()
    {
        require_once('config.php');
        $config = new Config();

        $hostadress = $config->host;
        $username = $config->user_name;
        $password = $config->password;
        $my_sql_db = $config->database;

        $mysqi = new mysqli($hostadress, $username, $password, $my_sql_db);

        if (mysqli_connect_errno()) {
            die('Could not connect to MySQL: ' . mysqli_connect_error());
        }

        return $mysqi;
    }


    /*-----------=============TYPICAL SQL TRANSACTIONS===============----------------*/

    #Get
    public function get_data($table, $columns = null, $where = '1=1')
    {
        if(!empty($columns))
        {
            $sql = 'SELECT '. $columns ."\n". ' FROM '. $table ."\n";
        }
        else
        {
            $sql = 'SELECT * '. "\n" .'FROM '. $table ."\n";
        }

        $sql .= 'WHERE '. $where;

        $result = $this->run_sql($sql);

        return $result;
    }

    #Post
    public function insert_data($table, $column_values)
    {
        $to_insert = $this->prepare_for_insert($column_values);

        $columns = $to_insert['columns'];
        $values = $to_insert['values'];

        $sql  = 'INSERT INTO ('.$columns.')' ."\n";
        $sql .= 'VALUES ('.$values.')';

        $this->run_sql($sql);
        return true;
    }

    #Update
    public function update_data($table, $columns, $where)
    {
        $sql  = 'UPDATE '. $table .' SET';

        foreach($columns as $column=>$new_value)
        {
            $sql .= $column .' = '. $new_value;
        }

        $sql .= 'WHERE '. $where;

        $result = $this->run_sql($sql);

        return $result;
    }


    /*-----------==============MYSQL FUNCTIONS==============----------------*/
    public function run_sql($query)
    {
        $mysqli = $this->db_connect();

        $result = $mysqli->query($query);

        if(!$result) { die('Could not execute query: ' . mysql_error() . "\n". $query); }

        $data = array();
        while($row = mysqli_fetch_array($result)) { $data[] = $row; }

        $mysqli->close();

        return $data;
    }

    public function prepare_for_insert($column_values)
    {
        $columns = '';
        $values = '';
        $i = 0;
        $total_coulmns_values = count($column_values);
        $prepared = array();

        var_dump($total_coulmns_values);

        foreach($column_values as $column => $value)
        {
            var_dump($i);
            # Checks to see if it's on the last column and value so as to avoid adding an
            # unwanted trailing comma.
            if($i == $total_coulmns_values)
            {
                $columns .= $column;

                # Checks if value is a string and escapes it accordingly
                if(is_string($value)) { $values .= mysqli_real_escape_string($this->db_connect(), $value); }
                else { $values .= $value; }
            }
            else
            {
                $columns .= $column.', ';

                if(is_string($value)) { $values .= mysqli_real_escape_string($this->db_connect(), $value).', '; }
                else { $values .= $value.', '; }
            }
            $i++;
        }

        $prepared['columns'] = $columns;
        $prepared['values'] = $values;

        return $prepared;
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
}
?>