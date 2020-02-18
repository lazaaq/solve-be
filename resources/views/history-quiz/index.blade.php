@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">History by Quiz</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">History by Quiz</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <!-- State saving -->
	<div class="panel panel-flat">
    <div style="padding:20px">
      <table class="table" id="table-quiz" class="display" style="width:100%">
  			<thead>
      		<tr>
             <th>id</th>
             <th>Code</th>
             <th>Category</th>
             <th>Type</th>
             <th>Title</th>
             <th>Description</th>
             <th class="col-md-2">Action</th>
          </tr>
  			</thead>
  			<tbody>
  			</tbody>
  		</table>
    </div>
	</div>
	<!-- /state saving -->
</div>
<!-- /content area -->
@include('history.download')
@endsection
@push('after_script')
  <script>
  var tableQuiz;
    $(document).ready(function(){
      $("#btn-download-history").on('click', function(){
          $('#modal-download-history').modal('show');
      });
      tableQuiz = $('#table-quiz').DataTable({
        processing	: true,
        language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records"
                  },
        // dom 		: "<fl<t>ip>",
  			serverSide	: true,
  			stateSave: true,
        ajax		: {
            url: "{{ url('table/data-history-quiz') }}",
            type: "GET",
        },
        columns: [
            { data: 'id', name:'id', visible:false},
            { data: 'code', name:'code', visible:true},
            { data: 'quiz_category', name:'quiz_category', visible:true},
            { data: 'quiz_type', name:'quiz_type', visible:true},
            { data: 'title', name:'title', visible:true},
            { data: 'description', name:'description', visible:true},
            { data: 'action', name:'action', visible:true},
        ],
      });
      /*END OF DATATABLE*/

    });
  </script>
@endpush
