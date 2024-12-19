<ul class="list-unstyled topbar-nav float-end mb-0">



    <li class="dropdown">
        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-bs-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" aria-expanded="false">
            <span class="ms-1 nav-user-name hidden-sm">Nick</span>
            <img src="{{asset('images/users/user-5.jpg')}}" alt="profile-user" class="rounded-circle thumb-xs" />
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="pages-profile.html"><i data-feather="user" class="align-self-center icon-xs icon-dual me-1"></i> Profile</a>
            <a class="dropdown-item" href="{{route('branch.index')}}"><i data-feather="users" class="align-self-center icon-xs icon-dual me-1"></i> Branch Manage</a>
            <a class="dropdown-item" href="{{route('role.index')}}"><i data-feather="users" class="align-self-center icon-xs icon-dual me-1"></i> Role Manage</a>
            <a class="dropdown-item" href="{{route('systemUser.index')}}"><i data-feather="users" class="align-self-center icon-xs icon-dual me-1"></i> System User</a>
            <div class="dropdown-divider mb-0"></div>
            <a class="dropdown-item" href="{{route('logout')}}"><i data-feather="power" class="align-self-center icon-xs icon-dual me-1"></i> Logout</a>
        </div>
    </li>
</ul><!--end topbar-nav-->