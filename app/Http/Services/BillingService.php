<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Http\Controllers\PaymentController;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Exception\ApiErrorException;

class BillingService
{

    public function __construct(protected $user)
    {
    }

    public function ensureStripeCustomerExists()
    {
        return $this->user->createOrGetStripeCustomer();
    }

    public function listPaymentMethods()
    {
        return $this->user->paymentMethods();
    }

    public function attachPaymentMethod($paymentMethodId)
    {
        $this->user->addPaymentMethod($paymentMethodId);
    }

    public function detachPaymentMethod($paymentMethodId)
    {
        $this->user->removePaymentMethod($paymentMethodId);
    }

    public function createCheckoutSession($cart, $discountCoupon = null)
    {
        $lineItems = $this->prepareLineItems($cart);

        $params = [
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ];

        if ($discountCoupon) {
            $params['discounts'] = [[
                'coupon' => $discountCoupon,
            ]];
        }

        try {
            $session = StripeSession::create($params, ['stripe_account' => $this->user->stripe_account]);
            return $session->id;
        } catch (ApiErrorException $e) {
            // Handle error
            throw new \Exception("Error creating checkout session: " . $e->getMessage());
        }
    }

    protected function prepareLineItems($cart)
    {
        $lineItems = [];
        foreach ($cart->items as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        }
        return $lineItems;
    }
}
