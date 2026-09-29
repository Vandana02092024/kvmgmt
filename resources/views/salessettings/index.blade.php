@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-heading">
            <h3 class="heading"> <a class="v-btn v-btn-primary " style="margin-right:8px" href="{{ url('/menu') }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a>SALES SETTINGS
            </h3>
            <br />
            </div>
        </div>
    </div>
<div class="col-lg-3 col-md-3  col-sm-6 col-xs-12">
            <div class="stat">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('/discount') }}">
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">

                        <a href="{{ url('/discount') }}" class="desc">DISCOUNTS & CREDITS</a>
                    </div>
                </a>
            </div>
       </div>
	   
	   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="stat">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('/adjustment') }}">
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">

                        <a href="{{ url('/adjustment') }}" class="desc">ADJUSTMENTS</a>
                    </div>
                </a>
            </div>
       </div>
	   
	   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="stat">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('/receipt') }}">
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">

                        <a href="{{ url('/receipt') }}" class="desc">RECEIPTS</a>
                    </div>
                </a>
            </div>
       </div>
	   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="stat">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('/sale') }}">
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">

                        <a href="{{ url('/sale') }}" class="desc">SALES</a>
                    </div>
                </a>
            </div>
       </div>
	</div>   
</section>
@endsection	   
	   