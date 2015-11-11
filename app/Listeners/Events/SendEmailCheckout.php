<?php

namespace LaravelCommerce\Listeners\Events;

use LaravelCommerce\Events\CheckoutEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailCheckout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckoutEvent  $event
     * @return void
     */
    public function handle(CheckoutEvent $event)
    {
        $user = $event->getUser();
        $order = $event->getOrder();

        Mail::send('email.checkout', ['user' => $user, 'order' => $order], function($m) use ($user, $order){
            $m->to($user->email, $user->name)->subject('Seu pedido #'. $order->id . 'foi finalizado');
        });
    }
}
