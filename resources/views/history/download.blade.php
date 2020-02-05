<div id="modal-download-history" class="modal fade">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<div class="panel panel-flat">
          <div class="panel-body">
            <fieldset class="content-group">
              <legend class="text-bold">Download History</legend>
              <div class="form-group">
                <label class="control-label col-lg-3">School Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                <select id="school" class="select-search" name="school" required>
                </select>
                </div>
              </div>
            </fieldset>
            <div>
              <div class="col-md-4">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-arrow-left13"></i> Close</button>
              </div>
              <div class="col-md-8 text-right">
                <button type="button" id="btn-submit" class="btn btn-primary"><i class="icon-download position-left"></i>Download</button>
              </div>
            </div>
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
    $('#school').select2({
    ajax : {
        url :  "{{ url('select/data-school') }}",
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

    $("#btn-submit").on('click', function(){
      window.location.href = "{{ url('admin/reporting') }}"+"/"+$('#school').val();
      $('#modal-download-history').modal('hide');
    });

});

</script>
@endpush
