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
                                        {{-- {{ dd( $slot) }} --}}

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
                                                        <button class="btn btn-secondary btn-shift-regular-slot btn-sm mb-1 mt-1"
                                                            data-old-regular-slot-id="{{ $s->id }}" data-old-regular-trainer-id="{{ $s->trainer->id }}">
                                                            Shift As Regular Slot
                                                        </button>
                                                        <button class="btn btn-secondary btn-shift-proxy-slot btn-sm mb-1 mt-1"
                                                            data-old-proxy-slot-id="{{ $s->id }}" data-old-proxy-trainer-id="{{ $s->trainer->id }}">
                                                            Shift As Proxy Slot
                                                        </button>
                                                    </td>  
                                                @endcan
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- form for shift slot --}}
                            <form id="shiftRegularSlotForm" action="{{ route('slot.shift-regular-slot') }}" method="POST">
                                @csrf
                                <div class="modal fade" id="verticalModal" tabindex="-1" role="dialog"
                                     aria-labelledby="verticalModalTitle"
                                     style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="verticalModalTitle">Shift As Regular Slot</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="old_regular_trainer_id" class="form-control old_regular_trainer_id" value="">
                                                <input type="hidden" name="old_regular_slot_id" class="form-control old_regular_slot_id" value="">
                                                <div class="col-md-12 mb-1">
                                                    <label for="name">Trainer Name: </label>
                                                    <select name="trainer_id" class="form-control staff_id select2" required>
                                                        <option value="0">------Select Trainer-----</option>
                                                        @foreach($trainers as $key =>$trainer)
                                                            @if($trainer->is_active == 0)
                                                                <option
                                                                    value="{{$trainer->id}}" {{old('name')==$trainer->id}}>{{$trainer->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mb-1">
                                                    <label for="name">Slot: </label>
                                                    <select name="slot_id" class="form-control slot select2" required>
                                                        <option value="">------Select Slot-----</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close
                                                </button>
                                                <button type="button" class="btn mb-2 btn-primary btn-submit-regular-slot">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            {{-- form for shift proxy slot --}}
                            <form id="shiftProxySlotForm" action="{{ route('slot.submit-proxy-slot') }}" method="POST">
                                @csrf
                                <div class="modal fade" id="verticalModal1" tabindex="-1" role="dialog"
                                     aria-labelledby="verticalModalTitle"
                                     style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="verticalModalTitle">Shift As Proxy Slot</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="old_proxy_trainer_id" class="form-control old_proxy_trainer_id" value="">
                                                <input type="hidden" name="old_proxy_slot_id" class="form-control old_proxy_slot_id" value="">
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
                                                {{-- <div id="slotContainer" style="display: none;">
                                                    <div class="col-md-12 mb-1">
                                                        <div class="form-group">
                                                            <label for="slot_time">Slot:</label>
                                                            <input type="text" class="form-control" name="slot_time" class="slot_time" id="slot_time" value="">
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="col-md-12 mb-1">
                                                    <label for="name">Slot: </label>
                                                    <select class="form-control slot select2" name="slot_id" required>
                                                        <option value="">------Select Slot-----</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mb-1">
                                                    <div class="form-group">
                                                        <label for="start_date">Starting Date:</label>
                                                        <input type="date" class="form-control" name="starting_date"
                                                               value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-1">
                                                    <div class="form-group">
                                                        <label for="end_date">Ending Date:</label>
                                                        <input type="date" class="form-control" name="ending_date"
                                                               value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close
                                                </button>
                                                <button type="button" class="btn mb-2 btn-primary btn-submit-proxy-slot">Submit</button>
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

        //shift regular slot
        $(document).on('click', '.btn-shift-regular-slot', function () {
            let id = parseInt($(this).data('id'));
            $('.student_id').val(id)
            $('#verticalModal').modal('toggle')
            $('.staff_id').val($('.staff_id').children().eq(0).val());
            $('.slot').html('<option value="">------Select Slot-----</option>')
            let oldRegularSlotId = $(this).data('old-regular-slot-id');
            let oldRegularTrainerId = $(this).data('old-regular-trainer-id');
            $('.old_regular_slot_id').val(oldRegularSlotId);
            $('.old_regular_trainer_id').val(oldRegularTrainerId);
        });

        $(document).on('change', '.staff_id', function () {
            let staff = ($(this).val());
            if (staff != "") {
                $.ajax({
                    url: '/shift-regular-slot/' + staff,
                    type: 'GET',
                    data: {
                        "_token": "{{csrf_token()}}",
                    },
                    success: function (data) {
                        let slotOption = '<option value="">------Select Slot-----</option>'
                        $.each(data.slots, function (index, slot) {
                            slotOption += '<option value="' + slot.id + '">' + slot.slot_time + '  (' + slot.rtc.rtc_name + ')</option>'
                        })
                        $('.slot').html("")
                        $('.slot').html(slotOption)
                    }
                });
            }
        });

        $(document).on('click', '.btn-submit-regular-slot', function () {
            $('#shiftRegularSlotForm').submit();
        });

        //assign proxy staff 
        $(document).on('click', '.btn-shift-proxy-slot', function () {
            $('#verticalModal1').modal('toggle');
            $('.proxy_class').val($('.proxy_class').children().eq(0).val());
            $('.slot').html('<option value="">------Select Slot-----</option>')

            let oldProxySlotId = $(this).data('old-proxy-slot-id');
            let oldProxyTrainerId = $(this).data('old-proxy-trainer-id');
        
            $('.old_proxy_slot_id').val(oldProxySlotId);
            $('.old_proxy_trainer_id').val(oldProxyTrainerId);

        });

        $(document).on('change', '.proxy_class', function () {
            let proxy = ($(this).val());
            if (proxy != "") {
                $.ajax({
                    url: '/shift-proxy-slot/' + proxy,
                    type: 'GET',
                    data: {
                        "_token": "{{csrf_token()}}",
                    },
                    success: function (data) {
                        console.log("Slot display done.", data);
                        let slotOption = '<option value="">------Select Slot-----</option>';
                        $.each(data.slots, function (index, slot) {
                            slotOption += '<option value="' + slot.id + '">' + slot.slot_time + '  (' + slot.rtc.rtc_name + ')</option>';
                        })
                        $('.slot').html("")
                        $('.slot').html(slotOption)
                    }
                });
            }
        });
        
        $(document).on('click', '.btn-submit-proxy-slot', function () {
            $('#shiftProxySlotForm').submit();
        });
    </script>
@endpush
