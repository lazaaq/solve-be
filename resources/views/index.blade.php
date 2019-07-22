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
    <div class="col-md-6">
      <!-- Simple list -->
    		<div class="panel panel-flat">
    			<div class="panel-heading">
    				<h5 class="panel-title">Simple user list</h5>
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
    					<li class="media-header">The Big Four</li>

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
