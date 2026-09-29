@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-heading">
                    <h3 class="heading"> <a class="v-btn v-btn-primary " style="margin-right:8px" href="{{ url('/user') }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a>EDIT USER
                    
                    <a class="v-btn v-btn-primary pull-right" href="{{ url('/user/create') }}">CREATE NEW USER</a>
					</h3>
                    <br /> 
                </div>
            </div>
        </div>
        <div class="row">

            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif

            <div class="col-sm-8 col-sm-offset-2">
                <div class="widget">
                    <div class="widget-content">
                        {!! Form::model($user, array('route' => ['user.update', $user->id], 'method' => 'PUT')) !!}
                        {{ csrf_field() }}



                            <div class="widget-content">

                                <div class="row form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="col-sm-12">
                                        <label>EMAIL</label>
                                        {!! Form::text('email', null, ['class' => 'form-control', 'readonly' => 'true']) !!}

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <div class="col-sm-12">
                                        <label for="name">NAME</label>
                                        {!! Form::text('name', null, ['class' => 'form-control']) !!}

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>                          
                                </div>
                                
                                <div class="row form-group{{ $errors->has('phone') ? ' has-error' : '' }}">                         
                                    <div class="col-sm-12">
                                        <label>PHONE</label>
                                        {!! Form::text('phone', null, ['class' => 'form-control']) !!}

                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group{{ $errors->has('role') ? ' has-error' : '' }}">                          
                                    <div class="col-sm-12">
                                        <label>ROLE</label>
                                        {{ Form::select('role', $roles, null,['class' => 'form-control', 'onChange' => 'getVal()', 'id' => 'roleId']) }}

                                        @if ($errors->has('role'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('role') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
								
								<div class="row form-group{{ $errors->has('moduleList') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label>MODULE ACCESS</label>			
										
										<div class="checkbox">
											<label><input type="checkbox" name="moduleList[]" value="1"<?php if(in_array("1", $module_data)){ echo " checked=\"checked\""; }?>>Sales</label>
											</br>
											<label><input type="checkbox" name="moduleList[]" value="2"<?php if(in_array("2", $module_data)){ echo " checked=\"checked\""; }?>>Labour</label>
                                            <label><input type="checkbox" name="moduleList[]" value="3"<?php if(in_array("3", $module_data)){ echo " checked=\"checked\""; }?>>Reporting</label>
										</div>
										@if ($errors->has('moduleList'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('moduleList') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>
								
								<div class="row form-group{{ $errors->has('email_location') ? ' has-error' : '' }}" id="emLoc">
									<div class="col-sm-12">
										<label>EMAIL LOCATION</label>
										
										@foreach($locations as $id => $location)
                                        <div class="checkbox">
                                            @if(in_array($id, $selEmailLocations))
                                           	<label><input type="checkbox" name="email_location[]" value="{{ $id }}" checked>{{ $location }}</label>
											@else
                                            <label>
                                                <input type="checkbox" name="email_location[]" value="{{ $id }}"  >{{ $location }}
                                            </label>
                                            @endif
                                        </div>
                                        @endforeach
										
										@if ($errors->has('email_location'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('email_location') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>
								
								
                                <div class="row form-group{{ $errors->has('claim') ? ' has-error' : '' }}">                         
                                    <div class="col-sm-12">
                                        <label>CLAIM</label>
                                        {!! Form::text('claim', null, ['class' => 'form-control']) !!}

                                        @if ($errors->has('claim'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('claim') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                                    <div class="col-sm-12">
                                        <label>SELECT LOCATION</label>

                                        @foreach($locations as $id => $location)
                                        <div class="checkbox">
                                            @if(is_array($selLocations) && ($x = array_search($id, $selLocations)))
                                            <label id="div{{ $id }}">
                                                {!!link_to_route('resetlocation', '', ['id' => $x, 'user' => $user->id], ['class' => 'fa fa-close anchor','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"reset location"])!!}
                                                {{ $location }}
                                            </label>
                                            @else
                                            <label>
                                                <input type="checkbox" name="location[]" value="{{ $id }}"  >{{ $location }}
                                            </label>
                                            @endif
                                            
                                        </div>
                                        @endforeach

                                        @if ($errors->has('location'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('location') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row form-group{{ $errors->has('password') ? ' has-error' : '' }}">                          
                                    <div class="col-sm-12">
                                        <label>PASSWORD</label>
                                        <input id="npassword" type="password" class="form-control" name="npassword">
                                        {!! Form::hidden('password', null, ['class' => 'form-control']) !!}
                                        
                                        @if ($errors->has('npassword'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('npassword') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <div class="col-sm-12">
                                        <label>CONFIRM PASSWORD</label>
                                        <input id="npassword-confirm" type="password" class="form-control" name="npassword_confirmation">

                                        @if ($errors->has('npassword_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('npassword_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                            <div class="widget-footer">
                                <button class="v-btn v-btn-primary">UPDATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
$(".fa-close").on("click", function(){
        if(confirm("Do you want to reset this location?")){
            return true;
        }else{
            return false;
        }
    });
$(document).ready(function() {
	  var userRole = $('#roleId').val();
	  if(userRole == 'Owner') {
		 $('#emLoc').show(); 
	  } else {
		 $('#emLoc').hide(); 
	  }
});

function getVal() {
    var userRole = $('#roleId').val();
	if(userRole == 'Owner') {
	   $('#emLoc').show(); 
    } else {
	  $('#emLoc').hide(); 
	}
}
</script>
@endsection