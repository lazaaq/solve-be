@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Dashboard</span></h4>
        </div>
    </div>

    {{-- <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="2_col.html">Starters</a></li>
            <li class="active">2 columns</li>
        </ul>
    </div> --}}
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
    <div class="row">
        @if(Auth::user()->hasRole('admin'))
        @include('dashboard.info')
        @endif
        @include('dashboard.leaderboard')
    </div>
</div>
@endsection
