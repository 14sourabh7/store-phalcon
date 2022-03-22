<?php

use Phalcon\Mvc\Controller;


class CheckoutController extends Controller
{
    public function indexAction()
    {
    }
    public function operationAction()
    {
        $userdetails = new Userdetails();
        $action = $this->request->getPost()['action'];
        switch ($action) {
            case 'getUserDetails':
                $id = $_POST['user_id'];
                $data =  $userdetails->getUserDetails($id);
                return $data;
                break;
        }
    }
}
