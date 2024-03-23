@extends('Frontend.Layouts.app')
@section('content')
<?php //dd($singleBlog['id']); ?>
    <div class="col-sm-9">
			<div class="blog-post-area">
				<h2 class="title text-center">Latest From our Blog</h2>
						<div class="single-blog-post">
							<h3>{{$singleBlog['name']}}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i> {{$singleBlog['created_at']}}</li>
									<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
								</ul>
								<span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span>
							</div>
							<a href="#">
								<img src="{{ asset('upload/Admin/blog/img/' . $singleBlog['image']) }}" alt="">
							</a>
							<p>
								{{ $singleBlog['desciption'] }}
						    </p> <br>

							<p>
								{{ $singleBlog['content'] }}
							 </p> <br>

							
							<div class="pager-area">
								<ul class="pager pull-right">
									@if($preBlog)
									<li>
										<a href="{{ url('/Frontend/BlogSingle/' .$preBlog) }}">Pre</a>
									</li>
									@endif

                                    @if($nextBlog)
									<li>
										<a href="{{ url('/Frontend/BlogSingle/' .$nextBlog) }}">Next</a>
									</li>
									@endif
								</ul>
							</div>
						</div>
			</div><!--/blog-post-area-->

                   
					 <div class="rating-area">
					 	 <!-- đánh giá -->
						 <div class="rate">
			                <div class="vote">
			                    <!-- <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
			                    <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
			                    <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
			                    <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
			                    <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
			                    <span class="rate-np">4.5</span> -->

			                    <!-- viết vòng for để in ra 5 ngôi sao khi làm trung bình cộng thay cho các thẻ html ở trên -->

			                    <?php for($i=1; $i <= 5 ; $i+=1) { ?>

                                     <div class="star_{{$i}} ratings_stars {{ $i <= $tbc ? 'ratings_over' : ''}}">
                                     	<input value="{{$i}}" type="hidden">
                                     </div>
                                   
			                    <?php } ?>
			                       <!-- dùng hàm round để làm tròn số -->
                                   <span class="rate-np"><?php echo round($tbc); ?></span>
			                </div> 
			            </div>
					</div> <!--/rating-area-->

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
					</div> -->
					<!--Comments-->
					<div class="response-area">
						<h2>3 RESPONSES</h2>
						<ul class="media-list">
                            @foreach($commnts_Blog as $comments_blog)<!--foreach 1-->
                            @if($comments_blog['level'] == 0)
							<li class="media">
								<a class="pull-left" href="#">
									<img class="media-object" style="width: 100px;" src="{{asset('Frontend/avatar/' .$comments_blog['avatar'] ) }}" alt="">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>{{$comments_blog['name']}}</li>
										<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
										<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
									</ul>
									<p>{{$comments_blog['comment']}}.</p>
									<a class="btn btn-primary replay" href="#" data-comment-id="{{$comments_blog['id']}}">
										<i class="fa fa-reply"></i>Replay
									</a>
								</div>
							</li>
							@endif
							    @foreach($commnts_Blog as $comments_blog2)<!--foreach 2-->
	                            @if($comments_blog2['level'] == $comments_blog['id'])
								<li class="media second-media">
									<a class="pull-left" href="#">
										<img class="media-object" style="width: 100px;" src="{{asset('Frontend/avatar/' .$comments_blog2['avatar'] ) }}" alt="">
									</a>
									<div class="media-body">
										<ul class="sinlge-post-meta">
											<li><i class="fa fa-user"></i>{{$comments_blog2['name']}}</li>
											<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
											<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
										</ul>
										<p>{{$comments_blog2['comment']}}</p>
										<a class="btn btn-primary " href="#" data-comment-id="{{$comments_blog['id']}}">
											<i class="fa fa-reply"></i>Replay
										</a>
									</div>
								</li>
								@endif
								@endforeach <!--/foreach 2-->
							@endforeach<!--/foreach 1-->
						</ul>					
					</div><!--/Response-area-->
					<div class="replay-box">
						<div class="row">
							<div class="col-sm-12">
								<h2>Leave a replay</h2>
								<div class="text-area">
									@if (session('success'))
									    <h1>{{ session('success') }}</h1>
									@endif
									<form action="{{route ('comments') }}" class="comments_blog" method="post">
										@csrf
										<div class="blank-arrow">
										      <label>Your Name</label>
										</div>
										<span>*</span>
										<input type="hidden" name="id_blog" value="{{ $singleBlog['id'] }}">
										<input type="hidden" name="level" value="0" id="cmt-con">
										<input type="hidden" value="avatar">
										<textarea name="message" rows="11"></textarea>
										<button type="submit" class="btn btn-primary " href="">post comment</button>
									</form>
									
								</div>
							</div>
						</div>
					</div><!--/Repaly Box-->
	</div>
            
 <script>
    	$(document).ready(function(){
    		$.ajaxSetup({
	                headers: {

	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                }
	        });

    		//vote
			$('.ratings_stars').hover(
	            // Handles the mouseover
	            function() {
	                $(this).prevAll().andSelf().addClass('ratings_hover');
	                // $(this).nextAll().removeClass('ratings_vote'); 
	            },
	            function() {
	                $(this).prevAll().andSelf().removeClass('ratings_hover');
	                // set_votes($(this).parent());
	            }
	        );

			$('.ratings_stars').click(function(){
				// var Values =  $(this).find("input").val();
		  //       alert(Values);
		  //   	if ($(this).hasClass('ratings_over')) {
		  //           $('.ratings_stars').removeClass('ratings_over');
		  //           $(this).prevAll().andSelf().addClass('ratings_over');
		  //       } else {
		  //       	$(this).prevAll().andSelf().addClass('ratings_over');
		  //       }

		        //xác thực người dùng login thì mới cho đânhs giá- dùng hàm auth check
                     var checkLogin = "{{Auth::Check()}}";
                     

                     //nếu đã login thì mới cho đánh giá
                     if (checkLogin) {
                     	//console.log(1111)
                     	var rate = $(this).find("input").val();
                     	// var rate =  123;
                     	// alert(rate);
                     	if($(this).hasClass('ratings_over')){
                     		$('.ratings_stars').removeClass('ratings_over');
                            $(this).prevAll().andSelf().addClass('ratings_over');
                     	}else{
                     		$(this).prevAll().andSelf().addClass('ratings_over');
                     	}

                     	// xử lí ajax không cần reload trang
                     	$.ajax({
                          type:'Post',
                          // url:"{{url('/Frontend/BlogSingle/rate')}}",
                          url : "{{ route('BlogsingleRate')}}",// bắt buộc dùng route chứ không dùng url
                          data:{
                          	rate:rate ,
                          	id_blog: "{{ $singleBlog['id'] }}",
                          },

                          success:function(xx){
                          	alert(xx.msg);
                          }
                     	});
                     }else{// ngược lại thì thông báo : vui lòng login và chuyển hướng về trang login
                     	alert("vui lòng login để đánh giá");
                     	// dùng window.location.href trong js
                     	window.location.href = "{{ route('Frontend.login') }}";
                     }
		    });

		    // comment
             $('.comments_blog').submit(function(){
                 // kiểm tra khi comment thì đã login chưa(dùng hàm auth)
                   var check_log = "{{ Auth::check() }}";
                if(check_log){
                	var comment = $('textarea[name="message"]').val();
                	if(comment = ""){
                		alert('vui lòng nhập bình luận');
                	}else{
                		return true;
                	}
                }else{
                	alert('vui lòng đăng nhập để bình luận');
                	// dùng window.location.href trong js
                    window.location.href = "{{ route('Frontend.login') }}";
                }  
                
                return false;
              
             });

             // nút replay
             $('a.replay').click(function(){
                  var replayId = $(this).data('comment-id');
                  $('#cmt-con').val(replayId);
                 //  alert('Replay: ' + replayId);
             });

		});	
    </script>	
    
@endsection