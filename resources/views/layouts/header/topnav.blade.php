@php
    $currentSection = Request::segment(1);
    $user = Auth::user();
    $moduleAccess = explode(',', (string) $user->module_access);
    $navigation = [
        ['label' => 'Dashboard', 'icon' => 'fa-th-large', 'url' => url('/dashboard'), 'sections' => ['dashboard']],
        ['label' => 'Weekly Sales', 'icon' => 'fa-usd', 'url' => url('/salesection'), 'sections' => ['salesection']],
        ['label' => 'Labor Reports', 'icon' => 'fa-users', 'url' => url('/laboursection'), 'sections' => ['laboursection', 'history']],
        ['label' => 'Supply Orders', 'icon' => 'fa-shopping-bag', 'url' => url('/order'), 'sections' => ['order']],
        ['label' => 'Problem Reports', 'icon' => 'fa-exclamation-triangle', 'url' => url('/report'), 'sections' => ['report']],
        ['label' => 'Claim Forms', 'icon' => 'fa-file-text-o', 'url' => url('/reimbursement'), 'sections' => ['reimbursement']],
        ['label' => 'Communications', 'icon' => 'fa-comment-o', 'url' => url('/service'), 'sections' => ['service']],
        ['label' => 'Payroll History', 'icon' => 'fa-history', 'url' => url('/payrollemployee'), 'sections' => ['payrollemployee']],
        ['label' => 'Reports & Analytics', 'icon' => 'fa-bar-chart', 'url' => url('/reportingsection'), 'sections' => ['reportingsection']],
    ];
@endphp

<header class="kv-topbar">
    <div class="kv-topbar-inner">
        <a class="kv-brand" href="{{ url('/dashboard') }}">
            <span class="kv-brand-mark">KV</span>
            <span class="kv-brand-copy">
                <strong>KV MANAGEMENT <small>LLC</small></strong>
                <span>Dry Cleaning Franchise Operations</span>
            </span>
        </a>

        <div class="kv-topbar-right">
            <form class="kv-location" method="POST" action="{{ url('/setlocation') }}" aria-label="Change current location">
                {{ csrf_field() }}
                <i class="fa fa-building-o"></i>
                <label class="sr-only" for="kvCurrentLocation">Current location</label>
                {{ Form::select('location', session()->get('all_locations', []), session()->get('location_id'), ['class' => 'kv-location-select', 'id' => 'kvCurrentLocation', 'onchange' => 'this.form.submit()']) }}
            </form>
            <div class="dropdown kv-notifications">
                <button class="kv-icon-button dropdown-toggle" type="button" id="kvNotifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Notifications">
                    <i class="fa fa-bell-o"></i>
                    @if(session()->get('total_new_csr') > 0)<span class="kv-notification-count">{{ session()->get('total_new_csr') }}</span>@endif
                </button>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="kvNotifications">
                    @if(session()->get('all_new_csr_data') != null)
                        @foreach(session()->get('all_new_csr_data') as $data)
                            @php $datafill = "Follow up with $data->customer_name on $data->followup_date by $data->followup_time"; @endphp
                            <li>{{ link_to_route('service.edit', $datafill, [$data->id]) }}</li>
                        @endforeach
                    @else
                        <li><a href="#">No notifications available.</a></li>
                    @endif
                </ul>
            </div>
            <div class="dropdown kv-user-menu">
                <button class="kv-user-button dropdown-toggle" type="button" id="kvUserMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="kv-avatar"><i class="fa fa-user"></i></span>
                    <span><strong>{{ Auth::user()->name }}</strong><small><i class="fa fa-shield"></i> {{ Auth::user()->role }}</small></span>
                    <i class="fa fa-chevron-down kv-caret"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="kvUserMenu"><li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li></ul>
            </div>
        </div>
    </div>
</header>

