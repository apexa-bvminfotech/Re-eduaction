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
                        <h3 class="card-title"><b>Student:</b> {{ $studentPtm->name }}</h3>
                    </div>
                    @foreach ($studentPtm->studentptm as $sptm)
                        <div class="card-body" style="border-bottom: 1px solid #007BFF;">
                            <div class="d-flex bd-highlight">
                                <div class="p-2 w-100 bd-highlight">
                                    <h5><i class="fas fa-calendar mr-1"></i> Date</h5>
                                    <p class="text-muted">
                                        {{ Carbon\Carbon::parse($sptm->date)->format('d-m-Y') }}
                                    </p>
                                </div>
                                <div class="p-2 flex-shrink-1 bd-highlight">
                                    @can('student-PTM-edit')
                                    <a href="{{ route('student_ptm.edit',$sptm->id) }}"
                                            class="btn btn-success btn-sm" title="Edit"><i
                                                class="fa fa-edit"></i></a>
                                    @endcan
                                </div>
                              </div>
                            <hr>
                            <h5><i class="fas fa-hand-point-right mr-1"></i><b> Effort & Improvement</b></h5>
                            <p class="text-muted">
                                {!! $sptm->effort_improvement !!}
                            </p>
                            <hr>
                            <h5><i class="fas fa-hand-point-right mr-1"></i><b> Next Month's Plan </b></h5>
                            <p class="text-muted">
                                {!! $sptm->next_month_plan  !!}
                            </p>
                            <hr>
                            <h5><i class="fas fa-hand-point-right mr-1"></i><b> Suggestion to Parents </b></h5>
                            <p class="text-muted">
                                {!! $sptm->suggestion_to_parents !!}
                            </p>
                            <hr>
                            <h5><i class="fas fa-hand-point-right mr-1"></i><b> Suggestion by Parents </b></h5>
                            <p class="text-muted">
                                {!! $sptm->suggestion_by_parents !!}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection