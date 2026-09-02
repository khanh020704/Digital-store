@extends('frontend.layouts.app')
@section('sidebar')
@include('frontend.layouts.menu-account')
<div class="col-sm-9">
   
					<div class="blog-post-area">
						<h2 class="title text-center">Create Product</h2>
						 <div class="signup-form"><!--sign up form-->
						<h2>Product Information</h2>
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
						<form action="{{ route('account.add-product.submit') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="text" name="name" placeholder="Name"/>
							<input type="number" name="price" placeholder="Price"/>
							<select name="id_category" class="form-control" >
                                <option value="">Please choose category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <select name="id_brand" class="form-control" >
                                <option value="">Please choose brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            <select name="status" id="status" class="form-control">
                                <option value="0">New</option>
                                <option value="1">Sale</option>
                            </select>
                            <input type="number" name="sale" id="sale_box" placeholder="Sale %" style="display: none;"/>
                            <input type="text" name="company" placeholder="Company profile"/>

                            <input type="file" name="image[]" multiple class="form-control">

                            <textarea name="detail" placeholder="Detail"></textarea>
							<button type="submit" class="btn btn-default">Create Product</button>
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

