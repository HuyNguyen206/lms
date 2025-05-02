<div class="col-xl-3 col-md-4 wow fadeInLeft">
    <div class="wsus__dashboard_sidebar">
        <div class="wsus__dashboard_sidebar_top">
            <div class="dashboard_banner">
                <img src="{{asset('assets/images/single_topic_sidebar_banner.jpg')}}" alt="img" class="img-fluid">
            </div>
            <div class="img">
                <img src="{{asset(auth()->user()->image)}}" alt="profile" class="img-fluid w-100">
            </div>
            <h4>{{auth()->user()->name}}</h4>
        </div>
        <ul class="wsus__dashboard_sidebar_menu">
            <li>
                @php
                $role = explode('/', request()->getRequestUri())[1] ?? 'student';
                @endphp
                <a href="{{route("$role.dashboard")}}" class="@if(request()->routeIs("$role.dashboard")) active @endif">
                    <div class="img">
                        <img src="{{asset('assets/images/dash_icon_8.png')}}" alt="icon" class="img-fluid w-100">
                    </div>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{route('profile', $role)}}" class="@if(request()->routeIs('profile')) active @endif">
                    <div class="img">
                        <img src="{{asset('assets/images/dash_icon_1.png')}}" alt="icon" class="img-fluid w-100">
                    </div>
                    Profile
                </a>
            </li>
            <li>
                <a href="{{route('instructor.courses.index')}}" class="@if(request()->routeIs('instructor.courses.index')) active @endif">
                    <div class="img">
                        <img src="{{asset('assets/images/dash_icon_1.png')}}" alt="icon" class="img-fluid w-100">
                    </div>
                    Course
                </a>
            </li>
        </ul>
    </div>
</div>
