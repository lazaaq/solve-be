<div id="modal_form_horizontal" class="modal fade">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 align="center" class="text-bold">Import Quiz</h5>
				{{-- <h5 class="modal-title">Horizontal form</h5> --}}
			</div>
        <form class="form-horizontal form-validate-jquery" action="{{route('quiz.saveImport',$quiz->id)}}" method="post" enctype="multipart/form-data" files=true>
        {{ csrf_field() }}
		      <div class="modal-body">
      			<fieldset class="content-group">
              <div class="form-group">
      					<label class="control-label col-lg-3">File</label>
      					<div class="col-lg-9">
      						<input type="file" name="excel" class="form-control">
                    @if ($errors->has('excel'))
                    <label style="padding-top:7px;color:#F44336;">
                        <strong><i class="fa fa-times-circle"></i> {{ $errors->first('excel') }}</strong>
                    </label>
                    @endif
                  <br>
                  <a href="{{route('quiz.downloadTemplate')}}" class="btn btn-xs btn-primary" id=""><i class="icon-download"></i> Template Import</a>
      					</div>
      				</div>
      			</fieldset>
            {{-- <div>
              <div class="col-md-4">
                <a href="{{route('quiz.show',$quiz->id)}}" class="btn btn-default" id=""> <i class="icon-arrow-left13"></i> Back</a>
              </div>
              <div class="col-md-8 text-right">
                <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
        				<button type="submit" class="btn btn-primary bg-primary-800">Submit <i class="icon-arrow-right14 position-right"></i></button>
              </div>
      			</div> --}}
  				</div>
  				<div class="modal-footer">
  					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  					<button type="submit" class="btn btn-primary">Submit form</button>
  				</div>
  			</form>
  		</div>
  	</div>
  </div>
