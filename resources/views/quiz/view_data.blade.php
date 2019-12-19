@foreach ($question as $key => $value)
<div class="panel panel-white">
    <div class="panel-body">
        <p class="panel-title">
        <div class="col-md-9">
        <div class="col-md-1">
            <a><i class="icon-help position-left text-slate"></i></a>{{$number++}}
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
        <button id="show-hide-option" value="{{$value->id}}" style="margin-top:-8px;color:#fff;margin-right:10px" class="btn border-info btn-xs text-info-600 btn-flat btn-icon pull-right"><i class="icon-eye position-left"></i>Show</button>
        </div>
        </p>
    </div>
    <hr style="margin-top:0">
    <div>
        <div id="option{{$value->id}}" class="panel-body hide">
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

@push('after_script')
  <script>
    $(document).ready(function(){
        $(document).on('click', '#show-hide-option', function(){
            var id = $(this).val();
            if ($('#option'+id).hasClass('hide')) {
                $('#show-hide-option[value="'+id+'"]').empty();
                $('#show-hide-option[value="'+id+'"]').append("<i class='icon-eye position-left'></i>Hide");
                $('#option'+id).removeClass('hide');
            } else {
                $('#show-hide-option[value="'+id+'"]').empty();
                $('#show-hide-option[value="'+id+'"]').append("<i class='icon-eye position-left'></i>Show");
                $('#option'+id).addClass('hide');   
            }
        });
    });
  </script>
@endpush