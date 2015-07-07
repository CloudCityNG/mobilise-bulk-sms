<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>New user Registration</title>
	<link type="text/css" href="/code/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="/code/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="/code/css/theme.css" rel="stylesheet">
	<link type="text/css" href="/code/images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>
    @include('layouts.partials._navbarlogin')

    @include('flash::message')

	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
				    {!! Form::open(['url'=>'user/register', 'method'=>'post', 'class'=>'form-vertical', 'autocomplete'=>'off', 'id'=>'loginForm']) !!}
						<div class="module-head">
							<h3>New User Registeration</h3>
						</div>
						<div class="module-body">
							<div class="control-group">
								<div class="controls row-fluid">
								{!! Form::text('username', Input::old('username'), ['class'=>'span12','placeholder'=>'Username','required']) !!}
								</div>
							</div>
							<div class="control-group">
                                <div class="controls row-fluid">
                                {!! Form::email('email', Input::old('email'), ['class'=>'span12 email','placeholder'=>'Email','required']) !!}
                                </div>
                            </div>
							<div class="control-group">
								<div class="controls row-fluid">
								{!! Form::password('password', ['class'=>'span12 password','placeholder'=>'Password','required']) !!}
								</div>
							</div>
							<div class="control-group">
                                <div class="controls row-fluid">
                                {!! Form::password('password_confirmation', ['class'=>'span12 password','placeholder'=>'Password Again','required']) !!}
                                </div>
                            </div>
						</div>

						@include('layouts.partials._errors', ['error_header'=>"Form Error(s)"])

						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" class="btn btn-primary">Register Me</button>
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div><!--/.wrapper-->

	<div class="footer">
		<div class="container">
			<b class="copyright">&copy; <?php echo date("Y", time());?> Mobilise - Bulk-SMS </b>All rights reserved.
		</div>
	</div>
	<script src="/code/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="/code/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="/code/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script>$('#flash-overlay-modal').modal();</script>
	<script>
	$(document).ready(function(){

	});
	</script>
</body>