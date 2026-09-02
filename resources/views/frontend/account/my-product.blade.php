@extends('frontend.layouts.app')
@section('sidebar')
@include('frontend.layouts.menu-account')
<div class="col-sm-9">
					<div class="table-responsive cart_info">
						<table class="table table-condensed">
							<thead>
								<tr class="cart_menu">
                                    <td>ID</td>
                                    <td>Image</td>
									<td>Name</td>
									<td>Price</td>									
									<td>Action</td>
									
								</tr>
							</thead>
							<tbody>
                                @forelse($products as $product)
								<tr>
                                    <td>{{ $product->id }}</td>
                                    <td class="cart_product">
									@php
    									$images = json_decode($product->image, true);
									@endphp
									@if(!empty($images))
										<a href=""><img src="{{ asset('upload/product/small/'.$images[0])}}" alt="{{ $product->name }}"></a>
									@else
    									<img src="{{ asset('frontend/images/home/no-image.png') }}">
									@endif
									</td>
									<td class="cart_description">
										<h4><a href="">{{ $product->name }}</a></h4>
										
									</td>
									<td class="cart_price">
										<p>${{ $product->price }}</p>
									</td>
									
									<td class="cart_total"> 
                                        <div style="display:flex; gap:10px;">
										<a href="{{ route('account.edit-product', $product->id) }}"  class="">Edit</a>
										<form action="{{ route('account.delete-product', $product->id) }}" method="POST" style=" margin:0;" >
											@csrf
											@method('DELETE')
											<button type="submit" onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-sm btn-danger">Delete</button>
										</form>
                                        </div>
									</td>
                                    
									
								</tr>
                                
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No products found. 
                                    </td>
                                </tr>
                                @endforelse

							</tbody>
                          
						</table>                                    
					</div>
                     <div style="margin-bottom: 15px; text-align: right;">
        <a href="{{ route('account.add-product') }}" class="btn btn-primary">
            Add Product
        </a>
    </div>
				</div>
@endsection