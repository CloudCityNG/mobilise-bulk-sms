@if ($errors->any())
    <div class="alert alert-error">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
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