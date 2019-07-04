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
            <li class="active">Create</li>
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
			<div class="col-md-12">
        <label class="text-bold col-md-2">Quis Type</label>
        <label class="col-md-10">: {{$quiz->quizType['name']}}</label>

        <label class="text-bold col-md-2">Title</label>
        <label class="col-md-10">: {{$quiz->title}}</label>

        <label class="text-bold col-md-2">Total Question</label>
        <label class="col-md-10">: {{$quiz->sum_question}}</label>

        <label class="text-bold col-md-2">Description</label>
        <label class="col-md-10">: {{$quiz->description}}</label>
      </div>
		</div>
	</div>
</div>

<div class="content">
  <!-- State saving -->
	<div class="panel panel-flat">
    <div class="panel-body">
      <form class="stepy-clickable" action="#">
        @for ($i=1; $i < $quiz->sum_question+1; $i++)
          <fieldset title="{{$i}}">
					<legend class="text-semibold"></legend>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Question:</label>
                <textarea type="text" name="question" rows="3" class="form-control"  placeholder="">{{ old('question') }}</textarea>
							</div>
						</div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label col-lg-3">Picture</label>
                <input type="file" name="picture" class="form-control">
              </div>
            </div>
						<div class="col-md-12">
							<div class="form-group">
								<label>First Multiple Choice:</label>
                <input type="text" name="first_multiple_choice" class="form-control" value="{{ old('first_multiple_choice') }}" placeholder="">
                  @if ($errors->has('first_multiple_choice'))
                  <label style="padding-top:7px;color:#F44336;">
                      <strong><i class="fa fa-times-circle"></i> {{ $errors->first('first_multiple_choice') }}</strong>
                  </label>
                  @endif
							</div>
						</div>
            <div class="col-md-12">
							<div class="form-group">
								<label>Second Multiple Choice:</label>
                <input type="text" name="second_multiple_choice" class="form-control" value="{{ old('second_multiple_choice') }}" placeholder="">
                  @if ($errors->has('second_multiple_choice'))
                  <label style="padding-top:7px;color:#F44336;">
                      <strong><i class="fa fa-times-circle"></i> {{ $errors->first('second_multiple_choice') }}</strong>
                  </label>
                  @endif
							</div>
						</div>
            <div class="col-md-12">
							<div class="form-group">
								<label>First Multiple Choice:</label>
                <input type="text" name="third_multiple_choice" class="form-control" value="{{ old('third_multiple_choice') }}" placeholder="">
                  @if ($errors->has('third_multiple_choice'))
                  <label style="padding-top:7px;color:#F44336;">
                      <strong><i class="fa fa-times-circle"></i> {{ $errors->first('third_multiple_choice') }}</strong>
                  </label>
                  @endif
							</div>
						</div>
            <div class="col-md-12">
							<div class="form-group">
								<label>First Multiple Choice:</label>
                <input type="text" name="fourth_multiple_choice" class="form-control" value="{{ old('fourth_multiple_choice') }}" placeholder="">
                  @if ($errors->has('fourth_multiple_choice'))
                  <label style="padding-top:7px;color:#F44336;">
                      <strong><i class="fa fa-times-circle"></i> {{ $errors->first('fourth_multiple_choice') }}</strong>
                  </label>
                  @endif
							</div>
						</div>
            <div class="col-md-12">
							<div class="form-group">
								<label>First Multiple Choice:</label>
                <input type="text" name="fifth_multiple_choice" class="form-control" value="{{ old('fifth_multiple_choice') }}" placeholder="">
                  @if ($errors->has('fifth_multiple_choice'))
                  <label style="padding-top:7px;color:#F44336;">
                      <strong><i class="fa fa-times-circle"></i> {{ $errors->first('fifth_multiple_choice') }}</strong>
                  </label>
                  @endif
							</div>
						</div>
            <div class="col-md-12">
							<div class="form-group">
								<label class="display-block">True Answer:</label>
                <label class="radio-inline col-md-1">
                  <input type="radio" name="radio-inline-left" class="styled" checked="checked">
                  First
                </label>
                <label class="radio-inline col-md-1">
                  <input type="radio" name="radio-inline-left" class="styled">
                  Second
                </label>
                <label class="radio-inline col-md-1">
                  <input type="radio" name="radio-inline-left" class="styled">
                  Third
                </label>
                <label class="radio-inline col-md-1">
                  <input type="radio" name="radio-inline-left" class="styled">
                  Fourth
                </label>
                <label class="radio-inline col-md-1">
                  <input type="radio" name="radio-inline-left" class="styled">
                  Fifth
                </label>
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

  </script>
@endpush
