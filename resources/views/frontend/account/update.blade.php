@extends('frontend.layouts.app')
@section('sidebar')
   
<section>
    <div class="container">
        <div class="row">
            @include('frontend.layouts.menu-account')

            <div class="col-sm-9">
                <div class="blog-post-area">
                    <h2 class="title text-center">Update Profile</h2>

                    <div class="signup-form">
                        <h2>Update your account</h2>

                        <form method="POST" action="{{ route('account.update.submit') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Name"/>

                            <input type="email" name="email" value="{{ Auth::user()->email }}" readonly placeholder="Email"/>

                            <input type="password" name="password" placeholder="New Password"/>

                            <input type="text" name="phone" value="{{ Auth::user()->phone }}" placeholder="Phone"/>

                            <textarea name="address" placeholder="Address">{{ Auth::user()->address }}</textarea>

                            {{-- COUNTRY --}}
                            <select name="id_country" class="form-control">
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" 
                                        {{ Auth::user()->id_country == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- AVATAR --}}
                            <input type="file" name="avatar" class="form-control">

                            <button type="submit" class="btn btn-default">Update</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection