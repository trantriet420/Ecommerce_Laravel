@extends('Frontend.Layouts.appCart')
@section('content')
     <?php //dd($cart); ?>
<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active">Shopping Cart</li>
		</ol>
</div>
<div class="table-responsive cart_info">
		<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						 @if(count($cart) > 0)

						    <?php $Tototal_sum_qty = 0; ?>

							@foreach($cart as $itemCart)
							   <?php $imgProduct = json_decode($itemCart['hinhanh'],true); ?>
							   <?php 

							      $total = $itemCart['price'] *  $itemCart['quantity']; 
							      //echo ($total);
                                  
                                  $Tototal_sum_qty += $total;
                                  //echo ($Tototal_sum_qty);

							    ?>
							<tr>
								<td class="cart_product">
									<a href="#">
										<img src="{{ asset('upload/products/' .$imgProduct[0]) }}" 
										style="width: 110px;
	                                        height: 110px;">
	                                </a>
								</td>
								<td class="cart_description">
									<h4><a href="#">{{ $itemCart['name']}}</a></h4>
									<p>Web ID: {{ $itemCart['id']}}</p>
								</td>
								<td class="cart_price ">
									<p>${{ intval($itemCart['price']) }}</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<a class="cart_quantity_up" > + </a>
										<input class="cart_quantity_input" type="text" name="quantity" value="{{ $itemCart['quantity'] }}" autocomplete="off" size="2">
										<a class="cart_quantity_down" > - </a>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">$<span><?php echo $total; ?></span></p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							@endforeach
							<!-- ngược lại thì show ra thông báo "không có sản phẩm nào" -->
						@else	
						    <tr>
						    	<td colspan="6">
									<div style="text-align: center;
										        padding: 20px;
										        margin: 10px;
										        background-color: #f8d7da;
										        color: #721c24;
										        border-color: #f5c6cb;
										        border-radius: .25rem;">
										        	<p>Chưa có sản phẩm nào trong giỏ hàng</p>
									</div>
								</td>
						    </tr>
						@endif    
					</tbody>
		</table>
</div>  
<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$59</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li class="toal_span">Total
								<span >$
								    <label class="Tototal_sum_qty" style="color: #696763;">
								    	<?php echo (count($cart) > 0) ? $Tototal_sum_qty : 0;  ?>
								    </label>
							    </span>
						    </li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
