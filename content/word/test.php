[page:Test]

<?php
    include_lib('db_interrogator');

    $dbi = new DbInterrogator();

    $columns = $dbi->table_columns('www_user_profile');
    $tables = $dbi->db_tables('word_world_wonder');

    $get = $dbi->get_data('www_user_profile', null, 'is_active = 1');

    $new_user = array(
        'user_name' => 'Bro J',
        'user_actual_name' => 'John',
        'user_surname' => 'McGinnis',
        'user_email' => 'john@gmail.com',
        'user_password' => md5('john1234'),
        'date_of_birth' => '1993-06-27',
        'gender' => 1,
        'is_active' => 0
    );

    $insert = $dbi->insert_data('www_user_profile', $new_user);

    var_dump($insert);

    /*var_dump($tables);
    var_dump($columns);
    var_dump($get);*/
?>