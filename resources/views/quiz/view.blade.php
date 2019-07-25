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
            <li><a href="{{route('quiz.index')}}">Quiz</a></li>
            <li class="active">Create Question</li>
        </ul>
    </div>
</div>

<div class="content">
  <div class="panel panel-white">
		<div class="panel-heading">
      @if ($errors->messages())
        <div class="alert alert-warning alert-styled-left">
  				<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
          @foreach ($errors->messages() as $key => $error)
            @foreach ($error as $key => $error)
              <span class="text-semibold">Warning!</span> {{ $error }}<br>
              {{-- <li>{{ $error }}</li> --}}
            @endforeach
          @endforeach
		    </div>
      @endif
      @if (session('totalQuestion'))
        <div class="alert alert-info alert-styled-left alert-bordered">
  				<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
  				<span class="text-semibold">Heads up!</span> {{session('totalQuestionSuccess')}} of {{session('totalQuestion')}} question has been imported.
		    </div>
      @endif
    @if ($quiz->sum_question == 0)
      <button style="margin-top:-6px" class="add-modal btn btn-primary btn-sm pull-right"><span class="icon-add position-left"></span>Create Question</button>
      <button style="margin-top:-6px;margin-right:6px" type="button" class="btn btn-primary btn-sm bg-primary pull-right" data-toggle="modal" data-target="#import"><i class="icon-upload position-left"></i> Import Question</button>
    @endif
    	<h6 class="panel-title "><i class="icon-cog3 position-left"></i> Quiz Info</h6>
		</div>
		<div class="panel-body">
      <div class="col-md-2">
        @if($quiz->pic_url == 'blank.jpg')
          <img class="img-responsive" src="{{asset('img/blank.jpg')}}" alt="Quiz Type" title="Change the quiz type picture" width="100%">
        @else
          <img class="img-responsive" src="{{route('quiz.picture',$quiz->id)}}" alt="Quiz Type" title="Change the quiz type picture" width="100%">
        @endif
        <br>
      </div>
			<div class="col-md-6">
        <label class="text-bold col-md-4">Quis Type</label>
        <label class="col-md-8">: {{$quiz->quizType['name']}}</label>

        <label class="text-bold col-md-4">Title</label>
        <label class="col-md-8">: {{$quiz->title}}</label>

        <label class="text-bold col-md-4">Total Question</label>
        <label class="col-md-8">: {{$quiz->sum_question}}</label>

        <label class="text-bold col-md-4">Total Visible Question</label>
        <label class="col-md-8">: {{$quiz->tot_visible}}</label>

        <label class="text-bold col-md-4">Description</label>
        <label class="col-md-8">: {{$quiz->description}}</label>
      </div>
		</div>
	</div>
</div>

