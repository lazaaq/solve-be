@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Banner</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="">Master Data</a></li>
            <li><a href="{{route('banner.index')}}">Banner</a></li>
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
  		<form class="form-horizontal form-validate-jquery" action="{{route('banner.store')}}" method="post" enctype="multipart/form-data" files=true>
        {{ csrf_field() }}
  			<fieldset class="content-group">
  				<legend class="text-bold">Creat Banner</legend>
          <div class="form-group">
            <label class="control-label col-lg-3">Description <span class="text-danger">*</span></label>
            <div class="col-lg-9">
              <textarea type="text" name="description" rows="3" class="form-control"  placeholder="">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                <label style="padding-top:7px;color:#F44336;">
                    <strong><i class="fa fa-times-circle"></i>{{ $errors->first('description') }}</strong>
                </label>
                @endif
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-3">Link To <span class="text-danger">*</span></label>
            <div class="col-lg-9">
              <input type="text" name="link_to" class="form-control" value="{{ old('link_to') }}" placeholder="">
                @if ($errors->has('link_to'))
                <label style="padding-top:7px;color:#F44336;">
                    <strong><i class="fa fa-times-circle"></i> {{ $errors->first('link_to') }}</strong>
                </label>
                @endif
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-3">Is Viewed<span class="text-danger">*</span></label>
            <div class="col-lg-9">
              <label class="radio-inline col-md-2">
                <input checked type="radio" name="is_view" {{ collect(old('is_view'))->contains(1) ? 'checked' : '' }} value="1" class="styled">
                View
              </label>
              <label class="radio-inline col-md-2">
                <input type="radio" name="is_view" {{ collect(old('is_view'))->contains(0) ? 'checked' : '' }} value="0" class="styled">
                Not View
                @if ($errors->has('is_view'))
                <label style="padding-top:7px;color:#F44336;">
                    <strong><i class="fa fa-times-circle"></i> {{ $errors->first('is_view') }}</strong>
                </label>
                @endif
            </div>
          </div>
          <div class="form-group">
  					<label class="control-label col-lg-3">Picture</label>
  					<div class="col-lg-9">
  						<input type="file" name="picture" class="form-control">
              @if ($errors->has('picture'))
              <label style="padding-top:7px;color:#F44336;">
              <strong><i class="fa fa-times-circle"></i>{{ $errors->first('picture') }}</strong>
              </label>
              @endif
  					</div>
  				</div>
  			</fieldset>
        <div>
          <div class="col-md-4">
            <a href="{{route('banner.index')}}"type="reset" class="btn btn-default" id=""> <i class="icon-arrow-left13"></i> Back</a>
          </div>
          <div class="col-md-8 text-right">
            <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
    				<button type="submit" class="btn btn-primary bg-primary-800">Submit <i class="icon-arrow-right14 position-right"></i></button>
          </div>
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
