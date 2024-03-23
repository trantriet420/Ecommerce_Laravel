@extends('Frontend.Layouts.appnotLeft')
@section('content')
    <h1>Login</h1>
    <div class="col-sm-4 col-sm-offset-1">
		<div class="login-form"><!--login form-->
			<!-- hiển thị bắt lỗi -->
                    @if($errors->any())
                        <div>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif  <!-- kết thúc hiển thị bắt lỗi -->
                    
			<!-- thông báo đăng kí thất bại -->
                    @if(session('error'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                {{session('error')}}
                            </div>
                    @endif
			<h2>Login to your account</h2>
				<form action="{{route('Frontend.login')}}" method="Post">
					@csrf
					<input type="email" placeholder="Email Address" name="email" />
					<input type="password" placeholder="Password" name="password" />
					<span>
					<input type="checkbox" class="checkbox" name="remember_me"> 
								Keep me signed in
					</span>
					<button type="submit" class="btn btn-default">Login</button>
				</form>
		</div><!--/login form-->
	</div>
@endsection