<?php

use Phalcon\Mvc\Model;

class Product
{
    public $id;
    public $name;
    public $price;
    public function __construct(string $id, string $name, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }
}
