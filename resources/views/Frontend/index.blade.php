@extends('Frontend.Layouts.app')
@section('content')
<?php //dd($getProducts); ?>
    <div class="features_items"><!--features_items-->
			<h2 class="title text-center">Features Items</h2>
			@foreach($getProducts as $productHome)
				<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
										<img src="{{ url('upload/products/' .$productHome['hinhanh'][0]) }}" alt="" />
										<h2>${{ intval($productHome['price']) }}</h2>
										<p>{{ $productHome['name']}}</p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								<div class="product-overlay">
									<div class="overlay-content">
										<h2>${{ intval($productHome['price']) }}</h2>
										<p>{{ $productHome['name']}}</p>
										<button  type="submit" name="submit" class="btn btn-default add-to-cart" data-id="{{ $productHome['id'] }}">
											<i class="fa fa-shopping-cart"></i>Add to cart
										</button>
									</div>
								</div>
							</div>
							<div class="choose">
								<ul class="nav nav-pills nav-justified">
									<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
									<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									<li><a href="{{ url('/Frontend/Client/Product/detail/' .$productHome['id'])}}"><i class="fa fa-plus-square"></i>Detail</a></li>
								</ul>
							</div>
						</div>
				</div>
            @endforeach	
	</div><!--features_items-->
	<script>
		    $(document).ready(function(){
		    	
                // xử lí nút add to cart
                var cartQuanty = 0
                $('.add-to-cart').click(function(){
                     //alert('thanh cong');

                     //lấy id của sản phẩm
                     var productId = $(this).data('id');
                     //alert(productId);
                    
                    // cho số lượng sản phẩm tăng dần sau mỗi lần clcik chon add to cart
                    cartQuanty++;
                    // truyền số lượng vào thẻ span có id là cart-quantity
                    $('#cart-quantity').text(cartQuanty);
                    
                    $.ajaxSetup({
		                headers: {

		                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		                }
		            });
                    // truyền vào ajax 
                    $.ajax({
                        url : '{{ route('addToCart') }}', // bắt buộc dùng route chứ không dùng url
                        method : 'Post',
                        data: {
                        	productId : productId,
                            cartQuanty: cartQuanty,
                        },
                        success: function(response) {
				            console.log(response);
				        }
                    });
                });
		    });
	</script>
@endsection