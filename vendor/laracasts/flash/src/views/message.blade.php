@if (Session::has('flash_notification.message'))
    @if (Session::has('flash_notification.overlay'))
        @include('flash::modal', ['modalClass' => 'flash-modal', 'title' => Session::get('flash_notification.title'), 'body' => Session::get('flash_notification.message')])
    @else
        <div class="uk-alert uk-alert-{{ Session::get('flash_notification.level') }}" data-uk-alert>
            <a class="uk-alert-close uk-close" href=""></a>
            {{ Session::get('flash_notification.message') }}
        </div>
    @endif
@endif