</section><!--/#do_action-->   	

  <script>
  	    $(document).ready(function(){
  	    	 var Total_order_amount = 0;
  	    	 $('.cart_quantity_up').click(function(){
  	    	 	 //alert('plus');

  	    	 	 var getQty = $(this).closest('.cart_quantity_button').find('input').val();
  	    	 	 //alert(getQty);

  	    	 	 var getPrice = $(this).closest('tr').find('.cart_price p').text();
  	    	 	 var price = getPrice.split('$')[1];
  	    	 	 //alert(price);

  	    	 	 var getTotal = $(this).closest('tr').find('.cart_total .cart_total_price span').text();
                //alert(getTotal);

                 var getId = $(this).closest('tr').find('.cart_description p').text();
                 var id = getId.split('Web ID: ')[1];
                 //alert(id);

                 var ToTalSum = $('ul').closest('.total_area').find('.toal_span .Tototal_sum_qty').text()
				  //alert(ToTalSum);

				 // cho quantity tăng thêm 1
				 var quantity = parseInt( getQty) + 1;
				 //alert(quantity);

                 // tổng tiền từng sản phẩm sau khi tăng quantity (giá x số lượng vừa tăng)
                  var priceTotal = price * quantity;
                  //alert(priceTotal);

                  //  tổng giá tiền toàn bộ các sản phẩm ở  phần What would you like to do next?
                  var Total_order_amount = Number(price) + Number(ToTalSum);
                  //alert(Total_order_amount);

                 // dua nguoc gia tri vao lai - hien thi ra man hinh
                $(this).closest('.cart_quantity_button').find('input').val(quantity);
                $(this).closest('tr').find('.cart_total .cart_total_price span').text(priceTotal);
                $('ul').closest('.total_area').find('.toal_span .Tototal_sum_qty').text(Total_order_amount);

                $.ajaxSetup({
		                headers: {

		                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		                }
		        });


		        $.ajax({
                   url : "{{ route('changeQty') }}",
                   method: "Post",
                   data : {
                       id : id,
                       quantity : quantity,
                       function : 1
                    },
                        success: function(response) {
				            console.log(response);
				        }
		        });
 
  	    	 })// kết thúc sự kiện click " + "


  	    	 $('.cart_quantity_down').click(function(){
                //alert('reduce')
                 var getQty = $(this).closest('.cart_quantity_button').find('input').val();
  	    	 	 // alert(getQty);

  	    	 	 var getPrice = $(this).closest('tr').find('.cart_price p').text();
  	    	 	 var price = getPrice.split('$')[1];
  	    	 	 // alert(price);

  	    	 	 var getTotal = $(this).closest('tr').find('.cart_total .cart_total_price span').text();
                 //alert(getTotal);

                 var getId = $(this).closest('tr').find('.cart_description p').text();
                 var id = getId.split('Web ID: ')[1];
                 //alert(id);

                 var ToTalSum = $('ul').closest('.total_area').find('.toal_span .Tototal_sum_qty').text()
				 //alert(ToTalSum);

				 // cho quatity giảm 1
				 var quantity = parseInt( getQty) - 1;
				 //alert(quantity)

				 if (quantity < 1)  // nếu quantity nhỏ hơn 1 thì xóa luôn sản phẩm
				 {
                      $(this).closest('tr').remove();

				 }else{

                      var subPriceTotal  = price * quantity;
                      //alert(subPriceTotal);

                     $(this).closest('.cart_quantity_button').find('input').val(quantity);
                     $(this).closest('tr').find('.cart_total .cart_total_price span').text(subPriceTotal);

				 }

				 //  tổng giá tiền toàn bộ các sản phẩm ở  phần What would you like to do next?
				 var Total_order_amount = Number(ToTalSum) - Number(price)  ;
				 //console.log(Total_order_amount)

				 $('ul').closest('.total_area').find('.toal_span .Tototal_sum_qty').text(Total_order_amount);

				 $.ajaxSetup({
		                headers: {

		                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		                }
		        });

				 $.ajax({
                   url : "{{ route('changeQty') }}",
                   method: "Post",
                   data : {
                       id : id,
                       quantity : quantity,
                       function : 2
                    },
                        success: function(response) {
				            console.log(response);
				        }
		        });

  	    	 })// kết thúc sự kiện " - "


  	    	 $('.cart_quantity_delete').click(function(){
  	    	 	 //alert('delete')

                 var getQty = $(this).closest('.cart_quantity_button').find('input').val();
  	    	 	 // alert(getQty);

  	    	 	 var getPrice = $(this).closest('tr').find('.cart_price p').text();
  	    	 	 var price = getPrice.split('$')[1];
  	    	 	 // alert(price);

  	    	 	 var getTotal = $(this).closest('tr').find('.cart_total .cart_total_price span').text();
                 //alert(getTotal);

                 var getId = $(this).closest('tr').find('.cart_description p').text();
                 var id = getId.split('Web ID: ')[1];
                 //alert(id);

                 var ToTalSum = $('ul').closest('.total_area').find('.toal_span .Tototal_sum_qty').text()
				 //alert(ToTalSum);

				 var Total_order_amount = Number(ToTalSum) - Number(getTotal)  ;
				 //console.log(Total_order_amount)

				 $('ul').closest('.total_area').find('.toal_span .Tototal_sum_qty').text(Total_order_amount)
				 $(this).closest('tr').empty() // click vào icon "x" thì xóa luôn <tr> của spham 

				 $.ajaxSetup({
		                headers: {

		                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		                }
		        });

				 $.ajax({
                   url : "{{ route('changeQty') }}",
                   method: "Post",
                   data : {
                       id : id,
                       function : 3
                    },
                        success: function(response) {
				            console.log(response);
				        }
		        });

  	    	 }) // kết thúc sự kiện delete

  	    })
  </script>		
@endsection