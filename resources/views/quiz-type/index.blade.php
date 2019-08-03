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
	<div class="panel panel-flat">
    <div style="padding:20px">
      <button id="btn-create" type="button" class="btn btn-primary btn-sm bg-primary-800"><i class="icon-add position-left"></i> Create New</button>
    	<table class="table" id="table-quiz-type" class="display" style="width:100%">
  			<thead>
      		<tr>
             <th>Id</th>
             <th>Category</th>
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
</div>
@include('quiz-type.create')
@include('quiz-type.edit')
<!-- /content area -->
@endsection
@push('after_script')
  <script>
  var tableQuizType;
    $(document).ready(function(){
        $("#btn-create").on('click', function(){
            $('.fileinput-remove-button').click();
            $('input[name=name]').val('');
            $('textarea[name=description]').val('');
            $('#modal-create').modal('show');
        });
    		/* START OF DATATABLE */
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
              { data: 'quiz_category', name:'quiz_category', visible:true},
              { data: 'name', name:'name', visible:true},
              { data: 'description', name:'description', visible:true},
              { data: 'action', name:'action', visible:true},
          ],
        });
        /* END  OF DATATABLE */

      /* START OF GET DATA FOR FORM EDIT */
      $("#table-quiz-type tbody").on('click','#btn-edit', function(){
          $('.fileinput-remove-button').click();
          $("#quiz-type-edit :input").val('');
          $('#modal-edit').modal('show');
          var data = tableQuizType.row( $(this).parents('tr') ).data();
          var id = data['id'];
          var category_id = data['quiz_category'];
          var token = $('input[name=_token]').val();
          var urlData = " {{ url('admin/quiztype') }}"+"/"+id+"/edit";
          $.ajax({
              type: 'GET',
              dataType: 'json',
              url: "{{ url('select/data-quiz-category') }}"+"/"+category_id,
          }).then(function (data) {
              // create the option and append to Select2
              var option = new Option(data.name, data.id, true, true);
              $('#quiz_category_edit').append(option).trigger('change');
          });

          $.getJSON( urlData, function(data){
          /*START GET PICTURE*/
            $('#img-edit').empty();
            var img = $('<img id="img-quiztype" class="img-responsive" src="{{asset('img/blank.jpg')}}" alt="Quiz Type" title="" width="100" height="50"><br>');
            if (data['data']['pic_url'] != "blank.jpg") {
              var img = $('<img id="img-quiztype" class="img-responsive" src="{{ url('storage/quiz_type/') }}/'+id+'" alt="Quiz Type" title="" width="100" height="50"><br>');
            }
            $('#img-edit').append(img);
          /*END GET PICTURE*/
            $('input[name=_method]').val('PUT');
            $('input[name=_token]').val(token);
            $('input[name=name_edit]').val(data['data']['name']);
            $('input[name=id_edit]').val(data['data']['id']);
            $('textarea[name=description_edit]').val(data['data']['description']);
          });
      });
      /*END OF GET DATA FOR FORM EDIT*/

      /*START OF DELETE DATA*/
      $('#table-quiz-type tbody').on( 'click', '#delete', function () {
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
                console.log('HALO');
                if(result.status === 'failed'){
                    toastr.error(result.message, 'Error', {timeOut: 5000});
                }
                else {
                  tableQuizType.ajax.reload();
                  toastr.success('Successfully deleted data!', 'Success Alert', {timeOut: 5000});
                }
              }
            });
          }
        });
      });
      /*END OF DELETE DATA*/
    });
  </script>
@endpush
