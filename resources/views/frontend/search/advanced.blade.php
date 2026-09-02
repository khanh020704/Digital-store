@extends('frontend.layouts.app')
@section('sidebar')
    @include('frontend.layouts.menu-left')
@endsection
@section('content')
<div class="features_items"><!--features_items-->
	<h2 class="title text-center">Features Items</h2>
    <div class="filter-bar">
        <form method="GET" action="{{ route('search.advanced') }}">

        <input type="text" name="name" placeholder="Name"
               value="{{ request('name') }}"/>

        <select name="price">
            <option value="">Price</option>
            <option value="0-2000">0-2000</option>
            <option value="2000-500000">2000-500000</option>
        </select>

        <select name="category">
            <option value="">Category</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>

        <select name="brand">
            <option value="">Brand</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>

        <select name="status">
            <option value="">Status</option>
            <option value="0">New</option>
            <option value="1">Sale</option>
        </select>

        <button class="btn btn-warning">Search</button>

        </form>
    </div>
    
    <div class="features_items">
        
        @if($products->count() > 0)

            @foreach($products as $item)

                @php
                    $images = json_decode($item->image, true) ?? [];
                @endphp

                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        
                        <div class="single-products">
                            <div class="productinfo text-center">
                                
                                <img src="{{ asset('upload/product/small/' . ($images[0] ?? 'no-image.png')) }}" alt="" />

                                <h2>${{ number_format($item->price, 0, ',', '.') }}</h2>

                                <p>{{ $item->name }}</p>

                                <a href="#" class="btn btn-default add-to-cart">
                                    <i class="fa fa-shopping-cart"></i>Add to cart
                                </a>

                            </div>

                            <div class="product-overlay">
                                <div class="overlay-content">
                                    <h2>${{ number_format($item->price, 0, ',', '.') }}</h2>
                                    <p>{{ $item->name }}</p>

                                    <a href="#" class="btn btn-default add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-plus-square"></i>Add to wishlist
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('account.details', $item->id) }}">
                                        <i class="fa fa-plus-square"></i>Details
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

            @endforeach

        @else
            <p>Không tìm thấy sản phẩm</p>
        @endif

    </div>

   
    {{ $products->links() }}
</div>


@endsection

