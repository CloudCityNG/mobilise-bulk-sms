<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{!! !empty($page_title) ? $page_title : "Quic SMS" !!}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Google webfont -->
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
    <!-- FontAwesome css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Core bootstrap -->
    <link rel="stylesheet" href="/kanda/css/bootstrap.min.css">
    <!-- Kanda's extended style -->
    <link rel="stylesheet" href="/kanda/css/startup.css">
    <link rel="stylesheet" href="/kanda/css/extended.min.css">
    <link rel="stylesheet" href="/kanda/css/extra.css">
    <link rel="stylesheet" href="/assets/semanticui/semantic.min.css">
    <!-- Modernizr -->
    <!--[if IE 8]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <![endif]-->
</head>
<body>

    <div id="startup-page">

            <!-- header -->
                  <div id="header">
                    <div class="container">
                      <!-- navbar -->
                            @include('layouts.kanda.partials.nav')
                      <!-- /navbar -->

                    </div>
                  </div>
                  <!-- /header -->

          <!-- main -->
          <div id="main">
            <div class="container">

                <div class="row" style="margin-top: 20px;">

                    <div class="col-sm-5">
                        @include('layouts.kanda.partials.sidebar')
                    </div>

                    <div class="col-sm-7">
                        <img src="http://www.placehold.it/400x200/FFFFFF/666666" class="img-responsive">
                    </div>
                </div>

              <!-- features -->
              <div class="row">
                <div class="col-sm-4">
                  <div class="feature-item">
                    <i class="fa fa-desktop fa-fw text-orange feature-icon"></i>
                    <h3 class="feature-title">Fully Responsive</h3>
                    <p class="feature-text">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt nobis sunt accusamus mollitia fuga dolor suscipit quisquam nemo in, sint adipisci et quaerat consequuntur repellat.
                    </p>
                  </div>
                </div>
                <!-- col -->
                <div class="col-sm-4">
                  <div class="feature-item">
                    <i class="fa fa-dashboard fa-fw text-orange feature-icon"></i>
                    <h3 class="feature-title">Rich Extensions</h3>
                    <p class="feature-text">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt nobis sunt accusamus mollitia fuga dolor suscipit quisquam nemo in, sint adipisci et quaerat consequuntur repellat.
                    </p>
                  </div>
                </div>
                <!-- col -->
                <div class="col-sm-4">
                  <div class="feature-item">
                    <i class="fa fa-cubes fa-fw text-orange feature-icon"></i>
                    <h3 class="feature-title">Design Quality</h3>
                    <p class="feature-text">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt nobis sunt accusamus mollitia fuga dolor suscipit quisquam nemo in, sint adipisci et quaerat consequuntur repellat.
                    </p>
                  </div>
                </div>
                <!-- col -->
              </div>
              <!-- features -->

              <!-- clients -->
              <div class="row">
                <div class="col-sm-12">
                  <div class="page-header">
                    <h2 class="text-center">Our lovely Clients</h2>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-6 col-md-3">
                  <a href="#" class="thumbnail">
                    <img src="http://www.placehold.it/400x200/FFFFFF/666666" class="img-responsive">
                  </a>
                </div>
                <!-- thumbnail -->
                <div class="col-xs-6 col-md-3">
                  <a href="#" class="thumbnail">
                    <img src="http://www.placehold.it/400x200/FFFFFF/666666" class="img-responsive">
                  </a>
                </div>
                <!-- thumbnail -->
                <div class="col-xs-6 col-md-3">
                  <a href="#" class="thumbnail">
                    <img src="http://www.placehold.it/400x200/FFFFFF/666666" class="img-responsive">
                  </a>
                </div>
                <!-- thumbnail -->
                <div class="col-xs-6 col-md-3">
                  <a href="#" class="thumbnail">
                    <img src="http://www.placehold.it/400x200/FFFFFF/666666" class="img-responsive">
                  </a>
                </div>
                <!-- thumbnail -->
                <div class="col-xs-6 col-md-3">
                  <a href="#" class="thumbnail">
                    <img src="http://www.placehold.it/400x200/FFFFFF/666666" class="img-responsive">
                  </a>
                </div>
                <!-- thumbnail -->
                <div class="col-xs-6 col-md-3">
                  <a href="#" class="thumbnail">
                    <img src="http://www.placehold.it/400x200/FFFFFF/666666" class="img-responsive">
                  </a>
                </div>
                <!-- thumbnail -->
                <div class="col-xs-6 col-md-3">
                  <a href="#" class="thumbnail">
                    <img src="http://www.placehold.it/400x200/FFFFFF/666666" class="img-responsive">
                  </a>
                </div>
                <!-- thumbnail -->
                <div class="col-xs-6 col-md-3">
                  <a href="#" class="thumbnail">
                    <img src="http://www.placehold.it/400x200/FFFFFF/666666" class="img-responsive">
                  </a>
                </div>
                <!-- thumbnail -->
              </div>
              <!-- /clients -->

            </div>
          </div>

          <!-- pricing -->
          <div id="pricing">
            <div class="container">
              <div class="row">
                <div class="col-sm-5">
                  <img src="https://dl.dropboxusercontent.com/u/36017898/photo/starter-1.png" class="img-responsive" />
                </div>
                <!-- col -->
                <div class="col-sm-7">
                  <h3 class="pricing-title">Just only 29$ per user</h3>
                  <p class="pricing-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, tempora incidunt. Sit iste ea reiciendis minus eos placeat eum ex voluptate tempora.</p>
                  <p>
                    <a href="#" class="btn btn-orange">Open an account</a>
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- About -->
          <div id="about">
            <div class="container">

              <div class="row" id="starter-slider">
                <div class="col-sm-12">
                  <!-- Carousel -->
                  <div id="aboutSlider" class="owl-carousel">
                    <div class="items"><img src="https://dl.dropboxusercontent.com/u/36017898/photo/slider-1.jpg" /></div>
                    <div class="items"><img src="https://dl.dropboxusercontent.com/u/36017898/photo/slider-2.jpg" /></div>
                    <div class="items"><img src="https://dl.dropboxusercontent.com/u/36017898/photo/slider-3.jpg" /></div>
                  </div>
                  <!-- /Carousel -->
                </div>
              </div>

              <div class="row">
                <div class="col-sm-7">
                  <h3 class="about-title">JindaTheme Coperation</h3>
                  <address>
                    <small>2973 Moo7 Bangkok, Thailand 11120</small>
                  </address>
                  <p class="about-text">
                    The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ in their grammar, their pronunciation and their most common words. Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words. If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages.
                  </p>
                </div>
                <!-- col -->
                <div class="col-sm-5">
                  <a href="#" class="thumbnail">
                    <img src="https://dl.dropboxusercontent.com/u/36017898/photo/google-map.jpg" class="img-responsive" />
                  </a>
                </div>
              </div>

            </div>
          </div>

          <!-- Contact -->
          <div id="contact">
            <div class="container">

              <div class="row">
                <div class="col-sm-6">
                  <h4>Feel free to contact us</h4>
                  <blockquote>
                    <small>example@example.com</small>
                  </blockquote>
                  <a href="#" class="contact-facebook"><i class="fa fa-facebook-square fa-fw"></i></a>
                  <a href="#" class="contact-twitter"><i class="fa fa-twitter-square fa-fw"></i></a>
                  <a href="#" class="contact-gplus"><i class="fa fa-google-plus-square fa-fw"></i></a>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took..</p>
                </div>
                <!-- col -->
                <div class="col-sm-6">
                  <h6>How do i create a new page?</h6>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum qui officiis, accusamus ad mollitia molestias maiores. Repellat suscipit earum, natus expedita, sapiente atque..</p>
                  <h6>What payment types do you accept?</h6>
                  <p>We accept payments from MasterCard, Visa, Visa Debit and American Express. We do not accept PayPal. Remember, you do not need to supply card details to start your free trial.</p>
                </div>
              </div>

            </div>
          </div>

          <!-- footer -->
          <div id="footer">
            <div class="container">
              <div class="row">
                <div class="col-sm-12 text-center">
                  <p class="footer-text">Copyright 2014 © Your Company Name.</p>
                </div>
              </div>
            </div>
          </div>

        </div>

    <!-- jQuery -->
    <script src="/js/jquery/jquery-latest.js"></script>
    <script src="/assets/semanticui/semantic.min.js"></script>
    <!-- Core Bootstrap -->
    <script src="/kanda/js/bootstrap.min.js"></script>
    <!-- Kanda's extended script -->
    <script src="/kanda/js/extended.min.js"></script>

    <script>
    // initialize Kanda extended script
    extended = new Extended();
    </script>
</body>
</html>