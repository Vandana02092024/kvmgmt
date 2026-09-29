<header class="skin-primary">
	<div class="col-sm-4 col-xs-4">
		
		<img src="{{ url('/resources/views/Logo1.png') }}" height="54px"> <!-- http://44.230.62.131/kvmgmt/resources/views/Logo1.png -->
		<!-- <div class="brand-name">
	    	<div class="toggle-side-bar inline" id="toggle-side-bar">
	        	<i class="fa fa-bars"></i>
	    	</div>
	      	<div class="inline bold" >KV Management LLC</div>
	   </div> -->	
	</div>
	<div class="col-sm-8 col-xs-8">
	<div class="pull-right">
	<div class="dropdown admin-dropdown dropdown-menu-right inline" style="margin-top:3px;">
			<button class="v-btn btn-lg dropdown-toggle uppercase" style="margin-right:10px; background-color:transparent"type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				<i class="fa fa-bell-o"></i>
				@if(session()->get('total_new_csr') > 0)
				<span class="noOfNoti">{{ session()->get('total_new_csr') }}</span>
			    @else
					<span style="display:none;"></span>
				@endif
			</button>
			<?php /* ?>
			@if(count(session()->get('all_new_csr_data') > 0) && session()->get('all_new_csr_data') != null)
			<?php */ ?>
			@if(session()->get('all_new_csr_data') != null)
				<ul class="dropdown-menu" style="min-width:300px;" aria-labelledby="dropdownMenu2">
					@foreach(session()->get('all_new_csr_data') as $data)
					@php $datafill = "Follow up with $data->customer_name on $data->followup_date by $data->followup_time"
					@endphp
						<li>{{ link_to_route('service.edit', $datafill ,[$data->id],['style' => 'white-space:normal;']) }}</li>
					@endforeach
				</ul>
			@endif
			
			<?php /* ?>
			@if(count(session()->get('all_new_csr_data') > 0) && session()->get('all_new_csr_data') == null)
			<?php */ ?>
			@if(session()->get('all_new_csr_data') == null)
				<ul class="dropdown-menu" style="min-width:200px;" aria-labelledby="dropdownMenu2">
					<li style='white-space:normal;'><a> No notifications Available.</a></li>
				</ul>
			@endif
			
		</div>
		<div class="dropdown pull-right admin-dropdown">
			<b>LOCATION :</b> 
			{{ session()->get('locationName') }}
			<button class="v-btn v-btn-primary dropdown-toggle uppercase" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			{{ Auth::user()->name }}
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				
				<li><a href="{{ url('/logout') }}"
				>Logout</a></li>
			</ul>
		</div>	
	</div>
	</div>
</header>

<style>
.noOfNoti{    position: absolute;
    top: 1px;
    font-weight: bold;
    right: 12px;
    padding: 0px 0px;
    background-color: white;
    color: #ef0808;
    font-size: 12px;
    height: 18px;
    text-align: center;
    width: 18px;
    border-radius: 50%;}
.dropdown-menu>li a{padding:10px} 
</style>