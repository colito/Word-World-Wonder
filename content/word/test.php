[page:Test]

<?php
    include_lib('www_user_profile');

    $user_profile = new www_user_profile();

    $get = $user_profile->get_data('www_user_profile', null, 'is_active = 1');

    $user_profile->user_name = 'Bro Sam';
    $user_profile->user_actual_name = 'Samual';
    $user_profile->user_surname = 'McGinnis';
    $user_profile->user_email = 'sam@gmail.com';
    $user_profile->user_password = 'sam1234';
    $user_profile->date_of_birth = '1993-06-27';
    $user_profile->gender = 1;
    $user_profile->is_active = 0;

    var_dump($user_profile->user_name);

    var_dump($user_profile->db_table);

    $where = 'user_email = "' . $user_profile->user_email.'"';

    var_dump($user_profile->record_exists($where));

    var_dump($get);

    var_dump($user_profile->save());

?>