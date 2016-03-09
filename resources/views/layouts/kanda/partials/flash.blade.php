@if ( Session::has('flash.message') )
<script>
$(function(){
    @if( Session::get('flash.level') == 'success' || Session::get('flash.level') == 'error')
    swal('{{Session::get('flash.header')}}',"{{Session::get('flash.message')}}", "{{Session::get('flash.level')}}");
    @else
    swal('{{Session::get('flash.header')}}',   '{{Session::get('flash.message')}}' );
    @endif
});
</script>
@endif

