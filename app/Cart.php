<?php

namespace App;


class Cart
{
    public $items = null;
    public $cantidadTotal = 0;
    public $precioTotal = 0;

    public function __construct($oldCart){
        if($oldCart){
            $this->items = $oldCart->items;
            $this->cantidadTotal = $oldCart->cantidadTotal;
            $this->precioTotal = $oldCart->precioTotal;
        }
    }

    public function add($item, $id){
        $itemGuardado = ['cantidad' => 0, 'precio' => $item->precio, 'item' => $item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $itemGuardado = $this->items[$id];
            }
        }
        $itemGuardado['cantidad']++;
        $itemGuardado['precio'] = $item->precio * $itemGuardado['cantidad'];

        $this->items[$id] = $itemGuardado;
        $this->cantidadTotal++;
        $this->precioTotal += $item->precio;
    }

    public function addByQty($item, $id, $qty){
        $storedItem = ['cantidad' => 0, 'precio' => $item->precio, 'item' => $item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }

        $prevQty = $storedItem['cantidad'];
        $prevPrice = $storedItem['precio'];

        $storedItem['cantidad'] = $qty;
        $storedItem['precio'] = $item->precio * $storedItem['cantidad'];
        $this->items[$id] = $storedItem;

        $this->cantidadTotal -= $prevQty;
        $this->cantidadTotal += $storedItem['cantidad'];
        $this->precioTotal -= $prevPrice;
        $this->precioTotal += $storedItem['precio'];
    }

    public function removeItem($id){
        $this->items[$id]['cantidad']--;
        $this->items[$id]['precio'] -= $this->items[$id]['item']['precio'];
        $this->cantidadTotal--;
        $this->precioTotal -= $this->items[$id]['item']['precio'];

        if($this->items[$id]['cantidad'] <= 0){
            unset($this->items[$id]);
        }
    }

    public function resetItem($id){
        $this->cantidadTotal -= $this->items[$id]['cantidad'];
        $this->precioTotal -= $this->items[$id]['precio'];
        unset($this->items[$id]);
    }
}
