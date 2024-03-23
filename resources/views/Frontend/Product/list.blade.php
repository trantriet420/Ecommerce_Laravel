@extends('Frontend.Layouts.appUser')
@section('content')
     <?php //dd($getProducts); ?>
<section id="cart_items">
	<!-- <div class="container"> -->     
		            <div class="table-responsive cart_info">
						<table class="table table-condensed" style="table-layout: fixed;">
							<thead>
								<tr class="cart_menu">
									<td >Id</td>
									<td >Name</td>
									<td >Image</td>
									<td >Price</td>
									<td >Action</td>
									<td></td>
									<td></td>
								</tr>
							</thead>
							<tbody>
								<!-- nếu có sản phẩm thì hiển thị ra -->
								@if(count($getProducts) > 0)
									@foreach($getProducts as $productList)
									<?php //dd($productList['hinhanh'][0]); ?>
									<tr>
										<td>
											<p>{{ $productList['id'] }}</p>
										</td>
										<td>
											<h4><a href="#">{{ $productList['name']}}</a></h4>
										</td>
										<td>
											<a href="#"><img src="{{ url('upload/products/' .$productList['hinhanh'][0]) }}" style="width: 50%;"></a>
										</td>
										<td>
											<p>${{ intval($productList['price']) }}</p>
										</td>
										<td>
											<a href="{{ url('/Frontend/Client/Product/edit/' .$productList['id'])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
										</td>
										<td>
											<a class="cart_quantity_delete" href="{{url('/Frontend/Client/Product/delete/' .$productList['id']) }}"><i class="fa fa-times"></i></a>
										</td>
										
									</tr>
									@endforeach
                                <!-- ngược lại thì show ra thông báo "không có sản phẩm nào" -->
                                @else
                                    <div class="alert alert-success alert-dismissible">
		                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                                <h4><i class="icon fa fa-check"></i> Thông báo! không có sản phẩm nào</h4>
		                            </div>
								@endif	
							</tbody>
						</table>
						
					</div>
	<!-- </div> -->
</section>					
@endsection