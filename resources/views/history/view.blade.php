@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">History User</span></h4>
        </div>
    </div>
    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{route('history.index')}}">History</a></li>
            <li><a href="{{route('history.show',$user)}}">History User</a></li>
            <li class="active">Detail History</li>
        </ul>
    </div>
</div>

<div class="content">
  <div class="panel panel-white">
		<div class="panel-heading">
      @if ($errors->messages())
        <div class="alert alert-warning alert-styled-left">
  				<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
          @foreach ($errors->messages() as $key => $error)
            @foreach ($error as $key => $error)
              <span class="text-semibold">Warning!</span> {{ $error }}<br>
              {{-- <li>{{ $error }}</li> --}}
            @endforeach
          @endforeach
		    </div>
      @endif
      @if (session('totalQuestion'))
        <div class="alert alert-info alert-styled-left alert-bordered">
  				<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
  				<span class="text-semibold">Heads up!</span> {{session('totalQuestionSuccess')}} of {{session('totalQuestion')}} question has been imported.
		    </div>
      @endif
      @if (session('dbTransactionError'))
        <div class="alert alert-danger alert-styled-left alert-bordered">
  				<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
  				<span class="text-semibold">Oops!</span> {{session('dbTransactionError')}}
		    </div>
      @endif
    @if ($quiz->sum_question == 0)
      <button style="margin-top:-6px" class="add-modal btn btn-primary btn-sm pull-right"><span class="icon-add position-left"></span>Create Question</button>
      <button style="margin-top:-6px;margin-right:6px" type="button" class="btn btn-primary btn-sm bg-primary pull-right" data-toggle="modal" data-target="#import"><i class="icon-upload position-left"></i> Import Question</button>
    @endif
    	<h6 class="panel-title "><i class="icon-cog3 position-left"></i> Quiz Info</h6>
		</div>
		<div class="panel-body">
      <div class="col-md-2">
        @if($quiz->pic_url == 'blank.jpg')
          <img class="img-responsive" src="{{asset('img/blank.jpg')}}" alt="Quiz Type" title="Change the quiz type picture" width="100%">
        @else
          <img class="img-responsive" src="{{route('quiz.picture',$quiz->id)}}" alt="Quiz Type" title="Change the quiz type picture" width="100%">
        @endif
        <br>
      </div>
			<div class="col-md-6">
        <label class="text-bold col-md-4">Quis Type</label>
        <label class="col-md-8">: {{$quiz->quizType['name']}}</label>

        <label class="text-bold col-md-4">Title</label>
        <label class="col-md-8">: {{$quiz->title}}</label>

        <label class="text-bold col-md-4">Time</label>
        <label class="col-md-8">: {{$quiz->time}}</label>

        <!-- <label class="text-bold col-md-4">Start Time</label>
        <label class="col-md-8">: {{\Carbon\Carbon::parse($data->first()->created_at)->format('j F Y, H:i:s')}}</label>

        <label class="text-bold col-md-4">End Time</label>
        <label class="col-md-8">: {{\Carbon\Carbon::parse($data->last()->created_at)->format('j F Y, H:i:s')}}</label> -->

        <label class="text-bold col-md-4">Description</label>
        <label class="col-md-8">: {{$quiz->description}}</label>
      </div>
		</div>
	</div>
</div>

@if ($quiz->sum_question > 0)
  <div class="content">
  <!-- State saving -->
	<div class="panel panel-white">
    <div class="panel-heading">
			<h6 class="panel-title "><i class="icon-cog3 position-left"></i> User Answer</h6>
		</div>
    <div class="panel-body">
        <!-- <div class="panel-body" style="padding:0px; margin-bottom:10px;margin-top:-10px">
            <div class="input-group col-md-3 pull-right">
							<input type="text" id="search" class="form-control" placeholder="Search records">
              <span class="input-group-addon"><i class="icon-search4"></i></span>
						</div>
        </div> -->
      <div id="container-quiz">
      @include('history.view_data')
      </div>
      <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
  	</div>
	<!-- /state saving -->
  </div>
</div>
@endif
@endsection
