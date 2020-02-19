@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Teacher</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="">Master Data</a></li>
            <li class="active">Teacher</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <!-- State saving -->
	<div class="panel panel-flat">
    <div style="padding:20px">
      <div class="col-md-1">
        <a href="{{route('lecture.create')}}" class="btn btn-primary btn-sm bg-primary-800"><i class="icon-add position-left"></i>Create New</a>
      </div>
      <table id="table-teacher" class="table">
  			<thead>
  				<tr>
            <th>Id</th>
  					<th>Name</th>
  					<th>Username</th>
            <th>Email</th>
            <th>Phone Number</th>
  					<th class="col-md-2">Actions</th>
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
var tableTeacher;
  $(document).ready(function(){
		/* tabel user */
    tableTeacher = $('#table-teacher').DataTable({
      processing	: true,
			serverSide	: true,
			stateSave: true,
      language: {
                  search: "_INPUT_",
                  searchPlaceholder: "Search records"
                },
      ajax		: {
          url: "{{ url('table/data-teacher') }}",
          type: "GET",
      },

      columns: [
          { data: 'id', name:'id', visible:false},
          { data: 'name', name:'name', visible:true},
          { data: 'username', name:'username', visible:true},
          { data: 'email', name:'email', visible:true},
          { data: 'phone_number', name:'phone_number', visible:true},
          { data: 'action', name:'action', visible:true},
      ],
    });

    $('#table-teacher tbody').on( 'click', 'button', function () {
        var data = tableTeacher.row( $(this).parents('tr') ).data();
          swal({
          // title: "Are you sure?",
          text: "Are you sure to delete data?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              url: "{{ url('admin/lecture/delete') }}"+"/"+data['id'],
              method: 'get',
              success: function(result){
                tableTeacher.ajax.reload();
                swal("Data has been deleted!", {
                  icon: "success",
                });
              }
            });
          } else {
            swal("Data file is safe!");
          }
        });
      });
  });

</script>
@endpush
