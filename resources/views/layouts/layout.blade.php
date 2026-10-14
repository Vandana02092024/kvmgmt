<!DOCTYPE html>
<html>
<head>
	@include('layouts.header.header')
</head>
<body ng-app="ng-dashboard" class="{{ Auth::guest() ? 'kv-auth-body' : 'kv-app-body kv-section-'.Request::segment(1).(in_array(Request::segment(1), ['dashboard', 'salesection', 'laboursection']) ? '' : ' kv-module-screen') }}">
    @if (Auth::guest())
        @yield('content')
    @else
        @include('layouts.header.topnav')
        <div class="main-content">
           @php /* @include('layouts.sidebar.sidebar') */ @endphp
            @yield('content')
        </div>
    @endif
@if((Request::segment(1)!='product') ||(Request::segment(1)=='product' && Request::segment(2)=='create' ) )
<script>
localStorage.removeItem("DataTables_example_/kvmgmt/product");
</script>
@endif


</body>
</html>
