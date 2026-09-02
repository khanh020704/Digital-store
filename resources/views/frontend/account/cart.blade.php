@extends('frontend.layouts.app')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
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
                        @if(session('cart')&& count(session('cart'))>0)
                            @foreach(session('cart') as $id => $item)
						<tr data-id="{{ $id }}">
							<td class="cart_product">
								 <img src="{{ asset('upload/product/small/'.$item['image']) }}" width="70">
							</td>
							<td class="cart_description">
								<h4>{{ $item['name'] }}</h4>
								<p>ID: {{$id}}</p>
							</td>
							<td class="cart_price">
								<p>${{ $item['price'] }}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a href="javascript:void(0)" class="cart_quantity_up">+</a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{ $item['qty'] }}" autocomplete="off" size="2">
									<a href="javascript:void(0)" class="cart_quantity_down">-</a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">${{ $item['price'] * $item['qty'] }}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
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
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
                            @php
                                $totalAll=0;
                                if(session('cart')){
                                    foreach(session('cart') as $item){
                                        $totalAll += $item['price'] * $item['qty'];
                                    }
                                }
                            @endphp
							<li>Cart Sub Total <span id="sub-total">${{$totalAll}}</span></li>
							@php
    							$ecoTax = $totalAll * 0.02;
							@endphp
							<li>Eco Tax <span id = "eco-tax">${{$ecoTax ?? 2}}</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span id="cart-total">${{$totalAll + $ecoTax}}</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="{{ route('checkout.page') }}">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
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
