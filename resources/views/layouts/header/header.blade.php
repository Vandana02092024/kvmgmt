<title>KV Management LLC2</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=0">


<!-- fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
{!!Html::style('css/font-awesome.min.css?v='.time(), array(), true)!!}

<!-- css -->
{!!Html::style('css/bootstrap.min.css?v='.time(), array(), true)!!}

<!-- plugins css-->
{!!Html::style('plugins/datatable/dataTables.bootstrap.min.css?v='.time(), array(), true)!!}
{!!Html::style('plugins/datepicker/jquery-ui.css?v='.time(), array(), true)!!}

<!-- custom css-->
{!!Html::style('css/layout.css?v='.time(), array(), true)!!}
{!!Html::style('css/custom.css?v='.time(), array(), true)!!}
{!!Html::style('css/responsive.css?v='.time(), array(), true)!!}

<!-- js -->	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
{!!Html::script('js/bootstrap.min.js', array(), true)!!}


<!-- plugins Js-->
{!!Html::script('plugins/datatable/jquery.dataTables.min.js', array(), true)!!}
{!!Html::script('plugins/datatable/dataTables.bootstrap.min.js', array(), true)!!}
{!!Html::script('plugins/datepicker/jquery-ui.js', array(), true)!!}
{!!Html::script('js/custom.js', array(), true)!!}
{!!Html::script('js/jquery.inputmask.min.js', array(), true)!!}



<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//// window close //////
$(window).unload(function() { 
 window.location = 'https://kvmgmt.com/logout/';
});



</script>