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
                        <li class="breadcrumb-item"><a href="{{route('back.main')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('job.index')}}">Jobs</a></li>
                        <li class="breadcrumb-item active">Create</li>
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
                        <form action="{{route('job.store')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">Post a new job</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="Job title"
                                                       value="{{old('title')}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <input type="number" name="salary" class="form-control" id="salary" placeholder="Salary"
                                                       value="{{old('salary')}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label for="description">Description</label>
                                                <textarea type="text" name="description" class="form-control textarea" id="description">{{old('description')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label for="responsibility">Responsibility</label>
                                                <textarea type="text" name="responsibility" class="form-control textarea" id="responsibility">{{old('responsibility')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label for="other_information">Other relevant information</label>
                                                <textarea type="text" name="other_information" class="form-control textarea" id="other_information">{{old('other_information')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <input type="number" name="slots" min="1" max="100" class="form-control" id="slots"
                                                       placeholder="Available Slots" value="{{old('slots')}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <input type="text" name="location" min="1" max="100" class="form-control" id="location"
                                                       placeholder="Location" value="{{old('location')}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <input placeholder="Deadline" name="deadline" id="deadline" type="date" class="form-control" value="{{old('deadline')}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label for="employment_period">Employment Period:</label>
                                                <select  name="employment_period" class="form-control" id="skill_id">
                                                    <option value="1">Permanent</option>
                                                    <option value="2">Temporary</option>
                                                    <option value="3">Contract</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label for="requirement_id">Requirements:</label>
                                                <select multiple name="requirement_id[]" class="form-control" id="requirement_id">
                                                    @foreach(json_decode($requirements,FALSE) as $requirement)
                                                        <option value="{{$requirement->requirement_id}}">{{$requirement->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label for="skill_id">Required skills:</label>
                                                <select multiple name="skill_id[]" class="form-control" id="skill_id">
                                                    @foreach(json_decode($skills,FALSE) as $skill)
                                                        <option value="{{$skill->skill_id}}">{{$skill->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label for="company_id">Employer:</label>
                                                <select name="company_id" class="form-control" id="skill_id">
                                                    @foreach(json_decode($companies,FALSE) as $company)
                                                        <option value="{{$company->company_id}}">{{$company->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-block btn-outline-success">Create</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>

                </div>
                {{--<div class="col-12">
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
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                </tr>
                                </thead>
                                <tbody id="jobs">

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>--}}
            </div>
        </div>

    </section>
    <div id="modal_field"></div>

@stop
@section('js')
    {{--<script>
        function FormDataToJSON(FormElement){
            let formData = new FormData(FormElement);
            let ConvertedJSON= {};
            for (const [key, value]  of formData.entries())
            {
                ConvertedJSON[key] = value;
            }
            return ConvertedJSON
        }

        function post(url,data,id){
            id = document.getElementById(id);
            let NewData =JSON.stringify(FormDataToJSON(data));
            let ajcall = new XMLHttpRequest();
            ajcall.open('POST',url);
            ajcall.setRequestHeader('Content-Type','application/json');/*text/html; charset=utf-8*/
            ajcall.onload = function (e) {
                if (this.readyState ===4 && this.status===200){
                    id.innerHTML=JSON.parse(this.responseText);
                    id.hidden=false;
                    get('{{route('api.field.all_fields')}}','fields');
                }
                if (this.readyState ===4 && this.status===500){
                    let res = this.responseText;
                    console.log(res)
                }
            };
            ajcall.send(NewData);
        }
        function get(url, target){
            let  id = document.getElementById(target);
            let ajcall = new XMLHttpRequest();
            ajcall.open('GET',url);
            ajcall.onload = function (e) {
                if (this.readyState ===4 && this.status===200){
                    let decoded=JSON.parse(this.responseText);
                    id.innerHTML = null;
                    for ( let i=0;i<decoded.length;i++){
                        id.innerHTML += `
                        <tr>
                        <td>${decoded[i].name}</td>
                        <td>${decoded[i].email}</td>
                        <td>${decoded[i].phone}</td>
                        <td>${decoded[i].location}</td>
                        <td>
                            <button onclick="EditModal(${decoded[i].id})" class="btn btn-info pull-left">Edit</button >
                            <button onclick="DeleteModal(${decoded[i].id})" class="btn btn-danger pull-right">Delete</button></td>
                        </tr>
                        `;
                    }

                }
                if (this.readyState ===4 && this.status===500){
                    let res = this.responseText;
                    console.log(res)
                }
            };
            ajcall.send();
        }
        function rget(url) {
            let c = new XMLHttpRequest();
            // url = window.location.origin+'/api/admin/job/show/'+id;
            c.open('GET',url);
            c.onload = function(){
                if (this.readyState===4 && this.status===200){
                    let   job = JSON.parse(this.responseText)
                }

            };
            c.send();
        }
        function EditModal(id){
            let url = window.location.origin+'/api/admin/job/show/'+id;
            let c = new XMLHttpRequest();
            // url = window.location.origin+'/api/admin/job/show/'+id;
            c.open('GET',url);
            c.onload = function(){
                if (this.readyState===4 && this.status===200){
                    let   job = JSON.parse(this.responseText);
                    let formModal = `
                <button type="button" hidden="hidden" id="modal_button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
                </button>
       <div class="modal fade" id="modal-success">
    <form method="post" onsubmit="        window.addEventListener('submit',function (e) {
            e.preventDefault();
        }); post('${window.location.origin+'/api/admin/job/update/'+id}',this,'res'); document.getElementById('dismiss-modal').click()">
        <input type="hidden" class="form-control" name="_method" value="PUT">
        <input type="hidden" name="_token" value="jBV9IRwd42Vet0ziuBkPVeTL5QAqDiVSuLU9kgxV">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <input type="text" name="name" class="form-control" id="name" placeholder="Job Name"
                                                           value="${job.cname}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <input type="text" name="email" class="form-control" id="email" placeholder="Email Address"
                                                           value="${job.email}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <label for="description">Description</label>
                                                    <textarea type="text" name="description" class="form-control" id="description">
                                            ${job.description}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <input type="tel" name="phone_number" class="form-control" id="phone_number"
                                                           placeholder="Phone Number" value="${job.phone}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <input type="text" name="location" class="form-control" id="location" placeholder="Location"
                                                           value="${job.location}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <label for="field_id">Field:</label>
                                                    <select name="field_id" class="form-control" id="field_id">
                                                        @foreach(json_decode($fields,FALSE) as $field)
                        <option value="{{$field->field_id}}">{{$field->field_name}}</option>
                                                        @endforeach
                        </select>
                    </div>
                </div>

            </div>
        </div>

        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" id="dismiss-modal" class="btn btn-default" data-dismiss="modal">Close</button>
        <input  type="submit" class="btn btn-primary" value="Save changes">
        </div>
        </div>
        </form>
        </div>
`;

                    let modal_field =document.getElementById('modal_field');
                    modal_field.innerHTML = formModal;
                    let btn = document.getElementById('modal_button');
                    btn.click();
                }

            };
            c.send();
        }
        function DeleteModal(id){
            let formModal = `
                <button type="button" hidden="hidden" id="modal_button" class="btn btn-success" data-toggle="modal" data-target="#modal-danger">
                </button>
       <div class="modal fade" id="modal-danger">
    <form onsubmit="post('${window.location.origin+'/api/admin/job/delete/'+id}',this,'res'); document.getElementById('dismiss-modal').click()">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" value="jBV9IRwd42Vet0ziuBkPVeTL5QAqDiVSuLU9kgxV">
                <div class="form-group">
                <input type="hidden" class="form-control" name="_method" value="DELETE">
                <p>Are you sure you want to perform this action? This cannot be undone.</p>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" id="dismiss-modal" class="btn btn-outline-light" data-dismiss="modal">No</button>
              <input  type="submit" class="btn btn-outline-light" value="Yes, delete this field">
            </div>
          </div>
        </form>
        </div>
`;
            let modal_field =document.getElementById('modal_field');
            modal_field.innerHTML = formModal;
            let btn = document.getElementById('modal_button');
            btn.click();
        }
        window.onload = (e) => get('{{route('api.job.all_jobs')}}','jobs');
        // window.addEventListener('submit',function (e) {
        //     e.preventDefault();
        // });
    </script>--}}
    <!-- Summernote -->
    <script src="{{asset('dashboard/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(function () {
            $('.textarea').summernote()
        })
    </script>
@stop