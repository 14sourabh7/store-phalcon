<?php

use Phalcon\Mvc\Controller;


class ProductController extends Controller
{
    public function indexAction()
    {
    }
    public function getproductAction()
    {
        $product = new Products();
        $sku = $this->request->getPost()['sku'];
        return  $product->getProduct($sku);
    }
}
