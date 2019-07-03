@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Quiz Type</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="">Master Data</a></li>
            <li class="active">Quiz Type</li>
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
  		<form class="form-horizontal form-validate-jquery" action="#">
  			<fieldset class="content-group">
  				<legend class="text-bold">Basic inputs</legend>

  				<!-- Basic text input -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Basic text input <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="text" name="basic" class="form-control" required="required" placeholder="Text input validation">
  					</div>
  				</div>
  				<!-- /basic text input -->


  				<!-- Input with icons -->
  				<div class="form-group has-feedback">
  					<label class="control-label col-lg-3">Input with icon <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="text" name="with_icon" class="form-control" required="required" placeholder="Text input with icon validation">
  						<div class="form-control-feedback">
  							<i class="icon-droplets"></i>
  						</div>
  					</div>
  				</div>
  				<!-- /input with icons -->


  				<!-- Input group -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Input group <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<div class="input-group">
  							<div class="input-group-addon"><i class="icon-mention"></i></div>
  							<input type="text" name="input_group" class="form-control" required="required" placeholder="Input group validation">
  						</div>
  					</div>
  				</div>
  				<!-- /input group -->


  				<!-- Password field -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Password field <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="password" name="password" id="password" class="form-control" required="required" placeholder="Minimum 5 characters allowed">
  					</div>
  				</div>
  				<!-- /password field -->


  				<!-- Repeat password -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Repeat password <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="password" name="repeat_password" class="form-control" required="required" placeholder="Try different password">
  					</div>
  				</div>
  				<!-- /repeat password -->


  				<!-- Email field -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Email field <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="email" name="email" class="form-control" id="email" required="required" placeholder="Enter a valid email address">
  					</div>
  				</div>
  				<!-- /email field -->


  				<!-- Repeat email -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Repeat email <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="email" name="repeat_email" class="form-control" required="required" placeholder="Enter a valid email address">
  					</div>
  				</div>
  				<!-- /repeat email -->


  				<!-- Minimum characters -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Minimum characters <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="text" name="minimum_characters" class="form-control" required="required" placeholder="Enter at least 10 characters">
  					</div>
  				</div>
  				<!-- /minimum characters -->


  				<!-- Maximum characters -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Maximum characters <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="text" name="maximum_characters" class="form-control" required="required" placeholder="Enter 10 characters maximum">
  					</div>
  				</div>
  				<!-- /maximum characters -->


  				<!-- Minimum number -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Minimum number <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="text" name="minimum_number" class="form-control" required="required" placeholder="Enter a value greater than or equal to 10">
  					</div>
  				</div>
  				<!-- /minimum number -->


  				<!-- Maximum number -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Maximum number <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="text" name="maximum_number" class="form-control" required="required" placeholder="Please enter a value less than or equal to 10">
  					</div>
  				</div>
  				<!-- /maximum number -->


  				<!-- Basic textarea -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Basic textarea <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<textarea rows="5" cols="5" name="textarea" class="form-control" required="required" placeholder="Default textarea"></textarea>
  					</div>
  				</div>
  				<!-- /basic textarea -->

  			</fieldset>

  			<fieldset class="content-group">
  				<legend class="text-bold">Advanced inputs</legend>

  				<!-- Number range -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Number range <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="text" name="number_range" class="form-control" required="required" placeholder="Enter a value between 10 and 20">
  					</div>
  				</div>
  				<!-- /number range -->


  				<!-- Touchspin spinners -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Touchspin spinner <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<div class="input-group">
  							<input type="text" name="touchspin" value="" required="required" class="touchspin-postfix" placeholder="Not valid if empty">
  						</div>
  					</div>
  				</div>
  				<!-- /touchspin spinners -->


  				<!-- Custom message -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Custom message <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="text" name="custom" class="form-control" required="required" placeholder="Custom error message">
  					</div>
  				</div>
  				<!-- /custom message -->


  				<!-- URL validation -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">URL validation <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="text" name="url" class="form-control" required="required" placeholder="Enter a valid URL address">
  					</div>
  				</div>
  				<!-- /url validation -->


  				<!-- Date validation -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Date validation <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="text" name="date" class="form-control" required="required" placeholder="April, 2014 or any other date format">
  					</div>
  				</div>
  				<!-- /date validation -->


  				<!-- ISO date validation -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">ISO date validation <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="text" name="date_iso" class="form-control" required="required" placeholder="YYYY/MM/DD or any other ISO date format">
  					</div>
  				</div>
  				<!-- /iso date validation -->


  				<!-- Numbers only -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Numbers only <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="text" name="numbers" class="form-control" required="required" placeholder="Enter decimal number only">
  					</div>
  				</div>
  				<!-- /numbers only -->


  				<!-- Digits only -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Digits only <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="text" name="digits" class="form-control" required="required" placeholder="Enter digits only">
  					</div>
  				</div>
  				<!-- /digits only -->


  				<!-- Credit card validation -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Credit card validation <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="text" name="card" class="form-control" required="required" placeholder="Enter credit card number. Try 446-667-651">
  					</div>
  				</div>
  				<!-- /credit card validation -->


  				<!-- Basic file uploader -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Basic file uploader <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="file" name="unstyled_file" class="form-control" required="required">
  					</div>
  				</div>
  				<!-- /basic file uploader -->


  				<!-- Styled file uploader -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Styled file uploader <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<input type="file" name="styled_file" class="file-styled" required="required">
  					</div>
  				</div>
  				<!-- /styled file uploader -->


  				<!-- Basic select -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Basic select <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<select name="default_select" class="form-control" required="required">
  							<option value="">Choose an option</option>
  							<optgroup label="Alaskan/Hawaiian Time Zone">
  								<option value="AK">Alaska</option>
  								<option value="HI">Hawaii</option>
  								<option value="CA">California</option>
  							</optgroup>
  							<optgroup label="Mountain Time Zone">
  								<option value="AZ">Arizona</option>
  								<option value="CO">Colorado</option>
  								<option value="WY">Wyoming</option>
  							</optgroup>
  							<optgroup label="Central Time Zone">
  								<option value="AL">Alabama</option>
  								<option value="AR">Arkansas</option>
  								<option value="KY">Kentucky</option>
  							</optgroup>
  							<optgroup label="Eastern Time Zone">
  								<option value="CT">Connecticut</option>
  								<option value="DE">Delaware</option>
  								<option value="FL">Florida</option>
  							</optgroup>
  						</select>
  					</div>
  				</div>
  				<!-- /basic select -->


  				<!-- Select2 select -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Select2 select <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<select name="select2" data-placeholder="Select a State..." class="select" required="required">
  							<option></option>
  							<optgroup label="Alaskan/Hawaiian Time Zone">
  								<option value="AK">Alaska</option>
  								<option value="HI">Hawaii</option>
  							</optgroup>
  							<optgroup label="Pacific Time Zone">
  								<option value="CA">California</option>
  								<option value="NV">Nevada</option>
  								<option value="OR">Oregon</option>
  								<option value="WA">Washington</option>
  							</optgroup>
  							<optgroup label="Mountain Time Zone">
  								<option value="AZ">Arizona</option>
  								<option value="CO">Colorado</option>
  								<option value="ID">Idaho</option>
  								<option value="WY">Wyoming</option>
  							</optgroup>
  							<optgroup label="Central Time Zone">
  								<option value="AL">Alabama</option>
  								<option value="AR">Arkansas</option>
  								<option value="IL">Illinois</option>
  								<option value="KY">Kentucky</option>
  							</optgroup>
  						</select>
  					</div>
  				</div>
  				<!-- /select2 select -->


  				<!-- Multiple select -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Multiple select <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<select name="default_multiple_select" class="form-control" multiple="multiple" required="required">
  							<optgroup label="Alaskan/Hawaiian Time Zone">
  								<option value="AK">Alaska</option>
  								<option value="HI">Hawaii</option>
  								<option value="CA">California</option>
  								<option value="NV">Nevada</option>
  								<option value="WA">Washington</option>
  							</optgroup>
  							<optgroup label="Mountain Time Zone">
  								<option value="AZ">Arizona</option>
  								<option value="CO">Colorado</option>
  								<option value="ID">Idaho</option>
  								<option value="WY">Wyoming</option>
  							</optgroup>
  							<optgroup label="Central Time Zone">
  								<option value="AL">Alabama</option>
  								<option value="AR">Arkansas</option>
  								<option value="IL">Illinois</option>
  								<option value="KS">Kansas</option>
  								<option value="KY">Kentucky</option>
  							</optgroup>
  						</select>
  					</div>
  				</div>
  				<!-- /multiple select -->

  			</fieldset>

  			<fieldset class="content-group">
  				<legend class="text-bold">Checkboxes and radios</legend>

  				<!-- Basic single checkbox -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Basic single checkbox <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<div class="checkbox">
  							<label>
  								<input type="checkbox" name="single_basic_checkbox" required="required">
  								Accept our terms
  							</label>
  						</div>
  					</div>
  				</div>
  				<!-- /basic singlecheckbox -->


  				<!-- Basic checkbox group -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Basic checkbox group <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<div class="checkbox">
  							<label>
  								<input type="checkbox" name="basic_checkbox" required="required">
  								Duis eget nibh purus
  							</label>
  						</div>

  						<div class="checkbox">
  							<label>
  								<input type="checkbox" name="basic_checkbox">
  								Maecenas non nulla ac nunc
  							</label>
  						</div>

  						<div class="checkbox">
  							<label>
  								<input type="checkbox" name="basic_checkbox">
  								Maecenas egestas tristique
  							</label>
  						</div>
  					</div>
  				</div>
  				<!-- /basic checkbox group -->


  				<!-- Inline checkbox group -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Basic inline checkbox group <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<label class="checkbox-inline">
  							<input type="checkbox" name="basic_inline_checkbox" required="required">
  							Duis eget nibh purus
  						</label>

  						<label class="checkbox-inline">
  							<input type="checkbox" name="basic_inline_checkbox">
  							Maecenas non nulla ac nunc
  						</label>
  					</div>
  				</div>
  				<!-- /inline checkbox group -->


  				<!-- Basic radio group -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Basic radio group <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<div class="radio">
  							<label>
  								<input type="radio" name="basic_radio" required="required">
  								Cras leo turpis malesuada eget
  							</label>
  						</div>

  						<div class="radio">
  							<label>
  								<input type="radio" name="basic_radio">
  								Maecenas congue justo vel ipsum
  							</label>
  						</div>
  					</div>
  				</div>
  				<!-- /basic radio group -->


  				<!-- Basic inline radio group -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Basic inline radio group <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<label class="radio-inline">
  							<input type="radio" name="basic_radio_group" required="required">
  							Cras leo turpis malesuada eget
  						</label>

  						<label class="radio-inline">
  							<input type="radio" name="basic_radio_group">
  							Maecenas congue justo vel ipsum
  						</label>
  					</div>
  				</div>
  				<!-- /basic inline radio group -->


  				<hr>


  				<!-- Single styled checkbox -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Single styled checkbox <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<div class="checkbox">
  							<label>
  								<input type="checkbox" name="single_styled_checkbox" class="styled" required="required">
  								Accept our terms
  							</label>
  						</div>
  					</div>
  				</div>
  				<!-- /single styled checkbox -->


  				<!-- Styled checkbox group -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Styled checkbox group <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<div class="checkbox">
  							<label>
  								<input type="checkbox" name="styled_checkbox" class="styled" required="required">
  								Duis eget nibh purus
  							</label>
  						</div>

  						<div class="checkbox">
  							<label>
  								<input type="checkbox" name="styled_checkbox" class="styled">
  								Maecenas non nulla ac nunc
  							</label>
  						</div>

  						<div class="checkbox">
  							<label>
  								<input type="checkbox" name="styled_checkbox" class="styled">
  								Maecenas egestas tristique
  							</label>
  						</div>
  					</div>
  				</div>
  				<!-- /styled checkbox group -->


  				<!-- Inline checkbox group -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Inline checkbox group <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<label class="checkbox-inline">
  							<input type="checkbox" name="styled_inline_checkbox" class="styled" required="required">
  							Duis eget nibh purus
  						</label>

  						<label class="checkbox-inline">
  							<input type="checkbox" name="styled_inline_checkbox" class="styled">
  							Maecenas non nulla ac nunc
  						</label>
  					</div>
  				</div>
  				<!-- /inline checkbox group -->


  				<!-- Styled radio group -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Styled radio group <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<div class="radio">
  							<label>
  								<input type="radio" name="styled_radio" class="styled" required="required">
  								Cras leo turpis malesuada eget
  							</label>
  						</div>

  						<div class="radio">
  							<label>
  								<input type="radio" name="styled_radio" class="styled">
  								Maecenas congue justo vel ipsum
  							</label>
  						</div>
  					</div>
  				</div>
  				<!-- /styled radio group -->


  				<!-- Styled inline radio group -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Styled inline radio group <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<label class="radio-inline">
  							<input type="radio" name="styled_inline_radio" class="styled" required="required">
  							Cras leo turpis malesuada eget
  						</label>

  						<label class="radio-inline">
  							<input type="radio" name="styled_inline_radio" class="styled">
  							Maecenas congue justo vel ipsum
  						</label>
  					</div>
  				</div>
  				<!-- /styled inline radio group -->

  			</fieldset>

  			<fieldset>
  				<legend class="text-bold">Switcher components</legend>

  				<!-- Switchery single -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Swichery single <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<div class="checkbox checkbox-switchery switchery-xs">
  							<label>
  								<input type="checkbox" name="switchery_single" class="switchery" required="required">
  								Accept our terms
  							</label>
  						</div>
  					</div>
  				</div>
  				<!-- /switchery single -->


  				<!-- Switchery group -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Swichery group <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<div class="checkbox checkbox-switchery switchery-xs">
  							<label>
  								<input type="checkbox" name="switchery_group" class="switchery" required="required">
  								Duis eget nibh purus
  							</label>
  						</div>

  						<div class="checkbox checkbox-switchery switchery-xs">
  							<label>
  								<input type="checkbox" name="switchery_group" class="switchery">
  								Maecenas non nulla ac nunc
  							</label>
  						</div>

  						<div class="checkbox checkbox-switchery switchery-xs">
  							<label>
  								<input type="checkbox" name="switchery_group" class="switchery">
  								Maecenas egestas tristique
  							</label>
  						</div>
  					</div>
  				</div>
  				<!-- /switchery group -->


  				<!-- Inline switchery group -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Inline swichery group <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<label class="checkbox-inline checkbox-switchery switchery-xs">
  							<input type="checkbox" name="inline_switchery_group" class="switchery" required="required">
  							Duis eget nibh purus
  						</label>

  						<label class="checkbox-inline checkbox-switchery switchery-xs">
  							<input type="checkbox" name="inline_switchery_group" class="switchery">
  							Maecenas egestas tristique
  						</label>
  					</div>
  				</div>
  				<!-- /inline switchery group -->


  				<hr>


  				<!-- Switch single -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Switch single <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<div class="checkbox checkbox-switch">
  							<label>
  								<input type="checkbox" name="switch_single" data-on-text="Yes" data-off-text="No" class="switch" required="required">
  								Accept our terms
  							</label>
  						</div>
  					</div>
  				</div>
  				<!-- /switch single -->


  				<!-- Switch group -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Switch group <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<div class="checkbox checkbox-switch">
  							<label>
  								<input type="checkbox" name="switch_group" class="switch" required="required">
  								Duis eget nibh purus
  							</label>
  						</div>

  						<div class="checkbox checkbox-switch">
  							<label>
  								<input type="checkbox" name="switch_group" class="switch">
  								Maecenas non nulla ac nunc
  							</label>
  						</div>

  						<div class="checkbox checkbox-switch">
  							<label>
  								<input type="checkbox" name="switch_group" class="switch">
  								Maecenas egestas tristique
  							</label>
  						</div>
  					</div>
  				</div>
  				<!-- /switch group -->


  				<!-- Inline switch group -->
  				<div class="form-group">
  					<label class="control-label col-lg-3">Inline switch group <span class="text-danger">*</span></label>
  					<div class="col-lg-9">
  						<label class="checkbox-inline checkbox-switch">
  							<input type="checkbox" name="inline_switch_group" class="switch" required="required">
  							Duis eget nibh purus
  						</label>

  						<label class="checkbox-inline checkbox-switch">
  							<input type="checkbox" name="inline_switch_group" class="switch">
  							Maecenas non nulla ac nunc
  						</label>
  					</div>
  				</div>
  				<!-- /inline switch group -->

  			</fieldset>

  			<div class="text-right">
  				<button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
  				<button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
  			</div>
  		</form>
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
