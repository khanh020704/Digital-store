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