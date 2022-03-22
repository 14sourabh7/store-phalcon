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
        $action = $this->request->getPost()['action'];
        switch ($action) {
            case 'getFilterProducts':
                $filter = $this->request->getPost()['filter'];
                return $filter == 'All' ? $product->getProducts() : $product->getFilterProducts($filter);
                break;
            case 'getProducts':
                return $product->getProducts();
                break;
        }
    }
}
