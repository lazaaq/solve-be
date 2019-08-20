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
      @if (session('dbTransactionError'))
        <div class="alert alert-danger alert-styled-left alert-bordered">
  				<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
  				<span class="text-semibold">Oops!</span> {{session('dbTransactionError')}}
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
      <a href="{{route('quiz.export',$quiz->id)}}" style="margin-top:-6px;margin-right:6px" type="button" class="btn btn-primary btn-sm bg-primary pull-right"><i class="icon-download position-left"></i> Export Question</a>
			<h6 class="panel-title "><i class="icon-cog3 position-left"></i> Question & Option</h6>
		</div>
    <div class="panel-body">
        <div class="panel-body" style="padding:0px; margin-bottom:10px;margin-top:-10px">
            <div class="input-group col-md-3 pull-right">
							<input type="text" id="search" class="form-control" placeholder="Search records">
              <span class="input-group-addon"><i class="icon-search4"></i></span>
						</div>
        </div>
      <div id="container-quiz">
      @include('quiz.view_data')
      </div>
      <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
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
    //console.log("{{$quiz->id}}");
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

      function fetch_data(page, query)
      {
        $.ajax({
        url:"/search/quiz/"+"{{$quiz->id}}"+"?page="+page+"&query="+query,
        method:'GET',
        success:function(data)
        {
          $('#container-quiz').html('');
          $('#container-quiz').html(data);
        }
        })
      }

      $(document).on('keyup', '#search', function(){
        var query = $('#search').val();
        var page = $('#hidden_page').val();
        fetch_data(page, query);
      });

      $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);

        var query = $('#search').val();

        $('li').removeClass('active');
          $(this).parent().addClass('active');
        fetch_data(page, query);
      });

  });
</script>
@endpush
