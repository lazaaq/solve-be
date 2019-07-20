{{-- @extends('layouts.app')
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
            <li><a href="{{route('quiztype.index')}}">Quiz Type</a></li>
            <li class="active">Create</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <!-- State saving -->
	<div class="panel panel-flat">
    <div class="panel-body">
  		<form class="form-horizontal form-validate-jquery" action="{{route('quiztype.store')}}" method="post" enctype="multipart/form-data" files=true>
        {{ csrf_field() }}
  			<fieldset class="content-group">
  				<legend class="text-bold">Creat Quiz Type</legend>
          <div class="form-group">
            <label class="control-label col-lg-3">Type Name <span class="text-danger">*</span></label>
            <div class="col-lg-9">
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="">
                @if ($errors->has('name'))
                <label style="padding-top:7px;color:#F44336;">
                    <strong><i class="fa fa-times-circle"></i> {{ $errors->first('name') }}</strong>
                </label>
                @endif
            </div>
          </div>
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
            <a href="{{route('quiztype.index')}}"type="reset" class="btn btn-default" id=""> <i class="icon-arrow-left13"></i> Back</a>
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
<!-- Page header -->
{{-- <div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Quiz Type</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="">Master Data</a></li>
            <li><a href="{{route('quiztype.index')}}">Quiz Type</a></li>
            <li class="active">Create</li>
        </ul>
    </div>
</div> --}}
<!-- /page header -->

<!-- Content area -->
<div id="modal-create" class="modal fade">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<div class="panel panel-flat">
          <div class="panel-body">
        		<form class="form-horizontal form-validate-jquery" id="quiz-type-store" method="post" enctype="multipart/form-data" files=true>
              <fieldset class="content-group">
        				<legend class="text-bold">Creat Quiz Type</legend>
                <div class="form-group">
                  <label class="control-label col-lg-3">Type Name <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="" required>
                      @if ($errors->has('name'))
                      <label style="padding-top:7px;color:#F44336;">
                          <strong><i class="fa fa-times-circle"></i> {{ $errors->first('name') }}</strong>
                      </label>
                      @endif
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Description <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                    <textarea type="text" name="description" rows="3" class="form-control"  placeholder="" required>{{ old('description') }}</textarea>
                      @if ($errors->has('description'))
                      <label style="padding-top:7px;color:#F44336;">
                          <strong><i class="fa fa-times-circle"></i>{{ $errors->first('description') }}</strong>
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
                  {{-- <a href="{{route('quiztype.index')}}"type="reset" class="btn btn-default" id=""> <i class="icon-arrow-left13"></i> Back</a> --}}
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-arrow-left13"></i> Close</button>
                </div>
                <div class="col-md-8 text-right">
                  <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
          				{{-- <button type="submit" class="btn btn-primary bg-primary-800">Submit <i class="icon-arrow-right14 position-right"></i></button> --}}
                  <button type="submit" id="btn-save-konsul" class="btn btn-primary">Simpan</button>
                </div>
        			</div>
        		</form>
        	</div>
      	<!-- /state saving -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /content area -->
@push('after_script')
<script type="text/javascript">
/* get form data before submit */
$(document).ready(function(){
    /* save data */
    $('#btn-save-konsul').on( 'click', function () {
        var record ={'_token': '{{ csrf_token() }}',
                     'name'        : $('input[name=name]').val(),
                     'description' : $('textarea[name=description]').val(),
                     'picture'     : $('input[name=picture]').val(),
                    };
        $.ajax({
            'type': 'POST',
            'url' : "{{ route('quiztype.store') }}",
            'data': record,
            'dataType': 'JSON',
            'success': function(response){
              swal({
                // title: "Are you sure?",
                text: "Success",
                icon: "success",
                buttons: true,
                dangerMode: false,
              });
              $('#modal-create').modal('hide');
              tableQuizType.ajax.reload();
            },
            'error': function(response){
              var errorText = '';
              console.log(response)
              $.each(response.responseJSON.errors, function(key, value) {
                  errorText += value+'<br>'
              });
              console.log(response.status+':'+response.responseJSON.message);
              console.log(errorText);
            }
        });
        // $('#modal-create').modal('hide');
        // tableQuizType.ajax.reload();
        // swal({
        //   title: "Good!",
        //   text: "Success create data.",
        //   icon: "success",
        //   buttons: true,
        //   dangerMode: false,
        // });
    });
});

</script>
@endpush
