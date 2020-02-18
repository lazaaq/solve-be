@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Role</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="">Master Data</a></li>
            <li class="active">Role</li>
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
        <a href="{{route('role.create')}}" class="btn btn-primary btn-sm bg-primary-800"><i class="icon-add position-left"></i>Create New</a>
      </div>
      <table id="table-role" class="table">
  			<thead>
  				<tr>
            <th>ID</th>
            <th>Role</th>
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
var tableRole;
  $(document).ready(function(){
		/* tabel role */
    tableRole = $('#table-role').DataTable({
      processing	: true,
			serverSide	: true,
			stateSave: true,
      language: {
                  search: "_INPUT_",
                  searchPlaceholder: "Search records"
                },
      ajax		: {
          url: "{{ url('table/data-role') }}",
          type: "GET",
      },

      columns: [
          { data: 'id', name:'id', visible:false},
          { data: 'name', name:'name', visible:true},
          { data: 'action', name:'action', visible:true},
      ],
    });

    $('#table-role tbody').on( 'click', 'button', function () {
        var data = tableRole.row( $(this).parents('tr') ).data();
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
              url: "{{ url('admin/role/delete') }}"+"/"+data['id'],
              method: 'get',
              success: function(result){
                tableRole.ajax.reload();
                swal("Data has been deleted!", {
                  icon: "success",
                });
              }
            });
          } else {
            swal("Data is safe!");
          }
        });
      });
  });

</script>
@endpush
