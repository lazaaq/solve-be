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
		{{-- <div class="panel-heading">
			<h5 class="panel-title">State saving</h5>
		</div> --}}

		{{-- <div class="panel-body"> --}}
			{{-- DataTables has the option of being able to <code>save the state</code> of a table: its paging position, ordering state etc., so that is can be restored when the user reloads a page, or comes back to the page after visiting a sub-page. This state saving ability is enabled by the <code>stateSave</code> option. The <code>duration</code> for which the saved state is valid can be set using the <code>stateDuration</code> initialisation parameter (2 hours by default). --}}
		{{-- </div> --}}
    <div style="padding:20px">
      {{-- <button id="btn-create" type="button" class="btn btn-primary btn-sm bg-primary-800" data-toggle="modal" data-target="#modal-create"><i class="icon-add position-left"></i> Create New</button> --}}
      <button id="btn-create" type="button" class="btn btn-primary btn-sm bg-primary-800"><i class="icon-add position-left"></i> Create New</button>
    	<table class="table" id="table-quiz-type" class="display" style="width:100%">
  			<thead>
      		<tr>
             <th>Id</th>
             <th>Name</th>
             <th>Description</th>
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
@include('quiz-type.create')
<!-- /content area -->
@endsection
@push('after_script')
  <script>
  var tableQuizType;
    $(document).ready(function(){
        $("#btn-create").on('click', function(){
            $('#modal-create').modal('show');
        });
    		/* tabel user */
        tableQuizType = $('#table-quiz-type').DataTable({
        processing	: true,
        language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records"
                  },
        // dom 		: "<fl<t>ip>",
  			serverSide	: true,
  			stateSave: true,
        ajax		: {
            url: "{{ url('table/data-quiz-type') }}",
            type: "GET",
        },
        columns: [
            { data: 'id', name:'id', visible:false},
            { data: 'name', name:'name', visible:true},
            { data: 'description', name:'description', visible:true},
            { data: 'action', name:'action', visible:true},
        ],
      });
      $('#table-quiz-type tbody').on( 'click', 'button', function () {
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
              url: "{{ url('admin/quiztype/delete') }}"+"/"+data['id'],
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
    });
  </script>
@endpush
