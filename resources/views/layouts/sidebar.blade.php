<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Menu</li>
                @foreach (SideMenu::get() as $menu)
                    @if ($menu['tipe'] == '1')
                        <li>
                            <a href="{{ route($menu['route']) }}"
                                class="waves-effect {{ Request::segment(2) == $menu['index'] ? 'mm-active' : '' }} ">
                                <i class="{{ $menu['icon'] }}"></i>
                                <span>{{ $menu['menu'] }}</span>
                            </a>
                        </li>
                    @else
                        <li class="{{ Request::segment(2) == $menu['index'] ? 'mm-active' : '' }} ">
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="{{ $menu['icon'] }}"></i>
                                <span>{{ $menu['menu'] }}
                                    <span class="float-right menu-arrow">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </span>
                                </span>
                            </a>
                            <ul class="submenu">
                                @if (count($menu['sub']) > 0)
                                    @foreach ($menu['sub'] as $sub)
                                        <li><a href="{{ route($sub['sub-route']) }}">{{ $sub['sub-menu'] }}</a></li>
                                    @endforeach
                                @else
                                    <li>No Sub Menu</li>
                                @endif
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
