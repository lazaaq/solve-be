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
      <form id="form-question" class="stepy-clickable form-validate-jquery" action="{{route('question.store')}}" method="post" enctype="multipart/form-data" files=true>
        @csrf
        @for ($i=0; $i < $total; $i++)
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
                <input type="file" name="picture[{{$i}}]" class="file-input-custom" data-show-caption="true" data-show-upload="false" accept="image/*">
                {{-- <input type="file" name="picture[{{$i}}]" class="form-control"> --}}
                @if ($errors->has('picture.'.$i))
                  <label style="padding-top:7px;color:#F44336;">
                      <strong><i class="fa fa-times-circle"></i> {{$errors->first('picture.'.$i)}}</strong>
                  </label>
                @endif
              </div>
            </div>
            <div class="col-sm-12">
							<div class="form-group" id="choice{{$i}}">
                <div id="choice_1">
                  <label>First Multiple Choice:</label>
                  <input type="text" name="choice[{{$i}}][0]" class="form-control" value="{{ old('choice.'.$i.'.0') }}" placeholder="">
                  <input type="file" name="picture_choice[{{$i}}][0]" class="form-control">
                  @if ($errors->has('choice.'.$i.'.0'))
                  <label style="padding-top:7px;color:#F44336;">
                      <strong><i class="fa fa-times-circle"></i> {{$errors->first('choice.'.$i.'.0')}}</strong>
                  </label>
                  @endif
                  @if ($errors->has('picture_choice.'.$i.'.0'))
                    <label style="padding-top:7px;color:#F44336;">
                        <strong><i class="fa fa-times-circle"></i> {{$errors->first('picture_choice.'.$i.'.0')}}</strong>
                    </label>
                  @endif
                </div>

                <div id="choice_2">
                  <label>Second Multiple Choice:</label>
                  <input type="text" name="choice[{{$i}}][1]" class="form-control" value="{{ old('choice.'.$i.'.1') }}" placeholder="">
                  <input type="file" name="picture_choice[{{$i}}][1]" class="form-control">

                  @if ($errors->has('choice.'.$i.'.1'))
                  <label style="padding-top:7px;color:#F44336;">
                      <strong><i class="fa fa-times-circle"></i> {{$errors->first('choice.'.$i.'.1')}}</strong>
                  </label>
                  @endif
                  @if ($errors->has('picture_choice.'.$i.'.1'))
                    <label style="padding-top:7px;color:#F44336;">
                        <strong><i class="fa fa-times-circle"></i> {{$errors->first('picture_choice.'.$i.'.1')}}</strong>
                    </label>
                  @endif
                  <div class="btn-group" role="group">
                    <button type="button" value="{{$i}}" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>

              <div class="form-group hide" id="template_choice_3_{{$i}}">
                <div id="choice_3">
                  <label>Third Multiple Choice:</label>
                  <input type="text" name="choice[{{$i}}][2]" class="form-control" value="{{ old('choice.'.$i.'.2') }}" placeholder="">
                  <input type="file" name="picture_choice[{{$i}}][2]" class="form-control">
                  @if ($errors->has('choice.'.$i.'.2'))
                  <label style="padding-top:7px;color:#F44336;">
                      <strong><i class="fa fa-times-circle"></i> {{$errors->first('choice.'.$i.'.2')}}</strong>
                  </label>
                  @endif
                  @if ($errors->has('picture_choice.'.$i.'.2'))
                    <label style="padding-top:7px;color:#F44336;">
                        <strong><i class="fa fa-times-circle"></i> {{$errors->first('picture_choice.'.$i.'.2')}}</strong>
                    </label>
                  @endif
                  <div class="btn-group" role="group">
                    <button type="button" value="{{$i}}" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
                    <button type="button" value="{{$i}}" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>

              <div class="form-group hide" id="template_choice_4_{{$i}}">
                <div id="choice_4">
                  <label>Fourth Multiple Choice:</label>
                  <input type="text" name="choice[{{$i}}][3]" class="form-control" value="{{ old('choice.'.$i.'.3') }}" placeholder="">
                  <input type="file" name="picture_choice[{{$i}}][3]" class="form-control">
                  @if ($errors->has('choice.'.$i.'.3'))
                  <label style="padding-top:7px;color:#F44336;">
                      <strong><i class="fa fa-times-circle"></i> {{$errors->first('choice.'.$i.'.3')}}</strong>
                  </label>
                  @endif
                  @if ($errors->has('picture_choice.'.$i.'.3'))
                    <label style="padding-top:7px;color:#F44336;">
                        <strong><i class="fa fa-times-circle"></i> {{$errors->first('picture_choice.'.$i.'.3')}}</strong>
                    </label>
                  @endif
                  <div class="btn-group" role="group">
                    <button type="button" value="{{$i}}" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
                    <button type="button" value="{{$i}}" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>

              <div class="form-group hide" id="template_choice_5_{{$i}}">
                <div id="choice_5">
                  <label>Fifth Multiple Choice:</label>
                  <input type="text" name="choice[{{$i}}][4]" class="form-control" value="{{ old('choice.'.$i.'.4') }}" placeholder="">
                  <input type="file" name="picture_choice[{{$i}}][4]" class="form-control">
                  @if ($errors->has('choice.'.$i.'.4'))
                  <label style="padding-top:7px;color:#F44336;">
                      <strong><i class="fa fa-times-circle"></i> {{$errors->first('choice.'.$i.'.4')}}</strong>
                  </label>
                  @endif
                  @if ($errors->has('picture_choice.'.$i.'.4'))
                    <label style="padding-top:7px;color:#F44336;">
                        <strong><i class="fa fa-times-circle"></i> {{$errors->first('picture_choice.'.$i.'.4')}}</strong>
                    </label>
                  @endif
                  <div class="btn-group" role="group">
                    <button type="button" value="{{$i}}" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
              </div>

						</div>

            <div class="col-md-12">
							<div class="form-group" id="option{{$i}}">
								<label class="display-block">True Answer:</label>
                <div id="first_{{$i}}" class="">
                  <label class="radio-inline col-md-1">
                    <input checked type="radio" name="true_answer[{{$i}}]" {{ collect(old('true_answer.'.$i))->contains(1) ? 'checked' : '' }} value="1" class="styled">
                    First
                  </label>
                </div>
                <div id="second_{{$i}}" class="">
                  <label class="radio-inline col-md-1">
                    <input type="radio" name="true_answer[{{$i}}]" {{ collect(old('true_answer.'.$i))->contains(2) ? 'checked' : '' }} value="2" class="styled">
                    Second
                  </label>
                </div>
                <div id="third_{{$i}}" class="hide">
                  <label class="radio-inline col-md-1">
                    <input type="radio" name="true_answer[{{$i}}]" {{ collect(old('true_answer.'.$i))->contains(3) ? 'checked' : '' }} value="3" class="styled">
                    Third
                  </label>
                </div>
                <div id="fourth_{{$i}}" class="hide">
                  <label class="radio-inline col-md-1">
                    <input type="radio" name="true_answer[{{$i}}]" {{ collect(old('true_answer.'.$i))->contains(4) ? 'checked' : '' }} value="4" class="styled">
                    Fourth
                  </label>
                </div>
                <div id="fifth_{{$i}}" class="hide">
                  <label class="radio-inline col-md-1">
                    <input type="radio" name="true_answer[{{$i}}]" {{ collect(old('true_answer.'.$i))->contains(5) ? 'checked' : '' }} value="5" class="styled">
                    Fifth
                  </label>
                </div>
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
    $(document).ready(function(){

      $(document).on('click', '.addButton', function(){

        var id = $(this).val();
        console.log(id);
        var counter = $('#choice'+id+' div').children('input[type=text]').length;

          switch (counter) {
            case 2:
              var $template = $('#template_choice_3_'+id).children();
              $clone    = $template.clone();
              var $template2 = $('#third_'+id);
              $('#choice'+id).find('.btn-group').remove();
              break;
            case 3:
              var $template = $('#template_choice_4_'+id).children();
              $clone    = $template.clone();
              var $template2 = $('#fourth_'+id);
              $('#choice'+id).find('.btn-group').remove();
              break;
            case 4:
              var $template = $('#template_choice_5_'+id).children();
              $clone    = $template.clone();
              var $template2 = $('#fifth_'+id);
              $('#choice'+id).find('.btn-group').remove();
              break;
          }
          $('#choice'+id).append($clone);
          $template2.removeClass('hide');
      });

      $(document).on('click', '.removeButton', function(){

        var id = $(this).val();
        var counter = $('#choice'+id+' div').children('input[type=text]').length;

        switch (counter) {
          case 3:
            $('#choice'+id+' #choice_2').append('<div class="btn-group" role="group"><button type="button" value="'+id+'" class="btn btn-default addButton"><i class="fa fa-plus"></i></button></div>');
            var $template2 = $('#third_'+id);
            break;
          case 4:
            var $template = $('#template_choice_3_'+id).children();
            $clone    = $template.clone();
            $('#choice'+id+' #choice_3').append($clone.find('.btn-group'));
            var $template2 = $('#fourth_'+id);
            break;
          case 5:
            var $template = $('#template_choice_4_'+id).children();
            $clone    = $template.clone();
            $('#choice'+id+' #choice_4').append($clone.find('.btn-group'));
            var $template2 = $('#fifth_'+id);
            break;
        }
        $(this).parent().parent().remove();
        $template2.addClass('hide');
        // console.log($clone.find('.btn-group'));

      });

    });
  </script>
@endpush
