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

    #Post
    public function insert_data($user_id, $entry_text)
    {
        $entry_text = mysql_real_escape_string($entry_text);

        $sql = 	"INSERT INTO blog".
            "(user_id, blog_text) ".
            "VALUES($user_id, '$entry_text')";

        $this->run_sql($sql);
        return true;
    }

    #Update
    public function update_data($columns = array())
    {
        foreach($columns as $column)
        {

        }

        $sql =  'UPDATE table_name';
        $sql .= 'SET column1 = value1, column2 = value2';
        $sql .= 'WHERE some_column = some_value';

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