@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-heading">
            <h3 class="heading">SETTINGS
            <a class="v-btn v-btn-primary pull-right bg-light" href="{{ url('/dashboard') }}">BACK</a>
			</h3>
            <br />
            </div>
        </div>
        
    </div>
	

    <div class="row mt-4" style="margin-top: 50px;" ng-controller="stats">
        

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="stat">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('/location') }}">
                    <div class="visual">
                       <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                       <div ><a href="{{ url('/location') }}" class="desc">LOCATION</a></div>
                    </div>
                </a>
             </div>
       </div>

       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="stat">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('/user') }}">
                    <div class="visual">
                       <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        
                        <a href="{{ url('/user') }}" class="desc">USER </a>
                    </div>
                </a>
            </div>
       </div>

       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="stat">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('/category') }}">
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">

                        <a href="{{ url('/category') }}" class="desc">CATEGORY</a>
                    </div>
                </a>
            </div>
       </div>


       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="stat">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('/product') }}">
                    <div class="visual">
                        <i class="fa fa-cube" aria-hidden="true"></i>
                    </div>
                    <div class="details">

                        <a href="{{ url('/product') }}" class="desc">PRODUCT</a>
                    </div>
                </a>
            </div>
       </div>
    

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="stat">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('/seller') }}">
                    <div class="visual">
                       <i class="fa fa-industry" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                       <div ><a href="{{ url('/seller') }}" class="desc">VENDOR</a></div>
                    </div>
                </a>
             </div>
       </div>
	   
    </div>
</div>
</section>
@endsection
<script type="text/javascript" src="https://code.jquery.com/jquery-1.4.3.min.js" ></script>
