<?php

namespace App\Http\Controllers;

use App\Http\Services\BillingService;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $billingService = new BillingService(Auth::user());

        $billingService->ensureStripeCustomerExists();

        $paymentMethods = $billingService->listPaymentMethods();

        $pageConfigs = [
            'pageClass' => 'ecommerce-application',
        ];

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Checkout"]
        ];

        return view('/content/apps/ecommerce/app-ecommerce-checkout', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'paymentMethods' => $paymentMethods
        ]);
    }


    public function start_session(Request $request)
    {
        $user = Auth::user();

        $billingService = new BillingService($user);

        $billingService->ensureStripeCustomerExists();

        $products = [
            [
                "name" => "Product 1",
                "unit_amount" => 1000,
                "quantity" => 1,
            ]
        ];

        $session = $billingService->createCheckoutSession($products);

        return redirect($session->url, 303);
    }
}
