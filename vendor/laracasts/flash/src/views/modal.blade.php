@section('foot')
@parent
<script>UIkit.modal.alert("<h2>{{ $title }}</h2> {!! $body !!}");</script>
@stop