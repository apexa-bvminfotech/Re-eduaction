@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit New PTM</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('student_ptm.index') }}">Show student PTM List</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            {!! Form::model($ptmData, ['method' => 'PATCH','route' => ['student_ptm.update', $ptmData->id]]) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-1">
                                        <div class="form-group">
                                            <label for="name">Student</label>
                                            <select class="form-control select2" name="student_id">
                                                <option value="">Select Student</option>
                                                @foreach($students as $key => $b)
                                                    <option value="{{ $b->id }}" {{$ptmData->student_id == $b->id?'selected':''}}>{{ $b->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <div class="form-group">
                                            <label for="name">Trainer</label>
                                            <select class="form-control select2"
                                                    name="trainer_id">
                                                <option value="">Select Trainer</option>
                                                @foreach($trainers as $key => $b)
                                                    <option value="{{ $b->id }}" {{$ptmData->trainer_id == $b->id?'selected':''}}>{{ $b->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="dob">Date</label>
                                            <input type="date" class="form-control" name="date"
                                                   placeholder="enter birthdate"
                                                   value="{{Carbon\Carbon::parse($ptmData->date)->format('Y-m-d')}}">
                                            @error('date')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label>Effort & Improvement</label>
                                            <textarea id="summernote1" name="effort_improvement">{{ $ptmData->effort_improvement }}</textarea>
                                            @error('effort_improvement')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label>Next Month's Plan</label>
                                            <textarea id="summernote2" name="next_month_plan" >{{ $ptmData->next_month_plan }}</textarea>
                                            @error('next_month_plan')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label >Suggestion to Parents</label>
                                            <textarea id="summernote3" name="suggestion_to_parents">{{ $ptmData->suggestion_to_parents }}</textarea>
                                            @error('suggestion_to_parents')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label >Suggestion by Parents</label>
                                            <textarea id="summernote4" name="suggestion_by_parents">{{ $ptmData->suggestion_by_parents }}</textarea>
                                            @error('suggestion_by_parents')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer justify-content-end d-flex" >
                                <button type="submit" class="btn btn-primary mr-2">Edit</button>
                                <a href="{{ route('student_ptm.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#summernote1').summernote({
                height: 200
            });
            $('#summernote2').summernote({
                height: 200
            });
            $('#summernote3').summernote({
                height: 200
            });
            $('#summernote4').summernote({
                height: 200
            });
        });
    </script>
@endpush
