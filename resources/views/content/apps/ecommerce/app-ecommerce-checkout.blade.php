@extends('layouts/contentLayoutMaster')

@section('title', 'Checkout')

@section('vendor-style')
  <!-- Vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-number-input.css')) }}">
@endsection

@section('content')
  <div class="bs-stepper checkout-tab-steps">
    <!-- Wizard starts -->
    <div class="bs-stepper-header">
      <div class="step" data-target="#step-cart" role="tab" id="step-cart-trigger">
        <button type="button" class="step-trigger">
        <span class="bs-stepper-box">
          <i data-feather="shopping-cart" class="font-medium-3"></i>
        </span>
          <span class="bs-stepper-label">
          <span class="bs-stepper-title">Cart</span>
          <span class="bs-stepper-subtitle">Your Cart Items</span>
        </span>
        </button>
      </div>
      <div class="line">
        <i data-feather="chevron-right" class="font-medium-2"></i>
      </div>
      <div class="step" data-target="#step-payment" role="tab" id="step-payment-trigger">
        <button type="button" class="step-trigger">
        <span class="bs-stepper-box">
          <i data-feather="credit-card" class="font-medium-3"></i>
        </span>
          <span class="bs-stepper-label">
          <span class="bs-stepper-title">Payment</span>
          <span class="bs-stepper-subtitle">Select Payment Method</span>
        </span>
        </button>
      </div>
    </div>
    <!-- Wizard ends -->

    <div class="bs-stepper-content">
      <!-- Checkout Place order starts -->
      <div id="step-cart" class="content" role="tabpanel" aria-labelledby="step-cart-trigger">
        <div id="place-order" class="list-view product-checkout">
          <!-- Checkout Place Order Left starts -->
          <div class="checkout-items">
            @foreach ($cartItems as $cartItem)
              <div class="card ecommerce-card">
                <div class="item-img">
                  <a href="{{ url('app/ecommerce/details') }}">
                    <img src="{{ asset($cartItem->image_url) }}" alt="img-placeholder"/>
                  </a>
                </div>
                <div class="card-body">
                  <div class="item-name">
                    <h6 class="mb-0"><a href="{{ url('app/ecommerce/details') }}"
                                        class="text-body">{{ $cartItem->name }}</a></h6>
                    <span class="item-company">By <a href="#" class="company-name">{{ $cartItem->brand }}</a></span>
                    <div class="item-rating">
                      <ul class="unstyled-list list-inline">
                        @for ($i = 1; $i <= 5; $i++)
                          <li class="ratings-list-item">
                            <i data-feather="star"
                               class="{{ $i <= $cartItem->rating ? 'filled-star' : 'unfilled-star' }}"></i>
                          </li>
                        @endfor
                      </ul>
                    </div>
                  </div>
                  <span class="text-success mb-1">In Stock</span>
                  <span class="delivery-date text-muted">Delivery by, Wed Apr 25</span>
                </div>
                <div class="item-options text-center">
                  <div class="item-wrapper">
                    <div class="item-cost">
                      <h4 class="item-price">${{ number_format($cartItem->price, 2) }}</h4>
                    </div>
                  </div>
                  <form method="POST" action="{{ route('cart.remove', $cartItem->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-light mt-1 remove-cart">
                      <i data-feather="x" class="align-middle me-25"></i>
                      <span>Remove</span>
                    </button>
                  </form>
                </div>
              </div>
            @endforeach

          </div>
          <!-- Checkout Place Order Left ends -->

          <!-- Checkout Place Order Right starts -->
          <div class="checkout-options">
            <div class="card">
              <div class="card-body">
                <div class="price-details">
                  <h6 class="price-title">Price Details</h6>
                  <ul class="list-unstyled">
                    <li class="price-detail">
                      <div class="detail-title">Total MRP</div>
                      <div class="detail-amt">{{ $cartTotal }}$</div>
                    </li>
                    <li class="price-detail">
                      <div class="detail-title">Discount</div>
                      <div class="detail-amt discount-amt text-success">Up to {{$maxDiscount}}$</div>
                    </li>
                  </ul>
                  <hr/>
                  <ul class="list-unstyled">
                    <li class="price-detail">
                      <div class="detail-title detail-total">Total</div>
                      <div class="detail-amt fw-bolder">{{ $cartTotal }}$</div>
                    </li>
                  </ul>
                  <button type="button" class="btn btn-primary w-100 btn-next place-order">Place Order</button>
                </div>
              </div>
            </div>
            <!-- Checkout Place Order Right ends -->
          </div>
        </div>
        <!-- Checkout Place order Ends -->
      </div>
      <!-- Checkout Payment Starts -->
      <div id="step-payment" class="content" role="tabpanel" aria-labelledby="step-payment-trigger">
        <div class="amount-payable checkout-options">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Price Details</h4>
            </div>
            <div class="card-body">
              <ul class="list-unstyled price-details">
                <li class="price-detail">
                  <div class="details-title">Total</div>
                  <div class="detail-amt">
                    <strong>{{$cartTotal}}$</strong>
                  </div>
                </li>
                <li class="price-detail">
                  <div class="details-title">Discount</div>
                  <div class="detail-amt discount-amt text-success"><span id="discount-amount">N/A</span></div>
                </li>
              </ul>
              <hr/>
              <ul class="list-unstyled price-details">
                <li class="price-detail">
                  <div class="details-title">Amount Payable</div>
                  <div class="detail-amt fw-bolder"><span id="sidebar-total">{{$cartTotal}}$</span></div>
                </li>
              </ul>
            </div>
          </div>
        </div>


        <div class="payment-type">
          <div class="card">
            <div class="card-header flex-column align-items-start">
              <h4 class="card-title">Payment</h4>
            </div>
            <div class="card-body">
              <h6 class="card-holder-name my-75">John Doe</h6>
              <div class="form-check">
                <input type="radio" id="customColorRadio1" name="paymentOptions" class="form-check-input" checked/>
                <label class="form-check-label" for="customColorRadio1">
                  Continue with Stripe
                </label>
              </div>
              <div class="customer-cvv mt-1 row row-cols-lg-auto">
                <div class="col-3 d-flex align-items-center">
                  <label class="mb-50 form-label" for="discount-code">Enter Promo Code:</label>
                </div>
                <div class="col-4 p-0">
                  <input type="text" class="form-control mb-50" name="discount-code" id="discount-code" value="{{ session('applied_coupon', '') }}" {{ session()->has('applied_coupon') ? 'disabled' : '' }}/>
                </div>
                <div class="col-3">
                  <button type="button" class="btn btn-primary btn-cvv mb-50" id="apply-discount" {{ session()->has('applied_coupon') ? 'disabled' : '' }}>Apply</button>
                </div>
                <div class="col-3">
                  <button type="button" class="btn btn-secondary btn-cvv mb-50" id="remove-discount">Remove</button>
                </div>
              </div>
              <hr class="my-2"/>
              <div class="gift-card mb-25">
                <form method="POST" action="{{route("start-checkout-session")}}">
                  @csrf
                  <input type="hidden" name="applied_coupon" id="applied-coupon" value="">
                  <button type="submit" class="btn btn-primary btn-cvv mb-50">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Checkout Payment Ends -->
      <!-- </div> -->
    </div>
  </div>
