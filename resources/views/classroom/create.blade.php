<div id="modal-create" class="modal fade">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<div class="panel panel-flat">
          <div class="panel-body">
        		<form class="form-horizontal" id="classroom-store" method="post" enctype="multipart/form-data" files=true>
              @csrf
              <fieldset class="content-group">
        				<legend class="text-bold">Create Classroom</legend>
                <div class="form-group">
                  <label class="control-label col-lg-3">Classroom Name <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Code <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
										<div class="input-group">
											<span id="rnd-code" class="input-group-addon"><a id="rnd-code">Generate</a></span>
											<input type="text" name="code" class="form-control" value="{{ old('code') }}" placeholder="">
										</div>
                    <!-- <input type="text" name="code" class="form-control" value="{{ old('code') }}" placeholder=""> -->
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
		$("#rnd-code").on('click', function(){
				$('input[name=code]').val(makeid(5));
		});
    /* save data */
    $('#classroom-store').on('submit', function (e) {
      e.preventDefault();
        $.ajax({
            'type': 'POST',
            'url' : "{{ route('classroom.store') }}",
            'data': new FormData(this),
            'processData': false,
            'contentType': false,
            'dataType': 'JSON',
            'success': function(data){
							if(data.success){
                $('#modal-create').modal('hide');
								toastr.success('Successfully added data!', 'Success', {timeOut: 5000});
								tableClassroom.ajax.reload();
              }else{
								console.log(data);
	              for(var count = 0; count < data.errors.length; count++){
	              	toastr.error(data.errors[count], 'Error', {timeOut: 5000});
                }
              }
            },

        });
    });
		function makeid(length) {
		   var result           = '';
		   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		   var charactersLength = characters.length;
		   for ( var i = 0; i < length; i++ ) {
		      result += characters.charAt(Math.floor(Math.random() * charactersLength));
		   }
			 return result;
		}
});

</script>
@endpush
