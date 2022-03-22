<?php

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
        //return '<h1>Hello!!!</h1>';
    }
    public function checkuserAction(){
         $user = new Users();
        $email = $this->request->getPost()['email'];
        $password = $this->request->getPost()['password'];
        return $user->checkUser($email, $password);
    }
}