@endsection

@section('vendor-script')
  <!-- Vendor js files -->
  <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-checkout.js')) }}"></script>
  <script>
    $(document).ready(function () {
      const appliedCoupon = $('#applied-coupon').val();
      if (appliedCoupon) {
        updateDiscountAndTotal(appliedCoupon);
      }

      $('#apply-discount').on('click', function (e) {
        e.preventDefault();
        const discountCode = $('#discount-code').val();
        updateDiscountAndTotal(discountCode);
      });

      $('#remove-discount').on('click', function (e) {
        e.preventDefault();
        $.ajax({
          url: '/checkout/remove-discount',
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            if (response.success) {
              $('#apply-discount').prop('disabled', false);
              $('#discount-code').prop('disabled', false).val('');
              $('#applied-coupon').val('');
              $('#sidebar-total').text(`${response.newTotal}$`);
              $('#discount-amount').text('N/A');
            } else {
              alert(response.error);
            }
          }
        });
      });

      function updateDiscountAndTotal(discountCode) {
        $.ajax({
          url: '/checkout/apply-discount',
          method: 'POST',
          data: {code: discountCode},
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            if (response.success) {
              $('#apply-discount').prop('disabled', true);
              $('#discount-code').prop('disabled', true);
              $('#applied-coupon').val(discountCode);
              $('#sidebar-total').text(`${response.newTotal}$`);
              $('#discount-amount').text(`${response.discountAmount}$`);
            } else {
              alert(response.error);
            }
          }
        });
      }
    });
  </script>
@endsection
