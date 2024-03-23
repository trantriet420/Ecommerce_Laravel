@extends('Frontend.Layouts.appUser')
@section('content')
     <h1>edit product</h1>
     <?php 	//dd($editProduct); ?>
   <div class="col-sm-9">
			<div class="signup-form">
				<!-- thông báo thêm sản phẩm thành công -->
                   @if (session('success'))
						    <div class="alert alert-success">
						        {{ session('success') }}
						    </div>
					@endif
						
                    <!-- thông báo cập nhật thất bại -->
                    @if($errors->has('error'))
					    <div class="alert alert-danger">
					        {{ $errors->first('error') }}
					    </div>
					@endif

				<form action="{{ route('Product.update', ['id' => $editProduct['id']])}}" method="Post" enctype="multipart/form-data" >
					@csrf
					<input type="text" placeholder="Name" name="name"  value="{{ $editProduct['name'] }}"/>
					<input type="text" placeholder="Price" name="price" value="{{ $editProduct['price'] }}"/>
					<select name="Id_category" >
						 <!-- <option >Choose Category</option> -->
						 @foreach($Category as $value )
                                <option value="{{ $value['id'] }}"  <?php $value['id'] == $editProduct['id_category'] ? 'selected' : '' ?> >
                                        {{ $value['name'] }}
                                </option>
                         @endforeach
					</select>
					<select name="Id_brand">
						 <!-- <option >Choose Brand</option> -->
						 @foreach($Brand as $value )
                                <option value="{{ $value['id'] }}"  <?php $value['id'] == $editProduct['id_brand'] ? 'selected' : '' ?>>
                                        {{ $value['name'] }}
                                </option>
                         @endforeach
					</select>
					<select id="status" name="sale">
					    <option value="1" <?php $editProduct['sale'] == 1 ? 'selected' : '' ?> >sale</option>
					    <option value="0" <?php $editProduct['sale'] == 0 ? 'selected' : '' ?> >new</option>
					</select>
					<div id="sale-input" style="display: flex;">
					    <input type="text" placeholder="Nhập số..." name="giaSale" style="margin-right: 5px; width: 161px;"  value="{{ $editProduct['sale'] }}">
					    <span>%</span>	
					</div>	
                    
					<input type="text" placeholder="Company profile" name="company"  value="{{$editProduct['company']}}" />
					<input type="file" placeholder="hinh anh" name="hinhanh[]" multiple />
					<div style="display: flex; flex-wrap: wrap;">
						<?php //dd($getArrImage); ?>
						@foreach($getArrImage as $image)
						<div style=" margin-right: 10px;">
							 <img src="{{ url('upload/products/' .$image)}}" style="width: 30%;">
							 <input type="checkbox" style="width: 5%;" name="hinhCancel[]" value="{{ $image }}"> 
						</div>
						@endforeach 
					</div>
					<input type="text" placeholder="Detail" name="detail" value="{{$editProduct['detail']}}"/>
					<button type="submit" class="btn btn-default" >edit</button>
	            </form>
            </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    	$(document).ready(function() {
		    $('#status').change(function() {
		        if ($(this).val() == '1') {
		            $('#sale-input').show();
		        } else {
		            $('#sale-input').hide();
		        }
		    });
		});
    </script>
    

@endsection