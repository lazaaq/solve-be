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
  <!-- State saving -->
	<div class="panel panel-flat">
		{{-- <div class="panel-heading">
			<h5 class="panel-title">State saving</h5>
		</div> --}}

		{{-- <div class="panel-body"> --}}
			{{-- DataTables has the option of being able to <code>save the state</code> of a table: its paging position, ordering state etc., so that is can be restored when the user reloads a page, or comes back to the page after visiting a sub-page. This state saving ability is enabled by the <code>stateSave</code> option. The <code>duration</code> for which the saved state is valid can be set using the <code>stateDuration</code> initialisation parameter (2 hours by default). --}}
		{{-- </div> --}}
    <div class="panel-body">
      <form class="stepy-clickable" action="#">
				<fieldset title="1">
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
					</div>
				</fieldset>

				<fieldset title="2">
					<legend class="text-semibold">Your education</legend>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>University:</label>
                                <input type="text" name="university" placeholder="University name" class="form-control">
                              </div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Country:</label>
                                  <select name="university-country" data-placeholder="Choose a Country..." class="select">
                                      <option></option>
                                      <option value="1">United States</option>
                                      <option value="2">France</option>
                                      <option value="3">Germany</option>
                                      <option value="4">Spain</option>
                                  </select>
                                </div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Degree level:</label>
                                <input type="text" name="degree-level" placeholder="Bachelor, Master etc." class="form-control">
                              </div>

							<div class="form-group">
								<label>Specialization:</label>
                                <input type="text" name="specialization" placeholder="Design, Development etc." class="form-control">
                              </div>
						</div>

						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<label>From:</label>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
			                                    <select name="education-from-month" data-placeholder="Month" class="select">
			                                    	<option></option>
			                                        <option value="January">January</option>
			                                        <option value="...">...</option>
			                                        <option value="December">December</option>
			                                    </select>
		                                    </div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
			                                    <select name="education-from-year" data-placeholder="Year" class="select">
			                                        <option></option>
			                                        <option value="1995">1995</option>
			                                        <option value="...">...</option>
			                                        <option value="1980">1980</option>
			                                    </select>
		                                    </div>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<label>To:</label>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
			                                    <select name="education-to-month" data-placeholder="Month" class="select">
			                                    	<option></option>
			                                        <option value="January">January</option>
			                                        <option value="...">...</option>
			                                        <option value="December">December</option>
			                                    </select>
		                                    </div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
			                                    <select name="education-to-year" data-placeholder="Year" class="select">
			                                        <option></option>
			                                        <option value="1995">1995</option>
			                                        <option value="...">...</option>
			                                        <option value="1980">1980</option>
			                                    </select>
		                                    </div>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label>Language of education:</label>
                                <input type="text" name="education-language" placeholder="English, German etc." class="form-control">
                              </div>
						</div>
					</div>
				</fieldset>

				<fieldset title="3">
					<legend class="text-semibold">Your experience</legend>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Company:</label>
                                <input type="text" name="experience-company" placeholder="Company name" class="form-control">
                              </div>

							<div class="form-group">
								<label>Position:</label>
                                <input type="text" name="experience-position" placeholder="Company name" class="form-control">
                              </div>

							<div class="row">
								<div class="col-md-6">
									<label>From:</label>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
			                                    <select name="experience-from-month" data-placeholder="Month" class="select">
			                                    	<option></option>
			                                        <option value="January">January</option>
			                                        <option value="...">...</option>
			                                        <option value="December">December</option>
			                                    </select>
		                                    </div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
			                                    <select name="experience-from-year" data-placeholder="Year" class="select">
			                                        <option></option>
			                                        <option value="1995">1995</option>
			                                        <option value="...">...</option>
			                                        <option value="1980">1980</option>
			                                    </select>
		                                    </div>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<label>To:</label>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
			                                    <select name="experience-to-month" data-placeholder="Month" class="select">
			                                    	<option></option>
			                                        <option value="January">January</option>
			                                        <option value="...">...</option>
			                                        <option value="December">December</option>
			                                    </select>
		                                    </div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
			                                    <select name="experience-to-year" data-placeholder="Year" class="select">
			                                        <option></option>
			                                        <option value="1995">1995</option>
			                                        <option value="...">...</option>
			                                        <option value="1980">1980</option>
			                                    </select>
		                                    </div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
                              <div class="form-group">
								<label>Brief description:</label>
                                  <textarea name="experience-description" rows="4" cols="4" placeholder="Tasks and responsibilities" class="form-control"></textarea>
                              </div>

							<div class="form-group">
								<label class="display-block">Recommendations:</label>
                                  <input name="recommendations" type="file" class="file-styled">
                                  <span class="help-block">Accepted formats: pdf, doc. Max file size 2Mb</span>
                              </div>
						</div>
					</div>
				</fieldset>

				<fieldset title="4">
					<legend class="text-semibold">Additional info</legend>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="display-block">Applicant resume:</label>
                                  <input type="file" name="resume" class="file-styled">
                                  <span class="help-block">Accepted formats: pdf, doc. Max file size 2Mb</span>
                                </div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Where did you find us?</label>
                                  <select name="source" data-placeholder="Choose an option..." class="select-simple">
                                      <option></option>
                                      <option value="monster">Monster.com</option>
                                      <option value="linkedin">LinkedIn</option>
                                      <option value="google">Google</option>
                                      <option value="adwords">Google AdWords</option>
                                      <option value="other">Other source</option>
                                  </select>
                                </div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Availability:</label>
								<div class="radio">
									<label>
										<input type="radio" name="availability" class="styled">
										Immediately
									</label>
								</div>

								<div class="radio">
									<label>
										<input type="radio" name="availability" class="styled">
										1 - 2 weeks
									</label>
								</div>

								<div class="radio">
									<label>
										<input type="radio" name="availability" class="styled">
										3 - 4 weeks
									</label>
								</div>

								<div class="radio">
									<label>
										<input type="radio" name="availability" class="styled">
										More than 1 month
									</label>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Additional information:</label>
                                  <textarea name="additional-info" rows="5" cols="5" placeholder="If you want to add any info, do it here." class="form-control"></textarea>
                                </div>
						</div>
					</div>
				</fieldset>

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
