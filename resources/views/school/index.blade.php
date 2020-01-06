@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">School</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="">Master Data</a></li>
            <li class="active">School</li>
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
    	<table class="table" id="table-school" class="display" style="width:100%">
  			<thead>
      		<tr>
             <th>Id</th>
             <th>Name</th>
             <th>Address</th>
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
@include('school.create')
@include('school.edit')

@endsection
@push('after_script')
  <script>
  var tableSchool;
    $(document).ready(function(){
      $("#btn-create").on('click', function(){
          $('input[name=name]').val('');
          $('input[name=address]').val('');
          $('#modal-create').modal('show');
      });
  		/* START OF DATATABLE */
      tableSchool = $('#table-school').DataTable({
        processing	: true,
        language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records"
                  },
        // dom 		: "<fl<t>ip>",
  			serverSide	: true,
  			stateSave: true,
        ajax		: {
            url: "{{ url('table/data-school') }}",
            type: "GET",
        },
        columns: [
            { data: 'id', name:'id', visible:false},
            { data: 'name', name:'name', visible:true},
            { data: 'address', name:'address', visible:true},
            { data: 'action', name:'action', visible:true}
        ],
      });
      $('#table-school tbody').on( 'click', '#delete', function () {
        var data = tableSchool.row( $(this).parents('tr') ).data();
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
              url: "{{ url('admin/school/delete') }}"+"/"+data['id'],
              method: 'get',
              success: function(result){
                tableSchool.ajax.reload();
              }
            });
          }
        });
      });
      /* END OF DATATABLE */

      /* START OF GET DATA FOR FORM EDIT */
      $("#table-school tbody").on('click','#btn-edit', function(){
          $("#school-edit :input").val('');
          $('#modal-edit').modal('show');
          var data = tableSchool.row( $(this).parents('tr') ).data();
          var id = data['id'];
          var token = $('input[name=_token]').val();
          var urlData = " {{ url('admin/school') }}"+"/"+id+"/edit";
          $.getJSON( urlData, function(data){
            $('input[name=_method]').val('PUT');
            $('input[name=_token]').val(token);
            $('input[name=id_edit]').val(data['data']['id']);
            $('input[name=name_edit]').val(data['data']['name']);
            $('input[name=address_edit]').val(data['data']['address']);
          });
      });
      /*END OF GET DATA FOR FORM EDIT*/
    });
  </script>
@endpush
