@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-12">
                    <div class="col-sm-6">
                        <h1>Trainer Wise Student-Rtc-Regular-Slot Detail</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                @foreach ($trainerWiseData as $branch)
                    <div class="container-fluid">
                        <div class="card bg-light card-info">
                            <div class="card-header" style="display: flex;justify-content: space-between;">
                                <h3 class="card-title"><b>Branch Name :</b> {{ $branch->name }}</h3>
                                <h3 class="card-title"><b>Total Trainer :</b> {{ count($branch->trainer) }}</h3>
                            </div> 
                            @foreach($branch->trainer as $key => $trainerName)
                                <div class="card-body">
                                    <div class="card-header">
                                        <h3 class="card-title"><strong>Trainer Name : </strong> {{ $trainerName->surname }} {{ $trainerName->name }} </h3><br>
                                        <hr>
                                        @foreach ($trainerName->slots as $key => $slotTime)
                                            <div class="">
                                                <h3 class="card-title"><strong>Slot Time : </strong> {{ $slotTime->slot_time }} </h3><br>
                                                <h3 class="card-title"><strong>RTC Name : </strong> {{ $slotTime->rtc->rtc_name }} </h3><br>
                                                @if($slotTime->slotList->isEmpty())
                                                    <hr>  
                                                @endif
                                            </div>
                                            <div class="pt-2">
                                                @if($slotTime->slotList->isNotEmpty())
                                                    <div class="">
                                                        <table id="example1" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Student</th>
                                                                    <th>Meduim</th>
                                                                    <th>Standard</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    @foreach ($slotTime->slotList as $student)
                                                                        <tr>
                                                                            <td>{{ $student->student->name }} {{ $student->student->surname }}</td>
                                                                            <td> {{ $student->student->standard }}</td>
                                                                            <td> {{ $student->student->medium }}</td>
                                                                        </tr>              
                                                                    @endforeach
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>    
                                                    <hr>       
                                                @endif     
                                            </div> 
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection