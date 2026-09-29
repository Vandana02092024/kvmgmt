@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-heading">
            <h3 class="heading">PAYROLL SETTINGS
            <a class="v-btn v-btn-primary pull-right bg-light" href="{{ url('/menu') }}">BACK</a>
			</h3>
            <br />
            </div>
        </div>
        
    </div>
	
 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="stat">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('/payrolldepartment') }}">
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">

                        <a href="{{ url('/payrolldepartment') }}" class="desc">DEPARTMENT</a>
                    </div>
                </a>
            </div>
       </div>
	   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="stat">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('/payrollcategory') }}">
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">

                        <a href="{{ url('/payrollcategory') }}" class="desc">Category</a>
                    </div>
                </a>
            </div>
       </div>
	   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="stat">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('/payrollemployee') }}">
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">

                        <a href="{{ url('/payrollemployee') }}" class="desc">EMPLOYEE</a>
                    </div>
                </a>
            </div>
       </div>
	</div>   
</section>
@endsection	   
	   