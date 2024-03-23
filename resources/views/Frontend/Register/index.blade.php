@extends('Frontend.Layouts.appnotLeft')
@section('content')
    <h1>register</h1>
    <div class="col-sm-4">
		<div class="signup-form"><!--sign up form-->
			<h2>New User Signup!</h2>
			<!-- hiển thị bắt lỗi -->
                    @if($errors->any())
                        <div>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif  
                    <!-- kết thúc hiển thị bắt lỗi -->
			<!-- thông báo đăng kí thành công -->
                    @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                {{session('success')}}
                            </div>
                    @endif
                    
                    <!-- thông báo đăng kí thất bại -->
                    @if(session('error'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                {{session('error')}}
                            </div>
                    @endif
				<form action="{{route('Frontend.Register')}}" method="Post" enctype="multipart/form-data" >
					@csrf
					<input type="text" placeholder="Name" name="name" />
					<input type="email" placeholder="Email Address" name="email" />
					<input type="password" placeholder="Password" name="password" />
					<input type="text" placeholder="Phone No" name="phone" />
					<select class="form-control form-control-line" name="id_country">
                        <option >Choose Country</option>
                            @foreach($Country as $value )
                                <option value="{{ $value['id'] }}" >
                                    {{ $value['name'] }}
                                </option>
                            @endforeach
                        </select>
					<input type="text" placeholder="Address" name="address" />
					<input type="file" placeholder="Avatar" name="avatar" />
					<button type="submit" class="btn btn-default">Signup</button>
				</form>
		</div><!--/sign up form-->
	</div>
@endsection