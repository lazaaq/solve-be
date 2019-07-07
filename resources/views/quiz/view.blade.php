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
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <div class="panel panel-white">
		<div class="panel-heading">
			<h6 class="panel-title "><i class="icon-cog3 position-left"></i> Quiz Info</h6>
		</div>
		<div class="panel-body">
			<div class="col-md-6">
        <label class="text-bold col-md-4">Quis Type</label>
        <label class="col-md-8">: {{$quiz->quizType['name']}}</label>

        <label class="text-bold col-md-4">Title</label>
        <label class="col-md-8">: {{$quiz->title}}</label>

        <label class="text-bold col-md-4">Total Question</label>
        <label class="col-md-8">: {{$quiz->sum_question}}</label>

        <label class="text-bold col-md-4">Description</label>
        <label class="col-md-8">: {{$quiz->description}}</label>
      </div>
      <div class="col-md-6">
        @if($quiz->pic_url == 'blank.jpg')
        <img class="img-responsive" src="{{asset('img/blank.jpg')}}" alt="Quiz Type" title="Change the quiz type picture" width="100" height="50">
        @else
        <img class="img-responsive" src="{{route('quiz.picture',$quiz->id)}}" alt="Quiz Type" title="Change the quiz type picture" width="100" height="50">
        @endif
        <br>
      </div>
		</div>
	</div>
</div>

<div class="content">
  <!-- State saving -->
	<div class="panel panel-white">
    <div class="panel-heading">
      <a style="margin-top:-6px" href="#" class="btn btn-primary btn-sm pull-right"><i class="icon-add position-left"></i>Create New</a>
			<h6 class="panel-title "><i class="icon-cog3 position-left"></i> Question & Option</h6>
		</div>
    <div class="panel-body">
      @foreach ($quiz->question as $key => $value)
        <div class="panel panel-white">
      		<div class="panel-heading">
      			<p class="panel-title">
      				<a><i class="icon-help position-left text-slate"></i>{{ $value->question }}</a>
              <a style="margin-top:-8px;color:#fff" href="{{route('question.destroy',$value->id)}}" class="btn btn-danger btn-sm pull-right"><i class="icon-pencil6 position-left"></i>Delete</a>
              <a style="margin-top:-8px;color:#fff;margin-right:10px" href="{{route('question.edit',$value->id)}}" class="btn btn-info btn-sm pull-right"><i class="icon-trash position-left"></i>Edit</a>
      			</p>
      		</div>
      		<div>
      			<div class="panel-body">
              @foreach ($value->answer as $key2 => $value2)
              <div class="col-sm-12">
  							<div class="form-group">
                  @if ($value2->isTrue == '1')
                    <p><i style="color:#4CAF50;" class="fa fa-check-circle position-left"></i> {{ $value2->content }}</p>
                    {{-- <input type="text" name="choice[{{$value}}][{{$value2}}]" class="form-control" value="{{ $value2->pic_url }}" placeholder=""> --}}
                  @else
                    <p><i style="color:#F44336;" class="fa fa-times-circle position-left"></i> {{ $value2->content }}</p>
                    {{-- <input type="text" name="choice[{{$value}}][{{$value2}}]" class="form-control" value="{{ $value2->pic_url }}" placeholder=""> --}}
                  @endif
                </div>
  						</div>
              @endforeach
      			</div>
      		</div>
      	</div>
      @endforeach
  	</div>
	<!-- /state saving -->
  </div>
</div>
<!-- /content area -->
@endsection
@push('after_script')
  <script>

  </script>
@endpush
