@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Version App</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="">Master Data</a></li>
            <li class="active">Version App</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <!-- State saving -->
	<div class="panel panel-flat">
		{{-- <div class="panel-heading">
			<h5 class="panel-title">State saving</h5>
		</div> --}}

		{{-- <div class="panel-body"> --}}
			{{-- DataTables has the option of being able to <code>save the state</code> of a table: its paging position, ordering state etc., so that is can be restored when the user reloads a page, or comes back to the page after visiting a sub-page. This state saving ability is enabled by the <code>stateSave</code> option. The <code>duration</code> for which the saved state is valid can be set using the <code>stateDuration</code> initialisation parameter (2 hours by default). --}}
		{{-- </div> --}}
    <div style="padding:20px">
      <button id="btn-create" type="button" class="btn btn-primary btn-sm bg-primary-800"><i class="icon-add position-left"></i> Create New</button>
      {{-- <a href="{{route('version.create')}}" class="btn btn-primary btn-sm bg-primary-800"><i class="icon-add position-left"></i>Create New</a> --}}
    	<table class="table" id="table-version" class="display" style="width:100%">
  			<thead>
      		<tr>
             <th>Id</th>
             <th>Version</th>
             <th>Sub Version</th>
             <th>Year</th>
             {{-- <th class="col-md-1">Descripion</th> --}}
             <th class="col-md-2">Action</th>
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
@include('version.create')
@include('version.edit')

@endsection
@push('after_script')
  <script>
  var tableVersion;
    $(document).ready(function(){
      $("#btn-create").on('click', function(){
          $('input[name=version]').val('');
          $('input[name=sub_version]').val('');
          $('input[name=year]').val('');
          $('#modal-create').modal('show');
      });
  		/* START OF DATATABLE */
      tableVersion = $('#table-version').DataTable({
        processing	: true,
        language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records"
                  },
        // dom 		: "<fl<t>ip>",
  			serverSide	: true,
  			stateSave: true,
        ajax		: {
            url: "{{ url('table/data-version') }}",
            type: "GET",
        },
        columns: [
            { data: 'id', name:'id', visible:false},
            { data: 'version', name:'version', visible:true},
            { data: 'sub_version', name:'sub_version', visible:true},
            { data: 'year', name:'year', visible:true},
            // { data: 'description', name:'description', visible:true},
            { data: 'action', name:'action', visible:true},
        ],
      });
      $('#table-version tbody').on( 'click', '#delete', function () {
        var data = tableVersion.row( $(this).parents('tr') ).data();
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
              url: "{{ url('admin/version/delete') }}"+"/"+data['id'],
              method: 'get',
              success: function(result){
                tableVersion.ajax.reload();
                toastr.success('Successfully deleted data!', 'Success', {timeOut: 5000});
                // swal("Poof! Your imaginary file has been deleted!", {
                //   icon: "success",
                // });
              }
            });
          }
        });
      });
      /* END OF DATATABLE */

      /* START OF GET DATA FOR FORM EDIT */
      $("#table-version tbody").on('click','#btn-edit', function(){
          $("#version-edit :input").val('');
          $('#modal-edit').modal('show');
          var data = tableVersion.row( $(this).parents('tr') ).data();
          var id = data['id'];
          var token = $('input[name=_token]').val();
          var urlData = " {{ url('admin/version') }}"+"/"+id+"/edit";
          $.getJSON( urlData, function(data){
            $('input[name=_method]').val('PUT');
            $('input[name=_token]').val(token);
            $('input[name=id_edit]').val(data['data']['id']);
            $('input[name=version_edit]').val(data['data']['version']);
            $('input[name=sub_version_edit]').val(data['data']['sub_version']);
            $('input[name=year_edit]').val(data['data']['year']);
          });
      });
      /*END OF GET DATA FOR FORM EDIT*/
    });
  </script>
@endpush
