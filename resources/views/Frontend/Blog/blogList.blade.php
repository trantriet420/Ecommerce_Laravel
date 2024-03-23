@extends('Frontend.Layouts.app')
@section('content')
<?php //dd($blogList); ?>
    
            <div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						@foreach($blogList as $Bloglist )
						<div class="single-blog-post">
							<h3>{{$Bloglist['name']}}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i> {{$Bloglist['created_at']}}</li>
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
								<img src="{{ asset('upload/Admin/blog/img/' . $Bloglist['image']) }}" alt="">
							</a>
							<p>{{$Bloglist['desciption']}}</p>
							<?php //dd($Bloglist['id']); ?>
							<a  class="btn btn-primary" 
							 href="{{ url('/Frontend/BlogSingle/' . $Bloglist['id']) }}">Read More</a>
						</div>
						@endforeach
						<div class="pagination-area">
							{{ $blogList->links() }}
						</div>
					</div>
			</div>
	
    
@endsection