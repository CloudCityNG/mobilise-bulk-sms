@extends('layouts.material.frontend')


@section('content')
    <div>
        <h3 class="page-title">Sitemap</h3>

        @foreach($sitemap as $section_name => $value)
        <div style="padding-left: 40px;">
        <h4>{{alpha_case($section_name)}}</h4>
            <ul id="list">
            @foreach($value as $name => $val)
                <li><a href="{{$val}}">{{alpha_case($name)}}</a></li>
            @endforeach
            </ul>
        </div>
        @endforeach
        <br/>
        <br/>
        <br/>
    </div>
@endsection