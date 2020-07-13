@extends('back.layout.main')
@section('css')
    <link rel="stylesheet" href="{{asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('dashboard/plugins/summernote/summernote-bs4.css')}}">
    @stop
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jobs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('back.main')}}">Home</a></li>
                        <li class="breadcrumb-item active">Jobs</li>
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
                            <h3 class="card-title">All Jobs</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th>Applicants</th>
                                    <th>--</th>
                                </tr>
                                </thead>
                                <tbody id="jobs">
                                @foreach(json_decode($jobs) as $job)
                                    <tr>
                                        <td>{{$job->title}}</td>
                                        <td>{{$job->location}}</td>
                                        <td>{{$job->applicants}}</td>
                                        <td>
                                            <a target="_blank" href="{{route('jobs.single',$job->id)}}" class="btn btn-primary pull-left">View</a>
                                            <a href="{{route('job.edit',$job->id)}}" class="btn btn-info pull-right">Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
            </div>
        </div>

    </section>
    <div id="modal_field"></div>

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
    <!-- Summernote -->
    <script src="{{asset('dashboard/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(function () {
            $('.textarea').summernote()
        })
    </script>

@stop