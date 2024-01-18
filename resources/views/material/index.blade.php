@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Quiz</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="">Master Data</a></li>
            <li class="active">Material</li>
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
      <button id="btn-create-material" type="button" class="btn btn-primary btn-sm bg-primary-800"><i class="icon-add position-left"></i> Create New</button>
      <table class="table" id="table-material" class="display" style="width:100%">
  			<thead>
      		<tr>
             <th>id</th>
             <th>Category</th>
             <th>Type</th>
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
<!-- /content area -->
@include('material.create')
@include('material.edit')
@endsection
@push('after_script')
<script>
	var tableQuiz;
    $(document).ready(function(){
  		/* START OF DATATABLE */
      tableQuiz = $('#table-material').DataTable({
			processing	: true,
			language: {
                	search: "_INPUT_",
                	searchPlaceholder: "Search records"
                },
  			serverSide	: true,
  			stateSave: true,
			ajax		: {
				url: "{{ url('table/data-material') }}",
				type: "GET",
			},
			columns: [
				{ data: 'id', name:'id', visible:false},
				{ data: 'quiz_category', name:'quiz_category', visible:true},
				{ data: 'quiz_type', name: 'quiz_type', visible: true},
				{ data: 'name', name:'name', visible:true},
				{ data: 'description', name:'description', visible:true},
				{ data: 'action', name:'action', visible:true},

			],
     	}); 

		/* START OF CREATE DATA*/
		$("#btn-create-material").on('click', function(){
    	$('.fileinput-remove-button').click();
      // $('input[name=id_edit]').val(id);
        $('.fileinput-remove-button').click();
        $('input[name=name]').val('');
        $('textarea[name=description]').val('');
    	$('#modal-create-material').modal('show');
    });

    
      /* START OF GET DATA FOR FORM EDIT */
    $("#table-material tbody").on('click','#btn-edit', function(){
      $("#material-edit :input").val('');
      $('#modal-edit-material').modal('show');
      var data = tableQuiz.row( $(this).parents('tr') ).data();
      var id = data['id'];
      var name = data['name']
      var desc = data['description']
      var token = $('input[name=_token]').val();
      var urlData = " {{ url('admin/quizcategory') }}"+"/"+id+"/edit";
      var d = new Date();
      $.getJSON(urlData, function(data){
        $('input[name=_method]').val('PUT');
        $('input[name=_token]').val(token);
        $('input[name=name]').val(name);
        $('input[name=id_edit]').val(id);
        $('textarea[name=description]').val(desc);
      });
    });
    /*END OF GET DATA FOR FORM EDIT*/

    /* START OF DELETE DATA */
    $('#table-material tbody').on( 'click', 'button', function () {
      var data = tableQuiz.row( $(this).parents('tr') ).data();
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
            url: "{{ url('admin/material/delete') }}"+"/"+data['id'],
            method: 'get',
            success: function(result){
              tableQuiz.ajax.reload();
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
      /* END OF DELETE DATA */

    });
</script>
@endpush
