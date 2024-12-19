<nav class="navbar-custom">
    <ul class="list-unstyled topbar-nav float-end mb-0">

        <li class="dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-bs-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                <span class="ms-1 nav-user-name hidden-sm">{{session('auth')['name']}}</span>
                <img src="{{asset(session('auth')['image']??'user.jpg')}}" alt="profile-user" class="rounded-circle thumb-xs" />
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="{{route('branch.index')}}"><i data-feather="users" class="align-self-center icon-xs icon-dual me-1"></i> Switch Branch</a>
                <div class="dropdown-divider mb-0"></div>
                <a class="dropdown-item" href="{{route('logout')}}"><i data-feather="power" class="align-self-center icon-xs icon-dual me-1"></i> Logout</a>
            </div>
        </li>
    </ul><!--end topbar-nav-->

    <ul class="list-unstyled topbar-nav mb-0">
        <li>
            <button class="nav-link button-menu-mobile">
                <i data-feather="menu" class="align-self-center topbar-icon"></i>
            </button>
        </li>
        <li class="creat-btn">
            <div class="nav-link">
                <a class=" btn btn-sm btn-soft-primary" href="#" role="button"><i class="fas fa-plus me-2"></i>New Task</a>
            </div>
        </li>
    </ul>
</nav>