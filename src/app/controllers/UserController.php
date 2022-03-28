<?php

use Phalcon\Mvc\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
    }
    public function checkuserAction()
    {
        $escaper = new \App\Components\Myescaper();
        $user = new Users();
        $email = $escaper->sanitize($this->request->getPost()['email']);
        $password = $escaper->sanitize($this->request->getPost()['password']);
        return $user->checkUser($email, $password);
    }
    public function signupAction()
    {
        // return "Signup";
    }
    public function registerAction()
    {
        // return '<h1>registered</h1>';
        $user = new Users();
        $escaper = new \App\Components\Myescaper();
        $user->name = $escaper->sanitize($this->request->getPost()['name']);

        $user->password = $escaper->sanitize($this->request->getPost()['password']);
        $user->email = $escaper->sanitize($this->request->getPost()['email']);
        $user->role = 'user';
        $user->status = 'restricted';

        $success = $user->save();
        $email = $escaper->sanitize($this->request->getPost()['email']);
        $data = Users::find(["email = '$email'"]);
        return json_encode($data);
    }

    public function checkemailAction()
    {
        $escaper = new \App\Components\Myescaper();
        $email = $escaper->sanitize($this->request->getPost()['email']);
        $data = Users::find(["email = '$email'"]);
        return json_encode($data);
    }
}
