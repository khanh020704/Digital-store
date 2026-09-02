@extends('frontend.layouts.app')
@section('content')
@include('frontend.layouts.menu-left')
    <div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
                        @foreach ($blogs as $item)
						<div class="single-blog-post">
							<h3>{{ $item->title }}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i></li>
									<li><i class="fa fa-clock-o"></i> {{ $item->created_at->format('g:i A') }}</li>
									<li><i class="fa fa-calendar"></i> {{ $item->created_at->format('M j, Y') }}</li>
								</ul>
								<span>
										<i class="fa fa-star"> </i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
								</span>
							</div>
							<a href="{{ route('blog.show', $item->id) }}">
								<img src="{{ asset('storage/' . $item->image) }}" width="100">
							</a>
							<p>{{ ($item->content) }}</p>
							<a  class="btn btn-primary" href="{{ route('blog.show', $item->id) }}">Read More</a>
						</div>
                        @endforeach
						<div class="pagination-area">
                            {!! $blogs->links('pagination::bootstrap-4') !!}
                        </div>
					</div>
				</div>
@endsection

