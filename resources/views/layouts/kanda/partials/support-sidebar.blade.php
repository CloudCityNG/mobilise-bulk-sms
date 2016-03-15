<?php $urlPath = url(\Illuminate\Support\Facades\Request::path()); ?>

<div class="collection">
@foreach($supportMenu as $name => $link)
    <a href="{{$link}}" class="collection-item ">{{$name}}</a>
@endforeach
</div>


<div class="collection">
    <a href="#!" class="collection-item {{mark_active($urlPath, $sideMenu->about_us, 1)}}">Alvin</a>
    <a href="#!" class="collection-item ">Alvin</a>
    <a href="#!" class="collection-item">Alvin</a>
    <a href="#!" class="collection-item">Alvin</a>
</div>