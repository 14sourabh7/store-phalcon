<?php


use Phalcon\Mvc\Controller;

class OrderController extends Controller
{
    public function indexAction()
    {
    }

    /**
     * order operations
     *
     * @return void
     */
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



    /**
     * cart page
     *
     * @return void
     */
    public function cartAction()
    {
    }

    /**
     * cartoperations
     *
     * @return void
     */
    public function cartoperationAction()
    {
        $this->session->start();
        $cart = new \App\Components\Cart();
        $action = $this->request->getPost()['action'];
        switch ($action) {
            case 'add':
                if (!$this->session->get('cart')) {
                    $tempArr = array();
                    // $_SESSION['cart'] = json_encode($tempArr);
                    $this->session->set('cart', json_encode($tempArr));
                }
                $id = $this->request->getPost()['id'];
                $name = $this->request->getPost()['name'];
                $price = $this->request->getPost()['price'];
                $cart->setCart(json_decode($this->session->get('cart')));
                $product = new \App\Components\Product($id, $name, $price);
                $cart->addToCart($product);
                // $_SESSION['cart'] = json_encode($cart->getCart());
                $this->session->set('cart', json_encode($cart->getCart()));
                return ($this->session->get('cart'));
            case 'get':
                return $this->session->get('cart');
                break;
            case 'increase':
                $id = $this->request->getPost()['id'];
                $cart->setCart(json_decode($this->session->get('cart')));
                $cart->increaseQuantity($id);
                // $_SESSION['cart'] = json_encode($cart->getCart());
                $this->session->set('cart', json_encode($cart->getCart()));
                return ($this->session->get('cart'));
                break;
            case 'decrease':
                $id = $this->request->getPost()['id'];
                $cart->setCart(json_decode($this->session->get('cart')));
                $cart->decreaseQuantity($id);
                // $_SESSION['cart'] = json_encode($cart->getCart());
                $this->session->set('cart', json_encode($cart->getCart()));
                return ($this->session->get('cart'));
                break;
            case 'delete':
                $id = $this->request->getPost()['id'];
                $cart->setCart(json_decode($this->session->get('cart')));
                $cart->deleteProduct($id);
                // $_SESSION['cart'] = json_encode($cart->getCart());
                $this->session->set('cart', json_encode($cart->getCart()));
                return ($this->session->get('cart'));
                break;
            case 'empty':
                $cart->setCart(json_decode($this->session->get('cart')));
                $cart->clearCart();
                // $_SESSION['cart'] = json_encode($cart->getCart());
                $this->session->set('cart', json_encode($cart->getCart()));
                return ($this->session->get('cart'));
                break;
        }
    }


    /**
     * checkout page
     *
     * @return void
     */
    public function checkoutAction()
    {
    }

    /**
     * checkout operations
     *
     * @return void
     */
    public function checkoutoperationAction()
    {
        $userdetails = new Userdetails();
        $action = $this->request->getPost()['action'];
        switch ($action) {
            case 'getUserDetails':
                $id = $this->request->getPost()['id'];
                $data =  $userdetails->getUserDetails($id);
                return $data;
                break;
        }
    }

    public function confirmAction()
    {
    }
}
