@extends('layouts.header')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="buttonAlign">
                    <h2 class="mb-2 page-title">Edit Course</h2>
                    <a href="{{ route('course.index') }}" class="btn btn-primary">Back</a>
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
                <div class="card-deck col-12">
                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <form action="{{route('course.update',$course->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Course Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="course_name" class="form-control" placeholder="Add Course" value="{{ $course->course_name }}">
                                    </div>
                                </div>
                                @foreach($course->subCourses as $subCourse)
                                    <div class="form-group row ">
                                        <div class="col-sm-1"></div>
                                        <label for="subcourse" class="col-sm-2 col-form-label">SubCourse Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="edit_sub_course_name[{{$subCourse->id}}]" class="form-control"
                                                   value="{{$subCourse->sub_course_name}}">
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" name="add" id="add" class="btn btn-primary add">Add More</button>
                                        </div>
                                        {{--                                    <div class="col-sm-1">--}}
                                        {{--                                        <button type="button" name="delete" id="delete" class="btn btn-danger">-</button>--}}
                                        {{--                                    </div>--}}
                                    </div>
                                    @foreach($subCourse->points as $point)
                                        <div class="form-group row clone-points">
                                            <div class="col-sm-3"></div>
                                            <label for="points" class="col-sm-1 col-form-label ">Points</label>
                                            <div class="col-sm-5 clone-points">
                                                <input type="text" name="point[{{$subCourse->id}}][{{$point->id}}]"  data-id="{{$subCourse->id}}" class="form-control point-rmv" value="{{$point->sub_point_name}}">
                                            </div>
                                            {{--                                    <div class="col-sm-3">--}}
                                            {{--                                        <button type="button" name="add_point" data-id="{{$subCourse->id}}" class="btn btn-danger remove-point">-</button>--}}
                                            {{--                                    </div>--}}
                                            <div class="col-sm-3">
                                                <button type="button" name="add_point" data-id="{{$subCourse->id}}" class="btn btn-primary add-points btn-start">+</button>
                                            </div>

                                        </div>
                                    @endforeach
                                @endforeach
{{--                                                                <div class="form-group row ">--}}
{{--                                                                    <div class="col-sm-1"></div>--}}
{{--                                                                    <label for="subcourse" class="col-sm-2 col-form-label">SubCourse Name</label>--}}
{{--                                                                    <div class="col-sm-8">--}}
{{--                                                                        <input type="text" name="sub_course_name[]" class="form-control"--}}
{{--                                                                               placeholder="Add SubCourse">--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="form-group row clone-point">--}}
{{--                                                                    <div class="col-sm-3"></div>--}}
{{--                                                                    <label for="points" class="col-sm-1 col-form-label ">Points</label>--}}
{{--                                                                    <div class="col-sm-5">--}}
{{--                                                                        <input type="text" name="point[0][]"  data-id="0" class="form-control points" placeholder="Add points">--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="col-sm-3">--}}
{{--                                                                        <button type="button" name="add_point" data-id="0" class="btn btn-primary add-point btn-star">+</button>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
                                <div class="dynamic_field">

                                </div>
                                <div class="form-group mb-2 buttonEnd">
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
            var i = 0;
            $(".add").click(function () {
                i++;
                let html = '<div class="form-group row remove' + i + '" >'
                html += '<div class="col-sm-1"></div>'
                html += '<label for="subcourse" class="col-sm-2 col-form-label">Sub Course Name</label>'
                html += '<div class="col-sm-8">'
                html += '<input type="text" name="sub_course_name[]" class="form-control">'
                html += '</div>'
                html += '<div class="col-sm-1">'
                html += '<button type="button" name="add"  class="btn btn-danger btn_remove" id="' + i + '">X</button>'
                html += '</div>'
                html += '</div>'
                html += '<div class="form-group row remove' + i + '  clone-point">'
                html += '<div class="col-sm-3"></div>'
                html += '<label for="points" class="col-sm-1 col-form-label">Points</label>'
                html += '<div class="col-sm-5">'
                html += '<input type="text" name="point['+i+'][]" data-id="'+i+'"  class="form-control points">'
                html += '</div>'
                html += '<div class="col-sm-3">'
                html += '<button type="button" name="add_point"  data-id="'+i+'" class="btn btn-primary add-point btn-star">+</button>'
                html += '</div>'
                html += '</div>'
                $('.dynamic_field').append(html);
            });

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('.remove' + button_id + '').remove();
            });
            $(document).on('click',".add-point", function(){
                var ele = $(this).closest('.clone-point').clone(true);
                $(this).closest('.clone-point').after(ele);
                ele.find('.btn-star').removeClass('add-point').removeClass('btn-primary').addClass('btn-danger').addClass('point_remove').html('-')
                ele.find('.points').val("")
            })
            $(document).on('click', '.point_remove', function(){
                $(this).closest('.clone-point').remove();
            });
            $(document).on('click',".add-points", function(){
                var element = $(this).closest('.clone-points').clone(true);
                $(this).closest('.clone-points').after(element);
                element.find('.btn-start').removeClass('add-points').removeClass('btn-primary').addClass('btn-danger').addClass('points-rmv').html('-')
                element.find('.point-rmv').val("")
            })
            $(document).on('click','.points-rmv',function (){
                $(this).closest('.clone-points  ').remove();
            })
        });
    </script>
@endpush
