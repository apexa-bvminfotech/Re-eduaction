<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="{{asset('assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('student.index')}}" class="nav-link @if(Route::currentRouteName() == 'student.index')active  @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Student</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('trainer.index')}}" class="nav-link @if(Route::currentRouteName() == 'staff.index')active  @endif">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Trainer</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('course.index')}}" class="nav-link @if(Route::currentRouteName() == 'course.index')active  @endif">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Course</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('slot.index')}}" class="nav-link @if(Route::currentRouteName() == 'slot.index')active  @endif">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Slot</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('rtc.index')}}" class="nav-link @if(Route::currentRouteName() == 'rtc.index')active  @endif">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>RTC</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Student Attendance</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('staff_attendance.index')}}" class="nav-link @if(Route::currentRouteName() == 'staff_attendance.index')active  @endif">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Staff Attendance</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link @if(Route::currentRouteName() == 'roles.index')active  @endif">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link @if(Route::currentRouteName() == 'user.index')active  @endif">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Users</p>
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('branch.index') }}" class="nav-link @if(Route::currentRouteName() == 'user.index')active  @endif">--}}
{{--                        <i class="nav-icon fas fa-columns"></i>--}}
{{--                        <p>Branch</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </nav>
    </div>
</aside>
