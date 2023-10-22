<?php

namespace App\Listeners;

use App\Models\Order;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener
{
  public function handle(WebhookReceived $event): void
  {
    if ($event->payload['type'] === 'checkout.session.completed') {
      $session = $event->payload['data']['object'];
      $order = Order::where('payment_intent_id', $session['id'])->first();
      $order->status = 'completed';
      $order->save();
    }
  }
}
