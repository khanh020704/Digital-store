@extends('frontend.layouts.app')
@section('content')
@include('frontend.layouts.menu-left')
<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						<div class="single-blog-post">
							<h3>{{ $blog->title }}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> {{ $blog->author }}</li>
									<li><i class="fa fa-clock-o"></i> {{ $blog->created_at->format('g:i A') }}</li>
									<li><i class="fa fa-calendar"></i> {{ $blog->created_at->format('M j, Y') }}</li>
								</ul>
								<!-- <span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span> -->
							</div>
							<a href="{{ route('blog.show', $blog->id) }}">
								<img src="{{ asset('storage/' . $blog->image) }}" alt="">
							</a>
							<p>
								{{ $blog->content }}
							</p> <br>

							<p>
								{{ $blog->description }}
                            </p>

							<p>
								Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
							</p>
							<div class="pager-area">
								<ul class="pager pull-right">
                                    @if($previous)
									<li><a href="{{ route('blog.show', $previous->id) }}">Pre</a></li>
									@endif
									@if($next)
									<li><a href="{{ route('blog.show', $next->id) }}">Next</a></li>
									@endif
								</ul>
							</div>
						</div>
					</div><!--/blog-post-area-->

					<div class="rating-area">
						<ul class="ratings rate">
							 <li class="rate-this">Rate this item:</li>

							 <li> 
								<div class="rate">
								<div class="vote">
									<div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
									<div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
									<div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
									<div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
									<div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
									<span class="rate-np">({{ number_format($avg ?? '0.0', 1) }})</span>
								</div> 
							</div>
							</li>

							<li>
								<span class="rate-np">{{ number_format($avg ?? '0.0', 1) }}</span> 
								(<span id="vote-count">{{ $count ?? 0 }}</span> votes)
							</li>
						</ul>
						<ul class="tag">
							<li>TAG:</li>
							<li><a class="color" href="">Pink <span>/</span></a></li>
							<li><a class="color" href="">T-Shirt <span>/</span></a></li>
							<li><a class="color" href="">Girls</a></li>
						</ul>
					</div><!--/rating-area-->

					<div class="socials-share">
						<a href=""><img src="images/blog/socials.png" alt=""></a>
					</div><!--/socials-share-->

					<!-- <div class="media commnets">
						<a class="pull-left" href="#">
							<img class="media-object" src="images/blog/man-one.jpg" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Annie Davis</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							<div class="blog-socials">
								<ul>
									<li><a href=""><i class="fa fa-facebook"></i></a></li>
									<li><a href=""><i class="fa fa-twitter"></i></a></li>
									<li><a href=""><i class="fa fa-dribbble"></i></a></li>
									<li><a href=""><i class="fa fa-google-plus"></i></a></li>
								</ul>
								<a class="btn btn-primary" href="">Other Posts</a>
							</div>
						</div>
					</div> --><!--Comments-->
					<div class="response-area">
						<h2>{{ $comments->count() ?? 0 }} RESPONSES</h2>
						<ul class="media-list">
							@foreach($comments->where('level', 0) as $cmt)
							<li class="media " id="comment-{{ $cmt->id }}">
								
								<a class="pull-left" href="#">
									<img class="media-object" src="{{ asset($cmt->avatar_user) }}" alt="">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>{{ $cmt->name_user }}</li>
										<li><i class="fa fa-clock-o"></i>{{ $cmt->created_at->format('g:i A') }}</li>
										<li><i class="fa fa-calendar"></i>{{ $cmt->created_at->format('M d, Y') }}</li>
									</ul>
									<p>{{ $cmt->cmt }}</p>
									<a class="btn btn-primary reply-btn" data-id="{{ $cmt->id }}" href="#replay-box"><i class="fa fa-reply"></i>Replay</a>
								
								</div>	
								<div class="reply-box-container"></div>						
							</li>
							@foreach($comments->where('level', $cmt->id) as $reply)
                <li class="media second-media" id="comment-{{ $reply->id }}">

                    <a class="pull-left" href="#">
                        <img class="media-object"
                             src="{{ asset($reply->avatar_user) }}"
                             alt="">
                    </a>

                    <div class="media-body">
                        <ul class="sinlge-post-meta">
                            <li><i class="fa fa-user"></i> {{ $reply->name_user }}</li>
                            <li><i class="fa fa-clock-o"></i> {{ $reply->created_at->format('g:i A') }}</li>
                            <li><i class="fa fa-calendar"></i> {{ $reply->created_at->format('M d, Y') }}</li>
                        </ul>

                        <p>{{ $reply->cmt }}</p>

                        <a class="btn btn-primary reply-btn" data-id="{{ $reply->id }}">
                            <i class="fa fa-reply "></i> Replay
                        </a>
						
                    </div>
					<div class="reply-box-container"></div>
                </li>
				@endforeach
							@endforeach
						</ul>					
					</div><!--/Response-area-->
					<div id="main-reply-box">
					<div class="replay-box">
						<div class="row">
							<div class="col-sm-12">
								<h2>Leave a replay</h2>
								<form id="comment-form">
									@csrf
									<input type="hidden" name="id_blog" value="{{ $blog->id }}">
									<input type="hidden" name="level" value="0">

									<div class="blank-arrow">
										<label>Your Comment</label>
									</div>

									<span>*</span>

									<textarea name="cmt" rows="11"></textarea>	
									<button class="btn btn-primary" type="submit">Post comment</button>
									<button type="button" class="btn btn-primary cancel-reply">Cancel</button>
								</form>
		
								</div>
							</div>
						</div>
					</div><!--/Repaly Box-->
					</div>
				</div>	
	
