<?php $urlPath = url(\Illuminate\Support\Facades\Request::path()); ?>

<div class="collection">
@foreach($supportMenu as $name => $link)
    <a href="{{$link}}" class="collection-item {{mark_active($urlPath, $link, 1)}}">{{alpha_case($name)}}</a>
@endforeach
</div>