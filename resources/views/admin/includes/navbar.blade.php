<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
{{--        <li class="nav-item ">--}}

{{--            <a class="nav-link text-white font-weight-bold wallet" id="appWalletBalanceNavBar" href="#">App Wallet Balance: ${{$appWalletBalance}}</a>--}}

{{--        </li>--}}

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell text-white"></i>
                <span
                    class="badge badge-danger navbar-badge text-white">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span
                    class="dropdown-header vMHeader">0 Notification</span>
                <div class="dropdown-divider"></div>
                <a href="javascript:void(0)"
                   class="dropdown-item bg-info">
                    <p class="notificationCount">
                        <span class="notificationTime"> </span>
                    </p>
                </a>
                <hr class="mt-0 mb-0">

                <div class="dropdown-divider"></div>
                <a href="" class="dropdown-item dropdown-footer">See All Notification</a>
            </div>
        </li>


        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{Auth::user()->first_name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="javascript:void(0)">
                    Profile
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </li>

    </ul>


    <!-- Right navbar links -->
    {{--    <ul class="navbar-nav ml-auto">--}}
    {{--        <li>--}}
    {{--            <form id="logout-form" action="{{ route('logout') }}" method="POST" >--}}
    {{--                @csrf--}}
    {{--                <button type="submit" class="btn btn-danger">Logout</button>--}}

    {{--            </form>--}}
    {{--        </li>--}}

    {{--    </ul>--}}
</nav>
