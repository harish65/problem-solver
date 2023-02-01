@php

    if (Auth::user() -> role == 2){
        $template = 'layouts.admin';
        $title = 'Profile | Admin';
    }
    elseif(Auth::user() -> role == 1){
        $template = 'layouts.adult';
        $title = 'Profile | Adult';
    }
    elseif(Auth::user() -> role == 0){
        $template = 'layouts.child';
        $title = 'Profile | Admin';
    }
    
@endphp

@extends('layouts.project')
@section('title', $title)

@section('content')
<div class="">

    <div class="masonry-item col-lg-12 project-card">
        <!-- .card -->
        <div class="card card-fluid">
            <!-- .card-body -->
            <div class="card-body">
                <!-- grid row -->
                <div class="media align-items-center">
                    <!-- grid column -->
                    <div class="col-md-4">
                        <!-- .user-avatar -->
                        <a href="javascript:void(0)" class="user-avatar-xl"><img src="{{ asset('/assets/img/banner-img.png')}}" alt="Image"></a> <!-- /.user-avatar -->
                    </div><!-- /grid column -->
                    <!-- grid column -->
                    <div class="col-8 text-center">
                        <h4> Welcome to The GeoFunction Problem Solver</h4>
                        <h6> Think logically to solve problems</h6>
                        <h6> List of Projects</h6>
    
                        <div style="text-align: right; position: relative; top: 74px;">
                            <label>Grid View</label>
                            <input type="checkbox" id="viewControl" onclick="changeLayoutView()" value="0">
                        </div>
                    </div><!-- /grid column -->
    
                </div><!-- /grid row -->
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div>

    <div class="col-lg-12">
        <div class="row">
    
                        <div class="col-xl-3 col-lg-4 col-sm-6"></div>
</div>
@endsection 