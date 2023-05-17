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
            <li class="active">Detail Quiz</li>
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

    	<h6 class="panel-title" style="width:50%"><i class="icon-cog3 position-left"></i> Material Info</h6>
		</div>
		<div class="panel-body">
      <div class="col-md-2">
     
          <img class="img-responsive" src="{{asset('img/blank.jpg')}}" alt="Quiz Type" title="Change the quiz type picture" width="100%">
     
        <br>
      </div>

			<div class="col-md-6">
        <label class="text-bold col-md-4">Quis Type</label>
        <label class="col-md-8">: </label>

        <label class="text-bold col-md-4">Title</label>
        <label class="col-md-8">: </label>

        <label class="text-bold col-md-4">Total Question</label>
        <label class="col-md-8">: question</label>

        <label class="text-bold col-md-4">Total Visible Question</label>
        <label class="col-md-8">: question</label>

        <label class="text-bold col-md-4">Time</label>
        <label class="col-md-8">:  minute</label>

        <label class="text-bold col-md-4">Start Time</label>
        <label class="col-md-8">:</label>

        <label class="text-bold col-md-4">End Time</label>
        <label class="col-md-8">:</label>

        <label class="text-bold col-md-4">Description</label>
        <label class="col-md-8">: </label>
      </div>
		</div>
		
		</div>
	</div>
</div>




@endsection
@push('after_script')


@endpush
