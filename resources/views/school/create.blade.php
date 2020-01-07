<div id="modal-create" class="modal fade">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<div class="panel panel-flat">
          <div class="panel-body">
        		<form class="form-horizontal" id="school-store" method="post" enctype="multipart/form-data" files=true>
              @csrf
              <fieldset class="content-group">
        				<legend class="text-bold">Create School</legend>
                <div class="form-group">
                  <label class="control-label col-lg-3">School Name<span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                  <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Province <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                    <input type="text" name="province" class="form-control" value="{{ old('province') }}" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Regency <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                    <input type="text" name="regency" class="form-control" value="{{ old('regency') }}" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">District <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                    <input type="text" name="district" class="form-control" value="{{ old('district') }}" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Address <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="">
                  </div>
                </div>
        			</fieldset>
              <div>
                <div class="col-md-4">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-arrow-left13"></i> Close</button>
                </div>
                <div class="col-md-8 text-right">
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
    $('#school-store').on('submit', function (e) {
      e.preventDefault();
        $.ajax({
            'type': 'POST',
            'url' : "{{ route('school.store') }}",
            'data': new FormData(this),
            'processData': false,
            'contentType': false,
            'dataType': 'JSON',
            'success': function(data){
							if(data.success){
                $('#modal-create').modal('hide');
								toastr.success('Successfully added data!', 'Success', {timeOut: 5000});
								tableSchool.ajax.reload();
              }else{
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
