<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{ Auth::user()->name }}</strong>
                            </span> <span class="text-muted text-xs block">{{Auth::user()->username}} <b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{url('/profile')}}">Мой профиль</a></li>
                        <li><a href="{{url('/logout')}}">Выход</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    AAD
                </div>
            </li>
            <li class="{{ isActiveRoute('main') }}">
                <a href="{{ url('/') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Главная</span></a>
            </li>
            <li class="{{ isActiveRoute('users') }}">
                <a href="{{ url('/users') }}"><i class="fa fa-users"></i> <span class="nav-label">Пользователи</span> </a>
            </li>
            <li class="{{ isActiveRoute('computers') }}">
                <a href="{{ url('/computers') }}"><i class="fa fa-desktop"></i> <span class="nav-label">Компьютеры</span> </a>
            </li>
            <li class="{{ isActiveRoute('todo') }}">
                <a href="{{ url('/todo') }}"><i class="fa fa-check-square-o"></i> <span class="nav-label">Задачи</span> </a>
            </li>
        </ul>

    </div>
</nav>
