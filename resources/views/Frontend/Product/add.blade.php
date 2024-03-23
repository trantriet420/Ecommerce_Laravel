@extends('Frontend.Layouts.appUser')
@section('content')
     <h1>add product</h1>
   <div class="col-sm-9">
			<div class="signup-form">
				<!-- thông báo thêm sản phẩm thành công -->
                    @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                {{session('success')}}
                            </div>
                    @endif
				<form action="{{ route('Product.add')}}" method="Post" enctype="multipart/form-data" >
					@csrf
					<input type="text" placeholder="Name" name="name" />
					<input type="text" placeholder="Price" name="price" />
					<select name="Id_category" >
						 <option >Choose Category</option>
						 @foreach($Category as $value )
                                <option value="{{ $value['id'] }}" >
                                        {{ $value['name'] }}
                                </option>
                         @endforeach
					</select>
					<select name="Id_brand">
						 <option >Choose Brand</option>
						 @foreach($Brand as $value )
                                <option value="{{ $value['id'] }}" >
                                        {{ $value['name'] }}
                                </option>
                         @endforeach
					</select>
					<select id="status" name="sale">
					    <option value="1">sale</option>
					    <option value="0">new</option>
					</select>
					<div id="sale-input" style="display: flex;">
					    <input type="text" placeholder="Nhập số..." name="giaSale" style="margin-right: 5px; width: 161px;">
					    <span>%</span>	
					</div>	
                    
					<input type="text" placeholder="Company profile" name="company" />
					<input type="file" placeholder="hinh anh" name="hinhanh[]" multiple />
					<input type="text" placeholder="Detail" name="detail" />
					<button type="submit" class="btn btn-default">add</button>
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