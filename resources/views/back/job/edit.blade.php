@extends('back.layout.main')
@section('css')
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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('jobs.index')}}">Jobs</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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

                    <div class="card card-info">
                        <form action="{{route('job.update',$job)}}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h3 class="card-title">Make Update on <i>{{$job->title}}</i></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="Job title"
                                                       value="{{old('title')?:$job->title}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <input type="number" min="500" max="500000" name="salary" class="form-control" id="salary" placeholder="Salary"
                                                       value="{{old('salary')?:$job->salary}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label for="description">Description</label>
                                                <textarea type="text" name="description" class="form-control textarea" id="description">{{old('description')?:$job->description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label for="responsibility">Responsibility</label>
                                                <textarea type="text" name="responsibility" class="form-control textarea" id="responsibility">{{old('responsibility')?:$job->responsibility}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label for="other_information">Other relevant information</label>
                                                <textarea type="text" name="other_information" class="form-control textarea" id="other_information">{{old('other_information')?:$job->other_information}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <input type="number" name="slots" min="1" max="100" class="form-control" id="slots"
                                                       placeholder="Available Slots" value="{{old('slots')?:$job->slots}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <input type="text" name="location" min="1" max="100" class="form-control" id="location"
                                                       placeholder="Location" value="{{old('location')?:$job->location}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label for="employment_period">Employment Period:</label>
                                                <select  name="employment_period" class="form-control" id="skill_id">
                                                    <option value="1" @if($job->employment_period =='1')selected @endif>Permanent</option>
                                                    <option value="2" @if($job->employment_period =='2')selected @endif>Temporary</option>
                                                    <option value="3" @if($job->employment_period =='3')selected @endif>Contract</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label for="requirement_id">Requirements:</label>
                                                <select multiple name="requirement_id[]" class="form-control" id="requirement_id">
                                                    @foreach(json_decode($requirements,FALSE) as $requirement)
                                                        <option value="{{$requirement->requirement_id}}"
                                                                @if(in_array($requirement->requirement_id,$job->requirement_id)) selected  @endif>
                                                            {{$requirement->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label for="skill_id">Required skills:</label>
                                                <select multiple name="skill_id[]" class="form-control" id="skill_id">
                                                    @foreach(json_decode($skills,FALSE) as $skill)
                                                        <option value="{{$skill->skill_id}}" @if(in_array($skill->skill_id,$job->requirement_id)) selected @endif>{{$skill->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label for="company_id">Employer:</label>
                                                <select name="company_id" class="form-control" id="skill_id">
                                                    @foreach(json_decode($companies,FALSE) as $company)
                                                        <option value="{{$company->company_id}}" @if($company->company_id==$job->requirement_id) selected @endif>{{$company->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">
                                            Delete this job
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-block btn-outline-success">Update Changes</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </section>
    <div id="modal_field"></div>
    <div class="modal fade" id="modal-danger">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Confirm deletion of: <b>{{$job->title}}</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this job? This action cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                    <form action="{{route('job.destroy',$job->job_id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-light">Yes, Delete</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@stop
@section('js')
    <!-- Summernote -->
    <script src="{{asset('dashboard/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(function () {
            $('.textarea').summernote()
        })
    </script>

@stop