[page:Test]

<?php
    include_lib('www_user_profile');
    include_lib('model_morph');

    $user_profile = new www_user_profile();
    $model_morph = new model_morph('www_user_profile');


    $model_morph->columns['user_name'] = 'Mr Anderson';
    $model_morph->columns['user_actual_name'] = 'Neo';
    $model_morph->columns['user_surname'] = 'Anderson';
    $model_morph->columns['user_email'] = 'andy@gmail.com';
    $model_morph->columns['user_password'] = md5('andy1234');
    $model_morph->columns['date_of_birth'] = '1993-06-27';
    $model_morph->columns['gender'] = 1;

    var_dump($model_morph->columns_to_save());

    $model_morph->save(1, 'user_email', $model_morph->columns['user_email']);

    /*var_dump($user_profile->user_name);
    var_dump($user_profile->db_table);

    $where = 'user_email = "' . $user_profile->user_email.'"';

    var_dump($user_profile->record_exists($where));
    var_dump($get);
    var_dump($user_profile->save());*/

?>