<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 06/10/15
 * Time: 21:15
 */

namespace LaravelCommerce;


class Cart {

    /**
     *@var array
     */
    private $items;

    public function __construct()
    {
        $this->items = [];
    }

    /**
     *
     * Add item cart
     * @param $id
     * @param $name
     * @param $price
     * @return array
     */
    public function add($id, $name, $price)
    {
        $this->items += [
            $id => [
                'qtd' => isset($this->items[$id]['qtd']) ? $this->items[$id]['qtd']++ :1,
                'price' => $price,
                'name'  => $name
            ]
        ];
        return $this->items;
    }


    /**
     * Remove item cart
     * @param $id
     */
    public function remove($id)
    {
        unset($this->items[$id]);
    }

    /**
     * List all items cart
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * Get total price of the cart
     * @return int
     */
    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $items) {
            $total += $items['qtd'] * $items['price'];
        }

        return $total;
    }

    /**
     * @param $id
     * @param $qtd
     */
    public function update($id, $qtd)
    {
        if($qtd > 0){
            $this->items[$id]['qtd'] = $qtd;
        }else{
            $this->remove($id);
        }

    }

    /**
     * Clear cart
     */
    public function clear()
    {
        $this->items = [];
    }
}