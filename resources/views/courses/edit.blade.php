@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Course Update</h1>
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
                                    <form action="{{route('course.update',$course->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <div class="col-sm-1"></div>
                                            <label for="inputEmail3" class="col-sm-1 col-form-label">Course Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="course_name" class="form-control"
                                                       placeholder="Add Course"
                                                       value="{{ old('course_name', $course->course_name) }}">
                                            </div>
                                            @error('course_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                            <div class="col-sm-1">
                                                <button type="button" name="add" id="add" class="btn btn-primary add">
                                                    Add SubCourse
                                                </button>
                                            </div>
                                        </div>

                                        @php
                                            $count=0;
                                        @endphp
                                        @foreach($course->subCourses as $key => $subCourse)
                                            @php
                                                $count++;
                                            @endphp
                                            <div class="form-group row remove{{$count}}">
                                                <div class="col-sm-2"></div>
                                                <label for="subcourse" class="col-sm-1 col-form-label">SubCourse
                                                    Name</label>
                                                <div class="col-sm-7">

                                                    <input type="text" name="sub_course_name[{{$count}}][name]"
                                                           class="form-control"
                                                           value="{{ old('sub_course_name.' . $count . '.name', $subCourse->sub_course_name) }}">
                                                    <input type="hidden" name="sub_course_name[{{$count}}][id]"
                                                           class="form-control"
                                                           value="{{$subCourse->id}}">
                                                </div>
                                                <div class="col-sm-0">
                                                    <button type="button" name="add"
                                                            class="btn btn-danger btn_remove"
                                                            data-url="{{route('subCourse.destroy',$subCourse->id)}}"
                                                            data-id="{{$count}}">X
                                                    </button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button type="button" name="add_point" data-id="{{ $subCourse->points()->count() }}"
                                                            data-mid="{{$count}}"
                                                            class="btn btn-primary add-point btn-star">Add Point
                                                    </button>
                                                </div>
                                            </div>
                                            @php
                                                $ncount=0;
                                                $incPoint = $subCourse->points->count();
                                            @endphp
                                            @foreach($subCourse->points as $key1 => $point)
                                                @php
                                                    $ncount++;
                                                @endphp

                                                <div class="form-group row clone-points remove{{$count}}">
                                                    <div class="col-sm-3"></div>
                                                    <label for="points" class="col-sm-1 col-form-label ">Points</label>
                                                    <div class="col-sm-5 clone-points">
                                                        <input type="text"
                                                               name="sub_course_name[{{$count}}][point][{{$ncount}}][name]"
                                                               class="form-control point-rmv"
                                                               value="{{ old('sub_course_name.' . $count . '.point.' . $ncount . '.name', $point->sub_point_name) }}"
                                                               data-id="{{$ncount}}">
                                                        <input type="hidden"
                                                               name="sub_course_name[{{$count}}][point][{{$ncount}}][id]"
                                                               class="form-control point-id"
                                                               value="{{$point->id}}">
                                                    </div>


                                                    <div class="col-sm-1">
                                                        <button type="button" name="add"
                                                                class="btn btn-danger edit_btn_remove"
                                                                data-url="{{route('point.destroy',$point->id)}}">X
                                                        </button>
                                                    </div>

                                                </div>
                                            @endforeach
                                            <div id="dynamic_point_field_{{$count}}">

                                            </div>
                                        @endforeach

                                        <div class="dynamic_field">

                                        </div>
                                        <div class="form-group mb-2 float-right">
                                            <button type="submit" class="btn btn-success mr-2">Update</button>
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
            var i = "{{$count}}";
            var j = 1;
            $(".add").click(function () {
                i++;

                let html = '<div class="form-group row remove' + i + '" >'
                html += '<div class="col-sm-2"></div>'
                html += '<label for="subcourse" class="col-sm-1 col-form-label">Sub Course Name</label>'
                html += '<div class="col-sm-7">'
                html += '<input type="text" name="sub_course_name[' + i + '][name]" class="form-control" value="{{ old("sub_course_name.' + i + '.name") }}" placeholder="Add SubCourse" required>'
                html += '<input type="hidden" name="sub_course_name[' + i + '][id]" class="form-control" value="">'
                html += '</div>'
                html += '<div class="col-sm-0">'
                html += '<button type="button" name="add" class="btn btn-danger btn_remove" data-id="' + i + '" data-url="">X</button>'
                html += '</div>'
                html += '<div class="col-sm-1">'
                html += '<button type="button" name="add_point" data-id="' + j + '" data-mid="' + i + '" class="btn btn-primary add-point btn-star">Add Point</button>'
                html += '</div>'
                html += '</div>'
                html += '<div class="form-group row remove' + i + '  clone-points">'
                html += '<div class="col-sm-3"></div>'
                html += '</div>'
                html += '<div id="dynamic_point_field_' + i + '"></div>'
                $('.dynamic_field').append(html);

            });

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).data("id");
                let url = $(this).data('url')
                console.log(url)
                if (url != "") {
                    $.ajax({
                        url: url, // Replace "points" with the appropriate route URL for deleting a point
                        type: 'DELETE',
                        data: {
                            "_token": "{{csrf_token()}}",
                        },
                        success: function () {
                            console.log("SubCourse deleted successfully.");
                        }
                    });
                }
                $('.remove' + button_id + '').remove();
            });


            $(document).on('click', ".add-point", function () {

                let id = parseInt($(this).data('id'));
                let mid = parseInt($(this).data('mid'));
                let html = '<div class="form-group row remove' + mid + ' clone-points">'
                html += '<div class="col-sm-3"></div>'
                html += '<label for="points" class="col-sm-1 col-form-label">Points</label>'
                html += '<div class="col-sm-5">'
                html += '<input type="text" name="point[' + mid + '][]" data-id="' + mid + '"  class="form-control points " value="{{ old("point.' + i + '") }}" placeholder="Add points" required>'
                html += '</div>'
                html += '<div class="col-sm-3">'
                html += '<button type="button" name="point_remove" data-id="' + id + '" data-mid="' + mid + '" class="btn btn-danger edit_btn_remove btn-star p_' + mid + '">X</button>'
                html += '</div>'
                html += '</div>'
                id++;
                $('#dynamic_point_field_' + mid).append(html);
                $(this).data('id', id)
            });

            $(document).on('click', '.points-rmv', function () {
                $(this).closest('.clone-points').remove();
            })

            $(document).on('click', '.edit_btn_remove', function () {
                let url = $(this).data('url')
                console.log(url)
                if (url != "") {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            "_token": "{{csrf_token()}}",
                        },
                        success: function () {
                            console.log("Point deleted successfully.");
                        }
                    });
                }
                $(this).closest('.clone-points').remove();
            });
        });

    </script>
@endpush
