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
                <label class="section-label form-label mb-1">Options</label>
                <div class="coupons input-group input-group-merge">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Coupons"
                    aria-label="Coupons"
                    aria-describedby="input-coupons"
                  />
                  <span class="input-group-text text-primary ps-1" id="input-coupons">Apply</span>
                </div>
                <hr/>
                <div class="price-details">
                  <h6 class="price-title">Price Details</h6>
                  <ul class="list-unstyled">
                    <li class="price-detail">
                      <div class="detail-title">Total MRP</div>
                      <div class="detail-amt">$598</div>
                    </li>
                    <li class="price-detail">
                      <div class="detail-title">Bag Discount</div>
                      <div class="detail-amt discount-amt text-success">-25$</div>
                    </li>
                    <li class="price-detail">
                      <div class="detail-title">Estimated Tax</div>
                      <div class="detail-amt">$1.3</div>
                    </li>
                    <li class="price-detail">
                      <div class="detail-title">EMI Eligibility</div>
                      <a href="#" class="detail-amt text-primary">Details</a>
                    </li>
                    <li class="price-detail">
                      <div class="detail-title">Delivery Charges</div>
                      <div class="detail-amt discount-amt text-success">Free</div>
                    </li>
                  </ul>
                  <hr/>
                  <ul class="list-unstyled">
                    <li class="price-detail">
                      <div class="detail-title detail-total">Total</div>
                      <div class="detail-amt fw-bolder">$574</div>
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
        <form id="checkout-payment" class="list-view product-checkout" onsubmit="return false;">
          <div class="payment-type">
            <div class="card">
              <div class="card-header flex-column align-items-start">
                <h4 class="card-title">Payment options</h4>
                <p class="card-text text-muted mt-25">Be sure to click on correct payment option</p>
              </div>
              <div class="card-body">
                <h6 class="card-holder-name my-75">John Doe</h6>
                <div class="form-check">
                  <input type="radio" id="customColorRadio1" name="paymentOptions" class="form-check-input" checked/>
                  <label class="form-check-label" for="customColorRadio1">
                    US Unlocked Debit Card 12XX XXXX XXXX 0000
                  </label>
                </div>
                <div class="customer-cvv mt-1 row row-cols-lg-auto">
                  <div class="col-3 d-flex align-items-center">
                    <label class="mb-50 form-label" for="card-holder-cvv">Enter CVV:</label>
                  </div>
                  <div class="col-4 p-0">
                    <input type="password" class="form-control mb-50 input-cvv" name="input-cvv" id="card-holder-cvv"/>
                  </div>
                  <div class="col-3">
                    <button type="button" class="btn btn-primary btn-cvv mb-50">Continue</button>
                  </div>
                </div>
                <hr class="my-2"/>
                <ul class="other-payment-options list-unstyled">
                  <li class="py-50">
                    <div class="form-check">
                      <input type="radio" id="customColorRadio2" name="paymentOptions" class="form-check-input"/>
                      <label class="form-check-label" for="customColorRadio2"> Credit / Debit / ATM Card </label>
                    </div>
                  </li>
                  <li class="py-50">
                    <div class="form-check">
                      <input type="radio" id="customColorRadio3" name="paymentOptions" class="form-check-input"/>
                      <label class="form-check-label" for="customColorRadio3"> Net Banking </label>
                    </div>
                  </li>
                  <li class="py-50">
                    <div class="form-check">
                      <input type="radio" id="customColorRadio4" name="paymentOptions" class="form-check-input"/>
                      <label class="form-check-label" for="customColorRadio4"> EMI (Easy Installment) </label>
                    </div>
                  </li>
                  <li class="py-50">
                    <div class="form-check">
                      <input type="radio" id="customColorRadio5" name="paymentOptions" class="form-check-input"/>
                      <label class="form-check-label" for="customColorRadio5"> Cash On Delivery </label>
                    </div>
                  </li>
                </ul>
                <hr class="my-2"/>
                <div class="gift-card mb-25">
                  <p class="card-text">
                    <i data-feather="plus-circle" class="me-50 font-medium-5"></i>
                    <span class="align-middle">Add Gift Card</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="amount-payable checkout-options">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Price Details</h4>
              </div>
              <div class="card-body">
                <ul class="list-unstyled price-details">
                  <li class="price-detail">
                    <div class="details-title">Price of 3 items</div>
                    <div class="detail-amt">
                      <strong>$699.30</strong>
                    </div>
                  </li>
                  <li class="price-detail">
                    <div class="details-title">Delivery Charges</div>
                    <div class="detail-amt discount-amt text-success">Free</div>
                  </li>
                </ul>
                <hr/>
                <ul class="list-unstyled price-details">
                  <li class="price-detail">
                    <div class="details-title">Amount Payable</div>
                    <div class="detail-amt fw-bolder">$699.30</div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </form>
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
@endsection
