<!DOCTYPE html>
<html lang="en-gb" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Frontpage layout example - UIkit documentation</title>
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon.png">
        @section('head')
        <link rel="stylesheet" href="/assets/uikit/css/uikit.docs.min.css">
        <link rel="stylesheet" href="/assets/uikit/css/uikit.gradient.min.css">
        <link rel="stylesheet" href="/assets/uikit/css/components/slider.gradient.min.css">
        <link rel="stylesheet" href="/assets/css/style.css">
        @show

    </head>

    <body>
    @section('modal')
    @show

        <div class="main-div uk-container uk-container-center uk-margin-top uk-margin-large-bottom">

            <nav class="uk-navbar uk-margin-large-bottom">
                <a class="uk-navbar-brand uk-hidden-small" href="layouts_frontpage.html">Brand</a>
                <ul class="uk-navbar-nav uk-hidden-small">
                    <li class="uk-active">
                        <a href="">Home</a>
                    </li>
                    <li class="uk-parent" data-uk-dropdown>
                        <a href="">SMS Messaging <i class="uk-icon-caret-down"></i></a>
                        <div class="uk-dropdown uk-dropdown-navbar">
                            <ul class="uk-nav uk-nav-navbar">
                                <li><a href="#">Buk SMS</a></li>
                                <li class="uk-nav-header">Get Creative With SMS</li>
                                <li><a href="#">SMS Alerts</a></li>
                                <li><a href="#">SMS Reminders</a></li>
                                <li><a href="#">SMS Competitions</a></li>
                                <li><a href="#">Two factor Authentication</a></li>
                                <li><a href="#">Email To SMS</a></li>
                                <li><a href="#">Shortcode SMS</a></li>
                                <li><a href="#">Reservations and Bookings</a></li>
                                <li><a href="#">SMS Notifications</a></li>
                                <li><a href="#">International SMS</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a href="#">SMS in Industries</a></li>
                            </ul>
                        </div>

                    </li>
                    <li class="uk-parent" data-uk-dropdown>
                        <a href="">Solutions <i class="uk-icon-caret-down"></i></a>
                        <div class="uk-dropdown uk-dropdown-navbar">
                            <ul class="uk-nav uk-nav-navbar">
                                <li><a href="#">ShortCodes</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a href="#">USSD Interaction</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a href="#">Number Context</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a href="#">Dedicated Platform Hosting</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="uk-parent" data-uk-dropdown>
                        <a href="">Pricing & Coverage <i class="uk-icon-caret-down"></i></a>
                        <div class="uk-dropdown uk-dropdown-navbar">
                            <ul class="uk-nav uk-nav-navbar">
                                <li class="uk-nav-header">Local Pricing</li>
                                <li><a href="#">Messaging</a></li>
                                <li><a href="#">Shortcodes</a></li>
                                <li class="uk-nav-divider"></li>
                                <li class="uk-nav-header">International Pricing</li>
                                <li><a href="#">Messaging</a></li>
                                <li><a href="#">ShortCode</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="uk-parent" data-uk-dropdown>
                        <a href="">API <i class="uk-icon-caret-down"></i></a>
                        <div class="uk-dropdown uk-dropdown-navbar">
                            <ul class="uk-nav uk-nav-navbar">
                                <li><a href="#">REST</a></li>
                                <li><a href="#">HTTP/S</a></li>
                                <li><a href="#">XML</a></li>
                                <li><a href="#">FTP</a></li>
                                <li><a href="#">SMTP</a></li>
                                <li><a href="#">SOAP</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="uk-parent" data-uk-dropdown>
                        <a href="">Downloads & Resources <i class="uk-icon-caret-down"></i></a>
                        <div class="uk-dropdown uk-dropdown-navbar">
                            <ul class="uk-nav uk-nav-navbar">
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Product Help</a></li>
                                <li><a href="#">Guides & FAQ</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <div class="uk-navbar-content uk-navbar-flip  uk-hidden-small">
                    <div class="uk-button-group">
                        <a class="uk-button uk-button-danger" href="{{url('user/login')}}">Login >></a>
                        <a class="uk-button uk-button-primary" href="{{url('user/register')}}">Register for free</a>
                    </div>
                </div>
                <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
                <div class="uk-navbar-brand uk-navbar-center uk-visible-small">Brand</div>
            </nav>

            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-1">

                    <div class="uk-vertical-align uk-text-center" style="background: url('/images/speedlane.jpg') 50% 0 no-repeat; height: 450px;">
                        <div class="uk-vertical-align-middle uk-width-2-3 hero">
                            <h1 class="uk-heading-large large-text">High reliability mobile messaging platform</h1>
                            <p class="uk-text-large small-text">Customers and Clients can now be reached on mobiles, anytime, anywhere, anyday!</p>
                            <p>
                                <a class="uk-button uk-button-primary uk-button-large" href="#">How it works</a>
                                <a class="uk-button uk-button-large" href="#">Get started</a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <hr class="uk-grid-divider">

            <div class="uk-grid" uk-margin-large-bottom>

                <div class="uk-width-medium-1-1 uk-container-center">
                    <h1 class="uk-text-center">Companies that trusts us</h1>

                    <div class="uk-slidenav-position" data-uk-slider>
                        <div class="uk-slider-container">
                            <ul class="uk-slider uk-grid-width-medium-1-4 uk-margin-top uk-margin-bottom">
                                <li><img class="uk-vertical-align-middle" src="/images/logos/arik_.gif"></li>
                                <li><img src="/images/logos/mansard_.png"></li>
                                <li><img src="/images/logos/nb_.gif"></li>
                                <li><img src="/images/logos/png_.png"></li>
                                <li><img src="http://placehold.it/200x50"></li>
                                <li><img src="http://placehold.it/200x50"></li>
                                <li><img src="http://placehold.it/200x50"></li>
                                <li><img src="http://placehold.it/200x55"></li>
                                <li><img src="http://placehold.it/200x60"></li>
                                <li><img src="http://placehold.it/200x70"></li>
                                <li><img src="http://placehold.it/200x50"></li>
                                <li><img src="http://placehold.it/200x80"></li>
                            </ul>
                        </div>
                        <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous"></a>
                        <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next"></a>
                    </div>
                </div>
            </div>


            <div class="uk-grid uk-container-center" uk-margin-large-bottom uk-margin-large-top>
                <div class="uk-width-medium-1-3">
                    <div class="uk-panel uk-panel-box uk-panel-header uk-panel-space">
                        <h3 class="uk-panel-title box-head"><i class="uk-icon-cloud uk-icon-medium"></i> SMS Platform/Gateway</h3>
                        <p>Highly reliable & scalable future-generation SMS Gateway and Platform.</p>
                    </div>
                </div>
                <div class="uk-width-medium-1-3">
                    <div class="uk-panel uk-panel-box uk-panel-header uk-panel-space">
                        <h3 class="uk-panel-title box-head"><i class="uk-icon-envelope-square uk-icon-medium"></i> Bulk SMS</h3>
                        Send notifications, advertise and alert with our fully featured Bulk SMS.
                    </div>
                </div>
                <div class="uk-width-medium-1-3">
                    <div class="uk-panel uk-panel-box uk-panel-header uk-panel-space">
                        <h3 class="uk-panel-title box-head"><i class="uk-icon-file-text uk-icon-medium"></i> Whitepapers & guides</h3>
                        Free PDF downloads to assist customers with how to do/use mobilse messaging.
                    </div>
                </div>
            </div>
            <div class="uk-grid uk-container-center" uk-margin-large-bottom uk-margin-large-top>
                <div class="uk-width-medium-1-3">
                    <div class="uk-panel uk-panel-box uk-panel-header uk-panel-space">
                        <h3 class="uk-panel-title box-head"><i class="uk-icon-youtube-play uk-icon-medium"></i> Videos</h3>
                        <p>Highly reliable & scalable future-generation SMS Gateway and Platform.</p>
                    </div>
                </div>
                <div class="uk-width-medium-1-3">
                    <div class="uk-panel uk-panel-box uk-panel-header uk-panel-space">
                        <h3 class="uk-panel-title box-head"><i class="uk-icon-headphones uk-icon-medium"></i> Customer Support</h3>
                        Send notifications, advertise and alert with our fully featured Bulk SMS.
                    </div>
                </div>
                <div class="uk-width-medium-1-3">
                    <div class="uk-panel uk-panel-box uk-panel-header uk-panel-space">
                        <h3 class="uk-panel-title box-head"><i class="uk-icon-phone-square uk-icon-medium"></i> Contact Us</h3>
                        Free PDF downloads to assist customers with how to do/use mobilse messaging.
                    </div>
                </div>
            </div>



            <hr class="uk-grid-divider">

            <div class="uk-grid" data-uk-grid-margin>

                <div class="uk-width-medium-1-2">
                    <img width="660" height="400" src="/images/context.png" alt="">
                </div>

                <div class="uk-width-medium-1-2">
                    <h1 class="theme">Introducing Number Context</h1>
                    <p>Number Context service helps you keep your mobile number database up to date.</p>
                    <p>Active mobile subscribers often change numbers, go into roaming adn change providers while retaining their original phone number.
                        Knowing which mobile numbers are in use and available, or which network your client is currently using can greatly improve accuracy and cost effectiveness for many types of businesses.
                    </p>
                    <h2 class="theme">Pick your package</h2>
                    <p>
                        Banks, financial institutions, VoIP providers, call centres, analytics companies,
                        and others use our Number Context to clean their databases and keep them up to date.

                    </p>
                    <a class="uk-button uk-button-primary" href="#">Read more</a>
                </div>

            </div>

            <hr class="uk-grid-divider">

            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-2">
                    <h1 class="theme">Resellers are welcomed!</h1>
                    <p>Professional SMS messaging is a fast-growing branch of the telecommunications industry,
                        fuelled by the adoption of SMS by enterprises. It is also a business you can start with almost no investment,
                        offering good opportunity for profits.</p>

                    <h2 class="theme">Transparency. Functionality. Control.</h2>
                    <p>
                        Your have complete control and transparency of your operations, and the billing system is entirely under your command.
                        Our fully-featured messaging suite allows you to apply your own logo, colours, URL, and brand elements.
                    </p>
                    <a class="uk-button uk-button-primary" href="#">Button</a>
                </div>

                <div class="uk-width-medium-1-2">
                    <img width="660" height="400" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNjYwcHgiIGhlaWdodD0iNDAwcHgiIHZpZXdCb3g9IjAgMCA2NjAgNDAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA2NjAgNDAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSI2NjAiIGhlaWdodD0iNDAwIi8+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0yNTguMTg0LDE0My41djExM2gxNDMuNjMydi0xMTNIMjU4LjE4NHogTTM5MC4yNDQsMjQ0LjI0N0gyNzAuNDM3di04OC40OTRoMTE5LjgwOEwzOTAuMjQ0LDI0NC4yNDcNCgkJTDM5MC4yNDQsMjQ0LjI0N3oiLz4NCgk8cG9seWdvbiBmaWxsPSIjRDhEOEQ4IiBwb2ludHM9IjI3Ni44ODEsMjM0LjcxNyAzMDEuNTcyLDIwOC43NjQgMzEwLjgyNCwyMTIuNzY4IDM0MC4wMTYsMTgxLjY4OCAzNTEuNTA1LDE5NS40MzQgDQoJCTM1Ni42ODksMTkyLjMwMyAzODQuNzQ2LDIzNC43MTcgCSIvPg0KCTxjaXJjbGUgZmlsbD0iI0Q4RDhEOCIgY3g9IjMwNS40MDUiIGN5PSIxNzguMjU3IiByPSIxMC43ODciLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                </div>
            </div>

            <hr class="uk-grid-divider">

            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-1">
                    <div class="uk-panel uk-panel-box uk-text-center">
                        <p><strong>Phasellus viverra nulla ut metus.</strong> Quisque rutrum etiam ultricies nisi vel augue. <a class="uk-button uk-button-primary uk-margin-left" href="#">Button</a></p>
                    </div>
                </div>
            </div>

            <h1 class="uk-text-center">Our Clients</h1>

            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
                    <figure class="uk-overlay uk-overlay-hover">
                        <img width="350" height="150" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzUwcHgiIGhlaWdodD0iMTUwcHgiIHZpZXdCb3g9IjAgMCAzNTAgMTUwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAzNTAgMTUwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIzNTAiIGhlaWdodD0iMTUwIi8+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0xMzEuOTEsNDEuMXY2Ny44aDg2LjE4VjQxLjFIMTMxLjkxeiBNMjExLjE0NiwxMDEuNTQ5SDEzOS4yNlY0OC40NTFoNzEuODg3VjEwMS41NDl6Ii8+DQoJPHBvbHlnb24gZmlsbD0iI0Q4RDhEOCIgcG9pbnRzPSIxNDMuMTI5LDk1LjgzIDE1Ny45NDMsODAuMjU4IDE2My40OTQsODIuNjYgMTgxLjAwOSw2NC4wMTQgMTg3LjkwMiw3Mi4yNiAxOTEuMDE0LDcwLjM4MiANCgkJMjA3Ljg0OCw5NS44MyAJIi8+DQoJPGNpcmNsZSBmaWxsPSIjRDhEOEQ4IiBjeD0iMTYwLjI0MyIgY3k9IjYxLjk1NCIgcj0iNi40NzIiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                       <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                            <div>Client Name</div>
                        </figcaption>
                        <a class="uk-position-cover" href="#"></a>
                    </figure>
                </div>

                <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
                     <figure class="uk-overlay uk-overlay-hover">
                        <img width="350" height="150" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzUwcHgiIGhlaWdodD0iMTUwcHgiIHZpZXdCb3g9IjAgMCAzNTAgMTUwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAzNTAgMTUwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIzNTAiIGhlaWdodD0iMTUwIi8+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0xMzEuOTEsNDEuMXY2Ny44aDg2LjE4VjQxLjFIMTMxLjkxeiBNMjExLjE0NiwxMDEuNTQ5SDEzOS4yNlY0OC40NTFoNzEuODg3VjEwMS41NDl6Ii8+DQoJPHBvbHlnb24gZmlsbD0iI0Q4RDhEOCIgcG9pbnRzPSIxNDMuMTI5LDk1LjgzIDE1Ny45NDMsODAuMjU4IDE2My40OTQsODIuNjYgMTgxLjAwOSw2NC4wMTQgMTg3LjkwMiw3Mi4yNiAxOTEuMDE0LDcwLjM4MiANCgkJMjA3Ljg0OCw5NS44MyAJIi8+DQoJPGNpcmNsZSBmaWxsPSIjRDhEOEQ4IiBjeD0iMTYwLjI0MyIgY3k9IjYxLjk1NCIgcj0iNi40NzIiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                            <div>Client Name</div>
                        </figcaption>
                        <a class="uk-position-cover" href="#"></a>
                    </figure>
                </div>

                <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
                   <figure class="uk-overlay uk-overlay-hover">
                        <img width="350" height="150" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzUwcHgiIGhlaWdodD0iMTUwcHgiIHZpZXdCb3g9IjAgMCAzNTAgMTUwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAzNTAgMTUwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIzNTAiIGhlaWdodD0iMTUwIi8+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0xMzEuOTEsNDEuMXY2Ny44aDg2LjE4VjQxLjFIMTMxLjkxeiBNMjExLjE0NiwxMDEuNTQ5SDEzOS4yNlY0OC40NTFoNzEuODg3VjEwMS41NDl6Ii8+DQoJPHBvbHlnb24gZmlsbD0iI0Q4RDhEOCIgcG9pbnRzPSIxNDMuMTI5LDk1LjgzIDE1Ny45NDMsODAuMjU4IDE2My40OTQsODIuNjYgMTgxLjAwOSw2NC4wMTQgMTg3LjkwMiw3Mi4yNiAxOTEuMDE0LDcwLjM4MiANCgkJMjA3Ljg0OCw5NS44MyAJIi8+DQoJPGNpcmNsZSBmaWxsPSIjRDhEOEQ4IiBjeD0iMTYwLjI0MyIgY3k9IjYxLjk1NCIgcj0iNi40NzIiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                            <div>Client Name</div>
                        </figcaption>
                        <a class="uk-position-cover" href="#"></a>
                    </figure>
                </div>

                <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
                    <figure class="uk-overlay uk-overlay-hover">
                        <img width="350" height="150" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzUwcHgiIGhlaWdodD0iMTUwcHgiIHZpZXdCb3g9IjAgMCAzNTAgMTUwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAzNTAgMTUwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIzNTAiIGhlaWdodD0iMTUwIi8+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0xMzEuOTEsNDEuMXY2Ny44aDg2LjE4VjQxLjFIMTMxLjkxeiBNMjExLjE0NiwxMDEuNTQ5SDEzOS4yNlY0OC40NTFoNzEuODg3VjEwMS41NDl6Ii8+DQoJPHBvbHlnb24gZmlsbD0iI0Q4RDhEOCIgcG9pbnRzPSIxNDMuMTI5LDk1LjgzIDE1Ny45NDMsODAuMjU4IDE2My40OTQsODIuNjYgMTgxLjAwOSw2NC4wMTQgMTg3LjkwMiw3Mi4yNiAxOTEuMDE0LDcwLjM4MiANCgkJMjA3Ljg0OCw5NS44MyAJIi8+DQoJPGNpcmNsZSBmaWxsPSIjRDhEOEQ4IiBjeD0iMTYwLjI0MyIgY3k9IjYxLjk1NCIgcj0iNi40NzIiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                            <div>Client Name</div>
                        </figcaption>
                        <a class="uk-position-cover" href="#"></a>
                    </figure>
                </div>

                <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
                     <figure class="uk-overlay uk-overlay-hover">
                        <img width="350" height="150" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzUwcHgiIGhlaWdodD0iMTUwcHgiIHZpZXdCb3g9IjAgMCAzNTAgMTUwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAzNTAgMTUwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIzNTAiIGhlaWdodD0iMTUwIi8+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0xMzEuOTEsNDEuMXY2Ny44aDg2LjE4VjQxLjFIMTMxLjkxeiBNMjExLjE0NiwxMDEuNTQ5SDEzOS4yNlY0OC40NTFoNzEuODg3VjEwMS41NDl6Ii8+DQoJPHBvbHlnb24gZmlsbD0iI0Q4RDhEOCIgcG9pbnRzPSIxNDMuMTI5LDk1LjgzIDE1Ny45NDMsODAuMjU4IDE2My40OTQsODIuNjYgMTgxLjAwOSw2NC4wMTQgMTg3LjkwMiw3Mi4yNiAxOTEuMDE0LDcwLjM4MiANCgkJMjA3Ljg0OCw5NS44MyAJIi8+DQoJPGNpcmNsZSBmaWxsPSIjRDhEOEQ4IiBjeD0iMTYwLjI0MyIgY3k9IjYxLjk1NCIgcj0iNi40NzIiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                         <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                            <div>Client Name</div>
                        </figcaption>
                        <a class="uk-position-cover" href="#"></a>
                    </figure>
                </div>

                <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
                     <figure class="uk-overlay uk-overlay-hover">
                        <img width="350" height="150" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzUwcHgiIGhlaWdodD0iMTUwcHgiIHZpZXdCb3g9IjAgMCAzNTAgMTUwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAzNTAgMTUwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIzNTAiIGhlaWdodD0iMTUwIi8+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0xMzEuOTEsNDEuMXY2Ny44aDg2LjE4VjQxLjFIMTMxLjkxeiBNMjExLjE0NiwxMDEuNTQ5SDEzOS4yNlY0OC40NTFoNzEuODg3VjEwMS41NDl6Ii8+DQoJPHBvbHlnb24gZmlsbD0iI0Q4RDhEOCIgcG9pbnRzPSIxNDMuMTI5LDk1LjgzIDE1Ny45NDMsODAuMjU4IDE2My40OTQsODIuNjYgMTgxLjAwOSw2NC4wMTQgMTg3LjkwMiw3Mi4yNiAxOTEuMDE0LDcwLjM4MiANCgkJMjA3Ljg0OCw5NS44MyAJIi8+DQoJPGNpcmNsZSBmaWxsPSIjRDhEOEQ4IiBjeD0iMTYwLjI0MyIgY3k9IjYxLjk1NCIgcj0iNi40NzIiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                            <div>Client Name</div>
                        </figcaption>
                        <a class="uk-position-cover" href="#"></a>
                    </figure>
                </div>
            </div>


            <div class="uk-grid footer" data-uk-grid-margin>
                <div class="uk-width-1-1 uk-container-center">
                    <div class="uk-block uk-block-secondary uk-contrast uk-block-large">

                        <div class="uk-container">

                            <div class="uk-grid uk-grid-match" data-uk-grid-margin>

                                <div class="uk-width-medium-1-2">
                                    <div class="uk-container">
                                        <div class="uk-grid">
                                            <div class="uk-width-1-2 uk-margin-large-bottom">
                                                <div class="uk-panel uk-panel-header">
                                                    <h3 class="uk-panel-title bold white">SMS</h3>
                                                    <ul class="uk-list">
                                                        <li><a href="#">Bulk SMS</a></li>
                                                        <li>SMS Ideas</li>
                                                        <li>SMS in Industries</li>
                                                    </ul>
                                                </div>
                                            </div>

                                                <div class="uk-width-1-2">
                                                <div class="uk-panel uk-panel-header">
                                                    <h3 class="uk-panel-title bold white">Resources</h3>
                                                    <ul class="uk-list">
                                                        <li>Sender ID guide</li>
                                                        <li>Product Help</li>
                                                        <li>Blog</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="uk-width-1-2">
                                                <div class="uk-panel uk-panel-header">
                                                    <h3 class="uk-panel-title bold white">API</h3>
                                                    <ul class="uk-list">
                                                        <li>SMS API</li>
                                                        <li>Example Scripts</li>
                                                    </ul>
                                                </div>
                                                </div>

                                                <div class="uk-width-1-2">
                                                <div class="uk-panel uk-panel-header">
                                                    <h3 class="uk-panel-title bold white">Pricing & Coverage</h3>
                                                    <ul class="uk-list">
                                                        <li><a href="#">Message Pricing</a></li>
                                                        <li><a href="#">ShortCode Costs</a></li>
                                                        <li><a href="#">Number Context Costs</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <div class="uk-panel">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>




        <div id="offcanvas" class="uk-offcanvas">
            <div class="uk-offcanvas-bar">
                <ul class="uk-nav uk-nav-offcanvas">
                    <li class="uk-active">
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="#">SMS Messaging</a>
                    </li>
                    <li>
                        <a href="#">Solutions</a>
                    </li>
                    <li>
                        <a href="#">Pricing &nbsp; Coverage</a>
                    </li>
                    <li>
                        <a href="#">API</a>
                    </li>
                    <li>
                        <a href="#">Downloads &nbsp; Resources</a>
                    </li>

                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <li>
                        <a href="{{url('user/login')}}">Login</a>
                    </li>
                    <li>
                        <a href="{{url('user/register')}}">Register</a>
                    </li>

                </ul>
            </div>
        </div>
    @section('foot')
    <script src="/js/jquery/jquery-latest.js"></script>
    <script src="/assets/uikit/js/uikit.min.js"></script>
    <script src="/assets/uikit/js/components/slider.min.js"></script>
    @show
    </body>
</html>