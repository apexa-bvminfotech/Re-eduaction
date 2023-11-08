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
                        <div class="card-body">
                            <div class="card">
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
                                            <th>Report description</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1.</td>
                                                <td><a href="{{ route('report.trainer-wise-student-rtc-regular-slot') }}">Branch wise regular trainer slot with student list</a></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td><a href="{{ route('report.trainer-wise-student-rtc-proxy-slot') }}">Branch wise proxy trainer slot with student list</a></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td><a href="{{ route('report.course-wise-student-list') }}">Course wise Student List</a></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td><a href="{{ route('report.student-list') }}">Student List</a></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>5.</td>
                                                <td><a href="{{ route('report.pending-appreciation-student-list') }}">Pending appreciation Student List</a></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>6.</td>
                                                <td><a href="{{ route('report.pending-course-student-list') }}">Pending Course Student List</a></td>
                                                <td></td>
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
