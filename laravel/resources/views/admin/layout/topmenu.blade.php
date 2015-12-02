<header class="main-header">
    <!-- Logo -->
    <a href="{!! URL::to('/') !!}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">{!! $FirmNameShort or "IT" !!}</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">{!! $DashBoardSiteName !!}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li><a href="{{URL::to('/personal')}}">Личные настройки</a></li>
                <li><a href="{{URL::to('/logout')}}">Выйти</a></li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>