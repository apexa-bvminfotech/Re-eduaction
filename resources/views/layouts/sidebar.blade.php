<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link" style="display: flex;
    justify-content: space-around;background: #fff">
        <img src="{{ asset('assets/img') }}/re-education.jpg" alt="AdminLTE Logo" style="max-height: 30px;width: 165px;">
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('student.index')}}" class="nav-link @if(Route::currentRouteName() == 'student.index')active  @endif">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>Student</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('student_ptm.index')}}" class="nav-link @if(Route::currentRouteName() == 'student_ptm.index')active  @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Student PTM</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('trainer.index')}}" class="nav-link @if(Route::currentRouteName() == 'trainer.index')active  @endif">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
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
                    <a href="{{route('appreciation.index')}}" class="nav-link @if(Route::currentRouteName() == 'appreciation.index')active  @endif">
                        <i class="nav-icon fas fa-award"></i>
                        <p>Appreciation</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('slot.index')}}" class="nav-link @if(Route::currentRouteName() == 'slot.index')active  @endif">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>Slot</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('rtc.index')}}" class="nav-link @if(Route::currentRouteName() == 'rtc.index')active  @endif">
                        <i class="nav-icon fas fa-map-marker"></i>
                        <p>RTC</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link @if(Route::currentRouteName() == 'trainer_attendance.index')active  @endif">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p> Attendance
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('student_attendance.index')}}" class="nav-link @if(Route::currentRouteName() == 'student_attendance.index')active  @endif">
                                <i class="nav-icon fas fa-circle" style="font-size:12px"></i>
                                <p>Student Attendance</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('trainer_attendance.index')}}" class="nav-link @if(Route::currentRouteName() == 'trainer_attendance.index')active  @endif">
                                <i class="nav-icon fas fa-circle" style="font-size:12px"></i>
                                <p>Trainer Attendance</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link @if(Route::currentRouteName() == 'user.index')active  @endif">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link @if(Route::currentRouteName() == 'roles.index')active  @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('branch.index') }}" class="nav-link @if(Route::currentRouteName() == 'branch.index')active  @endif">
                        <i class="nav-icon fas fa-map-marker-alt"></i>
                        <p>Branch</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('course_material.index')}}" class="nav-link @if(Route::currentRouteName() == 'course_material.index')active  @endif">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>Course Material</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
