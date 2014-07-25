<?php
include_lib('db_interrogator');
class www_user_profile extends DbInterrogator
{
    public $id;
    public $user_name;
    public $user_actual_name;
    public $user_surname;
    public $user_email;
    public $user_password;
    public $date_of_birth;
    public $gender;
    public $sdate_created;
    public $is_active;

    function __construct()
    {
        $this->db_table = get_class($this);
    }

    public function columns()
    {
        $new_user = array(
            'user_name' => $this->user_name,
            'user_actual_name' => $this->user_actual_name,
            'user_surname' => $this->user_surname,
            'user_email' => $this->user_email,
            'user_password' => md5($this->user_password),
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'is_active' => $this->is_active
        );

        return $new_user;
    }

    public function save()
    {
        $table = $this->db_table;
        $columns = $this->columns();

        $where = 'user_email = "' . $this->user_email.'"';
        $exists = $this->record_exists($where);

        if($exists) { return false; }

        $this->insert_data($table, $columns);

        return true;
    }
}