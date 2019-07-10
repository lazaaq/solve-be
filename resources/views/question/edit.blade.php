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
  					<label><b>Question:</b></label>
            <textarea type="text" name="question" rows="3" class="form-control"  placeholder="">{{ $data->question }}</textarea>
            @if ($errors->has('question'))
              <label style="padding-top:7px;color:#F44336;">
                  <strong><i class="fa fa-times-circle"></i> {{ $errors->first('question') }}</strong>
              </label>
            @endif
  				</div>
          <div class="form-group">
            <label><b>Picture</b></label>
            @if(!empty($data->pic_url))
            <img style="padding:10px" class="img-responsive" src="{{route('question.picture',$data->id)}}" alt="Quiz Type" title="Change the quiz type picture" width="100" height="50">
            @endif
            <input type="file" name="picture" class="form-control">
            @if ($errors->has('picture'))
              <label style="padding-top:7px;color:#F44336;">
                  <strong><i class="fa fa-times-circle"></i> {{$errors->first('picture')}}</strong>
              </label>
            @endif
          </div>
          <div class="form-group">
            <label><b>Answer Option</b></label>
          </div>
          <div style="margin-top:-20px" class="panel panel-flat">
        		<div class="panel-body">
              @foreach ($data->answer as $key => $value)
            	<div class="form-group">
                <div style="margin-top:10px" class="col-md-3">
                @switch($key)
                  @case(0)
                  <label class="pull-right" style="margin-top:7px"><b>First Multiple Choice:</b></label>
                  @break
                  @case(1)
                  <label class="pull-right" style="margin-top:7px"><b>Second Multiple Choice:</b></label>
                  @break
                  @case(2)
                  <label class="pull-right" style="margin-top:7px"><b>Third Multiple Choice:</b></label>
                  @break
                  @case(3)
                  <label class="pull-right" style="margin-top:7px"><b>Fourth Multiple Choice:</b></label>
                  @break
                  @default
                  <label class="pull-right" style="margin-top:7px"><b>Fifth Multiple Choice:</b></label>
                @endswitch
                </div>
                <div style="margin-top:10px" class="col-md-9">
                  @if(!empty($value->pic_url))
                      <div class="col-md-12">
                        <div class="col-md-2">
                          <img style="padding:10px" class="img-responsive" src="{{route('answer.picture',$value->id)}}" alt="Quiz Type" title="Change the quiz type picture" width="100" height="50">
                        </div>
                        @if ($errors->has('picture_choice.'.$value->id))
                        <label style="padding-top:7px;color:#F44336;">
                          <strong><i class="fa fa-times-circle"></i> {{$errors->first('picture_choice_'.$value->id)}}</strong>
                        </label>
                        @endif
                      </div>
                      <div class="col-md-12">
                        <input type="file" style="width:200px" name="picture_choice[{{$key}}]" class="form-control">
                        <input type="text" name="choice[{{$key}}]" class="form-control" value="{{ $value->content }}" placeholder="">
                        @if ($errors->has('choice.'.$key))
                        <label style="padding-top:7px;color:#F44336;">
                          <strong><i class="fa fa-times-circle"></i> {{$errors->first('choice.'.$key)}}</strong>
                        </label>
                        @endif
                      </div>
                  @else
                      <div class="col-md-12">
                        <input type="text" name="choice[{{$key}}]" class="form-control" value="{{ $value->content }}" placeholder="">
                        @if ($errors->has('choice.'.$key))
                        <label style="padding-top:7px;color:#F44336;">
                          <strong><i class="fa fa-times-circle"></i> {{$errors->first('choice.'.$key)}}</strong>
                        </label>
                        @endif
                      </div>
                      <div class="col-md-12">
                        <input type="file" style="width:200px" name="picture_choice[{{$key}}]" class="form-control">
                        @if ($errors->has('picture_choice.'.$key))
                          <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{$errors->first('picture_choice.'.$key)}}</strong>
                          </label>
                        @endif
                      </div>
                    @endif
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <div class="form-group">
            <label class="display-block"><b>True Answer:</b></label>
            <label class="radio-inline col-md-1">
              <input type="radio" name="true_answer[]" @if ($data->answer[0]->isTrue == '1') checked @endif value="A" class="styled">
              First
            </label>
            <label class="radio-inline col-md-1">
              <input type="radio" name="true_answer[]" @if ($data->answer[1]->isTrue == '1') checked @endif value="B" class="styled">
              Second
            </label>
            <label class="radio-inline col-md-1">
              <input type="radio" name="true_answer[]" @if ($data->answer[2]->isTrue == '1') checked @endif value="C" class="styled">
              Third
            </label>
            <label class="radio-inline col-md-1">
              <input type="radio" name="true_answer[]" @if ($data->answer[3]->isTrue == '1') checked @endif value="D" class="styled">
              Fourth
            </label>
            <label class="radio-inline col-md-1">
              <input type="radio" name="true_answer[]" @if ($data->answer[4]->isTrue == '1') checked @endif value="E" class="styled">
              Fifth
            </label>
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
