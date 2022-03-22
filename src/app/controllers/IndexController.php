<?php

use Phalcon\Mvc\Controller;


class IndexController extends Controller
{
    public function indexAction()
    {
        $this->view->users = Users::find();
    }
    public function operationAction()
    {
        $product = new Products();
        $action = $_POST['action'];
        switch ($action) {
            case 'getFilterProducts':
                return $_POST['filter'] == 'All' ? $product->getProducts() : $product->getFilterProducts($_POST['filter']);
                break;
            case 'getProducts':
                return $product->getProducts();
                break;
        }
    }
}
