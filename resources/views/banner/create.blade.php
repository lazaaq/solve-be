{{-- @extends('layouts.app')
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
            <li class="active">Createe</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <!-- State saving -->
	<div class="panel panel-flat">
    <div class="panel-body">
  		<form class="form-horizontal form-validate-jquery" action="{{route('banner.store')}}" method="post" enctype="multipart/form-data" files=true>
        {{ csrf_field() }}
  			<fieldset class="content-group">
  				<legend class="text-bold">Create Banner</legend>
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
@endpush --}}

<div id="modal-create" class="modal fade">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<div class="panel panel-flat">
          <div class="panel-body">
        		<form class="form-horizontal form-validate-jquery" id="banner-store" method="post" enctype="multipart/form-data" files=true>
              @csrf
              <fieldset class="content-group">
        				<legend class="text-bold">Createe Banner</legend>
                <div class="form-group">
                  <label class="control-label col-lg-3">Description <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                    <textarea type="text" name="description" rows="3" class="form-control"  placeholder="">{{ old('description') }}</textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Link To <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                    <input type="text" name="link_to" class="form-control" value="{{ old('link_to') }}" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Is Viewed<span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                    <label class="radio-inline col-md-3">
                      <input checked type="radio" name="is_view" value="TAMPIL" class="styled is_view">
                      View
                    </label>
                    <label class="radio-inline col-md-3">
                      <input type="radio" name="is_view" value="TIDAK TAMPIL" class="styled is_view">
                      Not View
                  </div>
                </div>
                <div class="form-group">
        					<label class="control-label col-lg-3">Picture</label>
        					<div class="col-lg-9">
        						<input type="file" name="picture" class="file-input-custom" data-show-caption="true" data-show-upload="false" accept="image/*">
        					</div>
        				</div>
        			</fieldset>
              <div>
                <div class="col-md-4">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-arrow-left13"></i> Close</button>
                </div>
                <div class="col-md-8 text-right">
                  <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                  <button type="submit" id="btn-submit" class="btn btn-primary">Save</button>
                </div>
        			</div>
        		</form>
        	</div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /content area -->
@push('after_script')
<script type="text/javascript">
$(document).ready(function(){
    /* save data */
    $('#banner-store').on('submit', function (e) {
      e.preventDefault();
        $.ajax({
            'type': 'POST',
            'url' : "{{ route('banner.store') }}",
            'data': new FormData(this),
            'processData': false,
            'contentType': false,
            'dataType': 'JSON',
            'success': function(data){
							console.log(data);
							if(data.success){
                $('#modal-create').modal('hide');
								toastr.success('Successfully added data!', 'Success', {timeOut: 5000});
								tableBanner.ajax.reload();
              }else{
								console.log(data);
	              for(var count = 0; count < data.errors.length; count++){
	              	toastr.error(data.errors[count], 'Error', {timeOut: 5000});
                }
              }
            },

        });
    });
});

</script>
@endpush
