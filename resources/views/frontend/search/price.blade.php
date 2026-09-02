@extends('frontend.layouts.app')

@section('sidebar')
@include('frontend.layouts.menu-left')
@endsection
@section('content')

    <h2 class="title text-center">Features Items</h2>

    <div class="features_items" id="product-list">
        
        @include('frontend.search._product_list', ['products' => $products])
    </div>
    @endsection

@section('rate-script')
<script>
$(document).ready(function() {
    $('#sl2').slider();
   $('#sl2').on('slideStop', function(e) {

    let value = $('#sl2').slider('getValue');

    let min = value[0];
    let max = value[1];

    $.ajax({
        url: '/search/price',
        type: 'GET',
        data: { min: min, max: max },
        success: function(res) {
            $('#product-list').html(res);
        }
    });

});

}); 
</script>
@endsection
