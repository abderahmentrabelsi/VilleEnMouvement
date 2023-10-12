@extends('layouts/contentLayoutMaster')

@section('title', 'WishList')

@section('vendor-style')
  <!-- Vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
<!-- Wishlist Starts -->
<section id="wishlist" class="grid-view wishlist-items">
    @foreach($wishlistItems as $item)
        <div class="card ecommerce-card">
            <div class="item-img text-center">
                <a href="{{url('app/ecommerce/details')}}">
                    <img src="{{asset('images/pages/eCommerce/1.png')}}" class="img-fluid" alt="img-placeholder" />
                </a>
            </div>
            <div class="card-body">
                <div class="item-wrapper">
                    <div class="item-rating">
                        <ul class="unstyled-list list-inline">
                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                        </ul>
                    </div>
                    <div class="item-cost">
                        <h6 class="item-price">${{ $item->price }}</h6>
                    </div>
                </div>
                <div class="item-name">
                    <a href="{{url('app/ecommerce/details')}}">{{ $item->name }}</a>
                </div>
                <p class="card-text item-description">
                    {{ $item->description }}
                </p>
            </div>
            <div class="item-options text-center">
                <button type="button" class="btn btn-light btn-wishlist remove-wishlist">
                    <i data-feather="x"></i>
                    <span>Remove</span>
                </button>
                <button type="button" class="btn btn-primary btn-cart move-cart">
                    <i data-feather="shopping-cart"></i>
                    <span class="add-to-cart">Move to cart</span>
                </button>
            </div>
        </div>
    @endforeach
</section>
<!-- Wishlist Ends -->
@endsection

@section('vendor-script')
  <!-- Vendor js files -->
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-wishlist.js')) }}"></script>
@endsection
