<div class="nav-container">
    <nav id="main-menu-navigation" class="navigation-main">
        <div class="nav-lavel">Navigation</div>
        <div class="nav-item @if(request()->routeIs('backend.home'))  active @endif">
            <a href="{{ route('backend.home') }}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
        </div>


        <div class="nav-lavel">Access</div>



        <div class="nav-item @if(request()->routeIs('backend.users*')) active @endif"">
            <a href="{{ route('backend.users.index') }}"><i class="ik ik-user"></i> All Users</a>
        </div>


        <div class="nav-item @if(request()->routeIs('backend.roles*'))  active @endif">
            <a href="{{ route('backend.roles.index') }}"><i class="ik ik-shield-off"></i><span>Roles</span></a>
        </div>


        <div class="nav-item @if(request()->routeIs('backend.permissions*')) active @endif">
            <a href="{{ route('backend.permissions.index') }}" ><i class="ik ik ik-check-square"></i> Permissions</a>
        </div>


        <div class="nav-lavel">System</div>

        <div class="nav-item @if(request()->routeIs('backend.menus*')) active @endif">
            <a href="{{ route('backend.menus.index') }}" ><i class="ik ik ik-menu"></i> Menus</a>
        </div>
        {{-- <div class="nav-item has-sub">
            <a href="#"><i class="ik ik-box"></i><span>Basic</span></a>
            <div class="submenu-content">
                <a href="alerts.html" class="menu-item">Alerts</a>
                <a href="badges.html" class="menu-item">Badges</a>
                <a href="buttons.html" class="menu-item">Buttons</a>
                <a href="navigation.html" class="menu-item">Navigation</a>
            </div>
        </div>
        <div class="nav-item has-sub">
            <a href="#"><i class="ik ik-gitlab"></i><span>Advance</span> <span class="badge badge-success">New</span></a>
            <div class="submenu-content">
                <a href="modals.html" class="menu-item">Modals</a>
                <a href="notifications.html" class="menu-item">Notifications</a>
                <a href="carousel.html" class="menu-item">Slider</a>
                <a href="range-slider.html" class="menu-item">Range Slider</a>
                <a href="rating.html" class="menu-item">Rating</a>
            </div>
        </div>
        <div class="nav-item has-sub">
            <a href="#"><i class="ik ik-package"></i><span>Extra</span></a>
            <div class="submenu-content">
                <a href="session-timeout.html" class="menu-item">Session Timeout</a>
            </div>
        </div>
        <div class="nav-item">
            <a href="icons.html"><i class="ik ik-command"></i><span>Icons</span></a>
        </div>
        <div class="nav-lavel">Forms</div>
        <div class="nav-item has-sub">
            <a href="#"><i class="ik ik-edit"></i><span>Forms</span></a>
            <div class="submenu-content">
                <a href="../form-components.html" class="menu-item">Components</a>
                <a href="../form-addon.html" class="menu-item">Add-On</a>
                <a href="../form-advance.html" class="menu-item">Advance</a>
            </div>
        </div>
        <div class="nav-item">
            <a href="../form-picker.html"><i class="ik ik-terminal"></i><span>Form Picker</span> <span class="badge badge-success">New</span></a>
        </div>

        <div class="nav-lavel">Tables</div>
        <div class="nav-item">
            <a href="../table-bootstrap.html"><i class="ik ik-credit-card"></i><span>Bootstrap Table</span></a>
        </div>
        <div class="nav-item">
            <a href="../table-datatable.html"><i class="ik ik-inbox"></i><span>Data Table</span></a>
        </div>

        <div class="nav-lavel">Charts</div>
        <div class="nav-item has-sub">
            <a href="#"><i class="ik ik-pie-chart"></i><span>Charts</span> <span class="badge badge-success">New</span></a>
            <div class="submenu-content">
                <a href="../charts-chartist.html" class="menu-item">Chartist</a>
                <a href="../charts-flot.html" class="menu-item">Flot</a>
                <a href="../charts-knob.html" class="menu-item">Knob</a>
                <a href="../charts-amcharts.html" class="menu-item">Amcharts</a>
            </div>
        </div>

        <div class="nav-lavel">Apps</div>
        <div class="nav-item">
            <a href="../calendar.html"><i class="ik ik-calendar"></i><span>Calendar</span></a>
        </div>
        <div class="nav-item">
            <a href="../taskboard.html"><i class="ik ik-server"></i><span>Taskboard</span></a>
        </div>

        <div class="nav-lavel">Pages</div>

        <div class="nav-item has-sub">
            <a href="#"><i class="ik ik-lock"></i><span>Authentication</span></a>
            <div class="submenu-content">
                <a href="../login.html" class="menu-item">Login</a>
                <a href="../register.html" class="menu-item">Register</a>
                <a href="../forgot-password.html" class="menu-item">Forgot Password</a>
            </div>
        </div>
        <div class="nav-item has-sub">
            <a href="#"><i class="ik ik-file-text"></i><span>Other</span></a>
            <div class="submenu-content">
                <a href="../profile.html" class="menu-item">Profile</a>
                <a href="../invoice.html" class="menu-item">Invoice</a>
            </div>
        </div>
        <div class="nav-item">
            <a href="../layouts.html"><i class="ik ik-layout"></i><span>Layouts</span><span class="badge badge-success">New</span></a>
        </div>
        <div class="nav-lavel">Other</div>
        <div class="nav-item has-sub">
            <a href="javascript:void(0)"><i class="ik ik-list"></i><span>Menu Levels</span></a>
            <div class="submenu-content">
                <a href="javascript:void(0)" class="menu-item">Menu Level 2.1</a>
                <div class="nav-item has-sub">
                    <a href="javascript:void(0)" class="menu-item">Menu Level 2.2</a>
                    <div class="submenu-content">
                        <a href="javascript:void(0)" class="menu-item">Menu Level 3.1</a>
                    </div>
                </div>
                <a href="javascript:void(0)" class="menu-item">Menu Level 2.3</a>
            </div>
        </div>
        <div class="nav-item">
            <a href="javascript:void(0)" class="disabled"><i class="ik ik-slash"></i><span>Disabled Menu</span></a>
        </div>
        <div class="nav-item">
            <a href="javascript:void(0)"><i class="ik ik-award"></i><span>Sample Page</span></a>
        </div>
        <div class="nav-lavel">Support</div>
        <div class="nav-item">
            <a href="javascript:void(0)"><i class="ik ik-monitor"></i><span>Documentation</span></a>
        </div>
        <div class="nav-item">
            <a href="javascript:void(0)"><i class="ik ik-help-circle"></i><span>Submit Issue</span></a>
        </div> --}}
    </nav>
</div>
