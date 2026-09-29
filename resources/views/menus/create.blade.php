@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-heading">
            <h3 class="heading"> <a class="v-btn v-btn-primary " style="margin-right:8px" href="{{ url('/dashboard') }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a> SUPPLY ORDER
           
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
    <div class="row" style="margin-top: 40px;" ng-controller="stats">
        
         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="stat">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('/order/create') }}">
                    <div class="visual">
                       <i class="fa fa-cubes" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        
                        <a href="{{ url('/order/create') }}" class="desc">NEW SUPPLY ORDER</a>
                    </div>
                </a>
            </div>
       </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="stat">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('/order') }}">
                    <div class="visual">
                       <i class="fa fa-cubes" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        
                        <a href="{{ url('/order') }}" class="desc">SUPPLY ORDERS</a>
                    </div>
                </a>
            </div>
       </div>

      

    </div>


</div>
</section>
@endsection