@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
<div class="container">
    <div class="row">
        <div class="col-sm-8">

        </div>
        <div class="col-sm-4 pull-right">

                <form role="form" method="POST" action="{{ url('/setlocation') }}">
                {{ csrf_field() }}
                    <table border="0" width="100%">
                        <tr>
                            <td>
                                {{ Form::select('location', session()->get('all_locations'), session()->get('location_id'),['class' => 'form-control', 'id' => 'locationid']) }}
                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </td>
                            <td width="20%">
                                <button type="submit" class="v-btn v-btn-primary pull-right">
                                    CHANGE LOCATION
                                </button>
                            </td>
                        </tr>
                    </table>


 <style>

.mm{
		margin-right: 40px;

}
</style>







            </form>



        </div>

    </div>
    <br />
    <div class="row">
        <div class="col-sm-12">
            <div class="page-heading">
            <h3 class="heading text-center"  style="font-size: 2em;font-weight:bold;">MAIN MENU</h3>
            </div>
        </div>
    </div>
    <div class="row" ng-controller="stats">


        <?php
        $user = Auth::user();
        $module_data = explode(',',$user['module_access']);

        foreach($menus as $menu){
          $url = url('/'.$menu->route);
          $string = '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                <div class="stat">
                    <a class="dashboard-stat dashboard-stat-v2 blue" href="'.$url .'">
                        <div class="visual">
                         <i class="'.$menu->icon.'" aria-hidden="true"></i>
                        </div>
                        <div class="details">
                           <div><a href="'.$url .'" class="desc">'.$menu->name.'</a></div>
                        </div>
                    </a>
                 </div>
            </div>';

          if(in_array("1", $module_data) && $menu->name == 'SALES'){

             echo $string ;
           }elseif(in_array("2", $module_data) && $menu->name == 'LABOR'){
             echo $string ;
           }elseif($menu->name == 'SUPPLY ORDER'){
             echo $string ;
           }elseif($menu->name == 'CUSTOMER PROBLEM REPORTS'){
             echo $string ;
           }elseif( $menu->name == 'CLAIM FORM'){
             echo $string ;
           }elseif( $menu->name == 'CUSTOMER COMMUNICATIONS'){
             echo $string ;
           }elseif( $menu->name == 'PAYROLL EMPLOYEE HISTORY'){
             echo $string ;
           }
           elseif(in_array("2", $module_data) && $menu->name == 'REPORTS AND ANALYTICS'){
             echo $string ;
           }elseif(Auth::user()->role == 'Owner' && $menu->name == 'SETTINGS'){
             echo $string ;
           }

          }?>













    </div>
</div>
</section>


@if(Session::has('message'))

        @if(Session::get('message') === 0)
        @else
            <div id="confirmpopup" class="modal fade import-csv" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Notification</h4>
                  </div>
                  <div class="modal-body" id="getData">
                    {{ Session::get('message') }}
                  </div>
                  <div class="modal-footer">
                       {{ link_to_route('service.index','Read More...',null,['class' => 'y-btn y-btn-primary outline']) }}
                  </div>
                </div>
              </div>
            </div>
             <script type="text/javascript">
            $(document).ready(function(){
                $('#confirmpopup').modal('show');
            });
            </script>
        @endif

        @endif



@endsection
