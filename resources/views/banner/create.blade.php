<div id="modal-create" class="modal fade">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<div class="panel panel-flat">
          <div class="panel-body">
        		<form class="form-horizontal" id="banner-store" method="post" enctype="multipart/form-data" files=true>
              @csrf
              <fieldset class="content-group">
        				<legend class="text-bold">Create Banner</legend>
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
                      <input checked type="radio" id="viewCreate" name="isView" value="1" class="styled">
                      View
                    </label>
                    <label class="radio-inline col-md-3">
                      <input type="radio" id="notViewCreate" name="isView" value="0" class="styled">
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
			console.log($('input[name=isView]:checked').val());
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
