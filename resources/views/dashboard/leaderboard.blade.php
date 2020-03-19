@foreach ($collection as $key => $value)
<div class="col-md-4">
  <!-- Simple list -->
    <div class="panel panel-flat" style="height:400px;overflow-y:scroll;">
      <div class="panel-heading">
      <marquee behavior="scroll" style="color:#000" direction="left"><h5 class="panel-title">{{$value['title']}}</h5></marquee>
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
          <li class="media-header">Quiz Type : {{$value['type']}}</li>
          @if (empty($value['leaderboard']))
            <li class="media">
              <div class="media-body">
                <div class="media-heading text-semibold">Empty Data</div>
                {{-- <span class="text-muted">{{$value2->username}}</span> --}}
              </div>
            </li>
          @else
            @foreach ($value['leaderboard'] as $key2 => $value2)
              <li class="media">
                <div class="media-left media-middle">
                  <a href="#">
                    @if($value2->picture == 'avatar.png' || empty($value2->picture))
                      <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="avatar">
                    @else
                      <img src="{{route('user.picture',$value2->user_id)}}" class="img-circle" alt="avatar">
                    @endif
                  </a>
                </div>

                <div class="media-body">
                  <div class="media-heading text-semibold">{{$value2->name}}</div>
                  <span class="text-muted">{{$value2->username}}</span>
                </div>

                <div class="media-right media-middle">
                  <ul class="icons-list icons-list-extended text-nowrap">
                    <li style="font-size:18px"><b>{{$value2->total_score}}</b></li>
                    <li><i style="font-size:25px" class="icon-trophy2"></i></li>
                  </ul>
                </div>
              </li>
            @endforeach
          @endif
        </ul>
      </div>
    </div>
    <!-- /simple list -->
</div>
@endforeach
