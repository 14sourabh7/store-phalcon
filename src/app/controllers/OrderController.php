<?php

use Phalcon\Mvc\Controller;

class OrderController extends Controller
{
    public function indexAction()
    {
    }
    public function operationAction()
    {
        $order = new Orders();
        $action = $this->request->getPost()['action'];
        switch ($action) {
            case 'placeOrder':
                $user_id = $this->request->getPost()['user_id'];
                $quantity = $this->request->getPost()['quant'];
                $amount = $this->request->getPost()['total'];
                $address = $this->request->getPost()['address'];
                $pin = $this->request->getPost()['pin'];
                $cart = $this->request->getPost()['cart'];
                $status = $this->request->getPost()['status'];
                return $order->placeOrder($user_id, $quantity, $amount, $address, $pin, $cart, $status);
                break;
            case 'getOrders':
                $id = $this->request->getPost()['user_id'];
                return $order->getOrders($id);
                break;
        }
    }
    public function confirmAction()
    {
    }
}
