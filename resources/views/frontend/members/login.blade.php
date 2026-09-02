@extends('frontend.layouts.app')
@section('content')
<section id="form"><!--form-->
        <div class="container">
            <div class="row">
<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="{{ route('members.login') }}" method="POST">
							@csrf							
							<input type="email" name="email" placeholder="Email Address" />
							@if($errors->has('email'))
								<span class="text-danger">{{ $errors->first('email') }}</span>
							@endif
							<input type="password" name="password" placeholder="Password" />
							@if($errors->has('password'))
								<span class="text-danger">{{ $errors->first('password') }}</span>
							@endif
							<span>
								<input type="checkbox" name="member_me" class="checkbox"> 
								Keep me signed in
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
@endsection