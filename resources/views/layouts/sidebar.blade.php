<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link" style="display: flex;
    justify-content: space-around;background: #fff">
        <img src="{{ asset('assets/img') }}/re-education.jpg" alt="AdminLTE Logo" style="max-height: 30px;width: 165px;">
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(\Illuminate\Support\Facades\Auth::user()->type == 2)
                    <li class="nav-item">
                        <a href="{{route('studentdashboard.index')}}" class="nav-link @if(Route::currentRouteName() == 'studentdashboard.index')active  @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p> Dashboard</p>
                        </a>
                    </li>
                @else
                    @if(\Illuminate\Support\Facades\Auth::user()->type == 1)
                        <li class="nav-item">
                            <a href="{{route('trainerdashboard.index')}}" class="nav-link @if(Route::currentRouteName() == 'trainerdashboard.index')active  @endif">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p> Trainer Dashboard</p>
                            </a>
                        </li>
                    @endif
                    {{-- @if(\Illuminate\Support\Facades\Auth::user()->type == 1) --}}
                        <li class="nav-item">
                            <a href="{{route('trainer.weekly.schedule')}}" class="nav-link @if(Route::currentRouteName() == 'trainer.weekly.schedule')active  @endif">
                                <i class="nav-icon fas fa-calendar"></i>
                                <p> Trainer Weekly Schedule</p>
                            </a>
                        </li>
                    {{-- @endif --}}
                    @if(\Illuminate\Support\Facades\Auth::user()->type == 0 || \Illuminate\Support\Facades\Auth::user()->type == 3)
                        <li class="nav-item">
                            <a href="{{route('admindashboard.index')}}" class="nav-link @if(Route::currentRouteName() == 'admindashboard.index')active  @endif">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>Admin Dashboard</p>
                            </a>
                        </li>
                    @endif
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
                            @if(\Illuminate\Support\Facades\Auth::user()->type == 0)
                                <li class="nav-item">
                                    <a href="{{route('trainer_attendance.index')}}" class="nav-link @if(Route::currentRouteName() == 'trainer_attendance.index')active  @endif">
                                        <i class="nav-icon fas fa-circle" style="font-size:12px"></i>
                                        <p>Trainer Attendance</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    @if(\Illuminate\Support\Facades\Auth::user()->type == 0 || \Illuminate\Support\Facades\Auth::user()->type == 3)
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
                            <a href="{{route('course.index')}}" class="nav-link @if(Route::currentRouteName() == 'course.index')active  @endif">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>Course</p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{route('course_material.index')}}" class="nav-link @if(Route::currentRouteName() == 'course_material.index')active  @endif">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>Course Material</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('report.report-list')}}" class="nav-link @if(Route::currentRouteName() == 'report.report-list')active  @endif">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>Reports list</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file"></i>
                            <p> Reports
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            @can('course-wise-student-report')
                                <li class="nav-item">
                                    <a href="{{ route('report.course-wise-student-list') }}" class="nav-link @if(Route::currentRouteName() == 'report.course-wise-student-list')active  @endif">
                                        <i class="nav-icon fas fa-circle" style="font-size:12px"></i>
                                        <p>Course wise Student List</p>
                                    </a>
                                </li>
                            @endcan
                            @can('student-list-report')
                                <li class="nav-item">
                                    <a href="{{ route('report.student-list') }}" class="nav-link @if(Route::currentRouteName() == 'report.student-list')active  @endif">
                                        <i class="nav-icon fas fa-circle" style="font-size:12px"></i>
                                        <p>Student List</p>
                                    </a>
                                </li>
                            @endcan
                            @can('pending-appreciation-student-list-report')
                                <li class="nav-item">
                                    <a href="{{ route('report.pending-appreciation-student-list') }}" class="nav-link @if(Route::currentRouteName() == 'report.pending-appreciation-student-list')active  @endif">
                                        <i class="nav-icon fas fa-circle" style="font-size:12px"></i>
                                        <p>Pending appreciation Student List</p>
                                    </a>
                                </li>
                            @endcan
                            @can('pending-course-student-list-report')
                                <li class="nav-item">
                                    <a href="{{ route('report.pending-course-student-list') }}" class="nav-link @if(Route::currentRouteName() == 'report.pending-course-student-list')active  @endif">
                                        <i class="nav-icon fas fa-circle" style="font-size:12px"></i>
                                        <p>Pending Course Student List</p>
                                    </a>
                                </li>
                            @endcan
                            @can('student-list-with-course-detail-report')
                                <li class="nav-item">
                                    <a href="{{ route('report.student-list-with-course-detail') }}" class="nav-link @if(Route::currentRouteName() == 'report.student-list-with-course-detail')active  @endif">
                                        <i class="nav-icon fas fa-circle" style="font-size:12px"></i>
                                        <p>Student List with Course Detail</p>
                                    </a>
                                </li>
                            @endcan
                            @can('pending-counselling-student-list-report')
                                <li class="nav-item">
                                    <a href="{{ route('report.pending-counselling-student-list') }}" class="nav-link @if(Route::currentRouteName() == 'report.pending-counselling-student-list')active  @endif">
                                        <i class="nav-icon fas fa-circle" style="font-size:12px"></i>
                                        <p>Pending Counselling/Report/Key point Student List</p>
                                    </a>
                                </li>
                            @endcan
                            @can('pending-material-list-student-list-report')
                                <li class="nav-item">
                                    <a href="{{ route('report.pending-material-list-student-list') }}" class="nav-link @if(Route::currentRouteName() == 'report.pending-material-list-student-list')active  @endif">
                                        <i class="nav-icon fas fa-circle" style="font-size:12px"></i>
                                        <p>Pending Material List Student List</p>
                                    </a>
                                </li>
                            @endcan
                            @can('student-status-list-report')
                                <li class="nav-item">
                                    <a href="{{ route('report.student-status-list') }}" class="nav-link @if(Route::currentRouteName() == 'report.student-status-list')active  @endif">
                                        <i class="nav-icon fas fa-circle" style="font-size:12px"></i>
                                        <p>Student Status List</p>
                                    </a>
                                </li>
                            @endcan
                            <li class="nav-item">
                                <a href="{{ route('report.weekly-student-list-with-trainer') }}" class="nav-link @if(Route::currentRouteName() == 'report.weekly-student-list-with-trainer')active  @endif">
                                    <i class="nav-icon fas fa-circle" style="font-size:12px"></i>
                                    <p>Weekely Student List with Trainer</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('report.sloatwisestudent') }}" class="nav-link @if(Route::currentRouteName() == 'report.sloatwisestudent')active  @endif">
                                    <i class="nav-icon fas fa-circle" style="font-size:12px"></i>
                                    <p>Regular Sloat Wise Student List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('report.Proxysloatwisestudent') }}" class="nav-link @if(Route::currentRouteName() == 'report.Proxysloatwisestudent')active  @endif">
                                    <i class="nav-icon fas fa-circle" style="font-size:12px"></i>
                                    <p>Proxy Sloat Wise Student List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('report.transfer-student-transfer-trainer-list') }}" class="nav-link @if(Route::currentRouteName() == 'report.transfer-student-transfer-trainer-list')active  @endif">
                                    <i class="nav-icon fas fa-circle" style="font-size:12px"></i>
                                    <p>Transfer Student / Transfer Trainer List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('report.student-data') }}" class="nav-link @if(Route::currentRouteName() == 'report.transfer-student-transfer-trainer-list')active  @endif">
                                    <i class="nav-icon fas fa-circle" style="font-size:12px"></i>
                                    <p>Student </p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                    {{--                            @can('trainer-wise-student-Rtc-slot-report')--}}
{{--                                <li class="nav-item">--}}
{{--                                        <a href="{{ route('report.trainer-wise-student-rtc-regular-slot') }}" class="nav-link @if(Route::currentRouteName() == 'report.trainer-wise-student-rtc-regular-slot')active  @endif">--}}
{{--                                            <i class="nav-icon fas fa-circle" style="font-size:12px"></i>--}}
{{--                                            <p>Trainer wise student/RTC/Regular slot</p>--}}
{{--                                        </a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                            @can('trainer-wise-student-Rtc-slot-report')--}}
{{--                                <li class="nav-item">--}}
{{--                                        <a href="{{ route('report.trainer-wise-student-rtc-proxy-slot') }}" class="nav-link @if(Route::currentRouteName() == 'report.trainer-wise-student-rtc-proxy-slot')active  @endif">--}}
{{--                                            <i class="nav-icon fas fa-circle" style="font-size:12px"></i>--}}
{{--                                            <p>Trainer wise student/RTC/Proxy slot</p>--}}
{{--                                        </a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
                @endif
            </ul>
        </nav>
    </div>
</aside>