@endsection
@section('rate-script')
<script>
        $(document).ready(function(){
			var userRate = {{ $userRate ?? 0 }};
			if(userRate > 0) {
				$('.ratings_stars').each(function() {
					var rateValue = $(this).find('input').val();
					if(rateValue <= userRate) {
						$(this).addClass('ratings_over');
					}
				});
			}
            //vote
            $('.ratings_stars').hover(
                // Handles the mouseover
                function() {
                    $(this).prevAll().addBack().addClass('ratings_hover');
                    // $(this).nextAll().removeClass('ratings_vote'); 
                },
                function() {
                    $(this).prevAll().addBack().removeClass('ratings_hover');
                    // set_votes($(this).parent());
                }
            );

            $('.ratings_stars').click(function(){

                var checkLogin = "{{ Auth::check() ? 'true' : 'false' }}";

                if(checkLogin === 'true') {
                    var rate = $(this).find('input').val();

                    alert(rate);

                    if ($(this).hasClass('ratings_over')) {
                        $('.ratings_stars').removeClass('ratings_over');
                        $(this).prevAll().addBack().addClass('ratings_over');
                    } else {
                        $(this).prevAll().addBack().addClass('ratings_over');
                    }

                    $.ajax({
                        type: 'POST',
                        url: '{{ url("/blog/rate/ajax") }}',
                        data: {
                            rate: rate,
                            id_blog: {{ $blog->id ?? 0 }},
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data){
                            console.log(data);
                            $('.rate-np').text(data.avg);
							// Update the vote count display
							$('#vote-count').text(data.count);

                        }
                    });

                } else {
                    alert("vui long login de rate");
                }

            });
        });

$('#comment-form').submit(function(e){
    e.preventDefault();

    let form = $(this);

    $.ajax({
        url: "{{ route('blog.comment') }}",
        type: "POST",
        data: form.serialize(),

        success: function(res){
            let cmt = res.data;

            let html = `
               <li class="media ${cmt.level != 0 ? 'second-media' : ''}" id="comment-${cmt.id}">
            
            <a class="pull-left">
                <img class="media-object" src="/${cmt.avatar_user}" alt="">
            </a>

            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i> ${cmt.name_user}</li>
                    <li><i class="fa fa-clock-o"></i> ${new Date(cmt.created_at).toLocaleTimeString()}</li>
                    <li><i class="fa fa-calendar"></i> ${new Date(cmt.created_at).toLocaleDateString()}</li>
                </ul>

                <p>${cmt.cmt}</p>

                <a class="btn btn-primary reply-btn" data-id="${cmt.id}">
                    <i class="fa fa-reply"></i> Reply
                </a>
				<div class="reply-box-container"></div>
			 </div>
            </div>
        </li>
            `;
        if(cmt.level == 0){
            $('.media-list').prepend(html);

        }else{
            $('#comment-' + cmt.level).find('.media-body').append(html);
        }
        form[0].reset();
        	$('input[name="level"]').val(0);
			$('#main-reply-box').append($('.replay-box'));
        },
		

        error: function(err){
            console.log(err.responseJSON);
            alert("Lỗi: " + (err.responseJSON?.message || "Không gửi được comment"));
        }
    });
});

	$(document).on('click', '.reply-btn', function(e){
    e.preventDefault();

    let id = $(this).data('id');

	
    // set level = id cha
    $('input[name="level"]').val(id);

    // lấy form
    let form = $('.replay-box');

    // move form xuống dưới comment đang reply
    $('#comment-' + id).find('.reply-box-container').append(form);

    // focus textarea

    form.find('textarea').focus();
});
$(document).on('click', '.cancel-reply', function(){
    // reset level về comment cha
    $('input[name="level"]').val(0);

    // move form về vị trí gốc
    $('#main-reply-box').append($('.replay-box'));

    // clear textarea
    $('.replay-box textarea').val('');
});



		
     

    </script>
@endsection