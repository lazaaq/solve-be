@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Banners</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="">Master Data</a></li>
            <li class="active">Banners</li>
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
      <a href="{{route('banner.create')}}" class="btn btn-primary btn-sm bg-primary-800"><i class="icon-add position-left"></i>Create New</a>
    	<table class="table" id="table-banner" class="display" style="width:100%">
  			<thead>
      		<tr>
             <th>Id</th>
             <th>Picture</th>
             <th>Linked To</th>
             <th>Description</th>
             <th class="col-md-1">Viewed</th>
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
@endsection
@push('after_script')
  <script>
  var tableQuizType;
    $(document).ready(function(){
  		/* tabel user */
      tableQuizType = $('#table-banner').DataTable({
        processing	: true,
        language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records"
                  },
        // dom 		: "<fl<t>ip>",
  			serverSide	: true,
  			stateSave: true,
        ajax		: {
            url: "{{ url('table/data-banner') }}",
            type: "GET",
        },
        columns: [
            { data: 'id', name:'id', visible:false},
            { data: 'pictures', name:'pictures', visible:true},
            { data: 'linkTo', name:'linkTo', visible:true},
            { data: 'description', name:'description', visible:true},
            { data: 'isViewed', name:'isViewed', visible:true},
            { data: 'action', name:'action', visible:true},
        ],
      });
      $('#table-banner tbody').on( 'click', '#delete', function () {
        var data = tableQuizType.row( $(this).parents('tr') ).data();
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
              url: "{{ url('admin/banner/delete') }}"+"/"+data['id'],
              method: 'get',
              success: function(result){
                tableQuizType.ajax.reload();
                swal("Poof! Your imaginary file has been deleted!", {
                  icon: "success",
                });
              }
            });
          } else {
            swal("Your imaginary file is safe!");
          }
        });
      });

      $('#table-banner tbody').on( 'click', '#change-is-view', function () {
        var data = tableQuizType.row( $(this).parents('tr') ).data();
        swal({
          // title: "Are you sure?",
          text: "Are you sure to change is view data?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              url: "{{ url('admin/banner/change-is-view') }}"+"/"+data['id'],
              method: 'get',
              success: function(result){
                tableQuizType.ajax.reload();
                swal("Poof! Your imaginary file has been updated!", {
                  icon: "success",
                });
              }
            });
          } else {
            swal("Your imaginary file is safe!");
          }
        });
      });
    });
  </script>
@endpush
