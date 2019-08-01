@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Banners</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="">Master Data</a></li>
            <li class="active">Banners</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <!-- State saving -->
	<div class="panel panel-flat">
		{{-- <div class="panel-heading">
			<h5 class="panel-title">State saving</h5>
		</div> --}}

		{{-- <div class="panel-body"> --}}
			{{-- DataTables has the option of being able to <code>save the state</code> of a table: its paging position, ordering state etc., so that is can be restored when the user reloads a page, or comes back to the page after visiting a sub-page. This state saving ability is enabled by the <code>stateSave</code> option. The <code>duration</code> for which the saved state is valid can be set using the <code>stateDuration</code> initialisation parameter (2 hours by default). --}}
		{{-- </div> --}}
    <div style="padding:20px">
      <button id="btn-create" type="button" class="btn btn-primary btn-sm bg-primary-800"><i class="icon-add position-left"></i> Create New</button>
      {{-- <a href="{{route('banner.create')}}" class="btn btn-primary btn-sm bg-primary-800"><i class="icon-add position-left"></i>Create New</a> --}}
    	<table class="table" id="table-banner" class="display" style="width:100%">
  			<thead>
      		<tr>
             <th>Id</th>
             <th>Picture</th>
             <th>Linked To</th>
             <th>Description</th>
             <th class="col-md-1">Viewed</th>
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
@include('banner.create')
@include('banner.edit')

@endsection
@push('after_script')
  <script>
  var tableBanner;
    $(document).ready(function(){
      $("#btn-create").on('click', function(){
          $('textarea[name=description]').val('');
          $('input[name=link_to]').val('');
          $('input[name=is_view]').val('');
          $('input[name=picture]').val('');
          $('#modal-create').modal('show');
      });
  		/* START OF DATATABLE */
      tableBanner = $('#table-banner').DataTable({
        processing	: true,
        language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records"
                  },
        // dom 		: "<fl<t>ip>",
  			serverSide	: true,
  			stateSave: true,
        ajax		: {
            url: "{{ url('table/data-banner') }}",
            type: "GET",
        },
        columns: [
            { data: 'id', name:'id', visible:false},
            { data: 'pictures', name:'pictures', visible:true},
            { data: 'linkTo', name:'linkTo', visible:true},
            { data: 'description', name:'description', visible:true},
            { data: 'isViewed', name:'isViewed', visible:true},
            { data: 'action', name:'action', visible:true},
        ],
      });
      $('#table-banner tbody').on( 'click', '#delete', function () {
        var data = tableBanner.row( $(this).parents('tr') ).data();
        swal({
          // title: "Are you sure?",
          text: "Are you sure to delete data?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              url: "{{ url('admin/banner/delete') }}"+"/"+data['id'],
              method: 'get',
              success: function(result){
                tableBanner.ajax.reload();
                toastr.success('Successfully deleted data!', 'Success', {timeOut: 5000});
                // swal("Poof! Your imaginary file has been deleted!", {
                //   icon: "success",
                // });
              }
            });
          }
        });
      });
      /* END OF DATATABLE */

      /* START OF GET DATA FOR FORM EDIT */
      $("#table-banner tbody").on('click','#btn-edit', function(){
          $("#banner-edit :input").val('');
          $('#modal-edit').modal('show');
          var data = tableBanner.row( $(this).parents('tr') ).data();
          var id = data['id'];
          var token = $('input[name=_token]').val();
          var urlData = " {{ url('admin/banner') }}"+"/"+id+"/edit";
          $.getJSON( urlData, function(data){
          /*START GET PICTURE*/
            $('#img-edit').empty();
            var img = $('<img id="img-banner" class="img-responsive" src="{{ url('storage/banner/') }}/'+id+'" alt="" title="" height="50"><br>');
            $('#img-edit').append(img);
          /*END GET PICTURE*/
          console.log(data['data']['isView']);
            $('input[name=_method]').val('PUT');
            $('#view').val('1');
        		$('#notView').val('0');
            $('input[name=_token]').val(token);
            $('input[name=id_edit]').val(data['data']['id']);
            $('input[name=link_to_edit]').val(data['data']['linkTo']);
            $('input[name=isViewEdit][value='+data['data']['isView']+']').prop('checked', true).trigger('change');
            $('textarea[name=description_edit]').val(data['data']['description']);
          });
      });
      /*END OF GET DATA FOR FORM EDIT*/

      /* START OF CHANGE IS VIEW DATA */
      $('#table-banner tbody').on( 'click', '#change-is-view', function () {
        var data = tableBanner.row( $(this).parents('tr') ).data();
        if (data['isView'] == '1') {
          swal(
            {
              // title: "Are you sure?",
              text: "Are you sure to disable banner?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }
          ).then((willDelete) => {
            if (willDelete) {
              $.ajax({
                url: "{{ url('admin/banner/change-is-view') }}"+"/"+data['id'],
                method: 'get',
                success: function(result){
                  tableBanner.ajax.reload();
                  toastr.success('Successfully updated data!', 'Success', {timeOut: 5000});
                }
              });
            }
          });
        } else {
          swal(
            {
              text: "Are you sure to enable banner?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }
          ).then((willDelete) => {
            if (willDelete) {
              $.ajax({
                url: "{{ url('admin/banner/change-is-view') }}"+"/"+data['id'],
                method: 'get',
                success: function(result){
                  tableBanner.ajax.reload();
                  toastr.success('Successfully updated data!', 'Success', {timeOut: 5000});
                }
              });
            }
          });
        }
      });
      /* END OF CHANGE IS VIEW DATA*/
    });
  </script>
@endpush
