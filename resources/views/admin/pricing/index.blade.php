@extends('layouts.frontend.master')

@section('head')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('content')

<div class="uk-panel {{Request::segment(2)}}">
    <div class="uk-panel-badge uk-badge"></div>
    <h1 class="uk-panel-title uk-title">Pricing</h1>
    <p class="uk-lead">Set Pricing</p>

    <div class="errors" style="display:none;">
        <div class="uk-alert uk-alert-danger" data-uk-alert>
            <ul id="error-ul"></ul>
        </div>
    </div>
    {!! Form::open(['class'=>'uk-form uk-form-horizontal uk-margin-large-top', 'id'=>'set-pricing']) !!}
    <table class="uk-table uk-table-hover uk-table-stripped">
        <tr>
            <th>ID</th>
            <th>Lower Range</th>
            <th>Upper Range</th>
            <th>Price</th>
            <th></th>
        </tr>
        <tr>
            <td><input type="text" name="idn" id="idn" required="required" value="{{Input::old('idn')}}"/></td>
            <td><input type="text" name="lower_range" id="lower_range" required="required"/></td>
            <td><input type="text" name="upper_range" id="upper_range" required="required"/></td>
            <td><input type="text" name="unit_price" id="unit_price" required="required"/></td>
            <td><button id="submit" class="uk-button uk-button-success">Save</button></td>
        </tr>
    </table>
    {!! Form::close() !!}
    </div>

    <div id="table-container">
        @include('ajax.pricing')
    </div>
</div>

@stop

@section('foot')
@parent
<script src="/assets/uikit/js/components/notify.min.js"></script>
<script>
$('body').on('click', 'button#submit', function(e){
    e.preventDefault();
    var $this = $(this);

    var jqXHR = $.post('/admin/set-pricing', $('form#set-pricing').serialize());

    jqXHR.done(function(data){
        emptyErrorContainer('.errors')
        resetForm('#set-pricing');
        //update the table container with the result
        $('div#table-container').html( data.out );
    });

    jqXHR.fail(function(data){
        processError(data);
    });

});
</script>
@stop