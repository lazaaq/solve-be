@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Dashboard</span></h4>
        </div>
    </div>

    {{-- <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="2_col.html">Starters</a></li>
            <li class="active">2 columns</li>
        </ul>
    </div> --}}
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <div class="row">
    <div class="col-lg-4">

			<!-- Members online -->
			<div class="panel bg-teal-400">
				<div class="panel-body">
					<div class="heading-elements">
						<span class="heading-text badge bg-teal-800">+53,6%</span>
					</div>

					<h3 class="no-margin">3,450</h3>
					Members online
					<div class="text-muted text-size-small">489 avg</div>
				</div>

				<div class="container-fluid">
					<div id="members-online"></div>
				</div>
			</div>
			<!-- /members online -->

		</div>
    <div class="col-lg-4">
			<!-- Current server load -->
			<div class="panel bg-pink-400">
				<div class="panel-body">
					<div class="heading-elements">
						<ul class="icons-list">
	                		<li class="dropdown">
	                			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-sync"></i> Update data</a></li>
									<li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
									<li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
									<li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
								</ul>
	                		</li>
	                	</ul>
					</div>

					<h3 class="no-margin">49.4%</h3>
					Current server load
					<div class="text-muted text-size-small">34.6% avg</div>
				</div>

				<div id="server-load"></div>
			</div>
			<!-- /current server load -->

		</div>
    <div class="col-lg-4">

			<!-- Today's revenue -->
			<div class="panel bg-blue-400">
				<div class="panel-body">
					<div class="heading-elements">
						<ul class="icons-list">
	                		<li><a data-action="reload"></a></li>
	                	</ul>
                	</div>

					<h3 class="no-margin">$18,390</h3>
					Today's revenue
					<div class="text-muted text-size-small">$37,578 avg</div>
				</div>

				<div id="today-revenue"></div>
			</div>
			<!-- /today's revenue -->

		</div>
    <div class="col-lg-12">

			<!-- Traffic sources -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Traffic sources</h6>
					<div class="heading-elements">
						<form class="heading-form" action="#">
							<div class="form-group">
								<label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
									<input type="checkbox" class="switch" checked="checked">
									Live update:
								</label>
							</div>
						</form>
					</div>
				</div>

				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-4">
							<ul class="list-inline text-center">
								<li>
									<a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-plus3"></i></a>
								</li>
								<li class="text-left">
									<div class="text-semibold">New visitors</div>
									<div class="text-muted">2,349 avg</div>
								</li>
							</ul>

							<div class="col-lg-10 col-lg-offset-1">
								<div class="content-group" id="new-visitors"></div>
							</div>
						</div>

						<div class="col-lg-4">
							<ul class="list-inline text-center">
								<li>
									<a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-watch2"></i></a>
								</li>
								<li class="text-left">
									<div class="text-semibold">New sessions</div>
									<div class="text-muted">08:20 avg</div>
								</li>
							</ul>

							<div class="col-lg-10 col-lg-offset-1">
								<div class="content-group" id="new-sessions"></div>
							</div>
						</div>

						<div class="col-lg-4">
							<ul class="list-inline text-center">
								<li>
									<a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-people"></i></a>
								</li>
								<li class="text-left">
									<div class="text-semibold">Total online</div>
									<div class="text-muted"><span class="status-mark border-success position-left"></span> 5,378 avg</div>
								</li>
							</ul>

							<div class="col-lg-10 col-lg-offset-1">
								<div class="content-group" id="total-online"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="position-relative" id="traffic-sources"></div>
			</div>
			<!-- /traffic sources -->

		</div>



    <div class="col-md-6">
      <!-- Simple list -->
    		<div class="panel panel-flat">
    			<div class="panel-heading">
    				<h5 class="panel-title">Game Type Name</h5>
    				<div class="heading-elements">
    					<ul class="icons-list">
            		<li><a data-action="collapse"></a></li>
            		<li><a data-action="reload"></a></li>
            		<li><a data-action="close"></a></li>
            	</ul>
          	</div>
    			</div>

    			<div class="panel-body">
    				<ul class="media-list">
    					<li class="media-header">QUIZ NAME</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
    								<img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">James Alexander</div>
    							<span class="text-muted">Development</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                  	<li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Jeremy Victorino</div>
    							<span class="text-muted">Finances</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Margo Baker</div>
    							<span class="text-muted">Marketing</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Monica Smith</div>
    							<span class="text-muted">Design</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media-header">-----------------------------------------</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Bastian Miller</div>
    							<span class="text-muted">Web dev</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>
    				</ul>
    			</div>
    		</div>
    		<!-- /simple list -->
    </div>
    <div class="col-md-6">
      <!-- Simple list -->
    		<div class="panel panel-flat">
    			<div class="panel-heading">
    				<h5 class="panel-title">Game Type Name</h5>
    				<div class="heading-elements">
    					<ul class="icons-list">
            		<li><a data-action="collapse"></a></li>
            		<li><a data-action="reload"></a></li>
            		<li><a data-action="close"></a></li>
            	</ul>
          	</div>
    			</div>

    			<div class="panel-body">
    				<ul class="media-list">
    					<li class="media-header">QUIZ NAME</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
    								<img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">James Alexander</div>
    							<span class="text-muted">Development</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                  	<li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Jeremy Victorino</div>
    							<span class="text-muted">Finances</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Margo Baker</div>
    							<span class="text-muted">Marketing</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Monica Smith</div>
    							<span class="text-muted">Design</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media-header">-----------------------------------------</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Bastian Miller</div>
    							<span class="text-muted">Web dev</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>
    				</ul>
    			</div>
    		</div>
    		<!-- /simple list -->
    </div>
    <div class="col-md-6">
      <!-- Simple list -->
    		<div class="panel panel-flat">
    			<div class="panel-heading">
    				<h5 class="panel-title">Game Type Name</h5>
    				<div class="heading-elements">
    					<ul class="icons-list">
            		<li><a data-action="collapse"></a></li>
            		<li><a data-action="reload"></a></li>
            		<li><a data-action="close"></a></li>
            	</ul>
          	</div>
    			</div>

    			<div class="panel-body">
    				<ul class="media-list">
    					<li class="media-header">QUIZ NAME</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
    								<img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">James Alexander</div>
    							<span class="text-muted">Development</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                  	<li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Jeremy Victorino</div>
    							<span class="text-muted">Finances</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Margo Baker</div>
    							<span class="text-muted">Marketing</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Monica Smith</div>
    							<span class="text-muted">Design</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media-header">-----------------------------------------</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Bastian Miller</div>
    							<span class="text-muted">Web dev</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>
    				</ul>
    			</div>
    		</div>
    		<!-- /simple list -->
    </div>
    <div class="col-md-6">
      <!-- Simple list -->
    		<div class="panel panel-flat">
    			<div class="panel-heading">
    				<h5 class="panel-title">Game Type Name</h5>
    				<div class="heading-elements">
    					<ul class="icons-list">
            		<li><a data-action="collapse"></a></li>
            		<li><a data-action="reload"></a></li>
            		<li><a data-action="close"></a></li>
            	</ul>
          	</div>
    			</div>

    			<div class="panel-body">
    				<ul class="media-list">
    					<li class="media-header">QUIZ NAME</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
    								<img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">James Alexander</div>
    							<span class="text-muted">Development</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                  	<li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Jeremy Victorino</div>
    							<span class="text-muted">Finances</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Margo Baker</div>
    							<span class="text-muted">Marketing</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Monica Smith</div>
    							<span class="text-muted">Design</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media-header">-----------------------------------------</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Bastian Miller</div>
    							<span class="text-muted">Web dev</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>
    				</ul>
    			</div>
    		</div>
    		<!-- /simple list -->
    </div>
    <div class="col-md-6">
      <!-- Simple list -->
    		<div class="panel panel-flat">
    			<div class="panel-heading">
    				<h5 class="panel-title">Game Type Name</h5>
    				<div class="heading-elements">
    					<ul class="icons-list">
            		<li><a data-action="collapse"></a></li>
            		<li><a data-action="reload"></a></li>
            		<li><a data-action="close"></a></li>
            	</ul>
          	</div>
    			</div>

    			<div class="panel-body">
    				<ul class="media-list">
    					<li class="media-header">QUIZ NAME</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
    								<img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">James Alexander</div>
    							<span class="text-muted">Development</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                  	<li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Jeremy Victorino</div>
    							<span class="text-muted">Finances</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Margo Baker</div>
    							<span class="text-muted">Marketing</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Monica Smith</div>
    							<span class="text-muted">Design</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media-header">-----------------------------------------</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Bastian Miller</div>
    							<span class="text-muted">Web dev</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>
    				</ul>
    			</div>
    		</div>
    		<!-- /simple list -->
    </div>
    <div class="col-md-6">
      <!-- Simple list -->
    		<div class="panel panel-flat">
    			<div class="panel-heading">
    				<h5 class="panel-title">Game Type Name</h5>
    				<div class="heading-elements">
    					<ul class="icons-list">
            		<li><a data-action="collapse"></a></li>
            		<li><a data-action="reload"></a></li>
            		<li><a data-action="close"></a></li>
            	</ul>
          	</div>
    			</div>

    			<div class="panel-body">
    				<ul class="media-list">
    					<li class="media-header">QUIZ NAME</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
    								<img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">James Alexander</div>
    							<span class="text-muted">Development</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                  	<li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Jeremy Victorino</div>
    							<span class="text-muted">Finances</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Margo Baker</div>
    							<span class="text-muted">Marketing</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Monica Smith</div>
    							<span class="text-muted">Design</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>

    					<li class="media-header">-----------------------------------------</li>

    					<li class="media">
    						<div class="media-left media-middle">
    							<a href="#">
                    <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
    							</a>
    						</div>

    						<div class="media-body">
    							<div class="media-heading text-semibold">Bastian Miller</div>
    							<span class="text-muted">Web dev</span>
    						</div>

    						<div class="media-right media-middle">
    							<ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>9478</b></li>
                  	<li><i style="font-size:25px" class="icon-trophy2"></i></li>
                	</ul>
    						</div>
    					</li>
    				</ul>
    			</div>
    		</div>
    		<!-- /simple list -->
    </div>
  </div>

    <!-- Simple panel -->
    {{-- <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Simple panel</h5>
        </div>

        <div class="panel-body">
            <h6 class="text-semibold">Start your development with no hassle!</h6>
            <p class="content-group">Common problem of templates is that all code is deeply integrated into the core. This limits your freedom in decreasing amount of code, i.e. it becomes pretty difficult to remove unnecessary code from the project. Limitless allows you to remove unnecessary and extra code easily just by removing the path to specific LESS file with component styling. All plugins and their options are also in separate files. Use only components you actually need!</p>

            <h6 class="text-semibold">What is this?</h6>
            <p class="content-group">Starter kit is a set of pages, useful for developers to start development process from scratch. Each layout includes base components only: layout, page kits, color system which is still optional, bootstrap files and bootstrap overrides. No extra CSS/JS files and markup. CSS files are compiled without any plugins or components. Starter kit was moved to a separate folder for better accessibility.</p>

            <h6 class="text-semibold">How does it work?</h6>
            <p>You open one of the starter pages, add necessary plugins, uncomment paths to files in components.less file, compile new CSS. That's it. I'd also recommend to open one of main pages with functionality you need and copy all paths/JS code from there to your new page, it's just faster and easier.</p>
        </div>
    </div> --}}
    <!-- /simple panel -->

</div>
<!-- /content area -->
@endsection
