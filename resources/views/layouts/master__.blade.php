
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Simplest Bulk SMS API">
    <meta name="author" content="shegunbabs">
    <link rel="icon" href="../../favicon.ico">

    <title>simple SMS API | Bismsoft</title>

    @section('head')
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @show
  </head>

  <body>

  <!-- Modal -->
  <!-- Modal -->
<div class="modal2 fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body">
        <h3>Welcome</h3>
        <p>Join the winning team</p>
        <div class="loginForm">

        {!! Form::open(['url'=>'register','method'=>'POST','id'=>'_registerFormModal','autocomplete'=>'off']) !!}
          <div class="form-group">
            {!! Form::text('username','',['id'=>'username','class'=>'form-control','placeholder' => 'Username']) !!}
          </div>
          <div class="form-group">
            {!! Form::text('email','',['id'=>'email','class'=>'form-control','placeholder' => 'Email']) !!}
          </div>
          <div class="form-group">
            {!! Form::password('password',['id'=>'password','class'=>'form-control','placeholder' => 'password']) !!}
          </div>
          <div class="form-group">
            {!! Form::password('password_confirmation',['id'=>'password_confirmation','class'=>'form-control','placeholder' => 'Password Again']) !!}
          </div>
          <div class="last">
            <div id="loading" style="display:none;">&nbsp;</div>
            <button type="button" class="btn btn-primary" id="register">Register</button>
          </div>
          {!! Form::close() !!}
        </div>

        <div id="modal-errors">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>

    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Download</a></li>
            <li><a href="#">Product</a></li>
            <li><a href="#">Support</a></li>
            <li><a href="#" data-toggle="modal" data-target="#exampleModal">Sign In</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Navbar example</h1>
        <p>This example is a quick exercise to illustrate how the default, static and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
        <p>To see the difference between static and fixed top navbars, just scroll.</p>
        <p>
          <a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">View navbar docs &raquo;</a>
        </p>
      </div>

    </div> <!-- /container -->



    @section('foot')
    <script src="/js/jquery/jquery-latest.js"></script>
    <script src="/js/bootstrap/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript">
    $(function(){

        var formEl = {};

      $('.modal2 #register').click(function(){

        formEl.username = $('input[name=username]').val();
        formEl.email =  $('input[name=email]').val();
        formEl.password = $('input[name=password]').val();
        formEl.password_confirmation = $('input[name=password_confirmation]').val();

        $.ajax({
          url: 'register',
          type: 'POST',
          data: {
            'email': formEl.email,
            '_token':$('input[name=_token]').val(),
            'username': formEl.username,
            'password': formEl.password,
            'password_confirmation': formEl.password_confirmation},
          success: processSuccess,
          error: processError
        });


        function processSuccess(data)
        {
            $data = JSON.parse(data);
            if ($data.success == true)
                $( location ).prop('pathname', 'auth/login');
        }

        function processError(jqXhr)
        {
            //redirect on authentication error
            if ( jqXhr.status === 401 )
                $( location ).prop('pathname', 'auth/login');

            //lets handle validation error here
            if ( jqXhr.status === 422 )
            {
                //get response data
                $errors = jqXhr.responseJSON;

                errorsHtml = '<div class="alert alert-danger"><ul>';
                $.each( $errors, function(key, value){
                    errorsHtml += '<li>' + value[0] + '</li>';
                } );
                errorsHtml += '</ul></div>';

                $('#modal-errors').html(errorsHtml);
            }
        }
      });
    });

    $(document).ajaxStart(function(){
        $("#loading").css("display", "block");
    });

    $(document).ajaxComplete(function(){
        $("#loading").css("display", "none");
    });
    </script>
    @show
  </body>
</html>
