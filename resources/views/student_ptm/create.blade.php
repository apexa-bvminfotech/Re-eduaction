@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create New PTM</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('student_ptm.index') }}">Show RTC List</a></li>
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
                            {!! Form::open(array('route' => 'student_ptm.store','method'=>'POST', 'id' => 'quickForm')) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-1">
                                        <div class="form-group">
                                            <label for="name">Student</label>
                                            <select class="form-control select2" name="student_id">
                                                <option value="">Select Student</option>
                                                @foreach($students as $key => $b)
                                                    <option value="{{ $b->id }}" {{old('student_id') == $b->id?'selected':''}}>{{ $b->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('student_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <div class="form-group">
                                            <label for="name">Trainer</label>
                                            <select class="form-control select2"
                                                    name="trainer_id" required>
                                                <option value="">Select Trainer</option>
                                                @foreach($trainers as $key => $b)
                                                    <option value="{{ $b->id }}" {{old('trainers_id') == $b->id?'selected':''}}>{{ $b->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('trainer_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="dob">Date</label>
                                            <input type="date" class="form-control" name="date"
                                                   placeholder="enter birthdate"
                                                   value="{{ old('dob',date('Y-m-d')) }}" id="dob">
                                            @error('date')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label>Effort & Improvement</label>
                                            <textarea id="summernote1" name="effort_improvement">{{ old('effort_improvement') }}</textarea>
                                            @error('effort_improvement')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label>Next Month's Plan</label>
                                            <textarea id="summernote2" name="next_month_plan" >{{ old('next_month_plan') }}</textarea>
                                            @error('next_month_plan')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label >Suggestion to Parents</label>
                                            <textarea id="summernote3" name="suggestion_to_parents">{{ old('suggestion_to_parents') }}</textarea>
                                            @error('suggestion_to_parents')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label >Suggestion by Parents</label>
                                            <textarea id="summernote4" name="suggestion_by_parents">{{ old('suggestion_by_parents') }}</textarea>
                                            @error('suggestion_by_parents')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer justify-content-end d-flex" >
                                <button type="submit" class="btn btn-primary mr-2">Create</button>
                                <a href="{{ route('rtc.index') }}" class="btn btn-danger">Cancel</a>
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

            var form = $('#quickForm');
            var validator = form.validate({
                rules : {
                    date : {
                        required: true,
                    },
                    student_id : {
                        required: true,
                    },
                    trainer_id : {
                        required: true,
                    }
                },
                messages: {
                    date: {
                        required: 'Please select Date',
                    },
                    student_id: {
                        required: 'Please select Student ',
                    },
                    trainer_id: {
                        required: 'Please select Trainer ',
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).closest('.form-check').addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush