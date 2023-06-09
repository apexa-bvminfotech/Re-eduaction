@extends('layouts.admin')
@section('content')
<style>
    tr {
        border-top: 1px solid #ccc;
    }

    tr:first-child {
        border-top: 0;
    }

    tr > th {
        border-top: 0;
    }



</style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="buttonAlign">
                    <h2 class="mb-2 page-title">Show Staff</h2>
{{--                    <a href="{{ route('staff.index') }}" class="btn btn-primary">Back</a>--}}
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body shadow p-3 bg-white rounded">
                                <img
                                    src="https://static-prod.adweek.com/wp-content/uploads/2023/01/WhatsApp-Avatar-Profile-Photo-Hero-652x367.png"
                                    class="card-img-top " alt="..." width="50px" height="250px">
                                <div class="card-body">
                                    <h3 class="card-title text-center">{{ $staff->staff_name }}</h3>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="card shadow rounded">
                            <div class="row align-items-center ">
                                <div class="col"></div>
                                <div class="col-auto" style="padding-right: 25px;">
                                    <a href="{{ route('staff.edit',$staff->id) }}" class="btn btn-outline-info mt-2 " title="Edit"><i class="fa fa-edit"></i></a>
                                </div>
                            </div>
                            <table class="table table-borderless">
                                <tr>
                                    <th><b>Employee ID</b></th>
                                    <td>{{ $staff->employee_ID }}</td>
                                    <th><b>Name</b></th>
                                    <td>{{ $staff->first_name }}  {{ $staff->staff_name }}  {{ $staff->father_name }}</td>
                                </tr>
                                <tr>
                                    <th><b>Phone</b></th>
                                    <td>{{ $staff->eme_phone }}</td>
                                    <th><b>Emergency Phone</b></th>
                                    <td>{{ $staff->eme_phone }}</td>
                                </tr>
                                <tr>
                                    <th><b>Email</b></th>
                                    <td>{{ $staff->user->email }}</td>
                                    <th><b>Address</b></th>
                                    <td>{{ $staff->staff_address }}</td>
                                </tr>
                                <tr>
                                    <th><b>Staff I-card</b></th>
                                    <td>@if($staff->staff_I_card) <i class="fa fa-check-circle" style="font-size:23px;color:green"></i> @endif</td>
                                    <th><b>Staff Uniform</b></th>
                                    <td>@if($staff->staff_uniform) <i class="fa fa-check-circle" style="font-size:23px;color:green"></i> @endif</td>
                                </tr>
                                <tr>
                                    <th><b>Courses:</b></th>
                                    <td>
                                        <div class="mb-2">
                                            @foreach($course as $c)
                                                <button type="button" class="btn mb-2 btn-outline-primary" disabled="" style="color: #000;border-color: #080808;">{{ $c->course_name }}</button>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
