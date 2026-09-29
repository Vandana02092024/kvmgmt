<!DOCTYPE html>
<html>
<head>
	@include('layouts.header.header')
</head>
<body ng-app="ng-dashboard">
    @if(session()->has('location_id'))
        @if(session()->get('location_id') == 0)
            @yield('content')
        @else
            @if (Auth::guest())
                @yield('content')
            @else
                @include('layouts.header.topnav')
                <div class="main-content">
                   @php /* @include('layouts.sidebar.sidebar') */ @endphp
                    @yield('content')
                </div>
            @endif
        @endif
    @else
        @yield('content')
    @endif
@if((Request::segment(1)!='product') ||(Request::segment(1)=='product' && Request::segment(2)=='create' ) )
<script>
localStorage.removeItem("DataTables_example_/kvmgmt/product");
</script>
@endif


</body>
</html>
