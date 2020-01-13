<div id="modal-create" class="modal fade">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<div class="panel panel-flat">
          <div class="panel-body">
        	  <form class="form-horizontal" id="collager-classroom-store" method="post" enctype="multipart/form-data" files=true>
              @csrf
			  			<input type="hidden" name="classrom_id" value="{{$classroom->id}}">
              <fieldset class="content-group">
        				<legend class="text-bold">Add Classroom Member</legend>
								<div class="col-md-12" style="margin-right:0px">
									<button id="btn-select-all" type="button" class="btn btn-primary btn-xs bg-primary-800 pull-right" value="check"><i class="icon-select2 position-left"></i><span>Select All Student</span></button>
								</div>
								<table class="table" id="table-collager-classroom-add" class="display" style="width:100%">
					  			<thead>
					      		<tr>
					             <th>Id</th>
					             <th>Name</th>
					             <th class="col-md-2">Action</th>
					          </tr>
					  			</thead>
					  			<tbody>
					  			</tbody>
					  		</table>
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
var tableCollagerClassroomAdd;
var lecture_user_id, class_id;
$(document).ready(function(){
	lecture_user_id = $('#lecture_user_id').val();
	class_id = $('#classroom_id').val();
		tableCollagerClassroomAdd = $('#table-collager-classroom-add').DataTable({
		processing	: true,
		language: {
								search: "_INPUT_",
								searchPlaceholder: "Search name ..."
							},
		// dom 		: "<fl<t>ip>",
		serverSide	: true,
		stateSave: true,
		ajax		: {
				url : "{{ url('table/data-collager-classroom-add') }}" + '/' + lecture_user_id + '/' + class_id,
				type: "GET",
		},
		columns: [
				{ data: 'id', name:'id', visible:false},
				{ data: 'name', name:'name', visible:true},
				{ data: 'action', name:'action', visible:true},
		],
	});

	$('#collager-classroom-store').on('submit', function (e) {
      e.preventDefault();
        $.ajax({
            'type': 'POST',
            'url' : "{{ route('collager-classroom.store') }}",
            'data': new FormData(this),
            'processData': false,
            'contentType': false,
            'dataType': 'JSON',
            'success': function(data){
			if(data.success){
			$('#modal-create').modal('hide');
				toastr.success('Successfully added data!', 'Success', {timeOut: 5000});
				tableCollagerClassroom.ajax.reload();
				tableCollagerClassroomAdd.ajax.reload();
			}else{
				console.log(data);
					for(var count = 0; count < data.errors.length; count++){
						toastr.error(data.errors[count], 'Error', {timeOut: 5000});
					}
				}
			},

        });
    });

	$('#btn-select-all').click(function(event) {   
		if($(this).val() == 'check') {
			// Iterate each checkbox
			$(':checkbox').each(function() {
				this.checked = true;                        
			});
			$(this).val('uncheck');
			$("span", this).text("Unselect All Student");
		} else {
			$(':checkbox').each(function() {
				this.checked = false;                       
			});
			$(this).val('check');
			$("span", this).text("Select All Student");
		}
	});
});

</script>
@endpush
