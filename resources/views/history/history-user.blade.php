@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">History User</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{route('history.index')}}">History</a></li>
            <li class="active">History User</li>
        </ul>
    </div>
</div>
<!-- Content area -->
<div class="content">
    <!-- User thumbnail -->
    <div class="thumbnail">
        @if($data->picture == 'avatar.png')
        <img class="img-circle" src="{{asset('img/avatar.png')}}" alt="Avatar" title="Change the avatar" width="10%" height="50" style="padding-top:15px;">
        @else
        <img class="img-circle" src="{{route('user.picture',$data->id)}}" alt="Avatar" title="Change the avatar" width="10%" height="50" style="padding-top:15px;">
        @endif
        <div class="caption text-center">
            <h6 class="text-semibold no-margin">{{$data->name}} <small class="display-block">{{ucfirst($data->roles[0]['name'])}}</small></h6>
        </div>
    </div>
    <!-- /user thumbnail -->

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">Basic line chart</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <div class="chart-container">
                <div class="chart" id="c3-line-regions-chart"></div>
            </div>
        </div>
    </div>

    <div class="panel panel-flat">
        <div style="padding:20px">
            <table class="table" id="table-history-user" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Title Quiz</th>
                        <th>Date</th>
                        <th>Score</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /content area -->
@endsection
@push('after_script')
<script type="text/javascript" src="{{asset('js/plugins/visualization/d3/d3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/visualization/c3/c3.min.js')}}"></script>
<script>
    var history_user;
    $(document).ready(function(){
        history_user = $('#table-history-user').DataTable({
        order: [[ 4, "desc" ]],
        processing	: true,
        language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records"
                    },
        // dom 		: "<fl<t>ip>",
            serverSide	: true,
            stateSave: true,
        ajax		: {
            url : "{{ url('table/data-history-user') }}" + "/" + "{{$data->id}}",
            type: "GET",
        },
        columns: [
            { data: 'id', name:'id', visible:false},
            { data: 'category', name:'category', visible:true},
            { data: 'type', name:'type', visible:true},
            { data: 'title', name:'title', visible:true},
            { data: 'date', name:'date', visible:true},
            { data: 'score', name:'score', visible:true},
            { data: 'action', name:'action', visible:true},
        ],
        });

        $.ajax({
            type:'GET',
            url : "{{ url('table/data-history-chart') }}" + "/" + "{{$data->id}}",
            success:function(data){
            //alert(data.success);
            var chart_line_regions = c3.generate({
                bindto: '#c3-line-regions-chart',
                size: { height: 500 },
                point: {
                    r: 4
                },        
                data: {
                   // x: 'x',
                    columns: data,
                },
                grid: {
                    y: {
                        show: true
                    }
                },
                axis: {
                    x: {
                        label: 'Quiz ke-',
                        start: 1
                    },
                    y: {
                        label: 'Total score'
                    },
                }
            });
            }
        });
    });
</script>
@endpush
