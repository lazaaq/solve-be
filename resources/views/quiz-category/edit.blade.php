{{-- @extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Quiz Category</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="">Master Data</a></li>
            <li><a href="{{route('quizcategory.index')}}">Quiz Category</a></li>
            <li class="active">Edit</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <!-- State saving -->
	<div class="panel panel-flat">
    <div class="panel-body">
  		<form class="form-horizontal form-validate-jquery" action="{{route('quizcategory.update',$data->id)}}" method="post" enctype="multipart/form-data" files=true>
        @method('PUT')
        @csrf
  			<fieldset class="content-group">
  				<legend class="text-bold">Edit Quiz Category</legend>
          <div class="form-group">
            <label class="control-label col-lg-3">Category Name <span class="text-danger">*</span></label>
            <div class="col-lg-9">
              <input type="text" class="form-control" placeholder="" name="name" value="{{old('name') ? old('name') : $data->name}}">
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
              <textarea type="text" name="description" rows="3" class="form-control"  placeholder="">{{old('description') ? old('description') : $data->description}}</textarea>
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
              @if($data->pic_url == 'blank.jpg')
              <img class="img-responsive" src="{{asset('img/blank.jpg')}}" alt="Quiz Category" title="Change the quiz type picture" width="100" height="50">
              @else
              <img class="img-responsive" src="{{route('quizcategory.picture',$data->id)}}" alt="Quiz Category" title="Change the quiz type picture" width="100" height="50">
              @endif
              <br>
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
            <a href="{{route('quizcategory.index')}}"type="reset" class="btn btn-default" id=""> <i class="icon-arrow-left13"></i> Back</a>
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

<!-- Content area -->
<div id="modal-edit" class="modal fade">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<div class="panel panel-flat">
          <div class="panel-body">
        		<form class="form-horizontal" id="quiz-category-edit" method="post" enctype="multipart/form-data" files=true>
							@method('PUT')
              @csrf
              <fieldset class="content-group">
        				<legend class="text-bold">Edit Quiz Category</legend>
                <div class="form-group">
                  <label class="control-label col-lg-3">Category Name <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                    <input type="hidden" name="id_edit" class="form-control" value="" placeholder="">
                    <input type="text" name="name_edit" class="form-control" value="" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Description <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                    <textarea type="text" name="description_edit" rows="3" class="form-control"  placeholder=""></textarea>
                  </div>
                </div>
                <div class="form-group">
        					<label class="control-label col-lg-3">Picture</label>
                  <div id="img-edit" class="col-lg-9"></div>
									<label class="control-label col-lg-3"></label>
									<div class="col-lg-9">
										<input type="file" name="picture_edit" class="file-input-custom" data-show-caption="true" data-show-upload="false" accept="image/*">
										{{-- <input type="file" name="picture_edit" class="form-control"> --}}
									</div>
        				</div>
        			</fieldset>
              <div>
                <div class="col-md-4">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-arrow-left13"></i> Close</button>
                </div>
                <div class="col-md-8 text-right">
                  <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
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
$(document).ready(function(){
    /* START OF SAVE DATA */
    id = $('input[name=id_edit]').val();
		$('#quiz-category-edit').on('submit', function (e) {
      e.preventDefault();
        $.ajax({
						'type': 'post',
						'url' : "{{ url('admin/quizcategory') }}"+"/"+id,
						'data': new FormData(this),
            'processData': false,
            'contentType': false,
            'dataType': 'JSON',
            'success': function(data){
							console.log(data);
							if(data.success){
                $('#modal-edit').modal('hide');
								toastr.success('Successfully updated data!', 'Success', {timeOut: 5000});
								tableQuizCategory.ajax.reload();
              }else{
                for(var count = 0; count < data.errors.length; count++){
	              	toastr.error(data.errors[count], 'Error', {timeOut: 5000});
                }
              }
            },

        });
    });

    $('#quiz_category_edit').select2({
      ajax : {
        url :  "{{ url('select/data-quiz-category') }}",
        dataType: 'json',
        data: function(params){
            return {
                term: params.term,
            };
        },
        processResults: function(data){
            return {
                results: data
            };
        },
        cache : true,
      },
    });
});

</script>
@endpush
