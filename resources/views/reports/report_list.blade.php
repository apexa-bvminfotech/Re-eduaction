@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-12">
                    <div class="col-sm-6">
                        <h1>Report List</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card bg-light">
                        <div class="card-body" style="display: flex;justify-content: center">
                            <div class="card w-50" >
                                <div class="card-header">
                                    <h3 class="card-title">Simple Full Width Table</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Report Title with link</th>
                                        </tr>
                                        </thead>
                                        <tbody>
{{--                                            <tr>--}}
{{--                                                <td>1.</td>--}}
{{--                                                <td><a href="{{ route('report.trainer-wise-student-rtc-regular-slot') }}">Branch wise regular trainer slot with student list</a></td>--}}
{{--                                                <td></td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>2.</td>--}}
{{--                                                <td><a href="{{ route('report.trainer-wise-student-rtc-proxy-slot') }}">Branch wise proxy trainer slot with student list</a></td>--}}
{{--                                                <td></td>--}}
{{--                                            </tr>--}}
                                            @can('course-wise-student-report')
                                                <tr>
                                                    <td>1.</td>
                                                    <td><a href="{{ route('report.course-wise-student-list') }}">Course wise Student List</a></td>
                                                </tr>
                                            @endcan
                                            @can('student-list-report')
                                                <tr>
                                                    <td>2.</td>
                                                    <td><a href="{{ route('report.student-list') }}">Student List</a></td>
                                                </tr>
                                            @endcan
                                            @can('pending-appreciation-student-list-report')
                                                <tr>
                                                    <td>3.</td>
                                                    <td><a href="{{ route('report.pending-appreciation-student-list') }}">Pending appreciation Student List</a></td>
                                                </tr>
                                            @endcan
                                            @can('pending-course-student-list-report')
                                                <tr>
                                                    <td>4.</td>
                                                    <td><a href="{{ route('report.pending-course-student-list') }}">Pending Course Student List</a></td>
                                                </tr>
                                            @endcan
                                            @can('student-list-with-course-detail-report')
                                                <tr>
                                                    <td>5.</td>
                                                    <td><a href="{{ route('report.student-list-with-course-detail') }}">Student List with Course Detail</a></td>
                                                </tr>
                                            @endcan
                                            @can('pending-counselling-student-list-report')
                                                <tr>
                                                    <td>6.</td>
                                                    <td><a href="{{ route('report.pending-counselling-student-list') }}">Pending Counselling/Report/Key point Student List</a></td>
                                                </tr>
                                            @endcan
                                            @can('pending-material-list-student-list-report')
                                                <tr>
                                                    <td>7.</td>
                                                    <td><a href="{{ route('report.pending-material-list-student-list') }}">Pending Material List Student List</a></td>
                                                </tr>
                                            @endcan
                                            @can('student-status-list-report')
                                                <tr>
                                                    <td>8.</td>
                                                    <td><a href="{{ route('report.student-status-list') }}">Student Status List</a></td>
                                                </tr>
                                            @endcan
                                            <tr>
                                                <td>9.</td>
                                                <td><a href="{{ route('report.weekly-student-list-with-trainer') }}">Weekely Student List with Trainer</a></td>
                                            </tr>
                                            <tr>
                                                <td>10.</td>
                                                <td><a href="{{ route('report.transfer-student-transfer-trainer-list') }}">Transfer Student / Transfer Trainer List</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
