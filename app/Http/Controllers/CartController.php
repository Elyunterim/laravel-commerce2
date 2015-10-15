<?php

namespace LaravelCommerce\Http\Controllers;

use LaravelCommerce\Cart;
use LaravelCommerce\Http\Requests;
use LaravelCommerce\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(!Session::has('cart')){
            Session::set('cart', $this->cart);
        }
        return view('store.cart', ['cart' => Session::get('cart')]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($id)
    {
        $cart = $this->getCart();
        $product = Product::find($id);

        $cart->add($id, $product->name, $product->price);

        Session::set('cart', $cart);

        return redirect()->route('cart');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $cart = $this->getCart();
        $cart->remove($id);

        Session::set('cart', $cart);

        return redirect()->route('cart');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function change(Request $request)
    {
        try {
            $id = $request->input('id');
            $qtd = $request->input('qtd');

            $cart = $this->getCart();
            $cart->updateQtd($id, $qtd);

            return ['status' => 'success'];

        } catch (\Exception $e) {

            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Get cart
     * @return Cart
     */
    public function getCart()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
        } else {
            $cart = $this->cart;

        }
        return $cart;
    }
}
