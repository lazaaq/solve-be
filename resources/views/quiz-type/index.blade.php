@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Quiz Type</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="">Master Data</a></li>
            <li class="active">Quiz Type</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <!-- State saving -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">State saving</h5>
			<div class="heading-elements">
				<ul class="icons-list">
      		<li><a data-action="collapse"></a></li>
      		<li><a data-action="reload"></a></li>
      		<li><a data-action="close"></a></li>
      	</ul>
    	</div>
		</div>

		<div class="panel-body">
			DataTables has the option of being able to <code>save the state</code> of a table: its paging position, ordering state etc., so that is can be restored when the user reloads a page, or comes back to the page after visiting a sub-page. This state saving ability is enabled by the <code>stateSave</code> option. The <code>duration</code> for which the saved state is valid can be set using the <code>stateDuration</code> initialisation parameter (2 hours by default).
		</div>

		<table class="table datatable-save-state">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Picture</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	<!-- /state saving -->
</div>
<!-- /content area -->
@endsection
