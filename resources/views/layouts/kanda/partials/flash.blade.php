@if ( Session::has('flash.message') )
<script>
@if( Session::get('flash.level') == 'success' || Session::get('flash.level') == 'error')
$(document).ready(function(){
    swal('{{Session::get('flash.header')}}',"{{Session::get('flash.message')}}", "{{Session::get('flash.level')}}")
});
@endif
</script>
@endif

