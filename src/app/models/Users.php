<?php

use Phalcon\Mvc\Model;

class Users extends Model
{
    public $user_id;
    public $name;
    public $email;
    public $password;
    public $role;
    public $status;

    public function checkUser($email, $password)
    {
        $data = Users::find([
            'conditions'
            => "email='$email' AND password='$password'",
        ]);
        return json_encode($data);
    }
    public function getUsers()
    {
        $data = Users::find();
        return json_encode($data);
    }
    public function deleteUser($id)
    {
        $user = Users::findFirst($id);
        $result =  $user->delete();
        return json_encode($result);
    }
    public function updateStatus($id, $column, $status)
    {
        $user = Users::findFirst($id);
        $user->$column = $status;
        $result = $user->save();
        return json_encode($result);
    }
}
