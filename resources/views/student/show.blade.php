@extends('layouts.header')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <h2 class="h3 mb-4 page-title">Show Student </h2>
                <div class="my-4">
                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile" aria-selected="false">Security</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                               aria-controls="contact" aria-selected="false">Notifications</a>
                        </li>
                    </ul>
                    <form>
                        <div class="row mt-5 align-items-center">
                            <div class="col-md-3 text-center mb-5">
                                <div class="avatar avatar-xl">
                                    <img
                                        src="{{asset( $student->upload_student_image )}}"
                                        alt="..." class="avatar-img rounded-circle">
                                </div>
                            </div>
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h4 class="mb-1">{{$student->name}}</h4>
                                        <p class="small mb-3"><span class="badge badge-dark">New York, USA</span></p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-7">
                                        <p class="text-muted"> Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Mauris blandit nisl ullamcorper, rutrum metus in, congue lectus. In hac
                                            habitasse platea dictumst. Cras urna quam, malesuada vitae risus at, pretium
                                            blandit sapien. </p>
                                    </div>
                                    <div class="col">
                                        <p class="small mb-0 text-muted">Nec Urna Suscipit Ltd</p>
                                        <p class="small mb-0 text-muted">P.O. Box 464, 5975 Eget Avenue</p>
                                        <p class="small mb-0 text-muted">(537) 315-1481</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <table class="table table-borderless">
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>Surname:</b></th>
                                <td>{{$student->surname}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>Student Name:</b></th>
                                <td>{{$student->name}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>Father Name:</b></th>
                                <td>{{$student->father_name}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>Address:</b></th>
                                <td>{{$student->address}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>Gender:</b></th>
                                <td>{{$student->gender}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>Email ID:</b></th>
                                <td>{{$student->email_id}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>Father Contact No:</b></th>
                                <td>{{$student->father_contact_no}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>Mother Contact No:</b></th>
                                <td>{{$student->mother_contact_no}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>Standard:</b></th>
                                <td>{{$student->standard}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>Medium:</b></th>
                                <td>{{$student->medium}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>School Name:</b></th>
                                <td>{{$student->school_name}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>School Time:</b></th>
                                <td>{{$student->school_time}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>Extra Tuition Time:</b></th>
                                <td>{{$student->extra_tuition_time}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>Date Of Birth:</b></th>
                                <td>{{$student->dob}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>Age:</b></th>
                                <td>{{$student->age}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>Courses:</b></th>
                                <td>{{$student->course->course_name}}
                                </td>
                            </tr>

                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>Payment Condition:</b></th>
                                <td>{{$student->payment_condition}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid lightgray">
                                <th><b>Analysis Staff Name:</b></th>
                                <td>{{$student->staff->staff_name}}</td>
                            </tr>
                        </table>
                    </form>
                </div> <!-- /.card-body -->
            </div> <!-- /.col-12 -->
        </div> <!-- .row -->
    </div>
@endsection
