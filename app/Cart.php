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
}
