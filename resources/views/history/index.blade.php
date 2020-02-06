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
      <button id="btn-download-history" type="button" class="btn btn-primary btn-sm bg-primary"><i class="icon-download position-left"></i> Download History</button>
    	<table class="table" id="table-history" class="display" style="width:100%">
  			<thead>
      		<tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>School</th>
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
  var history;
    $(document).ready(function(){
      $("#btn-download-history").on('click', function(){
          $('#modal-download-history').modal('show');
          console.log('halo');
      });
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
            { data: 'name', name:'name', visible:true},
            { data: 'email', name:'email', visible:true},
            { data: 'school', name:'school', visible:true},
            { data: 'action', name:'action', visible:true},
        ],
      });

    });
  </script>
@endpush
