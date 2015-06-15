<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mobilise Bulk SMS</title>
        @section('head')
        <link type="text/css" href="/code/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="/code/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="/code/css/theme.css" rel="stylesheet">
        <link type="text/css" href="/code/css/style.css" rel="stylesheet">
        <link type="text/css" href="/code/images/icons/css/font-awesome.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
        @show
        	<!--[if lt IE 9]>
        		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        	<![endif]-->
    </head>
    <body>
        @include('layouts.partials._navbar')
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    @include('layouts.partials._sidebar')
                    <div class="span9">
                        <div class="content">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
                <b class="copyright">&copy; <?php echo date("Y", time());?> Mobilise - Bulk-SMS </b>All rights reserved.
            </div>
        </div>
        @section('foot')
        <script src="/code/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="/code/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="/code/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/code/scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="/code/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="/code/scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script>$('#flash-overlay-modal').modal();</script>
        @show
        <script src="/code/scripts/common.js" type="text/javascript"></script>
    </body>
</html>