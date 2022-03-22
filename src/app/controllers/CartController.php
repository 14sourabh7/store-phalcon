<?php
session_start();

use Phalcon\Mvc\Controller;


class CartController extends Controller
{
    public function indexAction()
    {
    }
    public function operationAction()
    {
        $cart = new Cart();
        $action = $this->request->getPost()['action'];
        switch ($action) {
            case 'add':
                if (!isset($_SESSION['cart'])) {
                    $tempArr = array();
                    $_SESSION['cart'] = json_encode($tempArr);
                }

                $cart->setCart(json_decode($_SESSION['cart']));
                $product = new Product($_POST['id'], $_POST['name'], $_POST['price']);
                $cart->addToCart($product);
                $_SESSION['cart'] = json_encode($cart->getCart());
                return ($_SESSION['cart']);
            case 'get':
                return ($_SESSION['cart']);
                break;
            case 'increase':
                $cart->setCart(json_decode($_SESSION['cart']));
                $cart->increaseQuantity($_POST['id']);
                $_SESSION['cart'] = json_encode($cart->getCart());
                return ($_SESSION['cart']);
                break;
            case 'decrease':
                $cart->setCart(json_decode($_SESSION['cart']));
                $cart->decreaseQuantity($_POST['id']);
                $_SESSION['cart'] = json_encode($cart->getCart());
                return ($_SESSION['cart']);
                break;
            case 'delete':
                $cart->setCart(json_decode($_SESSION['cart']));
                $cart->deleteProduct($_POST['id']);
                $_SESSION['cart'] = json_encode($cart->getCart());
                return ($_SESSION['cart']);
                break;
            case 'empty':
                $cart->setCart(json_decode($_SESSION['cart']));
                $cart->clearCart();
                $_SESSION['cart'] = json_encode($cart->getCart());
                return ($_SESSION['cart']);
                break;
        }
    }
}
