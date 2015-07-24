@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      @if(!empty($error_header))
        <strong>{!! $error_header !!}</strong>
      @else
        <strong>Form Errors</strong>
      @endif
      <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
@endif