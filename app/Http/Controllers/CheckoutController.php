<?php

namespace LaravelCommerce\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use LaravelCommerce\Events\CheckoutEvent;
use LaravelCommerce\Http\Requests;
use LaravelCommerce\Http\Controllers\Controller;
use LaravelCommerce\Order;
use LaravelCommerce\OrderItem;

class CheckoutController extends Controller
{


    public function place(Order $order, OrderItem $orderItem)
    {
        if (!Session::has('cart')) {

            return false;
        }
            $cart = Session::get('cart');

            if($cart->getTotal() > 0){

                $order = $order->create(['user_id' => Auth::user()->id, 'total' => $cart->getTotal(), 'status' => 0]);

                foreach ($cart->all() as $k => $item) {

                    $order->items()->create([
                        'product_id' => $k,
                        'price' => $item['price'],
                        'qtd' => $item['qtd']
                    ]);
                }

                $cart->clear();

                event(new CheckoutEvent(Auth::user(), $order));

                return view('store.checkout', compact('order'));

            } else {
                return redirect()->route('cart');
            }
        }

}
