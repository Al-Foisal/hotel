<!-- LOGO -->
<div class="brand">
    <a href="index.html" class="logo">
        <span>
            <img src="{{asset('images/logo-sm.png')}}" alt="logo-small" class="logo-sm">
        </span>
        <span>
            <img src="{{asset('images/logo.png')}}" alt="logo-large" class="logo-lg logo-light">
            <img src="{{asset('images/logo-dark.png')}}" alt="logo-large" class="logo-lg logo-dark">
        </span>
    </a>
</div>
<!--end logo-->
<div class="menu-content h-100" data-simplebar>
    <ul class="metismenu left-sidenav-menu">

        @foreach(menuList() as $menu)
        @if (session('owner_id') == session('auth_id')||array_key_exists($menu['permission'], session('single_permission')))

        <li>
            <a href="{{$menu['hasSub'] && session('owner_id') == session('auth_id')||$menu['hasSub'] && findMenu($menu['permission'])?'javascript: void(0);':$menu['link']}}">
                <i data-feather="file-plus" class="align-self-center menu-icon"></i>
                <span>{{$menu['title']}}</span>
                @if($menu['hasSub'] && session('owner_id') == session('auth_id')||$menu['hasSub'] && findMenu($menu['permission']))
                <span class="menu-arrow">
                    <i class="mdi mdi-chevron-right"></i>
                </span>
                @endif
            </a>
            @if(session('owner_id') == session('auth_id')||$menu['hasSub'] && findMenu($menu['permission']))
            <ul class="nav-second-level" aria-expanded="false">
                @foreach($menu['subMenu'] as $submenu)
                @if(session('owner_id') == session('auth_id')||findSub($menu['permission'],$submenu['permission']))
                <li class="nav-item">
                    <a class="nav-link" href="{{$submenu['link']}}">
                        <i class="ti-control-record"></i>
                        {{$submenu['title']}}
                    </a>
                </li>
                @endif
                @endforeach
            </ul>
            @endif
        </li>

        @endif
        @endforeach
    </ul>

    <div class="update-msg text-center">
        <a href="javascript: void(0);" class="float-end close-btn text-muted" data-dismiss="update-msg" aria-label="Close" aria-hidden="true">
            <i class="mdi mdi-close"></i>
        </a>
        <h5 class="mt-3">Mannat Themes</h5>
        <p class="mb-3">We Design and Develop Clean and High Quality Web Applications</p>
        <a href="javascript: void(0);" class="btn btn-outline-warning btn-sm">Upgrade your plan</a>
    </div>
</div>