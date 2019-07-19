<div id="modal_form_horizontal" class="modal fade">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        <form class="form-horizontal form-validate-jquery" action="{{route('quiz.saveImport',$quiz->id)}}" method="post" enctype="multipart/form-data" files=true>
        {{ csrf_field() }}
		      <div class="modal-body">
						<div class="col-md-12 text-center" style="margin-bottom:10px">
							<i class="fa fa-4x fa-upload"></i>
						</div>
						<div class="col-md-12">
							<fieldset class="content-group">
								<div class="form-group">
									<div class="col-lg-12">
										<h6 style="text-align:center"> Choose a document. Upload a .xls, or .xlsx</h6>
										<input type="file" name="excel" class="form-control">
										@if ($errors->has('excel'))
											<label style="padding-top:7px;color:#F44336;">
												<strong><i class="fa fa-times-circle"></i> {{ $errors->first('excel') }}</strong>
											</label>
										@endif
										<a style="margin-top:10px" href="{{route('quiz.downloadTemplate')}}" class="btn btn-xs btn-primary pull-right" id=""><i class="icon-download"></i> Download Template</a>
									</div>
								</div>
							</fieldset>
						</div>
  				</div>
  				<div class="modal-footer">
						<div class="col-md-12">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Submit form</button>
						</div>
  				</div>
  			</form>
  		</div>
  	</div>
  </div>
