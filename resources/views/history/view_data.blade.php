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
        </p>
    </div>
    <hr style="margin-top:0">
    <div>
        @if ($key < $data->count())
            <div id="option{{$value->id}}" class="panel-body">
            @foreach ($value->answer as $key2 => $value2)
            @if($data[$key]->collager_answer == $value2->option)
              @if($data[$key]->isTrue == 1)
                <div class="col-sm-6 form-group" style="border: 2px solid #4CAF50;">
              @else
                <div class="col-sm-6 form-group" style="border: 2px solid #F44336;">
              @endif
                    @if ($value2->isTrue == '1')
                        <div class="col-md-1">
                        <p style="margin:0px" class="pull-right"><i style="color:#4CAF50;" class="fa fa-check-circle position-left"></i></p>
                        </div>
                        <div class="col-md-11">
                        @if(!empty($value2->pic_url))
                        <div class="col-md-3">
                            <img class="img-responsive" src="{{route('answer.picture',$value2->id)}}" alt="Quiz Type" title="Change the quiz type picture" width="100" height="50">
                        </div>
                        @endif
                        <p style="margin:0px">{{ $value2->content }}</p>
                        </div>
                    @else
                        <div class="col-md-1">
                        <p style="margin:0px" class="pull-right"><i style="color:#F44336;" class="fa fa-times-circle position-left"></i></p>
                        </div>
                        <div class="col-md-11">
                        @if(!empty($value2->pic_url))
                        <div class="col-md-3">
                            <img class="img-responsive" src="{{route('answer.picture',$value2->id)}}" alt="Quiz Type" title="Change the quiz type picture" width="100" height="50">
                        </div>
                        @endif
                        <p style="margin:0px">{{ $value2->content }}</p>
                        </div>
                    @endif
                </div>
            @else
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
            @endif
            @endforeach
            </div>
        @else
            <div id="option{{$value->id}}" class="panel-body">
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
        @endif
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
