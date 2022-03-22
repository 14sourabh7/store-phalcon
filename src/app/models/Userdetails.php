<?php

use Phalcon\Mvc\Model;

class Userdetails extends Model
{
    public $user_id;
    public $name;
    public $email;
    public $mobile;
    public $address;
    public $pin;

    public function getUserDetails($id)
    {

        $data = Userdetails::findFirst($id);
        return $data;
    }
    public function updateUserDetail($id, $name, $email, $mobile, $address, $pin)
    {
        $userdetails = Userdetails::findFirst($id);
        $userdetails->name = $name;
        $userdetails->email = $email;
        $userdetails->mobile = $mobile;
        $userdetails->pin = $pin;
        $userdetails->address = $address;
        $result = $userdetails->save();
        if ($result) {
            $user = Users::findFirst($id);
            $user->name = $name;
            $added = $user->save();
        }
        return json_encode($added);
    }
}
