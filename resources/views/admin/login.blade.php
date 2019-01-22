<!DOCTYPE html>
<html lang="en">
<head>
	<title>ITV-ME CRM</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('customer/CRM/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('customer/CRM/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('customer/CRM/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('customer/CRM/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{url('customer/CRM/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('customer/CRM/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('customer/CRM/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{url('customer/CRM/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('customer/CRM/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('customer/CRM/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('customer/CRM/images/bg-01.jpg');">
			<div class="wrap-login100">
                
                <form class="login100-form validate-form" method="POST" action="{{route('admin.checkLogin')}}">
                    {{ csrf_field() }}
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>
					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>
                    @if(!empty(session('not_login')))
                    <div class="alert alert-danger">
                        <center>
                           Sorry You Are Not Allowed To Login
                        </center>
                    </div> 
                    @endif
					<div class="wrap-input100 validate-input" data-validate = "Enter email">
						<input class="input100" type="email" name="email" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{url('customer/CRM/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{url('customer/CRM/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{url('customer/CRM/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{url('customer/CRM/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{url('customer/CRM/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{url('customer/CRM/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{url('customer/CRM/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{url('customer/CRM/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{url('customer/CRM/js/main.js')}}"></script>

</body>
</html>