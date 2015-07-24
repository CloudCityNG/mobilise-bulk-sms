@if ($errors->any())

<div class="uk-alert uk-alert-danger" data-uk-alert>
    <a href="" class="uk-alert-close uk-close"></a>
    @if(!empty($error_header))
    <h3>{!! $error_header !!}</h3>
    @endif

    <ul>
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
    </ul>
</div>
@endif