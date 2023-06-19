@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
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
                        <div class="card-header">
                            <div class="buttonAlign d-flex justify-content-between">
                                <h3 class="mb-1 page-title">Create New Course</h3>
                                <a href="{{ route('course.index') }}" class="btn btn-outline-primary float-right">Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('course.store')}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Course Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="course_name" class="form-control" placeholder="Add Course" required>
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <div class="col-sm-1"></div>
                                    <label for="subcourse" class="col-sm-2 col-form-label">SubCourse Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="sub_course_name[]" class="form-control"
                                               placeholder="Add SubCourse" required>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" name="add" id="add" class="btn btn-primary">Add More</button>
                                    </div>
                                </div>
                                <div class="form-group row clone-point">
                                    <div class="col-sm-3"></div>
                                    <label for="points" class="col-sm-1 col-form-label ">Points</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="point[0][]" data-id="0"  class="form-control points" placeholder="Add points" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" name="add_point" data-id="1" data-mid="0" class="btn btn-primary add-point btn-star">+</button>
                                    </div>
                                </div>
                                <div id="dynamic_point_field_0">

                                </div>
                                <div class="dynamic_field">

                                </div><br>
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

@endsection
@push('scripts')
    <script>
        $(function () {
            var i = 0;
            var j = 1;
            $("#add").click(function () {
                i++;
                let html = '<div class="form-group row remove' + i + '" >'
                html += '<div class="col-sm-1"></div>'
                html += '<label for="subcourse" class="col-sm-2 col-form-label">Sub Course Name</label>'
                html += '<div class="col-sm-8">'
                html += '<input type="text" name="sub_course_name[]" class="form-control" placeholder="Add SubCourse" required>'
                html += '</div>'
                html += '<div class="col-sm-1">'
                html += '<button type="button" name="add" class="btn btn-danger btn_remove" id="' + i + '">X</button>'
                html += '</div>'
                html += '</div>'
                html += '<div class="form-group row remove' + i + ' clone-point">'
                html += '<div class="col-sm-3"></div>'
                html += '<label for="points" class="col-sm-1 col-form-label">Points</label>'
                html += '<div class="col-sm-5">'
                html += '<input type="text" name="point[' + i + '][]" data-id="' + i + '"  class="form-control points" placeholder="Add points" required>'
                html += '</div>'
                html += '<div class="col-sm-3">'
                html += '<button type="button" name="add_point" data-id="' + j + '" data-mid="' + i + '" class="btn btn-primary add-point btn-star p_' + i + '">+</button>'
                html += '</div>'
                html += '</div>'
                html += '<div id="dynamic_point_field_' + i + '"></div>'
                $('.dynamic_field').append(html);
            });

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('.remove' + button_id + '').remove();
            });

            $(document).on('click', ".add-point", function () {
                let id = parseInt($(this).data('id'));
                let mid = parseInt($(this).data('mid'));
                console.log(id, $(this).data('mid'))
                id++
                var ele = $(this).closest('.clone-point').clone(true).appendTo('#dynamic_point_field_' + mid);
                // $(this).closest('.clone-point').after(ele);
                ele.find('.btn-star').removeClass('add-point').removeClass('btn-primary').addClass('btn-danger').addClass('point_remove').html('-')
                ele.find('.points').val("")
                $(this).data('id', id)
            })
            $(document).on('click', '.point_remove', function () {
                $(this).closest('.clone-point').remove();
            });
        });
    </script>
@endpush
