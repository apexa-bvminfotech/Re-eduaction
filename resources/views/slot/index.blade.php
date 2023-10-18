@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Slot Management</h1>
                    </div>
                    <div class="col-sm-6 row input-group-append justify-content-end">
                        @can('slot-create')
                            <div class="col-md-3 text-right">
                                <a href="{{route('slot.create')}}" class="btn btn-primary"><i class="fa fa-plus pr-2"></i> Add</a>
                            </div>
                        @endcan
                        <div class="col-md-3">
                            <div class="btn-group submitter-group float-right">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Status</div>
                                </div>
                                <select class="form-control status-dropdown">
                                    <option value="0">Active</option>
                                    <option value="1">De Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>

        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th><span></span></th>
                                            <th>Trainer Name</th>
                                            <th>RTC Name</th>
                                            <th>Time</th>
                                            <th>WhatsApp group Name</th>
                                            @can('slot-edit')
                                                <th>Status</th>
                                                <th>Action</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($slot as $key => $s)
                                            <tr>
                                                <td>{{ $s->id }}</td>
                                                <td>{{$s->branch->name}}</td>
                                                <td>{{ $s->trainer->name }}</td>
                                                <td>{{$s->rtc->rtc_name}}</td>
                                                <td>{{ $s->slot_time }}</td>
                                                <td>{{$s->whatsapp_group_name}}</td>
                                                @can('slot-edit')
                                                    <td>
                                                        <span style="display: none">{{ $s->is_active }}</span>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" data-id="{{$s->id}}" class="custom-control-input checkStatus" id="c{{$key+1}}" {{ $s->is_active ? '' : 'checked' }}>
                                                            <label class="custom-control-label" for="c{{$key+1}}"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('slot.edit',$s->id) }}" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                                        @foreach($trainerAttendances as $key => $attendance)
                                                        @php
                                                            $slotId = [];
                                                        @endphp
                                                            @foreach($studentStaffAssign as $key => $studentStaff)
                                                                @if($attendance->trainer_id == $s->trainer_id && $attendance->slot_id == $s->id)
                                                                    @if($studentStaff->trainer_id == $s->trainer_id && $studentStaff->slot_id == $s->id && $studentStaff->is_active == '0')
                                                                        @if(!in_array($studentStaff->slot_id,$slotId))
                                                                            <button class="btn btn-secondary btn-proxy btn-sm mb-1 mt-1" data-slot-time="{{ $s->slot_time }}" value="{{ $s->id }}"
                                                                                data-rtc-id="{{ $s->rtc->id }}" data-branch-id="{{ $s->branch->id }}" data-whtsapp-grp="{{ $s->whatsapp_group_name }}"
                                                                                data-slot-id="{{ $s->id }}" data-old-trainer-id="{{ $s->trainer->id }}" data-trainer-id="{{ $s->trainer->id }}"> 
                                                                                Assign Proxy Trainer
                                                                            </button>
                                                                        @endif     
                                                                    @endif    
                                                                @endif
                                                                @php
                                                                    $slotId[] = $studentStaff->slot_id;
                                                                @endphp 
                                                            @endforeach   
                                                        @endforeach
                                                    </td>  
                                                @endcan
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <form id="assignProxySlotForm" action="{{ route('slot.submit-proxy-slot') }}" method="POST">
                                @csrf
                                <div class="modal fade" id="verticalModal1" tabindex="-1" role="dialog"
                                     aria-labelledby="verticalModalTitle"
                                     style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="verticalModalTitle">Assign ProxyTrainer</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="slot_time" class="form-control slot_time" value="">
                                                <input type="hidden" name="rtc_id" class="form-control rtc_id" value="">
                                                <input type="hidden" name="branch_id" class="form-control branch_id" value="">
                                                <input type="hidden" name="whatsapp_group_name" class="form-control whatsapp_group_name" value="">
                                                <input type="hidden" name="old_trainer_id" class="form-control old_trainer_id" value="">
                                                <input type="hidden" name="slot_id" class="form-control slot_id" value="">

                                                @php
                                                    $trainerId = [];
                                                @endphp

                                                <div class="col-md-12 mb-1">
                                                    <label for="name">Trainer Name(Proxy): </label>
                                                    <select class="form-control proxy_class select2 trainer_id" name="trainer_id" required>
                                                        <option value="0">------Select Trainer-----</option>
                                                        @foreach($trainers as $key =>$trainer)
                                                            @if($trainer->is_active == 0)
                                                                <option
                                                                    value="{{$trainer->id}}">{{$trainer->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div id="slotContainer" style="display: none;">
                                                    <div class="col-md-12 mb-1">
                                                        <div class="form-group">
                                                            <label for="slot_time">Slot:</label>
                                                            <input type="text" class="form-control" name="slot_time" class="slot_time" id="slot_time" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-1">
                                                    <div class="form-group">
                                                        <label for="start_date">Starting Date:</label>
                                                        <input type="date" class="form-control" name="starting_date"
                                                               value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}" max="{{date('Y-m-d')}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-1">
                                                    <div class="form-group">
                                                        <label for="end_date">Ending Date:</label>
                                                        <input type="date" class="form-control" name="ending_date"
                                                               value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}" max="{{date('Y-m-d')}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close
                                                </button>
                                                <button type="button" class="btn mb-2 btn-primary proxy_submit">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- /.card-body -->
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
            dataTable =  $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"],
                initComplete: function () {
                    this.api().columns([1]).every( function () {
                        var column = this;
                        var select = $('<select class="form-control select2"><option value="">All</option></select>')
                            .appendTo( $(column.header()).find('span').empty() )
                            .on({ 'change': function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false ).draw();

                                },
                                'click': function(e) {
                                    e.stopPropagation();
                                }
                            });
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        });
                    },
                    this.api().columns([6]).every( function () {
                            var column = this;
                            var val = 0;
                            $('.status-dropdown').on({ 'change': function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column.column(6).search(val).draw();
                                },
                            });
                            column.column(6).search(val).draw();
                        })
                    );
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


            $(document).on('change', '.checkStatus', function() {
                var status = $(this).prop('checked') == true ? 0 : 1;
                var slot_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: '/changeSlotStatus',
                    data: {'status': status, 'slot_id': slot_id},
                    success: function (data) {
                        toastr.options =
                            {
                                "closeButton" : true,
                                "progressBar" : true
                            }
                        if(status){
                            toastr.error(data.success);
                        } else {
                            toastr.success(data.success);
                        }
                    }
                });
            });
        });

        //assign proxy staff 
        $(document).on('click', '.btn-proxy', function () {
            $('#verticalModal1').modal('toggle');
            let slottime = $(this).data('slot-time');
            let rtcId = $(this).data('rtc-id');
            let branchId = $(this).data('branch-id');
            let whtsappGrp = $(this).data('whtsapp-grp');
            let slotId = $(this).data('slot-id');
            let oldTrainerId = $(this).data('old-trainer-id');
            
            $('.slot_time').val(slottime);
            $('.rtc_id').val(rtcId);
            $('.branch_id').val(branchId);
            $('.whatsapp_group_name').val(whtsappGrp);
            $('.slot_id').val(slotId);
            $('.old_trainer_id').val(oldTrainerId);

        });

        $(document).on('change', '.trainer_id', function(){
            let trainerId = $(this).val();
            let slotTime = $('.slot_time').val();
            let rtcId = $('.rtc_id').val();
            let branchId = $('.branch_id').val();
            let whtsappGrp = $('.whatsapp_group_name').val();

            $.ajax({
                url: "{{ route('slot.assign-proxy-slot') }}",
                type: 'GET',
                data: {
                    'slot_time': slotTime,
                    'trainer_id': trainerId,
                    'rtc_id': rtcId,
                    'branch_id': branchId,
                    'whatsapp_group_name': whtsappGrp,
                },
                success: function (data) {
                    $('#slotContainer').show();
                    $('#slot_time').val(slotTime);
                },
            })
        });
        
        $(document).on('click', '.proxy_submit', function () {
            $('#assignProxySlotForm').submit();
        });
    </script>
@endpush
