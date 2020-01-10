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
              <fieldset class="content-group">
        				<legend class="text-bold">Add Classroom Member</legend>
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
var lecture_user_id;
$(document).ready(function(){
	lecture_user_id = $('#lecture_user_id').val();
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
				url : "{{ url('table/data-collager-classroom-add') }}" + '/' + lecture_user_id,
				type: "GET",
		},
		columns: [
				{ data: 'id', name:'id', visible:false},
				{ data: 'name', name:'name', visible:true},
				{ data: 'action', name:'action', visible:true},
		],
	});

});

</script>
@endpush
