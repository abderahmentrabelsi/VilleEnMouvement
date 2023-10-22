<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index()
    {
        return Coupon::all();
    }

    public function store(CouponRequest $request)
    {
        return Coupon::create($request->validated());
    }

    public function show(Coupon $coupon)
    {
        return $coupon;
    }

    public function update(CouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->validated());

        return $coupon;
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return response()->json();
    }
}
