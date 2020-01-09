@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Classroom</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="">Master Data</a></li>
            <li class="active">Classroom</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <!-- State saving -->
	<div class="panel panel-flat">
		<div style="padding:20px">
      <button id="btn-create" type="button" class="btn btn-primary btn-sm bg-primary-800"><i class="icon-add position-left"></i> Create New</button>
    	<table class="table" id="table-classroom" class="display" style="width:100%">
  			<thead>
      		<tr>
             <th>Id</th>
             <th>Name</th>
             <th>Code</th>
             <th>Teacher Name</th>
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

@include('classroom.create')
@include('classroom.edit')
@endsection
@push('after_script')
  <script>
  var tableClassroom;
    $(document).ready(function(){
      /* Trigger modal create*/
      $("#btn-create").on('click', function(){
          $('input[name=name]').val('');
          $('input[name=code]').val('');
          $('#modal-create').modal('show');
      });
      /* End of Trigger modal create*/
  		/* tabel user */
      tableClassroom = $('#table-classroom').DataTable({
        processing	: true,
        language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records"
                  },
        // dom 		: "<fl<t>ip>",
  			serverSide	: true,
  			stateSave: true,
        ajax		: {
            url : "{{ url('table/data-classroom') }}",
            type: "GET",
        },
        columns: [
            { data: 'id', name:'id', visible:false},
            { data: 'name', name:'name', visible:true},
            { data: 'code', name:'code', visible:true},
            { data: 'lecture.user.name', name:'lecturer', visible:true},
            { data: 'action', name:'action', visible:true},
        ],
      });

      /* START OF GET DATA FOR FORM EDIT */
      $("#table-classroom tbody").on('click','#btn-edit', function(){
          $("#classroom-edit :input").val('');
          $('#modal-edit').modal('show');
          var data = tableClassroom.row( $(this).parents('tr') ).data();
          var id = data['id'];
          var token = $('input[name=_token]').val();
          var urlData = " {{ url('admin/classroom') }}"+"/"+id+"/edit";
          var d = new Date();
          $.getJSON( urlData, function(data){
            console.log(data);
            $('input[name=_method]').val('PUT');
            $('input[name=_token]').val(token);
            $('input[name=name_edit]').val(data['data']['name']);
            $('input[name=id_edit]').val(data['data']['id']);
            $('input[name=code_edit]').val(data['data']['code']);
          });
      });
      /*END OF GET DATA FOR FORM EDIT*/

      /*START OF DELETE DATA*/
      $('#table-classroom tbody').on( 'click', 'button', function () {
        var data = tableClassroom.row( $(this).parents('tr') ).data();
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
              url: "{{ url('admin/classroom/delete') }}"+"/"+data['id'],
              method: 'get',
              success: function(result){
                tableClassroom.ajax.reload();
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
      /*END OF DELETE DATA*/

    });
  </script>
@endpush
