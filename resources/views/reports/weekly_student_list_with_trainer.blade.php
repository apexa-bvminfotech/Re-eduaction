@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-8">
                        <h1>Weekly Student List with Trainer</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>    
        
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @foreach($trainerData as $trainerName => $slots)
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        @php
                                            $startDate = now()->startOfWeek();
                                            $endDate = now()->endOfWeek();
                                            $numberOfDays = 6;
                                        @endphp
                                        <thead>
                                            <tr>
                                                <th colspan="6"  style="background-color:lightgray"><b>Trainer Name : {{ $trainerName }}</b></th>
                                            </tr>
                                            <tr>
                                                @for ($day = 1; $day <= $numberOfDays; $day++)
                                                    <th class="text-center p-3">
                                                        {{ $startDate->format('d-m-Y') }}<br>
                                                        {{ $startDate->format('D') }}
                                                    </th>
                                                    @php
                                                        $startDate->addDay();
                                                    @endphp
                                                @endfor
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($slots as $slot)
                                                    @php
                                                        $sDate = now()->startOfMonth();
                                                        $eDate = now()->endOfMonth();
                                                        $numberOfDays = 6;
                                                    @endphp
                                                    <tr>
                                                        @for ($day = 1; $day <= $numberOfDays; $day++)
                                                            <td class="text-center p-5">
                                                                Slot Time :- {{ $slot['slot_time'] }}<br><br>
                                                                Students :- {{ implode(', ', $slot['students']) }}
                                                            </td>
                                                            @php
                                                                $sDate->addDay();
                                                            @endphp
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach    
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
