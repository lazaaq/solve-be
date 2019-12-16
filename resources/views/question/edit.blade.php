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
            <li class="active">Edit Question</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <div class="panel panel-flat">
		<div class="panel-body">
      <form id="form-edit-question" class="form-validate-jquery" action="{{route('question.update', $data->id)}}" method="post" enctype="multipart/form-data" files=true>
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
            <input type="file" name="picture" class="file-input-custom" data-show-caption="true" data-show-upload="false" accept="image/*">
            {{-- <input type="file" name="picture" class="form-control"> --}}
            @if ($errors->has('picture'))
              <label style="padding-top:7px;color:#F44336;">
                  <strong><i class="fa fa-times-circle"></i> {{$errors->first('picture')}}</strong>
              </label>
            @endif
          </div>
          <div class="form-group">
            <label><b>Answer Option</b></label>
          </div>
          <div style="margin-top:-20px" class="panel panel-flat" id="group_choice">
        		<div class="panel-body">
              @foreach ($data->answer as $key => $value)
            	<div class="form-group" id="option[{{$key}}]">
                <div style="margin-top:10px" class="col-md-3" div="name_choice[{{$key}}]">
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
                <div style="margin-top:10px" class="col-md-9" div="available_choice[{{$key}}]">
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
                        <input type="file" style="width:200px" name="picture_choice[{{$key}}]" class="file-input-custom" data-show-caption="true" data-show-upload="false" accept="image/*">
                        {{-- <input type="file" style="width:200px" name="picture_choice[{{$key}}]" class="form-control"> --}}
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
                        <input type="file" style="width:200px" name="picture_choice[{{$key}}]" class="file-input-custom" data-show-caption="true" data-show-upload="false" accept="image/*">
                        {{-- <input type="file" style="width:200px" name="picture_choice[{{$key}}]" class="form-control"> --}}
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
          <div class="form-group" id="true_answer">
            <label class="display-block"><b>True Answer:</b></label>
            @for($i=0;$i<count($data->answer);$i++)
            <label class="radio-inline col-md-1">
              <input type="radio" name="true_answer[]" @if ($data->answer[$i]->isTrue == '1') checked @endif value="{{$option_value[$i]}}" class="styled">
              {{$option[$i]}}
            </label>
            @endfor
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
    $(document).ready(function(){
      console.log($('#availabe_choice[1]'));
    });
  </script>
@endpush
