<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="{{url('/Frontend/home')}}"><img src="{{asset('Frontend/images/home/logo.png')}}" alt="" /></a>
						</div>
						<div class="btn-group pull-right clearfix">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canada</a></li>
									<li><a href="">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canadian Dollar</a></li>
									<li><a href="">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								<li>
									<a href="{{ url('/Frontend/Members/account') }}" class="account">
										<i class="fa fa-user"></i> Account
									</a>
								</li>
								<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="#"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li>
									<a href="{{ route('Cart')}}">
										<i class="fa fa-shopping-cart"></i> Cart
										<span id="cart-quantity"> </span>
									</a>
								</li>
								<li><a href="{{ route('Frontend.logout') }}"><i class="fa fa-lock"></i> Logout</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{url('/Frontend/home')}}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="#">Products</a></li>
										<li><a href="#">Product Details</a></li> 
										<li><a href="#">Checkout</a></li> 
										<li><a href="#">Cart</a></li> 
										<li><a href="{{url('/Frontend/Login')}}">Login</a></li> 
										<li><a href="{{url('/Frontend/Register')}}">Register</a></li>
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{url('/Frontend/BlogList')}}">Blog List</a></li>
										<li><a href="#">Blog Single</a></li>
                                    </ul>
                                </li> 
								<li><a href="#">404</a></li>
								<li><a href="#">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							
							  <input type="search" id="search" name="search" placeholder="Search"/>
							
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header>

	<script>
		  $(document).ready(function(){
		  	  $('.account').click(function(){
		  	  	  //alert('account')
		  	  	  var checkLogin = "{{ Auth::Check() }}";
		  	  	  if(checkLogin){
		  	  	  	 window.location.href = "{{ route('membersUpsates') }}";
		  	  	  }else{
		  	  	  	  alert('Vui lòng đăng nhập để vào trang account');
		  	  	  	  window.location.href = "{{ route('Frontend.login') }}";
		  	  	  }
		  	  })
		  	  
		  	  // xử lí ô input search
		  	  $("#search").on('keypress',function(e){
		  	  	  //Khi người dùng nhấn Enter (mã phím là 13)
		  	  	  if(e.which == 13){
                        var search =  $("#search").val();
                        if(search.trim() === '') {
			                alert('Vui lòng nhập sản phẩm cần tìm.');
			                return false;
			            }	
                        $.ajaxSetup({
			                headers: {

			                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			                }
		                });

		                $.ajax({
                            url : "{{ route('search') }}",
                            type: 'get',
                            data : {
                            	 search : search,
                            },
                            success: function(response) {
				               console.log(response);
				               window.location.href = "{{ route('search') }}";
				            }
		                });
		  	  	  }
		  	  })
		  })
	</script>