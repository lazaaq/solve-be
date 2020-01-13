@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Classroom Detail</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="">Master Data</a></li>
            <li><a href="{{url('admin/classroom')}}">Classroom</a></li>
            <li class="active">Classroom Detail</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <!-- State saving -->
	<div class="panel panel-flat">
		<div style="padding:20px">
      <div class="breadcrumb-line breadcrumb-line-component" style="margin-bottom:10px">
        <div class="col-md-2">
          <ul class="breadcrumb">
            <p>Class Code</p>
            <p>School Name</p>
            <p>Class Name</p>
            <p>Teacher</p>
          </ul>
        </div>
        <div class="col-md-9">
          <ul class="breadcrumb">
            <p>: {{$classroom->code}}</p>
            <p>: {{$classroom->user->school['name']}}</p>
            <p>: {{$classroom->name}}</p>
            <p>: {{$classroom->user['name']}}</p>
          </ul>
        </div>
      </div>
      <input type="hidden" name="classroom_id" id="classroom_id" value="{{$classroom->id}}">
      <input type="hidden" name="lecture_user_id" id="lecture_user_id" value="{{$classroom->user_id}}">
      <button id="btn-create" type="button" class="btn btn-primary btn-sm bg-primary-800"><i class="icon-add position-left"></i> Add Student</button>
    	<table class="table" id="table-collager-classroom" class="display" style="width:100%">
  			<thead>
      		<tr>
             <th>Id</th>
             <th>Name</th>
             <!-- <th>Code</th> -->
             <!-- <th>Teacher Name</th> -->
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

@include('collager-classroom.create')
@endsection
@push('after_script')
  <script>
  var tableCollagerClassroom;
  var classroom_id;
    $(document).ready(function(){
      classroom_id = $('#classroom_id').val();
      $("#btn-create").on('click', function(){
          $('#modal-create').modal('show');
      });
  		/* tabel user */
      tableCollagerClassroom = $('#table-collager-classroom').DataTable({
        processing	: true,
        language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records"
                  },
        // dom 		: "<fl<t>ip>",
  			serverSide	: true,
  			stateSave: true,
        ajax		: {
            url : "{{ url('table/data-collager-classroom') }}"+'/'+classroom_id,
            type: "GET",
        },
        columns: [
            { data: 'id', name:'id', visible:false},
            { data: 'collager.user.name', name:'name', visible:true},
            { data: 'action', name:'action', visible:true},
        ],
      });

      /*START OF DELETE DATA*/
      $('#table-collager-classroom tbody').on( 'click', 'button', function () {
        var data = tableCollagerClassroom.row( $(this).parents('tr') ).data();
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
              url: "{{ url('admin/collagerclassroom/delete') }}"+"/"+data['id'],
              method: 'get',
              success: function(result){
                tableCollagerClassroom.ajax.reload();
                tableCollagerClassroomAdd.ajax.reload();
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
