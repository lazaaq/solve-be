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
  <div class="panel panel-flat">
		<div class="panel-body">
      <form class="form-validate-jquery" action="{{route('question.update', $data->id)}}" method="post" enctype="multipart/form-data" files=true>
        @method('PUT')
        @csrf
        <fieldset class="content-group">
          <legend class="text-bold">Edit Question</legend>
          @csrf
          <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
  				<div class="form-group">
  					<label>Question:</label>
            <textarea type="text" name="question" rows="3" class="form-control"  placeholder="">{{ $data->question }}</textarea>
            @if ($errors->has('question'))
              <label style="padding-top:7px;color:#F44336;">
                  <strong><i class="fa fa-times-circle"></i> {{ $errors->first('question') }}</strong>
              </label>
            @endif
  				</div>
          <div class="form-group">
            <label class="control-label col-lg-3">Picture</label>
            <input type="file" name="picture" class="form-control">
            @if ($errors->has('picture'))
              <label style="padding-top:7px;color:#F44336;">
                  <strong><i class="fa fa-times-circle"></i> {{$errors->first('picture')}}</strong>
              </label>
            @endif
          </div>
          @foreach ($data->answer as $key => $value)

        	<div class="form-group">
            @switch($key)
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
            <input type="text" name="choice_{{$value->id}}" class="form-control" value="{{ $value->content }}" placeholder="">
            <input type="file" name="picture_choice_{{$value->id}}" class="form-control">
            @if ($errors->has('choice.'.$value->id))
              <label style="padding-top:7px;color:#F44336;">
                  <strong><i class="fa fa-times-circle"></i> {{$errors->first('choice_'.$value->id)}}</strong>
              </label>
            @endif
            @if ($errors->has('picture_choice.'.$value->id))
              <label style="padding-top:7px;color:#F44336;">
                  <strong><i class="fa fa-times-circle"></i> {{$errors->first('picture_choice_'.$value->id)}}</strong>
              </label>
            @endif
          </div>
          @endforeach
          <div class="form-group">
            <label class="display-block">True Answer:</label>
            @foreach ($data->answer as $key2 => $value2)
            <label class="radio-inline col-md-1">
              <input checked type="radio" name="true_answer" {{$value->isRight == '1' ? 'checked' : '' }} value="1" class="styled">
              @switch($key2)
                @case(0)<label>First</label>@break
                @case(1)<label>Second</label>@break
                @case(2)<label>Third</label>@break
                @case(3)<label>Fourth</label>@break
                @case(4)<label>Fifth</label>@break
              @endswitch
            </label>
            @endforeach
          </div>
        </fieldset>
        <div>
          <div class="col-md-4">
            <a href="{{route('quiz.show', $quiz->id)}}"type="reset" class="btn btn-default" id=""> <i class="icon-arrow-left13"></i> Back</a>
          </div>
          <div class="col-md-8 text-right">
            <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
            <button type="submit" class="btn btn-primary bg-primary-800">Submit <i class="icon-arrow-right14 position-right"></i></button>
          </div>
        </div>
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
