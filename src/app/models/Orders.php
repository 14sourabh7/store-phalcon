<?php

use Phalcon\Mvc\Model;

class Orders extends Model
{
    public $order_id;
    public $user_id;
    public $quantity;
    public $amount;
    public $address;
    public $pin;
    public $cart;
    public $date;
    public $status;

    public function placeOrder($user_id, $quantity, $amount, $address, $pin, $cart, $status)
    {
        $order = new Orders();
        $order->user_id = $user_id;
        $order->quantity = $quantity;
        $order->amount = $amount;
        $order->address = $address;
        $order->pin = $pin;
        $order->cart = $cart;
        $order->status = $status;
        $result =  $order->save();
        return json_encode($result);
    }
    public function getOrders($id)
    {
        $data = Orders::find("user_id = '$id'");
        return json_encode($data);
    }
    public function getAllOrders()
    {
        $data = Orders::find();
        return json_encode($data);
    }
    public function updateOrderStatus($id, $status)
    {
        $order = Orders::findFirst($id);
        $order->status = $status;
        $result = $order->save();
        return json_encode($result);
    }
}
