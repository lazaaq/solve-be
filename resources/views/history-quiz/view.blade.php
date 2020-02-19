@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Detail Quiz {{$quiz->title}}</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{url('admin/history-quiz')}}">History by Quiz</a></li>
            <li class="active">{{$quiz->title}}</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <!-- State saving -->
	<div class="panel panel-flat">
    <input type="hidden" name="quiz_id" id="quiz_id" value="{{$quiz->id}}">
    <div style="padding:20px">
      <a href="{{route('reporting-quiz',[$quiz->id])}}" title="View Detail" class="btn btn-primary btn-sm bg-primary"><i class="icon-download position-left"></i> Download History Quiz</a>
      <table class="table" id="table-quiz" class="display" style="width:100%">
  			<thead>
      		<tr>
             <th>id</th>
             <th>Name</th>
             <th>School</th>
             <th>Date</th>
             <th>Category</th>
             <th>Type</th>
             <th>Quiz</th>
             <th>True</th>
             <th>False</th>
             <th>Score</th>
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
@include('history.download')
@endsection
@push('after_script')
  <script>
  var tableQuiz;
    $(document).ready(function(){
      $("#btn-download-history").on('click', function(){
          $('#modal-download-history').modal('show');
      });
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
            url: "{{ url('table/data-history-quiz-detail') }}" + "/" + "{{$quiz->id}}",
            type: "GET",
        },
        columns: [
            { data: 'id', name:'id', visible:false},
            { data: 'collager.user.name', name:'collager.user.name', visible:true},
            { data: 'collager.user.school.name', name:'collager.user.school.name', visible:true},
            { data: 'created_at', name:'created_at', visible:true},
            { data: 'quiz.quiz_type.quiz_category.name', name:'quiz.quiz_type.quiz_category.name', visible:true},
            { data: 'quiz.quiz_type.name', name:'quiz.quiz_type.name', visible:true},
            { data: 'quiz.title', name:'quiz.title', visible:true},
            { data: 'isTrue', name:'isTrue', visible:true},
            { data: 'isFalse', name:'isFalse', visible:true},
            { data: 'total_score', name:'total_score', visible:true},
        ],
      });
      /*END OF DATATABLE*/

    });
  </script>
@endpush
