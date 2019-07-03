@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">User</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="">Master Data</a></li>
            <li class="active">User</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <!-- State saving -->
	<div class="panel panel-flat">
    <div style="padding:20px">
      <a href="{{route('user.create')}}" class="btn btn-primary btn-sm"><i class="icon-add position-left"></i>Create New</a>
  		<table id="table-user" class="table">
  			<thead>
  				<tr>
            <th>Id</th>
  					<th>Name</th>
  					<th>Username</th>
            <th>Email</th>
  					<th width="13%">Actions</th>
  				</tr>
  			</thead>
  			<tbody>
  			</tbody>
  		</table>
    </div>
	</div>
	<!-- /state saving -->
</div>
<!-- /content area -->
@endsection

@push('after_script')
<script>
var tableUser;
  $(document).ready(function(){
		/* tabel user */
    tableUser = $('#table-user').DataTable({
      processing	: true,
			serverSide	: true,
			stateSave: true,
      ajax		: {
          url: "{{ url('table/data-user') }}",
          type: "GET",
          data: {
              '_token': $('meta[name="csrf-token"]').attr('content'),
          },
      },
      columns: [
          { data: 'id', name:'id', visible:false},
          { data: 'name', name:'name', visible:true},
          { data: 'username', name:'username', visible:true},
          { data: 'email', name:'email', visible:true},
          { data: 'action', name:'action', visible:true},
      ],
    });
  });
  
</script>
@endpush
