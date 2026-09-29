@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-heading">
            <h3 class="heading">SETTINGS
            <a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">BACK</a>
			</h3>
            <br />
            </div>
        </div>
        <div class="col-sm-6 hide">
            <ul class="inline pull-right">
                <li class="quick-report">
                    <div class="quick-report-infos">
                        <h4><span class="text-xs text-light block">New Order</span>17,456</h4>
                    </div>
                    <span class="chart-icon"><span class="inlinesparkline">1,4,4,7,5,9,10</span></span>
                </li>
                <li class="quick-report">
                    <div class="quick-report-infos">
                        <h4><span class="text-xs text-light block">My Balance</span>17,456</h4>
                    </div>
                    <span class="chart-icon"><span class="inlinesparkline">1,4,4,7,5,9,10</span></span>
                </li>
            </ul>
        </div>
    </div>
	
<style>
.visual>i {
	margin-top: 24px;
}
</style>	
    <div class="row" ng-controller="stats">
        

        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
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

       <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
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

       <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
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


       <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
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
    

        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
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
	   
	   <div id="sales-btn" class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
            <div class="stat" >
                <span class="dashboard-stat dashboard-stat-v2 blue" >
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <span  class="desc">SALES</span>
                    </div>
                </span>
            </div>
       </div>
	   <div id="payroll-btn" class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
            <div class="stat" >
                <span class="dashboard-stat dashboard-stat-v2 blue" >
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <span  class="desc">PAYROLL</span>
                    </div>
                </span>
            </div>
       </div>
	<div id="sales-cat">
	   <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
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

	   <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
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
	   
	   <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
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
	   
	   <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
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
    </div>
	
	
	<div id="payroll-cat">
	   <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
            <div class="stat">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('/') }}">
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">

                        <a href="{{ url('/') }}" class="desc">DEPARTMENT</a>
                    </div>
                </a>
            </div>
       </div>
	   <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
            <div class="stat">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('/') }}">
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">

                        <a href="{{ url('/') }}" class="desc">EMPLOYEE</a>
                    </div>
                </a>
            </div>
       </div>
    </div>

    </div>
</div>
<style>
  #sales-cat
  {
	  display:none;
  }
  #payroll-cat
  {
	  display:none;
  }
</style>
</section>
@endsection
<script type="text/javascript" src="https://code.jquery.com/jquery-1.4.3.min.js" ></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#sales-btn').click(function(){	  
	  $('#sales-cat').toggle();
  });
  $('#payroll-btn').click(function(){	  
	  $('#payroll-cat').toggle();
  });
});
</script>