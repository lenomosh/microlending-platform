@extends('back.layout.main')
@section('css')
    <link rel="stylesheet" href="{{asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@stop
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Job Applications</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Applications</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-success alert-dismissible" hidden="hidden" id="res"></div>
            @if($errors->any())
                <div class="alert alert-danger alert-dismiss">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach

                    </ul>
                </div>
            @endif
            @if(session("success"))
                <div class="alert alert-success alert-dismiss">
                    {{session()->get('success')}}
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Applications</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Job</th>
                                    <th>Payment Attempts</th>
                                    <th>Paid</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($applications as $item)
                                    <tr>
                                        <td>{{$item->first_name}} {{$item->last_name}}</td>
                                        <td>{{$item->phone_number}}</td>
                                        <td>{{$item->gender}}</td>
                                        <td>{{$item->job_title}}</td>
                                        <td>{{$item->transaction_attempts}}</td>
                                        <td>{{$item->paid}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Job</th>
                                    <th>Payment Attempts</th>
                                    <th>Paid</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
            </div>
        </div>

    </section>

@stop
@section('js')
    <script src="{{asset('dashboard/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
        });
        </script>
@stop