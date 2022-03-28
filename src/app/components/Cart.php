<?php

namespace App\Components;

class Cart
{
    private $cart;

    public function __construct()
    {
        $this->cart = array();
    }

    /**
     * addToCart
     * function to add product to cart
     *
     * @param Product $product
     * @return void
     */

    public function addToCart(Product $product)
    {

        if (!$this->productExist($product)) {
            $product->quantity = 1;
            array_push($this->cart, $product);
        }
    }


    /**
     * productExist
     * function to check if product already exist.
     * if exists increase quantity by 1
     *
     * @param Product $product
     * @return void
     */
    public function productExist(Product $product)
    {
        foreach ($this->cart as $k => $v) {
            if ($v->id == $product->id) {
                $this->cart[$k]->quantity += 1;
                return true;
            }
        }
        return false;
    }

    /**
     * increaseQuantity
     * function to increase quantity by 1
     *
     * @param [type] $id
     * @return void
     */
    public function increaseQuantity($id)
    {
        $this->cart[$id]->quantity += 1;
    }



    /**
     * decreaseQuantity
     * function to decrease quantity by 1
     *
     * @param [type] $id
     * @return void
     */
    public function decreaseQuantity($id)
    {
        $this->cart[$id]->quantity -= 1;
        if ($this->cart[$id]->quantity < 1) {
            array_splice($this->cart, $id, 1);
        }
    }

    /**
     * deleteProduct
     * function to delete specific product from cart
     *
     * @param [type] $id
     * @return void
     */
    public function deleteProduct($id)
    {
        array_splice($this->cart, $id, 1);
    }

    /**
     * clearCart
     * function to clear cart
     *
     * @return void
     */
    public function clearCart()
    {
        $this->cart = array();
    }

    /**
     * setCart
     *
     * @param [type] $array
     * @return void
     */
    public function setCart($array)
    {
        $this->cart = $array;
    }

    /**
     * getCart
     *function to return cart array
     * @return array
     */
    public function getCart()
    {
        return $this->cart;
    }
}
