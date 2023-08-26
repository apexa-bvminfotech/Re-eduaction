@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-12">
                    <div class="col-sm-6">
                        <h1>Student PTM Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('student_ptm.index') }}">Show Student PTM List</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Student:</b> {{ $data->studentName }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <h5><i class="fas fa-calendar mr-1"></i> Date</h5>
                        <p class="text-muted">
                            {{ Carbon\Carbon::parse($data->date)->format('d-m-Y') }}
                        </p>
                        <hr>

                        <h5><i class="fas fa-hand-point-right mr-1"></i><b> Effort & Improvement</b></h5>
                        <p class="text-muted">
                            {!! $data->effort_improvement !!}
                        </p>
                        <hr>

                        <h5><i class="fas fa-hand-point-right mr-1"></i><b> Next Month's Plan </b></h5>
                        <p class="text-muted">
                            {!! $data->next_month_plan  !!}
                        </p>
                        <hr>

                        <h5><i class="fas fa-hand-point-right mr-1"></i><b> Suggestion to Parents </b></h5>
                        <p class="text-muted">
                            {!! $data->suggestion_to_parents !!}
                        </p>
                        <hr>

                        <h5><i class="fas fa-hand-point-right mr-1"></i><b> Suggestion by Parents </b></h5>
                        <p class="text-muted">
                            {!! $data->suggestion_by_parents !!}
                        </p>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
    </div>
@endsection


