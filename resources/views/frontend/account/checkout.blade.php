@extends('frontend.layouts.app')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Step1</h2>
                @if(!Auth::check())
                <div class="alert alert-warning">
                    ⚠️ Vui lòng đăng ký tài khoản để đặt hàng
                </div>

                <div class="signup-form">
                    <form action="{{ route('members.register') }}" method="POST" enctype="multipart/form-data">
                        @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $err)
            <p>{{ $err }}</p>
        @endforeach
    </div>
@endif
                        @csrf

                        <input type="text" name="name" placeholder="Name"/>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror

                        <input type="email" name="email" placeholder="Email"/>
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                        <input type="text" name="phone" placeholder="Phone"/>
                        <input type="text" name="address" placeholder="Address"/>

                        <select name="id_country">
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>

                        <input type="password" name="password" placeholder="Password"/>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password"/>
                        <input type="file" name="avatar" placeholder="Avatar"/>              
						<button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div>
            @endif
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@php 
        					$total = 0;
    					@endphp
						
						@if(session('cart'))
        					@foreach(session('cart') as $id => $item)
            			@php
                			$sub = $item['price'] * $item['qty'];
                			$total += $sub;
    					@endphp
						<tr data-id="{{ $id }}">
							<td class="cart_product">
								<a href=""><img src="{{ asset('upload/product/small/'.$item['image']) }}" width="80"></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $item['name'] }}</a></h4>
								<p> ID: {{ $id }}</p>
							</td>
							<td class="cart_price">
								<p>${{ number_format($item['price']) }}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a href="javascript:void(0)" class="cart_quantity_up"> + </a>
									<input class="cart_quantity_input" type="text" value="{{ $item['qty'] }}" autocomplete="off" size="2">
									<a href="javascript:void(0)" class="cart_quantity_down"> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">${{ number_format($sub) }}</p>
							</td>
							<td class="cart_delete">
								<a href="javascript:void(0)" class="cart_quantity_delete">></a>
							</td>
						</tr>
						  @endforeach
    					@else
						<tr>
    						<td colspan="6" style="text-align:center">
        						🛒 Cart is empty
    						</td>
						</tr>
						@endif

						@php
        					$ecoTax = $total * 0.02; // fix cứng như bạn đang dùng
        					$grandTotal = $total + $ecoTax;
    					@endphp
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td id="sub-total">${{ number_format($total) }}</td>
									</tr>
									<tr>
										<td>Exo Tax</td>
										<td id="eco-tax">${{ number_format($ecoTax) }}</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span id="cart-total">${{ number_format($grandTotal) }}</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="payment-options">
    <form action="{{ route('checkout.order') }}" method="POST">
        @csrf

        <label><input type="radio" name="payment" value="bank"> Bank</label>
        <label><input type="radio" name="payment" value="check"> Check</label>
        <label><input type="radio" name="payment" value="paypal"> Paypal</label>

        <div style="margin-top:20px;">
            @if(Auth::check())           
                <button class="btn btn-success">Đặt hàng</button>
            @else
                <button type="button" class="btn btn-danger">
                    Vui lòng đăng ký để đặt hàng
                </button>
            @endif
        </div>
    </form>
</div>
			
        
        </div>

		</div>
	</section> <!--/#cart_items-->
	@section('rate-script')
   <script>
$(document).ready(function () {

    $(document).on('click', '.cart_quantity_up', function (e) {
        e.preventDefault();

        let row = $(this).closest('tr');
        let id = row.data('id');

        updateCart(id, 'up', row);
    });

    $(document).on('click', '.cart_quantity_down', function (e) {
        e.preventDefault();

        let row = $(this).closest('tr');
        let id = row.data('id');

        updateCart(id, 'down', row);
    });

    $(document).on('click', '.cart_quantity_delete', function (e) {
        e.preventDefault();

        let row = $(this).closest('tr');
        let id = row.data('id');

        $.post("/cart/delete", {
            id: id,
            _token: $('meta[name="csrf-token"]').attr('content')
        }, function (res) {
            row.remove();
            $('#cart-total').text('$' + res.cartTotal);
            $('#sub-total').text('$' + res.cartTotal);
        });
    });

    function updateCart(id, type, row) {
        $.post("/cart/update", {
            id: id,
            type: type,
            _token: $('meta[name="csrf-token"]').attr('content')
        }, function (res) {
			if(res.delete){
				row.remove();
			}else{
				row.find('.cart_quantity_input').val(res.qty);
            	row.find('.cart_total_price').text('$' + res.itemTotal);
			}
            $('#sub-total').text('$' + res.cartTotal);
			$('#eco-tax').text('$' + res.ecoTax);
            $('#cart-total').text('$' + (res.cartTotal + res.ecoTax));
        });
    }

});
</script>
@endsection
@endsection