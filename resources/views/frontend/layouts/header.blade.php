<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="{{ route('frontend.index') }}"><img src="{{ asset('images/home/logo.png') }}" alt="" /></a>
						</div>
						<div class="btn-group pull-right clearfix">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canada</a></li>
									<li><a href="">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canadian Dollar</a></li>
									<li><a href="">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								@if(Auth::check() && Auth::user()->level == 0)
    <li><a href="{{ route('account.products') }}"><i class="fa fa-user"></i> Account</a></li>
@endif
								<li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
								
								<li><a href="{{ route('checkout.order') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="{{ route('frontend.account.cart') }}"><i class="fa fa-shopping-cart"></i> Cart (<span id="cart-count">
								{{ session('cart') ? array_sum(array_column(session('cart'), 'qty')) : 0 }}</span>)</a></li>

								@if(Auth::check())
									<li>
										<a href="{{ route('members.logout') }}"
										   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
											<i class="fa fa-lock"></i> Logout

										</a>
										<form id="logout-form" action="{{ route('members.logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
									</li>
								
								@else
									<li><a href="{{ route('members.login') }}"><i class="fa fa-lock"></i> Login</a></li>
									<li><a href="{{ route('members.register') }}"><i class="fa fa-user"></i> Register</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ route('frontend.index') }}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="">Products</a></li>
										<li><a href="">Product Details</a></li> 
										<li><a href="">Checkout</a></li> 
										<li><a href="">Cart</a></li> 
										@if(!Auth::check())
											<li><a href="{{ route('members.login') }}">Login</a></li>
										@endif	
                                    </ul>
                                </li> 
								<li class="dropdown">
    <a href="{{ route('blog.index') }}">Blog<i class="fa fa-angle-down"></i></a>
    <ul role="menu" class="sub-menu">
        <li><a href="{{ route('blog.index') }}">Blog List</a></li>
        <li><a href="{{ route('blog.show', 1) }}">Blog Single</a></li>
    </ul>
</li>
								<li><a href="404.html">404</a></li>
								<li><a href="contact-us.html">Contact</a></li>
								<li><a href="{{ route('search.advanced') }}">Search advanced</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<form action="{{ route('search.product') }}" method="GET">
								<input type="text" name="keyword" placeholder="Search"/>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->