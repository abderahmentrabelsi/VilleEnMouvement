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
    @foreach ($wishlistItems as $item)
        <div class="card ecommerce-card">
            <div class="item-img text-center">
                <a href="{{ $item->product ? route('product.details', ['product' => $item->product->id]) : '#' }}">
                    <img src="{{ $item->product ? asset('images/pages/eCommerce/' . $item->product->image) : '#' }}" class="img-fluid" alt="img-placeholder" />
                </a>
            </div>
            <div class="card-body">
                <div class="item-wrapper">
                    <div class="item-rating">
                        @if ($item->product)
                            @for ($i = 1; $i <= $item->product->rating; $i++)
                                <i data-feather="star" class="filled-star"></i>
                            @endfor
                            @for ($i = 1; $i <= 5 - $item->product->rating; $i++)
                                <i data-feather="star" class="unfilled-star"></i>
                            @endfor
                        @endif
                    </div>
                    <div class="item-cost">
                        <h6 class="item-price">${{ $item->product ? $item->product->price : 'N/A' }}</h6>
                    </div>
                </div>
                <div class="item-name">
                    <a href="{{ $item->product ? route('product.details', ['product' => $item->product->id]) : '#' }}">
                        {{ $item->product ? $item->product->name : 'Product Not Found' }}
                    </a>
                </div>
                <p class="card-text item-description">
                    {{ $item->product ? $item->product->description : 'Product Not Found' }}
                </p>
            </div>
            <div class="item-options text-center">
                @if ($item->product)
                    <form method="POST" action="{{ route('wishlist.remove', $item->product) }}">
                        @csrf
                        <button type="submit" class="btn btn-light btn-wishlist remove-wishlist">
                            <i data-feather="x"></i>
                            <span>Remove</span>
                        </button>
                    </form>
                    <form method="POST" action="{{ route('cart.add', $item->product) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-cart move-cart">
                            <i data-feather="shopping-cart"></i>
                            <span class="add-to-cart">Move to cart</span>
                        </button>
                    </form>
                @endif
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
