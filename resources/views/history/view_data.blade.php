@foreach ($data as $key => $value)
  <div class="panel panel-white">
    <div class="panel-body">
        <p class="panel-title">
        <div class="col-md-9">
            <div class="col-md-1">
                <a><i class="icon-help position-left text-slate"></i></a>{{$number++}}
            </div>
            @if(!empty($value->question->pic_url))
            <div class="col-md-2">
                <img class="img-responsive" src="{{route('question.picture',$value->question->id)}}" alt="Quiz Type" title="Change the quiz type picture" width="100" height="50"><br>
            </div>
            @endif
            <div class="col-md-9">
                {{ $value->question->question }}
                @if($value->question->answer->count() == 1)
                <i>(Soal Isian)</i>
                @endif
            </div>
        </div>
        </p>
    </div>
    <hr style="margin-top:0">
    <div>
      <div class="panel-body">
        @if ($value->collager_answer != '-')
            <!-- <div class="panel-body"> -->
            @foreach ($value->question->answer as $key2 => $value2)
            @if($value->collager_answer == $value2->option)
              @if($value->isTrue == 1)
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
            <!-- </div> -->
        @else
            <!-- <div class="panel-body"> -->
            @foreach ($value->question->answer as $key2 => $value2)
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
            <!-- </div> -->
        @endif

        @if ($value->question->answer->count() == '1')
          @foreach ($value->question->answer as $key2 => $value2)
            @if ($value->isTrue == '0')
            <!-- <div class="panel-body"> -->
              <div class="col-sm-6 form-group" style="border: 2px solid #F44336;">
                  <div class="col-md-1">
                      <p style="margin:0px" class="pull-right"><i style="color:#F44336;" class="fa fa-times-circle position-left"></i></p>
                  </div>
                  <div class="col-md-11">
                      <p style="margin:0px">{{ $value->collager_answer }}</p>
                  </div>
              </div>
            <!-- </div> -->
            @endif
          @endforeach
        @endif
        </div>
    </div>
</div>
@endforeach
<div class="col-md-6">
  <a href="{{route('history.show',$user)}}" class="btn btn-default" id=""> <i class="icon-arrow-left13"></i> Back</a>
</div>
<div class="col-md-6">
    <div class="pull-right">
    {{ $data->links() }}
    </div>
</div>
