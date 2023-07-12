@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Course Management</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('branch-create')
                            <a href="{{route('course.index')}}" class="btn btn-primary float-right">Back</a>
                        @endcan
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-deck col-12">
                            <div class="card shadow mb-3">
                                <div class="card-body">
                                    <form action="{{route('course.store')}}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm-0"></div>
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Course Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="course_name" class="form-control"
                                                       placeholder="Add Course" required>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" name="add" id="add" class="btn btn-primary">
                                                    Add SubCourse
                                                </button>
                                            </div>
                                        </div>

                                        <div class="dynamic_field"></div>
                                        <br>
                                        <div class="form-group mb-2  float-right">
                                            <button type="submit" class="btn btn-primary mr-1">Create</button>
                                            <a href="{{ route('course.index') }}" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            var i = 0;
            var j = 1;

            // Add Subcourse
            $("#add").click(function () {

                let html = '<div class="form-group row remove' + i + '" >'
                html += '<div class="col-sm-1"></div>'
                html += '<label for="subcourse" class="col-sm-2 col-form-label">Sub Course Name</label>'
                html += '<div class="col-sm-7">'
                html += '<input type="text" name="sub_course_name[]" class="form-control" placeholder="Add SubCourse" required>'
                html += '</div>'
                html += '<div class="col-sm-0">'
                html += '<button type="button" name="add" class="btn btn-danger btn_remove" id="' + i + '">X</button>'
                html += '</div>'
                html += '<div class="col-sm-1">'
                html += '<button type="button" name="add_point" data-id="' + j + '" data-mid="' + i + '" class="btn btn-primary add-point btn-star">Add Point</button>'
                html += '</div>'
                html += '</div>'
                html += '<div id="dynamic_point_field_' + i + '"></div>'
                $('.dynamic_field').append(html);
                i++;
            });

            // Remove Subcourse
            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('.remove' + button_id + '').remove();
            });

            // Add Point
            $(document).on('click', ".add-point", function () {
                let id = parseInt($(this).data('id'));
                let mid = parseInt($(this).data('mid'));
                let html = '<div class="form-group row remove' + mid + ' clone-point">'
                html += '<div class="col-sm-3"></div>'
                html += '<label for="points" class="col-sm-1 col-form-label">Points</label>'
                html += '<div class="col-sm-5">'
                html += '<input type="text" name="point[' + mid + '][]" data-id="' + mid + '"  class="form-control points" placeholder="Add points" required>'
                html += '</div>'
                html += '<div class="col-sm-3">'
                html += '<button type="button" name="point_remove" data-id="' + id + '" data-mid="' + mid + '" class="btn btn-danger point_remove btn-star p_' + mid + '">X</button>'
                html += '</div>'
                html += '</div>'
                id++;
                $('#dynamic_point_field_' + mid).append(html);
                $(this).data('id', id);
            });

            // Remove Point
            $(document).on('click', '.point_remove', function () {
                $(this).closest('.clone-point').remove();
            });
        });
    </script>
@endpush
