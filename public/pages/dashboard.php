<section id="sitemap" class="sitemap">

	<div class="container-fluid">

		<div class="row">

			<div class="col-sm-12">

				<ul class="breadcrumb">

				    <li><a href="#">Home</a></li>

				    <li class="active">Dashboard</li>

				</ul>

			</div>

		</div>

	</div>

</section>

<section id="dashboard-page" class="wrap">

	<div class="container-fluid">

		<div class="row">

			<div class="col-sm-6">

				<div class="page-heading">

					<!--<h3 class="heading">Hi <span class="text-red">Varun,</span> Welcome back <span class="block text-xs text-light">Quick Analytic view</span></h3>-->
					<h3 class="heading">Quick Analytic view</h3>

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

		<div class="row" ng-controller="stats">

			<div class="col-sm-6 col-md-3" ng-repeat="x in stats">

				<div class="widget stats bg-white relative">

					<ul class="widget-ctrl inline">

						<li><span><i class="fa fa-refresh"></i></span></li>

					</ul>

					<span class="icon icon-sm radius-50 stats-icon {{x.bgColor}}"><i class="fa {{x.icon}} text-white"></i></span>

					<h4 class="title"><span class="block uppercase text-light">{{x.title}}</span>{{x.total}}</h4>

				</div>

			</div>

		</div>

	</div>

</section>







<script type="text/javascript">

    $(function() {

        /** This code runs when everything has been loaded on the page */

        /* Inline sparklines take their values from the widget-contents of the tag */

        $('.inlinesparkline').sparkline(); 



        /* Sparklines can also take their values from the first argument 

        passed to the sparkline() function */

        var myvalues = [10,8,5,7,4,4,1];

        $('.dynamicsparkline').sparkline(myvalues);



        /* The second argument gives options such as chart type */

        $('.dynamicbar').sparkline(myvalues, {type: 'bar', barColor: 'green'} );



        /* Use 'html' instead of an array of values to pass options 

        to a sparkline with data in the tag */

        $('.inlinebar').sparkline('html', {type: 'bar', barColor: 'red'} );

    });

</script>



