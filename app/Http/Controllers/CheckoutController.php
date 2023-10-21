<?php

namespace App\Http\Controllers;

use App\Http\Services\BillingService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
//        $billingService = new BillingService(Auth::user());
//
//        $billingService->ensureStripeCustomerExists();
//
//        $paymentMethods = $billingService->listPaymentMethods();

        $pageConfigs = [
            'pageClass' => 'ecommerce-application',
        ];

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Checkout"]
        ];

        return view('/content/apps/ecommerce/app-ecommerce-checkout', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
//            'paymentMethods' => $paymentMethods
        ]);
    }
}
