<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SOLVE - JOGJA SCIENCE TRAINING</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('css/core.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('css/colors.min.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{asset('js/libraries/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/libraries/bootstrap.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{asset('js/app.min.js')}}"></script>
	<!-- /theme JS files -->

</head>

<body class="login-container">

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Password recovery -->
					<form method="POST" action="{{ route('password.email') }}">
                        @csrf
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
								<h5 class="content-group">Password recovery <small class="display-block">We'll send you instructions in email</small></h5>
							</div>

							<div class="form-group has-feedback">
                                <input id="email" placeholder="Your Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
								<div class="form-control-feedback">
									<i class="icon-mail5 text-muted"></i>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>

							<button type="submit" class="btn bg-pink-400 btn-block">Reset password <i class="icon-arrow-right14 position-right"></i></button>
						</div>
					</form>
					<!-- /password recovery -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
