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
            <li class="active">Quiz</li>
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
      {{-- <a href="{{route('quiz.create')}}" class="btn btn-primary btn-sm bg-primary-800"><i class="icon-add position-left"></i>Create New</a> --}}
      <table class="table" id="table-quiz" class="display" style="width:100%">
  			<thead>
      		<tr>
             <th>id</th>
             <th>Code</th>
             <th>Category</th>
             <th>Type</th>
             <th>Title</th>
             <th>Description</th>
             <th>Total Question</th>
             <th>Visible Question</th>
             <th>Time</th>
             <th>Status</th>
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
@include('quiz.create')
@include('quiz.edit')

@endsection
@push('after_script')
  <script>
  var tableQuiz;
    $(document).ready(function(){
      $("#btn-create").on('click', function(){
          $('.fileinput-remove-button').click();
          $('#modal-create').modal('show');
      });
  		/* START OF DATATABLE */
      tableQuiz = $('#table-quiz').DataTable({
        processing	: true,
        language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records"
                  },
        // dom 		: "<fl<t>ip>",
  			serverSide	: true,
  			stateSave: true,
        ajax		: {
            url: "{{ url('table/data-quiz') }}",
            type: "GET",
        },
        columns: [
            { data: 'id', name:'id', visible:false},
            { data: 'code', name:'code', visible:true},
            { data: 'quiz_category', name:'quiz_category', visible:true},
            { data: 'quiz_type', name:'quiz_type', visible:true},
            { data: 'title', name:'title', visible:true},
            { data: 'description', name:'description', visible:true},
            { data: 'sum_question', name:'sum_question', visible:true},
            { data: 'tot_visible', name:'tot_visible', visible:true},
            { data: 'time', name:'time', visible:true},
            { data: 'status', name:'status', visible:true},
            { data: 'action', name:'action', visible:true},
        ],
      });
      /*END OF DATATABLE*/

      /* START OF GET DATA FOR FORM EDIT */
      $("#table-quiz tbody").on('click','#btn-edit', function(){
          $('.fileinput-remove-button').click();
          $("#quiz-edit :input").val('');
          $('#modal-edit').modal('show');
          var data = tableQuiz.row( $(this).parents('tr') ).data();
          var id = data['id'];
          var token = $('input[name=_token]').val();
          var urlData = " {{ url('admin/quiz') }}"+"/"+id+"/edit";
          var d = new Date();
          $.getJSON( urlData, function(data){
          /*START GET PICTURE*/
            $('#img-edit').empty();
            var img = $('<img id="img-quiztype" class="img-responsive" src="{{asset('img/blank.jpg')}}" alt="Quiz Type" title="" width="100" height="50"><br>');
            if (data['data']['pic_url'] != "blank.jpg") {
              var img = $('<img id="img-quiztype" class="img-responsive" src="{{ url('storage/quiz/') }}/'+id+'?'+d.getTime()+'" alt="Quiz Type" title="" width="100" height="50"><br>');
            }
            $('#img-edit').append(img);
          /*END GET PICTURE*/
            // $('input[name=picture_edit]').val('');
            $('input[name=_method]').val('PUT');
            $('input[name=_token]').val(token);
            $('input[name=id_edit]').val(data['data']['id']);
            $('input[name=title_edit]').val(data['data']['title']);
            $('textarea[name=description_edit]').val(data['data']['description']);
            $('input[name=total_visible_question_edit]').val(data['data']['tot_visible']);
            $('input[name=total_question_edit]').val(data['data']['sum_question']);
            $('input[name=start_time_edit]').val(data['data']['start_time']);
            $('input[name=end_time_edit]').val(data['data']['end_time']);
            $('input[name=time_edit]').val(data['data']['time']);
            if (data['data']['code'] != null) {
              $('input[name=code]').val('checked').parent().addClass('checked',true).trigger('change');
            }
            $('input[name=code]').val('checked');
            $('select[name=quiz_category_edit]').val(data['data']['quiz_category_id']).trigger('change');
            $('select[name=quiz_type_edit]').val(data['data']['quiz_type_id']).trigger('change');
          });
      });
      /*END OF GET DATA FOR FORM EDIT*/

      /* START OF DELETE DATA */
      $('#table-quiz tbody').on( 'click', 'button', function () {
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
                url: "{{ url('admin/quiz/delete') }}"+"/"+data['id'],
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

        /* START OF CHANGE IS VIEW DATA */
        $('#table-quiz tbody').on( 'click', '#change-status', function () {
          var data = tableQuiz.row( $(this).parents('tr') ).data();
          var formData = new FormData();
          formData.append('_token', "{{ csrf_token() }}");
          formData.append('id', data['id']);
          if (data['status'] == 'active') {
            swal(
              {
                // title: "Are you sure?",
                text: "Are you sure to inactive quiz?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              }
            ).then((willDelete) => {
              if (willDelete) {
                $.ajax({
                  url: "{{ url('admin/quiz/change-status') }}"+"/"+data['id'],
                  method: 'post',
                  processData: false,
                  contentType: false,
                  dataType: 'JSON',
                  data: formData,
                  success: function(data){
                    if(data.success){
                      tableQuiz.ajax.reload();
                      toastr.success('Successfully updated data!', 'Success', {timeOut: 5000});
                    }else{
                      for(var count = 0; count < data.errors.length; count++){
                        toastr.error(data.errors[count], 'Error', {timeOut: 5000});
                      }
                    }
                  },
                });
              }
            });
          } else {
            swal(
              {
                text: "Are you sure to active quiz?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              }
            ).then((willDelete) => {
              if (willDelete) {
                $.ajax({
                  url: "{{ url('admin/quiz/change-status') }}"+"/"+data['id'],
                  method: 'post',
                  processData: false,
                  contentType: false,
                  dataType: 'JSON',
                  data: formData,
                  success: function(data){
                    if(data.success){
                      tableQuiz.ajax.reload();
                      toastr.success('Successfully updated data!', 'Success', {timeOut: 5000});
                    }else{
                      for(var count = 0; count < data.errors.length; count++){
                      toastr.error(data.errors[count], 'Error', {timeOut: 5000});
                      }
                    }
                  },
                });
              }
            });
          }
        });
        /* END OF CHANGE IS VIEW DATA*/
    });
  </script>
@endpush
