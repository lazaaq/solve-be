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
          <input type="hidden" name="jumlah" value="2">
  				<div class="form-group">
  					<label><b>Question:</b></label>
            <textarea name="question" rows="3" class="form-control"  placeholder="">{{ $data->question }}</textarea>
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
          <div style="margin-top:-20px" class="panel panel-flat">
        		<div class="panel-body" id="group_choice">
              @for ($key=0;$key<5;$key++)
            	<div class="form-group" id="option{{$key}}">
                <div style="margin-top:10px" class="col-md-3" id="name_choice{{$key}}">
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
                <div style="margin-top:10px" class="col-md-9" id="available_choice{{$key}}">
                  @if(!empty($data->answer->get($key)->pic_url))
                      <div class="col-md-12">
                        <div class="col-md-2">
                          <img style="padding:10px" class="img-responsive" src="{{route('answer.picture',$data->answer->get($key)->id)}}" alt="Quiz Type" title="Change the quiz type picture" width="100" height="50">
                        </div>
                        @if ($errors->has('picture_choice.'.$data->answer->get($key)->id))
                        <label style="padding-top:7px;color:#F44336;">
                          <strong><i class="fa fa-times-circle"></i> {{$errors->first('picture_choice_'.$data->answer->get($key)->id)}}</strong>
                        </label>
                        @endif
                      </div>
                      <div class="col-md-12">
                        <input type="text" name="choice[{{$key}}]" class="form-control" value="{{ $data->answer->get($key)->content }}" placeholder="">
                        @if ($errors->has('choice.'.$key))
                        <label style="padding-top:7px;color:#F44336;">
                          <strong><i class="fa fa-times-circle"></i> {{$errors->first('choice.'.$key)}}</strong>
                        </label>
                        @endif
                        <input type="file" style="width:200px" name="picture_choice[{{$key}}]" class="file-input-custom" data-show-caption="true" data-show-upload="false" accept="image/*">
                      </div>
                  @else
                      <div class="col-md-12">
                        @if ($data->answer->get($key) == NULL)
                        <input type="text" name="choice[{{$key}}]" class="form-control" value="" placeholder="">
                        @else
                        <input type="text" name="choice[{{$key}}]" class="form-control" value="{{ $data->answer->get($key)->content }}" placeholder="">
                        @endif
                        @if ($errors->has('choice.'.$key))
                        <label style="padding-top:7px;color:#F44336;">
                          <strong><i class="fa fa-times-circle"></i> {{$errors->first('choice.'.$key)}}</strong>
                        </label>
                        @endif

                        <input type="file" style="width:200px" name="picture_choice[{{$key}}]" class="file-input-custom" data-show-caption="true" data-show-upload="false" accept="image/*">
                        @if ($errors->has('picture_choice.'.$key))
                          <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{$errors->first('picture_choice.'.$key)}}</strong>
                          </label>
                        @endif
                      </div>
                  @endif
                </div>
              </div>
              @endfor
            </div>
          </div>
          <div class="form-group" id="true_answer">
            <label class="display-block"><b>True Answer:</b></label>
            @for($i=0;$i<5;$i++)
            @if($data->answer->get($i) == NULL)
            <label class="radio-inline col-md-1 hide" id="true{{$i}}">
              <input type="radio" disabled name="true_answer[]" value="{{$option_value[$i]}}" class="styled">
              {{$option[$i]}}
            </label>
            @else
            <label class="radio-inline col-md-1" id="true{{$i}}">
              <input type="radio" disabled name="true_answer[]" @if ($data->answer->get($i)->isTrue == '1') checked @endif value="{{$option_value[$i]}}" class="styled">
              {{$option[$i]}}
            </label>
            @endif
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
        var id = parseInt('{{$data->answer->count()}}') - 1; 
        var array = [1,2,3,4];
        var jumlah = parseInt('{{$data->answer->count()}}') - 1;
        $('input[name=jumlah]').val(jumlah)
      switch ('{{$data->answer->count()}}') {
        case '2':
          $('#available_choice1').append(button1(id));
          $.each(array, function( i, l ){
            if (l != id) {
              $('#option'+l).addClass('hide');
            }
          });
          break;
        case '3':
          $('#available_choice2').append(button2(id));

          $.each(array, function( i, l ){
            if (l > id) {
              $('#option'+l).addClass('hide');
            }
          });
          break;
        case '4':
          $('#available_choice3').append(button2(id));
          $.each(array, function( i, l ){
            if (l > id) {
              $('#option'+l).addClass('hide');
            }
          });
          break;
        default:
          $('#available_choice4').append(button3(id));
          $.each(array, function( i, l ){
            if (l > id) {
              $('#option'+l).addClass('hide');
            }
          });
          break;
      }

      $(document).on('click', '.addButton', function(){
        var id = parseInt($(this).val()) + 1;
        jumlah += 1;
        switch (id) {
          case 2:
            $('#available_choice'+id).append(button2(id));
            $('#option'+id).removeClass('hide');
            $('#true'+id).removeClass('hide');
            break;
          case 3:
            $('#available_choice'+id).append(button2(id));
            $('#option'+id).removeClass('hide');
            $('#true'+id).removeClass('hide');
            break;
          case 4:
            $('#available_choice'+id).append(button3(id));
            $('#option'+id).removeClass('hide');
            $('#true'+id).removeClass('hide');
            break;
        }
        id = id-1;
        $('#available_choice'+id+' #button'+id).remove();
        $('input[name=jumlah]').val(jumlah)
      });

      $(document).on('click', '.removeButton', function(){
        var id = parseInt($(this).val());
        jumlah -= 1;
        switch (id) {
          case 2:
            temp = id - 1;
            $('#available_choice'+temp).append(button1(temp));
            $('#option'+id).addClass('hide');
            $('#true'+id).addClass('hide');
            break;
          case 3:
            temp = id - 1;
            $('#available_choice'+temp).append(button2(temp));
            $('#option'+id).addClass('hide');
            $('#true'+id).addClass('hide');
            break;
          case 4:
            temp = id - 1;
            $('#available_choice'+temp).append(button2(temp));
            $('#option'+id).addClass('hide');
            $('#true'+id).addClass('hide');
            break;
        }
        $('#available_choice'+id+' #button'+id).remove();
        $('input[name=jumlah]').val(jumlah)
      });

      
      function button1(id) {return "<div class='col-md-12' id='button"+id+"'>"+
                  "<div class='btn-group' role='group'>"+
                  "<button type='button' value='"+id+"' class='btn btn-default addButton'><i class='fa fa-plus'></i></button>"+
                  "</div>"+
                  "</div>"}; 

      function button2(id) {return "<div class='col-md-12' id='button"+id+"'>"+
                  "<div class='btn-group' role='group'>"+
                  "<button type='button' value='"+id+"' class='btn btn-default removeButton'><i class='fa fa-minus'></i></button>"+
                  "<button type='button' value='"+id+"' class='btn btn-default addButton'><i class='fa fa-plus'></i></button>"+
                  "</div>"+
                  "</div>"}; 

      function button3(id) {return "<div class='col-md-12' id='button"+id+"'>"+
                  "<button type='button' value='"+id+"' class='btn btn-default removeButton'><i class='fa fa-minus'></i></button>"+
                  "</div>"+
                  "</div>"}; 
    });
  </script>
@endpush
