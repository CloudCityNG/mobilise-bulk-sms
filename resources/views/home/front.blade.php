@extends('layouts._master')

@section('carousel')
<div id="myCarousel" class="carousel slide">
      <div class="carousel-inner">
        <div class="item active">
          <img src="/assets/img/slide-01.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>High reliability mobile messaging platform</h1>
              <p class="lead">You can now reachout to any mobile phone anywhere in the world!</p>
              <a class="btn btn-large btn-success" href="#">Get started for free</a>
              <a class="btn btn-large btn-primary" href="#">How it works</a>
            </div>
          </div>
        </div>

      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div><!-- /.carousel -->

@stop

@section('head')
@parent
<style type="text/css">
div.wrapper{
    padding:0;
}
</style>
@stop


@section('foot')
@parent
<script>
    $('#myCarousel').carousel()
</script>
@stop