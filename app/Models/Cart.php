<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use stdClass;

class Cart extends Model
{
    public $items = [];
    public $totalQuantity;
    public $totalPrice;

    public function __construct($cart = null)
    {
        if ($cart) {
            $this->items = $cart->items;
            $this->totalQuantity = $cart->totalQuantity;
            $this->totalPrice = $cart->totalPrice;
        } else {
            $this->items = [];
            $this->totalQuantity = 0;
            $this->totalPrice = 0;
        }
    }

    public function add($product, $quantity)
    {
        $item = new stdClass();
        $item->id = $product->id;
        $item->name = $product->name;
        $item->image = $product->first_image;
        $item->price = $product->price;
        $item->quantity = 0;

        if (!array_key_exists($product->id, $this->items)) {
            $this->items[$product->id] = $item;
            $this->totalQuantity += $quantity;
            $this->totalPrice += ( $product->price * $quantity );
        } else {
            $this->totalQuantity += $quantity;
            $this->totalPrice += ( $product->price * $quantity );
        }

        $this->items[$product->id]->quantity += $quantity;
    }

    public function remove($id)
    {
        if (array_key_exists($id, $this->items)) {
            $this->totalQuantity -= $this->items[$id]->quantity;
            $this->totalPrice -= $this->items[$id]->quantity * $this->items[$id]->price;
            unset($this->items[$id]);
        }
    }

    public function updateCart($id, $quantity)
    {
        $this->totalQuantity -= $this->items[$id]->quantity ;
        $this->totalPrice -= $this->items[$id]->price * $this->items[$id]->quantity   ;
        $this->items[$id]->quantity = $quantity;
        $this->totalQuantity += $quantity ;
        $this->totalPrice += $this->items[$id]->price * $quantity;
    }
}
