<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RUKO - Rumah Korea</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('css/core.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('css/components.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('css/colors.css')}}" rel="stylesheet" type="text/css">

	<link href="{{ asset('DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('DataTables/Select-1.2.6/css/select.bootstrap4.min.css') }}" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" rel="stylesheet" />

	<link href="{{asset('css/icons/fontawesome/styles.min.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
	@stack('after_style')

	<!-- Core JS files -->
	<script type="text/javascript" src="{{asset('js/libraries/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/libraries/bootstrap.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
	<!-- /theme JS files -->

	<script src="{{ asset('DataTables/jquery.dataTables.min.js') }}" ></script>
  <script src="{{ asset('DataTables/dataTables.bootstrap4.min.js') }}" ></script>
	<!-- /theme JS files -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{asset('js/plugins/loaders/pace.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{asset('js/plugins/forms/validation/validate.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/plugins/forms/inputs/touchspin.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/plugins/forms/selects/select2.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/plugins/forms/styling/switch.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/plugins/forms/styling/switchery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/plugins/forms/styling/uniform.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/libraries/jquery_ui/interactions.min.js')}}"></script>

	<script type="text/javascript" src="{{asset('js/pages/form_validation.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/pages/form_select2.js')}}"></script>


	{{-- WIZARD DI SOAL --}}
	<!-- Theme JS files -->
	<script type="text/javascript" src="{{asset('js/plugins/forms/wizards/stepy.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/libraries/jasny_bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/pages/wizard_stepy.js')}}"></script>
	<!-- /theme JS files -->

	<script type="text/javascript" src="{{asset('js/plugins/velocity/velocity.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/plugins/velocity/velocity.ui.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/plugins/buttons/spin.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/plugins/buttons/ladda.min.js')}}"></script>

	<script type="text/javascript" src="{{asset('js/pages/components_buttons.js')}}"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	{{-- <script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script> --}}

	<!-- Input upload picture -->
	<script type="text/javascript" src="{{asset('js/plugins/uploaders/fileinput.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/pages/uploader_bootstrap.js')}}"></script>
	<!-- /Input upload picture -->

	@stack('after_script')

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse bg-primary-800">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"><img src="{{asset('img/logo_light.png')}}" alt=""></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs "><i class="icon-paragraph-justify3"></i></a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						@if(Auth::user()->picture == 'avatar.png')
						<img src="{{asset('img/avatar.png')}}">
						@else
						<img src="{{route('user.picture',Auth::user()->id)}}">
						@endif
						<span>{{Auth::user()->name}}</span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="{{route('user.show',Auth::id())}}"><i class="icon-user-plus"></i> My profile</a></li>
						<li><a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
								<i class="icon-switch2"></i>
								Logout
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main sidebar-default">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								@if(Auth::user()->picture == 'avatar.png')
								<a href="#" class="media-left"><img src="{{asset('img/avatar.png')}}" class="img-circle img-sm" alt=""></a>
								@else
								<a href="#" class="media-left"><img src="{{route('user.picture',Auth::user()->id)}}" class="img-circle img-sm" alt=""></a>
								@endif
								<div class="media-body">
									<span class="media-heading text-semibold">{{Auth::user()->name}}</span>
									<div class="text-size-mini text-muted">
										<i class="icon-pin text-size-small"></i> &nbsp;Sekip 3, UGM
									</div>
								</div>

								<div class="media-right media-middle">
									<ul class="icons-list">
										<li>
											<a href="#"><i class="icon-cog3"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					@include('layouts.sidebar')
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

			@yield('content')

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
	{{-- @include('sweetalert::alert') --}}
</body>
</html>
