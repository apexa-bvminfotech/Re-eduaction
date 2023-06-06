@extends('layouts.header')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="buttonAlign">
                    <h2 class="mb-2 page-title">Show Staff</h2>
                    <a href="{{ route('staff.index') }}" class="btn btn-primary">Back</a>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body shadow p-3 bg-white rounded">
                                <img
                                    src="https://static-prod.adweek.com/wp-content/uploads/2023/01/WhatsApp-Avatar-Profile-Photo-Hero-652x367.png"
                                    class="card-img-top " alt="..." width="50px" height="250px">
                                <div class="card-body">
                                    <h3 class="card-title" style="text-align: center">{{$staff->staff_name}}</h3>
                                    <p class="card-text">This is a wider card with supporting text below as a
                                        natural lead-in to additional content. This content is a little bit
                                        longer.</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card shadow rounded">
                            <table class="table table-borderless">
                                <tr style="border-bottom:1px solid lightgray">
                                    <th><b>Employee ID:</b></th>
                                    <td>{{$staff->employee_ID}}</td>
                                </tr>
                                <tr style="border-bottom:1px solid lightgray">
                                    <th><b>First Name:</b></th>
                                    <td>{{$staff->first_name}}</td>
                                </tr>
                                <tr style="border-bottom:1px solid lightgray">
                                    <th><b>Name:</b></th>
                                    <td>{{$staff->staff_name}}</td>
                                </tr>
                                <tr style="border-bottom:1px solid lightgray">
                                    <th><b>Father Name:</b></th>
                                    <td>{{$staff->father_name}}</td>
                                </tr>
                                <tr style="border-bottom:1px solid lightgray">
                                    <th><b>Phone:</b></th>
                                    <td>{{$staff->eme_phone}}</td>
                                </tr>
                                <tr style="border-bottom:1px solid lightgray">
                                    <th><b>Emergency Phone:</b></th>
                                    <td>{{$staff->eme_phone}}</td>
                                </tr>
                                <tr style="border-bottom:1px solid lightgray">
                                    <th><b>Email:</b></th>
                                    <td>{{$staff->user->email}}</td>
                                </tr>
                                <tr style="border-bottom:1px solid lightgray">
                                    <th><b>Address:</b></th>
                                    <td>{{$staff->staff_address}}</td>
                                </tr>
                                <tr style="border-bottom:1px solid lightgray">
                                    <th><b>Staff I-card:</b></th>
                                    <td>{{$staff->staff_I_card}}</td>
                                </tr>
                                <tr style="border-bottom:1px solid lightgray">
                                    <th><b>Staff Uniform:</b></th>
                                    <td>{{$staff->staff_uniform}}</td>
                                </tr>
                                <tr>
                                    @php
                                        $course_ids = json_decode($staff->course_id);
                                    @endphp
                                    <th><b>Courses:</b></th>

                                    <td>
                                        @foreach($course_ids as $c)
                                            @php
                                                $course =\App\Models\Course::where('id',$c)->first();
                                            @endphp
                                            <ul style="margin-left: -25px">
                                                <li>{{$course->course_name}},</li>
                                            </ul>
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div><a href="{{ route('staff.edit',$staff->id) }}" class="btn btn-outline-info mt-2 " title="Edit">Edit</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
