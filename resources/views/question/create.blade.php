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
			<h6 class="panel-title "><i class="icon-cog3 position-left"></i> QUIZ INFO</h6>
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
	<div class="panel panel-flat">
    <div class="panel-body">
      <form class="stepy-clickable form-validate-jquery" action="{{route('question.store')}}" method="post" enctype="multipart/form-data" files=true>
        @csrf
        @for ($i=0; $i < $quiz->sum_question; $i++)
          <fieldset>
					<legend class="text-semibold"></legend>
          <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Question:</label>
                <textarea type="text" name="question[]" rows="3" class="form-control"  placeholder="">{{ old('question.'.$i) }}</textarea>
                @if ($errors->has('question.'.$i))
                  <label style="padding-top:7px;color:#F44336;">
                      <strong><i class="fa fa-times-circle"></i> {{ $errors->first('question.'.$i) }}</strong>
                  </label>
                @endif
              </div>
						</div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label col-lg-3">Picture</label>
                <input type="file" name="picture[{{$i}}]" class="form-control">
                @if ($errors->has('picture.'.$i))
                  <label style="padding-top:7px;color:#F44336;">
                      <strong><i class="fa fa-times-circle"></i> {{$errors->first('picture.'.$i)}}</strong>
                  </label>
                @endif
              </div>
            </div>
            @for ($j=0; $j < 5; $j++)
            <div class="col-sm-12">
							<div class="form-group">
            @switch($j)
                @case(0)
                  <label>First Multiple Choice:</label>
                  @break
                @case(1)
                  <label>Second Multiple Choice:</label>
                  @break
                @case(2)
                  <label>Third Multiple Choice:</label>
                  @break
                @case(3)
                  <label>Fourth Multiple Choice:</label>
                  @break
                @default
                  <label>Fifth Multiple Choice:</label>
                @endswitch
                <input type="text" name="choice[{{$i}}][{{$j}}]" class="form-control" value="{{ old('choice.'.$i.'.'.$j) }}" placeholder="">
                <input type="file" name="picture_choice[{{$i}}][{{$j}}]" class="form-control">
                @if ($errors->has('choice.'.$i.'.'.$j))
                  <label style="padding-top:7px;color:#F44336;">
                      <strong><i class="fa fa-times-circle"></i> {{$errors->first('choice.'.$i.'.'.$j)}}</strong>
                  </label>
                @endif
                @if ($errors->has('picture_choice.'.$i.'.'.$j))
                  <label style="padding-top:7px;color:#F44336;">
                      <strong><i class="fa fa-times-circle"></i> {{$errors->first('picture_choice.'.$i.'.'.$j)}}</strong>
                  </label>
                @endif
              </div>
						</div>
            @endfor
							
            <div class="col-md-12">
							<div class="form-group">
								<label class="display-block">True Answer:</label>
                <label class="radio-inline col-md-1">
                  <input checked type="radio" name="true_answer[{{$i}}]" {{ collect(old('true_answer.'.$i))->contains(1) ? 'checked' : '' }} value="A" class="styled">
                  First
                </label>
                <label class="radio-inline col-md-1">
                  <input type="radio" name="true_answer[{{$i}}]" {{ collect(old('true_answer.'.$i))->contains(2) ? 'checked' : '' }} value="B" class="styled">
                  Second
                </label>
                <label class="radio-inline col-md-1">
                  <input type="radio" name="true_answer[{{$i}}]" {{ collect(old('true_answer.'.$i))->contains(3) ? 'checked' : '' }} value="C" class="styled">
                  Third
                </label>
                <label class="radio-inline col-md-1">
                  <input type="radio" name="true_answer[{{$i}}]" {{ collect(old('true_answer.'.$i))->contains(4) ? 'checked' : '' }} value="D" class="styled">
                  Fourth
                </label>
                <label class="radio-inline col-md-1">
                  <input type="radio" name="true_answer[{{$i}}]" {{ collect(old('true_answer.'.$i))->contains(5) ? 'checked' : '' }} value="E" class="styled">
                  Fifth
                </label>
							</div>
						</div>
					</div>
				</fieldset>
        @endfor
				<button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i></button>
			</form>
          <!-- /clickable title -->
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
