@extends('frontend.layouts.app')
@section('content')
<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="{{ route('members.register') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="text" name="name" placeholder="Name"/>
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
							<input type="email" name="email" placeholder="Email Address"/>
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <input type="text" name="phone" placeholder="Phone Number"/>
                            @if($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                            <input type="text" name="address" placeholder="Address"/>                            
                            @if($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                            <select name="id_country">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('id_country'))
                                <span class="text-danger">{{ $errors->first('id_country') }}</span>
                            @endif
							<input type="password" name="password" placeholder="Password"/>
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                            <input type="password" name="password_confirmation" placeholder="Confirm Password"/>
                            @if($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                            <input type="file" name="avatar" placeholder="Avatar"/>
                                @if($errors->has('avatar'))
                                    <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                @endif
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
@endsection