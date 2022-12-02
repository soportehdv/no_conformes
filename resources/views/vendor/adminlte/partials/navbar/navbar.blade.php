<nav
    class="main-header navbar navbar-expand
    {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
    {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    {{-- Navbar left links --}}
    <ul class="navbar-nav">
        {{-- Left sidebar toggler link --}}
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

        {{-- Configured left links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

        {{-- Custom left links --}}

        @yield('content_top_nav_left')
    </ul>
    <ul class="navbar-nav">
        @if (Auth::guest())
            <li><a style="color: white" href="{{ url('/') }}">SE HA CERRADO SESIÓN AUTOMÁTICAMENTE, POR FAVOR VUELVA A INICIAR SESIÓN NUEVAMENTE --> AQUI</a></li>
            <script type="text/javascript">
                function redirect() {
                    window.location.href = "<?php echo URL::to('/'); ?>";
                }
                window.onload = redirect;
            </script>
        @else
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    @if (count(auth()->user()->unreadNotifications))
                        <span class="badge badge-warning navbar-badge" style="right: 0px !important; top:0px !important">
                            <span class="badge badge-warning">{{ count(auth()->user()->unreadNotifications) }}</span>
                        </span>
                    @endif
                </a>
                @php
                    $hola = 0;
                @endphp
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header"><b>Notificaciones no leídas</b></span>
                    @forelse (auth()->user()->unreadNotifications as $notification)
                        {{-- {{ dd($notification->id) }} --}}
                        @php
                            $hola = $notification->data['noConformeID'];
                        @endphp
                        <button class="dropdown-item mark-as-read btn btn-sm btn-dark" type="submit"
                            data-id="{{ $notification->id }}" style="overflow: hidden;text-overflow: ellipsis;">
                            <i class="fas fa-envelope mr-2"></i>
                            @foreach (App\Models\User::all() as $us)
                                @if ($us->id == $notification->data['proceso'])
                                    {{ $us->proceso }}
                                @endif
                            @endforeach
                            <span
                                class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                        </button>
                    @empty
                        <span class="ml-3 pull-right text-muted text-sm">Sin notificaciones por leer </span>
                    @endforelse
                    <div class="dropdown-divider"></div>
                    <span class="dropdown-header"><b>notificaciones leídas</b></span>
                    @forelse (auth()->user()->readNotifications as $notification)
                        <a href="{{ route('NConformes.vista', $notification->data['noConformeID']) }}"
                            class="dropdown-item" style="overflow: hidden;text-overflow: ellipsis;">
                            <i class="fas fa-users mr-2"></i>
                            @foreach (App\Models\User::all() as $us)
                                @if ($us->id == $notification->data['proceso'])
                                    {{ $us->proceso }}
                                @endif
                            @endforeach
                            <span
                                class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                        </a>
                    @empty
                        <span class="ml-3 pull-right text-muted text-sm">Sin notificaciones leidas </span>
                    @endforelse


                    <div class="dropdown-divider"></div>
                    <a href="{{ route('markAsRead') }}" class="dropdown-item dropdown-footer bg-primary">Marcar todas
                        como
                        leídas</a>
                </div>
            </li>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <script>
                function sendMarkRequest(id = null) {
                    return $.ajax("{{ route('markNotification') }}", {
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id
                        }
                    });
                }
                $(function() {
                    $('.mark-as-read').click(function() {
                        let request = sendMarkRequest($(this).data('id'));
                        var id_Nc = "<?php echo $hola; ?>";
                        request.done(() => {
                            $(this).parents('div.alert').remove();
                            window.location.href = "<?php echo URL::to('NConformes/vista/"+id_Nc+"'); ?>";
                        });
                    });
                    $('#mark-all').click(function() {
                        let request = sendMarkRequest();
                        request.done(() => {
                            $('div.alert').remove();
                            location.reload();
                        })
                    });
                });
            </script>
        @endif

    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto">
        {{-- Custom right links --}}
        @yield('content_top_nav_right')

        {{-- Configured right links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

        {{-- User menu link --}}
        @if (Auth::user())
            @if (config('adminlte.usermenu_enabled'))
                @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
            @else
                @include('adminlte::partials.navbar.menu-item-logout-link')
            @endif
        @endif

        {{-- Right sidebar toggler link --}}
        @if (config('adminlte.right_sidebar'))
            @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
        @endif
    </ul>

</nav>
