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
                    <h2 class="mb-2 page-title">Show Trainer</h2>
{{--                                        <a href="{{ route('trainer.index') }}" class="btn btn-primary">Back</a>--}}
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="card shadow rounded">
                            <div class="row align-items-center ">
                                <div class="col"></div>
                                <div class="col-auto" style="padding-right: 25px;">
                                    <a href="{{ route('trainer.edit',$trainer->id) }}"
                                       class="btn btn-outline-info mt-2 "
                                       title="Edit"><i class="fa fa-edit"></i></a>
                                </div>
                            </div>
                            <table class="table table-borderless">
                                <tr>
                                    <th><b>Name</b></th>
                                    <td>{{ $trainer->name }}</td>
                                </tr>
                                <tr>
                                    <th><b>Branch Name</b></th>
                                    <td>{{ $trainer->branch->name }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

