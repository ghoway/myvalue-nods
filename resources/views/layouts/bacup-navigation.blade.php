<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('adminlte') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @php
                    $menus = \App\Models\Menu::whereNull('parent_id')->orderBy('header')->get();
                    $currentHeader = '';
                @endphp
                @foreach ($menus as $menu)
                    @if ($menu->header != $currentHeader)
                        <li class="nav-header">{{ $menu->header }}</li>
                        @php
                            $currentHeader = $menu->header;
                        @endphp
                    @endif
                    @if ($menu->role && !auth()->user()->hasRole($menu->role))
                        @continue
                    @endif
                    @if ($menu->children->isEmpty())
                        <li class="nav-item">
                            <a href="{{ url($menu->url) }}" class="nav-link {{ request()->is(ltrim($menu->url, '/').'*') ? 'active' : '' }}">
                                <i class="nav-icon {{ $menu->icon }}"></i>
                                <p>{{ $menu->title }}</p>
                            </a>
                        </li>
                    @else
                        @php
                            $open = $menu->children->pluck('url')->contains(function ($url) {
                                return request()->is(ltrim($url, '/').'*');
                            });
                        @endphp
                        <li class="nav-item has-treeview {{ $open ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $open ? 'active' : '' }}">
                                <i class="nav-icon {{ $menu->icon }}"></i>
                                <p>{{ $menu->title }}<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach ($menu->children as $submenu)
                                    @if ($submenu->role && !auth()->user()->hasRole($submenu->role))
                                        @continue
                                    @endif
                                    <li class="nav-item">
                                        <a href="{{ url($submenu->url) }}" class="nav-link {{ request()->is(ltrim($submenu->url, '/').'*') ? 'active' : '' }}">
                                            <i class="nav-icon {{ $submenu->icon }}"></i>
                                            <p>{{ $submenu->title }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
                <li class="nav-header"></li>
                <li class="nav-item">
                    <button href="{{ route('logout') }}" class="btn btn-danger btn-block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                    
                    <form class="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
