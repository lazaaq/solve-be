@foreach ($quiz as $key => $value)
<div class="col-md-4">
  <!-- Simple list -->
    <div class="panel panel-flat">
      <div class="panel-heading">
        <h5 class="panel-title">{{$value->title}}</h5>
        <div class="heading-elements">
          <ul class="icons-list">
            <li><a data-action="collapse"></a></li>
            <li><a data-action="reload"></a></li>
            <li><a data-action="close"></a></li>
          </ul>
        </div>
      </div>

      <div class="panel-body">
        <ul class="media-list">
          <li class="media-header">Quiz Type : {{$value->quizType['name']}}</li>
          @foreach ($value->quizCollager->sortByDesc('total_score') as $key2 => $value2)
          <li class="media">
            <div class="media-left media-middle">
              <a href="#">
                @if($value2->collager->user['picture'] == 'avatar.png')
                  <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="">
                @else
                  <img src="{{route('user.picture',$value2->collager->user['id'])}}" class="img-circle" alt="">
                @endif
              </a>
            </div>

            <div class="media-body">
              <div class="media-heading text-semibold">{{$value2->collager->user['name']}}</div>
              <span class="text-muted">{{$value2->collager->user['username']}}</span>
            </div>

            <div class="media-right media-middle">
              <ul class="icons-list icons-list-extended text-nowrap">
                <li style="font-size:18px"><b>{{$value2->total_score}}</b></li>
                <li><i style="font-size:25px" class="icon-trophy2"></i></li>
              </ul>
            </div>
          </li>
          {{-- @if($key2 == 4)
              @break
          @endif --}}
          @endforeach
        </ul>
      </div>
    </div>
    <!-- /simple list -->
</div>
@endforeach
