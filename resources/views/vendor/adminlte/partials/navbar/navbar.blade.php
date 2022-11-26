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
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                @if (count(auth()->user()->unreadNotifications))
                    <span class="badge badge-warning navbar-badge" style="right: 0px !important; top:0px !important">
                        <span class="badge badge-warning">{{ count(auth()->user()->unreadNotifications) }}</span>
                    </span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">Notificaciones no leídas</span>
                @forelse (auth()->user()->unreadNotifications as $notification)
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i>
                        @foreach (App\Models\User::all() as $us)
                            @if ($us->id == $notification->data['proceso'])
                                {{ $us->proceso }}
                            @endif
                        @endforeach
                        <span
                            class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                    </a>
                @empty
                    <span class="ml-3 pull-right text-muted text-sm">Sin notificaciones por leer </span>
                @endforelse
                <div class="dropdown-divider"></div>
                <span class="dropdown-header">notificaciones leídas</span>
                @forelse (auth()->user()->readNotifications as $notification)
                    <a href="#" class="dropdown-item">
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
                    <span class="float-right text-muted text-sm">Sin notificaciones leidas </span>
                @endforelse


                <div class="dropdown-divider"></div>
                <a href="{{ route('markAsRead') }}" class="dropdown-item dropdown-footer">Marcar todas como leídas</a>
            </div>
        </li>
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
