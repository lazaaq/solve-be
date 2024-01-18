<div id="modal-edit-file-materi" class="modal fade">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<div class="panel panel-flat">
          <div class="panel-body">
        		<form class="form-horizontal" id="file-materi-store" method="post" enctype="multipart/form-data" files=true>
              @csrf
              <input type="hidden" name="material_id" value="{{$material['id']}}">
              <fieldset class="content-group">
        				<legend class="text-bold">Create File Materi</legend>
                <div class="form-group">
                  <label class="control-label col-lg-3">File Name <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Description <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                    <textarea type="text" name="description" rows="3" class="form-control"  placeholder="">{{ old('description') }}</textarea>
                  </div>
                </div>
                <div class="form-group">
        					<label class="control-label col-lg-3">File</label>
        					<div class="col-lg-9">
                    <input id="file_materi" type="file" name="file_materi" data-show-caption="true" data-show-upload="false" accept="application/pdf">
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
<script type="text/javascript" src="{{asset('js/libraries/jquery.chained.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $("#file-materi-store").on('submit',function(e){
        e.preventDefault();
        $.ajax({
            'type': 'POST',
            'url' : "{{ route('file_materi.store') }}",
            'data': new FormData(this),
            'processData': false,
            'contentType': false,
            'dataType': 'JSON',
            'success': function(data){
							console.log("success", data);
							if(data.success){
                id = data.data.material_id;
                $('#modal-create-file-materi').modal('hide');
                // window.location.href = "{{ url('admin/material') }}"+"/"+id;
                toastr.success('Successfully added data!', 'Success', {timeOut: 5000});
                tableFileMateri.ajax.reload();
              }else{
                console.log(data);
	              for(var count = 0; count < data.errors.length; count++){
	              	toastr.error(data.errors[count], 'Error', {timeOut: 5000});
                }
              }
            },
        });
      });
    })

</script>
@endpush
