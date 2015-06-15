@extends('layouts.default')

@section('content')

<div class="jumbotron">
    <h1>Grow your Business with {{env('APP_NAME')}}</h1>
    <p class="tagline">Everything you need to make it through the winter.</p>
    <p>
        <a class="btn btn-primary btn-lg" href="#">Learn More <i class="fa fa-info"></i> »</a>
        <a class="btn btn-primary btn-lg" href="#">Register <i class="fa fa-user-plus"></i> »</a>
    </p>
</div>

<div class="body-content">
    <div class="row">
        <div class="col-sm-4">
            <div class="home-box">
                <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object" src="/img/blog01.jpg" alt="Products">
                    </a>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">Bulk SMS</h4>
                        Blazing fast and easy to use Bulk SMS based on industry standards
                  </div>
                </div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="home-box">
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE0IiB5PSIzMiIgc3R5bGU9ImZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0O2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjY0eDY0PC90ZXh0PjwvZz48L3N2Zz4=" data-holder-rendered="true" style="width: 64px; height: 64px;">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading" id="media-heading">Media heading<a class="anchorjs-link" href="#media-heading"><span class="anchorjs-icon"></span></a></h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
                    <div class="home-box">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE0IiB5PSIzMiIgc3R5bGU9ImZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0O2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjY0eDY0PC90ZXh0PjwvZz48L3N2Zz4=" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading" id="media-heading">Media heading<a class="anchorjs-link" href="#media-heading"><span class="anchorjs-icon"></span></a></h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                    </div>
                </div>

    </div>
</div>

@stop