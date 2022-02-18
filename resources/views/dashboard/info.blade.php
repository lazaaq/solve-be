<div class="col-lg-4">
  <!-- Members online -->
  <div class="panel bg-teal-400">
    <div class="panel-body">
      <div class="heading-elements">
        {{-- <span class="heading-text badge bg-teal-800">+53,6%</span> --}}
      </div>

      <h3 class="no-margin">{{$memberOnline}}</h3>
      Members online
      <div class="text-muted text-size-small">{{$totalMember}} total members</div>
    </div>

    <div class="container-fluid">
      <div id="members-online"></div>
    </div>
  </div>
  <!-- /members online -->
</div>
<div class="col-lg-4">
  <!-- Current server load -->
  <div class="panel bg-pink-400">
    <div class="panel-body">
      <div class="heading-elements">
        {{-- <span class="heading-text badge bg-pink-800">+53,6%</span> --}}
      </div>

      <h3 class="no-margin">{{$totalGamePlayed}}</h3>
      Quiz Taken
      @if ($totalGamePlayed == 0 || $totalGamePlayedBefore == 0)
        <div class="text-muted text-size-small">0% compared to the previous day</div>
      @else
        @if ($totalGamePlayed < $totalGamePlayedBefore)
          <div class="text-muted text-size-small">-{{$totalGamePlayed/$totalGamePlayedBefore*100}}% compared to the previous day</div>
        @else
          <div class="text-muted text-size-small">+{{$totalGamePlayed/$totalGamePlayedBefore*100}}% compared to the previous day</div>
        @endif
      @endif
    </div>

    <div id="server-load"></div>
  </div>
  <!-- /current server load -->
</div>
<div class="col-lg-4">
  <!-- Today's revenue -->
  <div class="panel bg-blue-400">
    <div class="panel-body">
      <div class="heading-elements">
      </div>
      <h3 class="no-margin">{{$totalQuiz}}</h3>
      Total Quiz
      <div class="text-muted text-size-small">from {{$totalQuizType}} type quizzes</div>
    </div>

    <div id="today-revenue"></div>
  </div>
  <!-- /today's revenue -->
</div>
