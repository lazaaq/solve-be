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
            <li><a href="{{route('quiz.index')}}">Material</a></li>
            <li class="active">Detail Material </li>
        </ul>
    </div>
</div>

<div class="content">
  <div class="panel panel-white">
		<div class="panel-heading">
    	<h6 class="panel-title" style="width:50%"><i class="icon-cog3 position-left"></i>File Materi</h6>
    </div>
		<div class="panel-body">
      <div class="col-md-12">
        <button id="btn-create-file-materi" type="button" class="btn btn-primary btn-sm bg-primary-800"><i class="icon-add position-left"></i> Create New</button>
        <table class="table" id="table-file-materi" class="display" style="width:100%">
          <thead>
            <tr>
               <th>No</th>
               <th>File Name</th>
               <th>File Url</th>
               <th>Updated At</th>
               <th class="col-md-2">Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
		</div>
	</div>
</div>

@include('material.file_materi.create')
@include('material.file_materi.edit')
@endsection
@push('after_script')
<script>
  var tableFileMateri;
  $(document).ready(function(){

    /* File Materi */

    // get data
  
    tableFileMateri = $('#table-file-materi').DataTable({
      pageLength: 5,
		  processing	: true,
		  language: {
        search: "_INPUT_",
        searchPlaceholder: "Search records"
      },
  		  serverSide	: true,
  		  stateSave: true,
			ajax: {
        url: "{{ url('table/data-file-materi') }}/" + "{{ $material['id'] }}",
				type: "GET",
			},
			columns: [
				{ data: 'id', name:'id', visible:false},
				{ data: 'name', name:'name', visible:true},
        { data: 'file_url', name:'file_url', visible:true},
				{ data: 'updated_at', name: 'updated_at', visible: true},
				{ data: 'action', name:'action', visible:true},
			],
    }); 


    // create data
		$("#btn-create-file-materi").on('click', function(){
      $('.fileinput-remove-button').click();
    	$('#modal-create-file-materi').modal('show');
    });

    // destroy data 
    $('#table-file-materi tbody').on( 'click', 'button', function () {
      var data = tableFileMateri.row( $(this).parents('tr') ).data();
        swal({
        text: "Are you sure to delete data?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: "{{ url('admin/material-info/file-materi//delete') }}"+"/"+data['id'],
            method: 'get',
            success: function(result){
              tableFileMateri.ajax.reload();
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

    /* edit data*/
    $("#table-file-materi tbody").on('click','#btn-edit', function(){
      $("#material-edit :input").val('');
      $('#modal-edit-file-materi').modal('show');
      var data = tableFileMateri.row( $(this).parents('tr') ).data();
      var id = data['id'];
      var name = data['name']
      var desc = data['description']
      var file_url = data['file_url']
      var token = $('input[name=_token]').val();
      var urlData = " {{ url('admin/quizcategory') }}"+"/"+id+"/edit";
      var d = new Date();
      $.getJSON(urlData, function(data){
        $('input[name=_method]').val('PUT');
        $('input[name=_token]').val(token);
        $('input[name=name]').val(name);
        $('input[name=id_edit]').val(id);
        $('textarea[name=description]').val(desc);
        if(file_url) {
            var fileUrl = "{{ url('/storage/file-materi/') }}" + "/" + file_url;
            console.log("kesini: ", fileUrl)
            $('#file_materi').attr('href', file_url);
            $('#file_materi').show();
        } else {
            $('#file_materi').hide();
        }
      });
    });


    /* END File Materi */
  });



</script>
@endpush
