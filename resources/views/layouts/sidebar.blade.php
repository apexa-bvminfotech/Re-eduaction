<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="{{asset('assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item  @if(Route::currentRouteName() == 'student.index') menu-open  @endif">
                    <a href="{{route('student.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Student</p>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'staff.index') menu-open  @endif">
                    <a href="{{route('staff.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Staff</p>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'course.index') menu-open  @endif">
                    <a href="{{route('course.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Course</p>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'sloat.index') menu-open  @endif">
                    <a href="{{route('sloat.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Sloat</p>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'rtc.index') menu-open @endif">
                    <a href="{{route('rtc.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>RTC</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Student Attendance</p>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'staff_attendance.index') menu-open @endif">
                    <a href="{{route('staff_attendance.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Staff Attendance</p>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'roles.index') menu-open @endif">
                    <a href="{{ route('roles.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'user.index') menu-open @endif">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Users</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>