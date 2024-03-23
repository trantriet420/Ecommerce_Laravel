@extends('Frontend.Layouts.app')
@section('content')
<?php //dd($Brand[2]['name']); ?>
<div class="product-details"><!--product-details-->
			<div class="col-sm-5">
				<div class="view-product">
					<img src="{{ url('upload/products/' . '/hinh380_'.$getArrImage[0]) }}" class="hinhTo"/>
						<a href="{{ url('upload/products/' .$getArrImage[0]) }}" rel="prettyPhoto"><h3>ZOOM</h3></a>
								
				</div>
				<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
						<div class="carousel-inner">
							@for($i = 1; $i <=3; $i++)
								<div class="item {{$i==1 ? 'active' : ''}}">
									@foreach($getArrImage as $imgDetail)
									<a href="#">
										<img src="{{url('upload/products/' . '/hinh84_'.$imgDetail )}}"  id="{{$imgDetail}}" class="hinhNho">
									</a>
									@endforeach
								</div>
							@endfor	
						</div>

								  <!-- Controls -->
								<a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								</a>
								<a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								</a>
				</div>

			</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="{{asset('Frontend/images/product-details/new.jpg')}}" class="newarrival" alt="" />
								<h2>{{ $detailProduct['name']}}</h2>
								<p>Web ID: {{ $detailProduct['id']}}</p>
								<img src="{{asset('Frontend/images/product-details/rating.png')}}" alt="" />
								<span>
									<span>US ${{ intval($detailProduct['price'])}}</span>
									<label>Quantity:</label>
									<input type="text" value="0" />
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
								<p><b>Availability:</b> In Stock</p>
								<p><b>Condition:</b></p>
								<p>
									<b>Brand:</b> 

								</p>
								<a href=""><img src="{{asset('Frontend/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
</div><!--/product-details-->

    <script>
     	   $(document).ready(function() {
			    $(".hinhNho").click(function() {
			        var hinhAnh = $(this).attr("src");
			        $(".hinhTo").attr("src", hinhAnh);

			        var srcImg = $(this).attr("id");
                    //alert(srcImg)

				    var newUrl = "{{url('upload/products/' )}}" + '/' + srcImg;
				    //alert(xx)
				    $("a[rel='prettyPhoto']").attr("href", newUrl);
			    });
			});
     </script>
@endsection