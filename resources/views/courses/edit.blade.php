@extends('layouts.admin')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($message = Session::get('danger'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if(session('status'))
        <h6 class="alert alert-success">{{session('status')}}</h6>
    @endif
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-deck col-12">
                    <div class="card shadow mb-3">
                        <div class="card-header">
                            <div class="buttonAlign d-flex justify-content-between">
                                <h2 class="mb-0 page-title">Edit Course</h2>
                                <a href="{{ route('course.index') }}" class="btn btn-primary float-right">Back</a>
                            </div>
                        </div>
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
                        <div class="card-body">
                            <form action="{{route('course.update',$course->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Course Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="course_name" class="form-control"
                                               placeholder="Add Course"
                                               value="{{ old('course_name', $course->course_name) }}">
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
                                        <div class="col-sm-1"></div>
                                        <label for="subcourse" class="col-sm-2 col-form-label">SubCourse Name</label>
                                        <div class="col-sm-8">

                                            <input type="text" name="sub_course_name[{{$count}}][name]"
                                                   class="form-control"
                                                   value="{{ old('sub_course_name.' . $count . '.name', $subCourse->sub_course_name) }}">
                                            <input type="hidden" name="sub_course_name[{{$count}}][id]"
                                                   class="form-control"
                                                   value="{{$subCourse->id}}">
                                        </div>
                                        @if($key == 0)
                                            <div class="col-sm-1">
                                                <button type="button" name="add" id="add" class="btn btn-primary add"
                                                        data-url="{{route('subCourse.destroy',$subCourse->id)}}">
                                                    Add More
                                                </button>
                                            </div>
                                        @else
                                            <div class="col-sm-1">
                                                <button type="button" name="add" class="btn btn-danger btn_remove"
                                                        data-url="{{route('subCourse.destroy',$subCourse->id)}}"
                                                        data-id="{{$count}}">X
                                                </button>
                                            </div>
                                        @endif

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
                                            @if($key1 == 0)
                                                <div class="col-sm-3">
                                                    <button type="button" name="add_point" data-id="{{$incPoint}}"
                                                            data-mid="{{$count}}"
                                                            class="btn btn-primary  add-points btn-start p_{{$count}}"
                                                            data-url="{{route('point.destroy',$point->id)}}">+
                                                    </button>
                                                </div>
                                            @else
                                                <div class="col-sm-1">
                                                    <button type="button" name="add"
                                                            class="btn btn-danger edit_btn_remove"
                                                            data-url="{{route('point.destroy',$point->id)}}">-
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                    <div id="dynamic_point_field_{{$count}}">

                                    </div>
                                @endforeach

                                <div class="dynamic_field">

                                </div>
                                <div class="form-group mb-2 float-right">
                                    <button type="submit" class="btn btn-primary mr-2">Update</button>
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
            var i = "{{$count}}";
            var j = 1;
            $(".add").click(function () {
                i++;

                let html = '<div class="form-group row remove' + i + '" >'
                html += '<div class="col-sm-1"></div>'
                html += '<label for="subcourse" class="col-sm-2 col-form-label">Sub Course Name</label>'
                html += '<div class="col-sm-8">'
                html += '<input type="text" name="sub_course_name[' + i + '][name]" class="form-control" value="{{ old("sub_course_name.' + i + '.name") }}">'
                html += '<input type="hidden" name="sub_course_name[' + i + '][id]" class="form-control" value="">'
                html += '</div>'
                html += '<div class="col-sm-1">'
                html += '<button type="button" name="add" class="btn btn-danger btn_remove" data-id="' + i + '" data-url="">X</button>'
                html += '</div>'
                html += '</div>'
                html += '<div class="form-group row remove' + i + '  clone-points">'
                html += '<div class="col-sm-3"></div>'
                html += '<label for="points" class="col-sm-1 col-form-label">Points</label>'
                html += '<div class="col-sm-5">'
                html += '<input type="text" name="sub_course_name[' + i + '][point][' + j + '][name]" data-id="' + i + '"  class="form-control point-rmv" value="{{ old("sub_course_name.' + i + '.point.' + j + '.name") }}">'
                html += '<input type="hidden" name="sub_course_name[' + i + '][point][' + j + '][id]" data-id="' + i + '"  class="form-control point-id" value="">'
                html += '</div>'
                html += '<div class="col-sm-3">'
                html += '<button type="button" name="add_point" data-id="' + j + '" data-mid="' + i + '" class="btn btn-primary add-points btn-start p_' + i + '" data-url="">+</button>'
                html += '</div>'
                html += '</div>'
                html += '  <div id="dynamic_point_field_' + i + '"></div>'
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


            $(document).on('click', ".add-points", function () {
                let id = parseInt($(this).data('id'));
                let mid = parseInt($(this).data('mid'));
                console.log(id, $(this).data('id'))
                id++;
                var element = $(this).closest('.clone-points').clone(true).appendTo('#dynamic_point_field_' + mid);
                element.find('.btn-start').removeClass('add-points').removeClass('btn-primary').addClass('btn-danger').addClass('points-rmv').addClass('edit_btn_remove').html('-').attr('data-url', "")
                element.find('.point-rmv').val("").attr('name', 'sub_course_name[' + mid + '][point][' + id + '][name]')
                element.find('.point-id').val("").attr('name', 'sub_course_name[' + mid + '][point][' + id + '][id]')
                $(this).data('id', id)

            })
            $(document).on('click', '.points-rmv', function () {
                let mid = parseInt($(this).data('mid'));
                let dId = parseInt($('.p_' + mid).data('id'))
                $('.p_' + mid).data('id', dId - 1)
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
