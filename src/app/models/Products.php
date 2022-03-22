<?php

use Phalcon\Mvc\Model;

class Products extends Model
{
    public $name;
    public $brand;
    public $price;
    public $discount;
    public $type;
    public $image;
    public $description;

    public function getProducts()
    {
        $data = Products::find();
        return json_encode($data);
    }
    public function getProduct($sku)
    {
        $data = Products::findFirst($sku);
        return json_encode($data);
    }
    public function getFilterProducts($val)
    {
        $data = Products::find([
            'conditions' => "type = '$val'"
        ]);
        return json_encode($data);
    }
    public function addProduct($name, $brand, $category, $price, $discount, $description)
    {
        $product = new Products();
        $product->name = $name;
        $product->brand = $brand;
        $product->type = $category;
        $product->price = $price;
        $product->discount = $discount;
        $product->image = '../public/assets/img/demopic/3.jpg';
        $product->description = $description;

        $result =  $product->save();
        return json_encode($result);
    }

    public function deleteProduct($id)
    {
        $product = products::findFirst($id);
        $result =  $product->delete();
        return json_encode($result);
    }
    public function updateProduct($id, $name, $brand, $category, $price, $discount)
    {
        $product = products::findFirst($id);
        $product->name = $name;
        $product->brand = $brand;
        $product->type = $category;
        $product->price = $price;
        $product->discount = $discount;
        $result = $product->save();
        return json_encode($result);
    }
}
