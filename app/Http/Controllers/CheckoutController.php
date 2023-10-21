<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponType;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
  public function index()
  {
    $user = Auth::user();
    $user->createOrGetStripeCustomer();

    $cartItems = $user->cart;

    $cartTotal = $cartItems->reduce(function ($carry, $item) {
      return $carry + $item->price;
    }, 0);


    $maxDiscount = Coupon::max('value') ?? 30;

    $pageConfigs = [
      'pageClass' => 'ecommerce-application',
    ];

    $breadcrumbs = [
      ['link' => "/", 'name' => "Home"], ['name' => "Checkout"]
    ];

    return view('/content/apps/ecommerce/app-ecommerce-checkout', [
      'pageConfigs' => $pageConfigs,
      'breadcrumbs' => $breadcrumbs,
      'cartItems' => $cartItems,
      'cartTotal' => $cartTotal,
      'maxDiscount' => $maxDiscount,
    ]);
  }


  public function start_session(Request $request)
  {
    $user = Auth::user();

    $user->createOrGetStripeCustomer();
    $couponCode = $request->session()->get('applied_coupon');
    $coupon = Coupon::where('code', $couponCode)->first();

    if ($couponCode && !$coupon) {
      $request->session()->forget('applied_coupon');
      return redirect()->back()->with('error', 'Invalid coupon code');
    }

    $total = Auth::user()->cart()->sum('price');

    $total = $couponCode && $coupon
      ? $coupon->discount_type == CouponType::Percentage
        ? $total * (1 - $coupon->value / 100)
        : $total - $coupon->value
      : $total;

    $session = Auth::user()->checkoutCharge($total * 100, 'VilleEnMouvement Rides', 1, [
      'success_url' => url('/'),
      'cancel_url' => url('/'),
    ]);

    $order = new Order();
    $order->buyer()->associate($user);
    $order->payment_intent_id = $session->id;
    $order->status = 'pending';

    foreach ($user->cart as $item) {
      $order->products()->attach($item->id, ['quantity' => 1]);
    }
    $order->save();
    return redirect($session->url, 303);
  }

  public function applyDiscount(Request $request)
  {
    if ($request->session()->has('applied_coupon')) {
      return $this->jsonErrorResponse('A coupon has already been applied');
    }

    $code = $request->input('code');
    $discount = Coupon::where('code', $code)->first();

    if (!$discount) {
      return $this->jsonErrorResponse('Invalid discount code');
    }

    if ($discount->isExpired()) {
      return $this->jsonErrorResponse('Discount code has expired');
    }

    $total = Auth::user()->cart()->sum('price');
    $newTotal = $discount->discount_type == CouponType::Percentage
      ? $total * (1 - $discount->value / 100)
      : $total - $discount->value;

    $request->session()->put('applied_coupon', $code);  // Store the applied coupon in the session

    return response()->json([
      'success' => true,
      'newTotal' => $newTotal,
      'discountAmount' => $total - $newTotal
    ]);
  }

  private function jsonErrorResponse($message)
  {
    return response()->json([
      'success' => false,
      'error' => $message
    ]);
  }

  public function removeDiscount(Request $request)
  {
    $request->session()->forget('applied_coupon');
    return response()->json([
      'success' => true,
    ]);
  }
}
