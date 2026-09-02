<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/assets/images/favicon.png') }}">

<!-- Custom CSS -->
<link href="{{ asset('admin/assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">

<!-- Custom CSS -->
<link href="{{ asset('admin/dist/css/style.min.css') }}" rel="stylesheet">
</head>

<body>

<div   id="main-wrapper" data-layout="vertical"
     data-navbarbg="skin6"
     data-sidebartype="full"
     data-sidebar-position="fixed"
     dat-theme="light"
     data-boxed-layout="full" > 


    {{-- Header --}}
    @include('admin.layouts.header')

    {{-- Sidebar --}}
    @include('admin.layouts.left-sidebar')

    {{-- Nội dung --}}
  
        @yield('content')


</div>

<script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>

<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('admin/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('admin/assets/extra-libs/sparkline/sparkline.js') }}"></script>

<!--Wave Effects -->
<script src="{{ asset('admin/dist/js/waves.js') }}"></script>

<!--Menu sidebar -->
<script src="{{ asset('admin/dist/js/sidebarmenu.js') }}"></script>

<!--Custom JavaScript -->
<script src="{{ asset('admin/dist/js/custom.min.js') }}"></script>

<!--This page JavaScript -->
<!--chartist chart-->
<script src="{{ asset('admin/assets/libs/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/pages/dashboards/dashboard1.js') }}"></script>

</body>
</html> 