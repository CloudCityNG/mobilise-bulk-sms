<?php
$check = $errors->count();
?>
@if ( $errors->any() )
<div class="ui error message">
  <i class="close icon"></i>
  @if ( !empty($error_header) )
  <div class="header">
      {!! $error_header !}}
  </div>
  @else
  <div class="header">
    There was
    @if($check == 1)
    an error
    @else
    some errors
    @endif
     with your submission
  </div>
  @endif
  <ul class="list">
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif