<div id="modal-create-material" class="modal fade">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<div class="panel panel-flat">
          <div class="panel-body">
        		<form class="form-horizontal" id="material-store" method="post" enctype="multipart/form-data" files=true>
              @csrf
              <fieldset class="content-group">
        				<legend class="text-bold">Create Quiz</legend>
								<div class="form-group">
                  <label class="control-label col-lg-3">Category Name <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
										<select id="category" class="select-search" name="quiz_category">
                        @foreach($quizcategory as $value => $key)
                            <option value="{{$key->id}}" {{collect(old('quiz_type'))->contains($key->id) ? 'selected':''}}>{{$key->name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Type<span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                    <select id="type" class="select-search" name="quiz_type">
                        @foreach($quiztype as $value1 => $key1)
                            <option value="{{$key1->id}}" {{collect(old('quiz_type'))->contains($key1->id) ? 'selected':''}} class="{{$key1->quiz_category_id}}">{{$key1->name}}</option>
                        @endforeach
                    </select>
                      @if ($errors->has('quiz_type'))
                      <label style="padding-top:7px;color:#F44336;">
                          <strong><i class="fa fa-times-circle"></i> {{ $errors->first('quiz_type') }}</strong>
                      </label>
                      @endif
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Name <span class="text-danger">*</span></label>
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
        			</fieldset>
              <div>
                <div class="col-md-4">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-arrow-left13"></i> Close</button>
                </div>
                <div class="col-md-8 text-right">
                  <!-- <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button> -->
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
		$("#type").chained("#category");
    /* save data */
    $('#material-store').on('submit', function (e) {
      e.preventDefault();
        $.ajax({
            'type': 'POST',
            'url' : "{{ route('material.store') }}",
            'data': new FormData(this),
            'processData': false,
            'contentType': false,
            'dataType': 'JSON',
            'success': function(data){
							console.log("success", data);
							if(data.success){
                id = data.data.id;
                $('#modal-create-material').modal('hide');
                window.location.href = "{{ url('admin/material') }}"+"/"+id;
                toastr.success('Successfully added data!', 'Success', {timeOut: 5000});
              }else{
								console.log("fail",data);
	              for(var count = 0; count < data.errors.length; count++){
	              	toastr.error(data.errors[count], 'Error', {timeOut: 5000});
                }
              }
            },

        });
    });

    $("#category" ).on( "change", function() {
      var selectedValue = $(this).val();
      $.ajax({
          url: "{{ url('select/data-quiz-category') }}/type/" + selectedValue,
          method: "GET",
          success: function(result) {
            // Clear the existing options
            $("#type").empty();
            // Iterate through the result and add each option to the dropdown
            $.each(result, function(index, item) {
              $("#type").append(new Option(item.text, item.id));
            });
          },
          error: function(xhr, status, error) {
              console.error(error);
          }
      });   
    });
});

</script>
@endpush
