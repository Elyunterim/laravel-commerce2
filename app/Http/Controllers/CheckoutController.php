<?php

namespace LaravelCommerce\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use LaravelCommerce\Events\CheckoutEvent;
use LaravelCommerce\Http\Requests;
use LaravelCommerce\Http\Controllers\Controller;
use LaravelCommerce\Order;
use LaravelCommerce\OrderItem;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Purchases\Subscriptions\Locator;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

class CheckoutController extends Controller
{


    public function place(Order $order, OrderItem $orderItem, CheckoutService $checkoutService)
    {
        if (!Session::has('cart')) {

            return false;
        }
            $cart = Session::get('cart');

            if($cart->getTotal() > 0){

                $checkout = $checkoutService->createCheckoutBuilder();

                $transactionReference = md5(Auth::user()->id ."_" . date("Ymd His") . "_" . $cart->getTotal());

                $order = $order->create([
                    'user_id' => Auth::user()->id,
                    'total' => $cart->getTotal(),
                    'status' => 1,
                    'payment_transaction_reference' => $transactionReference
                ]);

                foreach ($cart->all() as $k => $item) {

                    $order->items()->create([
                        'product_id' => $k,
                        'price' => $item['price'],
                        'qtd' => $item['qtd']
                    ]);

                    $checkout->addItem(new Item($k, $item['name'], number_format($item['price'],2,'.', ''), $item['qtd']));
                }

                $cart->clear();

                event(new CheckoutEvent(Auth::user(), $order));

                $checkout->setReference($transactionReference);

                $checkout->setRedirectTo(route('transaction.return',['transaction_reference' => $transactionReference]));

                $response = $checkoutService->checkout($checkout->getCheckout());

                return redirect($response->getRedirectionUrl());

            } else {
                return redirect()->route('cart');
            }
        }

        public function transactionReturn(Order $order, Request $request)
        {
            //Consulta no PagSeguro o status da transação
            $transactionStatus = $this->transactionStatus($request->transaction_id);

            $order->where('payment_transaction_reference', $request->transaction_reference)->update([

                'payment_transaction_code' => $request->transaction_id,
                'status' => $transactionStatus
            ]);

            return redirect()->route('account.orders');

        }

        public function transactionNotification(Order $order, Request $request, Locator $service)
        {
            $notificationType = $request->notificacationType;
            $notificationCode = $request->notificationCode;

            if($notificationType == 'transaction'){
                $transactionDetails = $service->getByNotification($notificationCode)->getDetails();

                if($transactionDetails->getStatus() != 4){
                    $order->where('payment_transaction_code', $transactionDetails->getCode())->update([
                        'status' => $transactionDetails->getStatus()
                    ]);
                }
            }

        }

        public function transactionStatus($code)
        {
            $service = App::make('Locator');

            $transactionStatus = $service->getByCode($code)->getDetails()->getStatus();

            if($transactionStatus == 4){
                $transactionStatus = 3;
            }

            return $transactionStatus;
        }
}
