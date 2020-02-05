@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">History</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">History</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <!-- State saving -->
	<div class="panel panel-flat">
    <div style="padding:20px">
    	<table class="table" id="table-history" class="display" style="width:100%">
  			<thead>
      		<tr>
              <th>Id</th>
              <th>Date</th>
              <th>Name</th>
              <th>School</th>
              <th>Category</th>
              <th>Type</th>
              <th>Quiz</th>
              <th>True</th>
              <th>False</th>
              <th>Score</th>
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

@endsection
@push('after_script')
  <script>
  var history;
    $(document).ready(function(){
      history = $('#table-history').DataTable({
        processing	: true,
        language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records"
                  },
        // dom 		: "<fl<t>ip>",
  			serverSide	: true,
  			stateSave: true,
        ajax		: {
            url : "{{ url('table/data-history') }}",
            type: "GET",
        },
        columns: [
            { data: 'id', name:'id', visible:false},
            { data: 'date', name:'date', visible:true},
            { data: 'collager.user.name', name:'name', visible:true},
            { data: 'collager.user.school.name', name:'school', visible:true},
            { data: 'quiz.quiz_type.quiz_category.name', name:'category', visible:true},
            { data: 'quiz.quiz_type.name', name:'type', visible:true},
            { data: 'quiz.title', name:'quiz', visible:true},
            { data: 'true_sum', name:'true', visible:true},
            { data: 'false_sum', name:'false', visible:true},
            { data: 'total_score', name:'score', visible:true},
            { data: 'action', name:'action', visible:true},
        ],
      });

    });
  </script>
@endpush

<th>Id</th>
<th>Date</th>
<th>Category</th>
<th>Type</th>
<th>Title Quiz</th>
<th>Name</th>
<th>Score</th>
<th>True</th>
<th>False</th>
<th>Score</th>
<th class="col-md-2">Action</th>
