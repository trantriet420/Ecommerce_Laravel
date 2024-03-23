@extends('Frontend.Layouts.appUser')
@section('content')
     <h1>update users</h1>
                    <!-- thông báo cập nhật thành công -->
                    @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                {{session('success')}}
                            </div>
                    @endif
                    
                    <!-- thông báo cập nhật thất bại -->
                    @if(session('error'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                {{session('error')}}
                            </div>
                    @endif
        <div class="col-sm-9">
			<div class="signup-form">
				<form action="{{ route('membersUpsates') }}" method="Post" enctype="multipart/form-data" >
					@csrf
					<input type="text" placeholder="Name" name="name" />
					<input type="email" placeholder="Email Address" name="email" />
					<input type="password" placeholder="Password" name="password" value="{{Auth::user()->password}}"/>
					<input type="text" placeholder="Phone No" name="phone" />
					<select name="id_country" >
						 <option >Choose Country</option>
						 @foreach($Country as $value )
                                <option value="{{ $value['id'] }}" >
                                        {{ $value['name'] }}
                                </option>
                         @endforeach
					</select>		
					<input type="text" placeholder="Address" name="address" />
					<input type="file" placeholder="Avatar" name="avatar" />
					<button type="submit" class="btn btn-default">Update</button>
	            </form>
            </div>
        </div>
    
@endsection