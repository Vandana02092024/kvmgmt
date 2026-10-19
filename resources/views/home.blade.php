@extends('layouts.layout')

@section('content')
@php
    $user = Auth::user();
    $moduleData = explode(',', (string) $user->module_access);
    $dashboardStoreCode = (string) session()->get('locationCode');
    $dashboardStoreDigits = preg_replace('/\D+/', '', $dashboardStoreCode);
    $dashboardStoreBadge = $dashboardIsCompany ? 'ALL' : (strlen($dashboardStoreDigits) >= 3 ? substr($dashboardStoreDigits, -3) : ($dashboardStoreCode ?: 'KV'));
    $maxDailySales = 0;
    foreach ($dashboardDailySales as $daySales) $maxDailySales = max($maxDailySales, $daySales['amount']);
    $maxCategoryRevenue = 0;
    foreach ($dashboardCategoryRevenue as $category) $maxCategoryRevenue = max($maxCategoryRevenue, $category->amount);
    $maxPayroll = 0;
    foreach ($dashboardPayrollHistory as $payrollWeek) $maxPayroll = max($maxPayroll, $payrollWeek->total_amount);
@endphp

<section id="dashboard-page" class="wrap kv-dashboard">
    <div class="container">
        <div class="kv-dashboard-context">
            <div class="kv-store-identity">
                <span class="kv-store-badge">{{ $dashboardStoreBadge }}</span>
                <div>
                    <h1>{{ $dashboardIsCompany ? 'Company Dashboard' : (session()->get('locationName') ?: 'Store Dashboard') }} @if($dashboardIsCompany)<small>ALL LOCATIONS</small>@elseif($dashboardLocationCount == 1)<small>{{ $dashboardStoreCode }}</small><span class="kv-store-active"><i class="fa fa-check-circle"></i>Active Store</span>@endif</h1>
                    <p>{{ $dashboardIsCompany ? 'Company-wide sales pace, labor, and store operations' : 'Franchise Entity: '.(session()->get('entityName') ?: 'KV Management LLC') }} <span>·</span> {{ $dashboardLocationCount }} location{{ $dashboardLocationCount == 1 ? '' : 's' }}</p>
                </div>
            </div>
            <div class="kv-dashboard-tools">
                <span class="kv-period-chip"><i class="fa fa-calendar"></i> Calendar Week <strong>{{ $dashboardCalendarWeek }}</strong></span>
                @if(!$dashboardIsCompany && $dashboardLocationCount == 1 && $dashboardStoreWeek)
                    <span class="kv-period-chip kv-period-store"><i class="fa fa-calendar-check-o"></i> Store Week <strong>{{ $dashboardStoreWeek }}</strong></span>
                @endif
                <span class="kv-period-date">{{ date('m-d-Y', strtotime($dashboardWeekStart)) }} – {{ date('m-d-Y', strtotime($dashboardWeekEnd)) }}</span>
            </div>
        </div>

        <div class="kv-kpi-grid">
            <article class="kv-kpi-card kv-kpi-sales">
                <div class="kv-kpi-top"><span>Weekly Gross Sales</span><i class="fa fa-usd"></i></div>
                <strong>${{ number_format($dashboardGrossSales, 2) }}</strong>
                <small>{{ date('M j', strtotime($dashboardWeekStart)) }} – {{ date('M j, Y', strtotime($dashboardWeekEnd)) }}</small>
            </article>
            <article class="kv-kpi-card kv-kpi-labor">
                <div class="kv-kpi-top"><span>Labor Ratio</span><i class="fa fa-users"></i></div>
                <strong>{{ number_format($dashboardLaborRatio, 1) }}%</strong>
                <small>${{ number_format($dashboardLaborTotal, 2) }} recorded labor cost</small>
            </article>
            <article class="kv-kpi-card kv-kpi-problems">
                <div class="kv-kpi-top"><span>Open Problem Tickets</span><i class="fa fa-exclamation-triangle"></i></div>
                <strong>{{ number_format($dashboardOpenProblems) }}</strong>
                <small>Not resolved</small>
            </article>
            <article class="kv-kpi-card kv-kpi-claims">
                <div class="kv-kpi-top"><span>Pending Claims</span><i class="fa fa-file-text-o"></i></div>
                <strong>{{ number_format($dashboardPendingClaims) }}</strong>
                <small>Awaiting next action</small>
            </article>
        </div>

        <div class="kv-dashboard-chart-grid">
            <article class="kv-dashboard-panel kv-daily-panel">
                <div class="kv-panel-heading"><div><h2>Daily Revenue Pace &amp; Intake</h2><p>Sales entered during the Saturday–Friday cycle</p></div><span class="kv-live-tag">Week {{ $dashboardCalendarWeek }}</span></div>
                <div class="kv-bar-chart" aria-label="Daily gross sales chart">
                    @foreach($dashboardDailySales as $daySales)
                        @php $barHeight = $maxDailySales > 0 ? max(5, ($daySales['amount'] / $maxDailySales) * 100) : 5; @endphp
                        <div class="kv-bar-column" title="{{ $daySales['label'] }}: ${{ number_format($daySales['amount'], 2) }}">
                            <span class="kv-bar-value">${{ number_format($daySales['amount'], 0) }}</span>
                            <div class="kv-bar-track"><span style="height: {{ $barHeight }}%"></span></div>
                            <small>{{ $daySales['label'] }}</small>
                        </div>
                    @endforeach
                </div>
                <div class="kv-chart-foot"><span>Weekly total <strong>${{ number_format($dashboardGrossSales, 2) }}</strong></span><span class="kv-chart-foot-status"><i class="fa fa-check-circle"></i> All assigned locations</span></div>
            </article>

            <article class="kv-dashboard-panel kv-category-panel">
                <div class="kv-panel-heading"><div><h2>Category Revenue</h2><p>Sales categories this week</p></div></div>
                @if(count($dashboardCategoryRevenue))
                    <div class="kv-category-list">
                        @foreach($dashboardCategoryRevenue as $category)
                            @php $categoryWidth = $maxCategoryRevenue > 0 ? max(4, ($category->amount / $maxCategoryRevenue) * 100) : 0; @endphp
                            <div class="kv-category-row"><div><span>{{ $category->name }}</span><strong>${{ number_format($category->amount, 2) }}</strong></div><div class="kv-category-track"><span style="width: {{ $categoryWidth }}%"></span></div></div>
                        @endforeach
                    </div>
                @else
                    <div class="kv-empty-chart"><i class="fa fa-pie-chart"></i><span>No sales categories recorded for this week.</span></div>
                @endif
                <a class="kv-panel-link" href="{{ url('/salesection') }}">View weekly sales <i class="fa fa-arrow-right"></i></a>
            </article>

            <article class="kv-dashboard-panel kv-payroll-panel">
                <div class="kv-panel-heading"><div><h2>Weekly Payroll</h2><p>Recent labor report totals</p></div><span class="kv-chart-icon"><i class="fa fa-bar-chart"></i></span></div>
                @if(count($dashboardPayrollHistory))
                    <div class="kv-payroll-chart" aria-label="Recent recorded labor totals">
                        @foreach($dashboardPayrollHistory as $payrollWeek)
                            @php $payrollHeight = $maxPayroll > 0 ? max(5, ($payrollWeek->total_amount / $maxPayroll) * 100) : 5; @endphp
                            <div class="kv-payroll-column" title="Week {{ $payrollWeek->start_week }}–{{ $payrollWeek->end_week }}: ${{ number_format($payrollWeek->total_amount, 2) }}"><span style="height: {{ $payrollHeight }}%"></span><small>{{ $payrollWeek->start_week }}</small></div>
                        @endforeach
                    </div>
                @else
                    <div class="kv-empty-chart"><i class="fa fa-users"></i><span>No labor reports recorded yet.</span></div>
                @endif
                <a class="kv-panel-link" href="{{ url('/laboursection') }}">View labor reports <i class="fa fa-arrow-right"></i></a>
            </article>
        </div>

        @if($dashboardIsCompany)
            <article class="kv-dashboard-panel kv-location-directory">
                <div class="kv-panel-heading">
                    <div><h2>Franchise Locations</h2><p>Select a store to switch the workspace to that location.</p></div>
                    <span class="kv-live-tag">{{ $dashboardLocationCount }} LOCATIONS</span>
                </div>
                <div class="table-responsive">
                    <table class="table kv-location-table">
                        <thead><tr><th>RANK</th><th>LOCATION</th><th>LOCATION CODE</th><th>WORKSPACE</th></tr></thead>
                        <tbody>
                        @foreach($dashboardLocations as $location)
                            <tr>
                                <td><span class="kv-location-rank">{{ $location->rank ?: $loop->iteration }}</span></td>
                                <td><strong>{{ $location->location }}</strong></td>
                                <td><span class="kv-location-code">{{ $location->location_code }}</span></td>
                                <td><form method="POST" action="{{ url('/setlocation') }}?dashboard=1">{{ csrf_field() }}<input type="hidden" name="location" value="{{ $location->id }}"><button type="submit" class="kv-location-open">Open Dashboard <i class="fa fa-arrow-right"></i></button></form></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </article>
        @endif

        @unless($dashboardIsCompany)
        <div class="kv-operations-heading">
            <div><h2>Store Operations Menu</h2><p>Direct access to workflows. Use the location selector above to choose a store.</p></div>
            @if(in_array('1', $moduleData))<a class="v-btn v-btn-primary" href="{{ url('/salesection/create') }}"><i class="fa fa-plus"></i> Enter Weekly Sales</a>@endif
        </div>

        <div class="kv-module-grid" ng-controller="stats">
            @foreach($menus as $menu)
                @php
                    $showMenu = false;
                    if (in_array('1', $moduleData) && $menu->name == 'SALES') $showMenu = true;
                    elseif (in_array('2', $moduleData) && $menu->name == 'LABOR') $showMenu = true;
                    elseif ($menu->name == 'SUPPLY ORDER') $showMenu = true;
                    elseif ($menu->name == 'CUSTOMER PROBLEM REPORTS') $showMenu = true;
                    elseif ($menu->name == 'CLAIM FORM') $showMenu = true;
                    elseif ($menu->name == 'CUSTOMER COMMUNICATIONS') $showMenu = true;
                    elseif ($menu->name == 'PAYROLL EMPLOYEE HISTORY') $showMenu = true;
                    elseif (in_array('2', $moduleData) && $menu->name == 'REPORTS AND ANALYTICS') $showMenu = true;
                    elseif ($user->role == 'Owner' && $menu->name == 'SETTINGS') $showMenu = true;
                @endphp
                @if($showMenu)
                    <a class="kv-module-card" href="{{ url('/'.$menu->route) }}">
                        <span class="kv-module-icon"><i class="{{ $menu->icon }}" aria-hidden="true"></i></span>
                        <span class="kv-module-copy"><strong>{{ $menu->name }}</strong><small>Open module <i class="fa fa-arrow-right"></i></small></span>
                    </a>
                @endif
            @endforeach
        </div>
        @endunless

        @unless($dashboardIsCompany)
        <div class="kv-dashboard-lower-grid">
            <article class="kv-dashboard-panel kv-list-panel">
                <div class="kv-panel-heading"><div><h2>Recent Customer Problem Reports</h2><p>Latest store reports and customer follow-up.</p></div><a href="{{ url('/report') }}">View all</a></div>
                @if(count($dashboardRecentProblems))
                    <div class="kv-recent-list">
                        @foreach($dashboardRecentProblems as $problem)
                            <a class="kv-recent-row" href="{{ url('/report') }}">
                                <span class="kv-recent-id">PR-{{ $problem->locationCode }}-{{ str_pad($problem->id, 4, '0', STR_PAD_LEFT) }}</span>
                                <span class="kv-recent-main"><strong>{{ trim($problem->customer_name.' '.$problem->customer_last_name) ?: 'Customer report' }}</strong><small>{{ $problem->problem }}</small></span>
                                <span class="kv-recent-meta"><b class="kv-status-pill">{{ $problem->locationName }} · {{ $problem->status ?: 'Open' }}</b><small>{{ date('M j, Y', strtotime($problem->filled_date ?: $problem->created_at)) }}</small></span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="kv-empty-list">No customer problem reports for this location.</div>
                @endif
            </article>

            <article class="kv-dashboard-panel kv-list-panel">
                <div class="kv-panel-heading"><div><h2>Weekly Sales History</h2><p>Saturday to Friday revenue records.</p></div><a href="{{ url('/salesection') }}">View all</a></div>
                @if(count($dashboardSalesHistory))
                    <div class="kv-recent-list kv-sales-history-list">
                        @foreach($dashboardSalesHistory as $salesWeek)
                            <a class="kv-recent-row" href="{{ url('/salesection') }}">
                                <span class="kv-recent-id">Wk #{{ $salesWeek->storeNo }}</span>
                                <span class="kv-recent-main"><strong>{{ $salesWeek->locationName }} · Store week {{ $salesWeek->storeNo }}</strong><small>Updated {{ date('M j, Y', strtotime($salesWeek->dataDate)) }}</small></span>
                                <span class="kv-recent-meta"><strong>${{ number_format($salesWeek->amount, 2) }}</strong><small>Gross sales</small></span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="kv-empty-list">No weekly sales reports have been entered yet.</div>
                @endif
            </article>
        </div>
        @endunless

        <footer class="kv-dashboard-footer"><span>KV MANAGEMENT LLC · Dry Cleaning Franchise Operations</span><span>Saturday to Friday reporting · {{ $dashboardLocationCount }} assigned locations</span></footer>
    </div>
</section>

@if(Session::has('message') && Session::get('message') !== 0)
    <div id="confirmpopup" class="modal fade import-csv" role="dialog">
        <div class="modal-dialog"><div class="modal-content">
            <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Notification</h4></div>
            <div class="modal-body" id="getData">{{ Session::get('message') }}</div>
            <div class="modal-footer">{{ link_to_route('service.index', 'Read More...', null, ['class' => 'y-btn y-btn-primary outline']) }}</div>
        </div></div>
    </div>
    <script>$(function () { $('#confirmpopup').modal('show'); });</script>
@endif
@endsection