<nav class="kv-tabbar" aria-label="Main navigation">
    <div class="kv-tabbar-inner">
        @foreach($navigation as $item)
            @php
                $visible = true;
                if ($item['label'] == 'Weekly Sales') $visible = in_array('1', $moduleAccess);
                if ($item['label'] == 'Labor Reports' || $item['label'] == 'Reports & Analytics') $visible = in_array('2', $moduleAccess);
            @endphp
            @if($visible)
                <a class="kv-tab {{ in_array($currentSection, $item['sections']) ? 'is-active' : '' }}" href="{{ $item['url'] }}">
                    <i class="fa {{ $item['icon'] }}"></i><span>{{ $item['label'] }}</span>
                </a>
            @endif
        @endforeach
        @if(Auth::user()->role == 'Owner')
            @php $settingsSections = ['location', 'user', 'menu', 'category', 'product', 'seller', 'vendor', 'salessetting', 'sale', 'discount', 'adjustment', 'receipt', 'payrollsetting', 'payrollcategory', 'payrolldepartment', 'asign_loaction']; @endphp
            <div class="dropdown kv-settings-nav {{ in_array($currentSection, $settingsSections) ? 'is-active' : '' }}">
                <button class="kv-tab dropdown-toggle {{ in_array($currentSection, $settingsSections) ? 'is-active' : '' }}" type="button" id="kvSettingsMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog"></i><span>Settings</span><i class="fa fa-chevron-down kv-settings-caret"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-right kv-settings-menu" aria-labelledby="kvSettingsMenu">
                    <li class="kv-settings-heading">Administration</li>
                    <li class="{{ $currentSection == 'location' ? 'active' : '' }}"><a href="{{ url('/location') }}"><i class="fa fa-map-marker"></i> Locations</a></li>
                    <li class="{{ $currentSection == 'user' ? 'active' : '' }}"><a href="{{ url('/user') }}"><i class="fa fa-users"></i> Users</a></li>
                    <li class="{{ $currentSection == 'asign_loaction' ? 'active' : '' }}"><a href="{{ url('/asign_loaction') }}"><i class="fa fa-th-list"></i> Menu assignments</a></li>
                    <li class="{{ $currentSection == 'menu' ? 'active' : '' }}"><a href="{{ url('/menu') }}"><i class="fa fa-th-large"></i> Settings Overview</a></li>
                    <li class="kv-settings-heading">Catalog</li>
                    <li class="{{ $currentSection == 'category' ? 'active' : '' }}"><a href="{{ url('/category') }}"><i class="fa fa-tags"></i> Categories</a></li>
                    <li class="{{ $currentSection == 'product' ? 'active' : '' }}"><a href="{{ url('/product') }}"><i class="fa fa-cube"></i> Products</a></li>
                    <li class="{{ in_array($currentSection, ['seller', 'vendor']) ? 'active' : '' }}"><a href="{{ url('/seller') }}"><i class="fa fa-truck"></i> Vendors</a></li>
                    <li class="kv-settings-heading">Sales setup</li>
                    <li class="{{ in_array($currentSection, ['salessetting', 'sale', 'discount', 'adjustment', 'receipt']) ? 'active' : '' }}"><a href="{{ url('/salessetting') }}"><i class="fa fa-usd"></i> Sales fields</a></li>
                    <li class="kv-settings-heading">Payroll setup</li>
                    <li class="{{ $currentSection == 'payrollsetting' ? 'active' : '' }}"><a href="{{ url('/payrollsetting') }}"><i class="fa fa-sliders"></i> Payroll settings</a></li>
                    <li class="{{ $currentSection == 'payrollcategory' ? 'active' : '' }}"><a href="{{ url('/payrollcategory') }}"><i class="fa fa-list"></i> Payroll categories</a></li>
                    <li class="{{ $currentSection == 'payrolldepartment' ? 'active' : '' }}"><a href="{{ url('/payrolldepartment') }}"><i class="fa fa-sitemap"></i> Payroll departments</a></li>
                </ul>
            </div>
        @endif
    </div>
</nav>
