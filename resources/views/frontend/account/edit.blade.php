@extends('frontend.layouts.app')
@section('sidebar')
@include('frontend.layouts.menu-account')
<div class="col-sm-9">
   
					<div class="blog-post-area">
						<h2 class="title text-center">Edit Product</h2>
						 <div class="signup-form"><!--sign up form-->
						<h2>Product Information</h2>
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
						<form action="{{ route('account.edit-product.submit', $product->id) }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="text" name="name" placeholder="Name" value="{{ $product->name }}"/>
							<input type="number" name="price" placeholder="Price" value="{{ $product->price }}"/>
							<select name="id_category" class="form-control" >
                                <option value="">Please choose category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->id_category == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <select name="id_brand" class="form-control" >
                                <option value="">Please choose brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $product->id_brand == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            <select name="status" id="status" class="form-control">
                                <option value="0" {{ $product->status == 0 ? 'selected': ''}}>New</option>
                                <option value="1" {{ $product->status == 1 ? 'selected': ''}}>Sale</option>
                            </select>
                            <input type="number" name="sale" id="sale_box" placeholder="Sale %" style="{{ $product->status==1 ? 'display: block': 'display: none;'}}" value="{{ $product->sale }}"/>

                            <input type="text" name="company" placeholder="Company profile" value="{{ $product->company }}"/>

                            <input type="file" name="image[]" multiple class="form-control">
                            @php
                                $images = json_decode($product->image, true);
                            @endphp

                            @if($images)
                                @foreach($images as $img)
                                    <div style="display:inline-block; margin:10px;">
                                        <img src="{{ asset('upload/product/small/'.$img) }}" width="80"><br>
                                        <input type="checkbox" name="delete_images[]" value="{{ $img }}"> 
                                    </div>
                                @endforeach
                            @endif

                            <textarea name="detail" placeholder="Detail">{{ $product->detail }}</textarea>
							<button type="submit" class="btn btn-default">Update Product</button>
						</form>
					</div>
					</div>
</div>
<script>
document.getElementById('status').addEventListener('change', function () {
    let saleBox = document.getElementById('sale_box');

    if (this.value == 1) {
        saleBox.style.display = 'block';
    } else {
        saleBox.style.display = 'none';
        saleBox.value = 0;
    }
});
</script>
@endsection