@if ($quiz->sum_question > 0)
  <div class="content">
  <!-- State saving -->
	<div class="panel panel-white">
    <div class="panel-heading">
      <button style="margin-top:-6px" class="add-modal btn btn-primary btn-sm pull-right"><span class="icon-add position-left"></span>Create New Question</button>
      <button style="margin-top:-6px;margin-right:6px" type="button" class="btn btn-primary btn-sm bg-primary pull-right" data-toggle="modal" data-target="#import"><i class="icon-upload position-left"></i> Import Question</button>
			<h6 class="panel-title "><i class="icon-cog3 position-left"></i> Question & Option</h6>
		</div>
    <div class="panel-body">
      @foreach ($question as $key => $value)
        <input type="hidden" name="id-question" value="{{$value->id}}">
        <div class="panel panel-white">
      		<div class="panel-body">
      			<p class="panel-title">
              <div class="col-md-9">
                <div class="col-md-1">
                  <a><i class="icon-help position-left text-slate"></i></a>
                </div>
                @if(!empty($value->pic_url))
                <div class="col-md-2">
                    <img class="img-responsive" src="{{route('question.picture',$value->id)}}" alt="Quiz Type" title="Change the quiz type picture" width="100" height="50"><br>
                </div>
                @endif
                <div class="col-md-9">
                  {{ $value->question }}
                </div>
              </div>
              <div class="col-md-3">
                <button id="delete-specific-question" value="{{$value->id}}" style="margin-top:-8px;color:#fff" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon pull-right"><i class="icon-trash position-left"></i>Delete</button>
                <a style="margin-top:-8px;color:#fff;margin-right:10px" href="{{route('question.edit',$value->id)}}" class="btn border-info btn-xs text-info-600 btn-flat btn-icon pull-right"><i class="icon-pencil6 position-left"></i>Edit</a>
              </div>
      			</p>
      		</div>
          <hr style="margin-top:0">
      		<div>
      			<div class="panel-body">
              @foreach ($value->answer as $key2 => $value2)
              <div class="col-sm-6 form-group">
                @if ($value2->isTrue == '1')
                  <div class="col-md-1">
                    <p class="pull-right"><i style="color:#4CAF50;" class="fa fa-check-circle position-left"></i></p>
                  </div>
                  <div class="col-md-11">
                    @if(!empty($value2->pic_url))
                    <div class="col-md-3">
                      <img class="img-responsive" src="{{route('answer.picture',$value2->id)}}" alt="Quiz Type" title="Change the quiz type picture" width="100" height="50">
                    </div>
                    @endif
                    <p>{{ $value2->content }}</p>
                  </div>
                @else
                  <div class="col-md-1">
                    <p class="pull-right"><i style="color:#F44336;" class="fa fa-times-circle position-left"></i></p>
                  </div>
                  <div class="col-md-11">
                    @if(!empty($value2->pic_url))
                    <div class="col-md-3">
                      <img class="img-responsive" src="{{route('answer.picture',$value2->id)}}" alt="Quiz Type" title="Change the quiz type picture" width="100" height="50">
                    </div>
                    @endif
                    <p>{{ $value2->content }}</p>
                  </div>
                @endif
  						</div>
              @endforeach
      			</div>
      		</div>
      	</div>
      @endforeach
      <div class="col-md-6">
        <a href="{{route('quiz.index')}}"type="reset" class="btn btn-default" id=""> <i class="icon-arrow-left13"></i> Back</a>
      </div>
      <div class="col-md-6">
        <div class="pull-right">
          {{ $question->links() }}
        </div>
      </div>

  	</div>
	<!-- /state saving -->
  </div>
</div>
@endif
<!-- START Modal Add Question -->
<div id="addQuestionModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
      <form class="form-validate-jquery" action="{{route('quiz.questionAdd',$quiz->id)}}" method="get">
        <div class="modal-body text-center">
          <i class="fa fa-4x fa-plus-square-o"></i>
          {{ csrf_field() }}
          <h6>How many questions do you want to make?</h6>
          <input type="number" name="total_add" min="1" class="form-control" value="{{ old('total_add') }}" placeholder="">
            @if ($errors->has('total_add'))
            <label style="padding-top:7px;color:#F44336;">
                <strong><i class="fa fa-times-circle"></i> {{ $errors->first('total_add') }}</strong>
            </label>
            @endif
        </div>
        <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Go!</button>
				</div>
      </form>
    </div>
  </div>
</div>
<!-- END Modal Add Question -->

<!-- START modal import -->
@include('quiz.import')
<!-- END modal import -->
@endsection
@push('after_script')
<script type="text/javascript">
  $(document).on('click', '.add-modal', function() {
    $('#addQuestionModal').modal('show');
  });
</script>
<script>
var tableQuiz;
  $(document).ready(function(){

    $('button#delete-specific-question').on('click', function () {
          var idQuestion = $(this).val();
          console.log(idQuestion);
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
              url: "{{ url('admin/question/delete') }}"+"/"+idQuestion,
              method: 'get',
              success: function(result){
                swal("Poof! Your imaginary file has been deleted!", {
                  icon: "success",
                });
                location.reload();
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
