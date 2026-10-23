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

<script>
(function () {
    function getBackControl(target) {
        var control = target.closest('a, button, input[type="button"], input[type="submit"]');
        if (!control) return null;
        var label = (control.innerText || control.value || control.getAttribute('aria-label') || '')
            .replace(/\s+/g, ' ').trim().toLowerCase();
        return /^back(?:\b|$)/.test(label) ? control : null;
    }

    document.querySelectorAll('a, button, input[type="button"], input[type="submit"]').forEach(function (control) {
        var label = (control.innerText || control.value || control.getAttribute('aria-label') || '')
            .replace(/\s+/g, ' ').trim().toLowerCase();
        if (/^back(?:\b|$)/.test(label)) control.classList.add('kv-global-back');
    });

    document.addEventListener('click', function (event) {
        var control = getBackControl(event.target);
        if (!control || event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
        if (control.tagName === 'A' && control.target && control.target !== '_self') return;

        if (window.history.length > 1) {
            event.preventDefault();
            window.history.back();
        }
    });
}());
</script>


</body>
</html>
