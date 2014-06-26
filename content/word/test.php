<?php
    include_lib('db_interrogator');

    $dbi = new DbInterrogator();

    $columns = $dbi->table_columns('www_user_profile');
    $tables = $dbi->db_tables('word_world_wonder');

    var_dump($tables);
    var_dump($columns);
?>