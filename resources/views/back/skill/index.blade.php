@extends('back.layout.main')
{{--@section('css')--}}
{{--<!-- Toastr -->--}}
{{--<link rel="stylesheet" href="{{asset('dashboard/plugins/toastr/toastr.min.css')}}">--}}
{{--@stop--}}
@section('content')
    <div id="res" class="alert alert-success alert-dismissible" hidden>

    </div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create Skills</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Skill</a></li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="row">
        <div class="col-md-6">
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Skill Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="fields">

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Skill Name</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <form id="skill_form" onsubmit="post('{{route('api.skill.store')}}',this,'res');" method="post">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Create new Skill</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Skill Title</label>
                            <input  type="text" class="form-control" id="name" name="name" required="required" placeholder="Name of a skill">
                        </div>
                        <input type="submit" class="btn btn-block btn-success" value="Create">
                    </div>
                    <!-- /.card-body -->

                </form>

            </div>

        </div>
    </div>
    <div id="modal_skill"></div>


@stop
@section('js')

    <script>
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
                    get('{{route('api.skill.all_skills')}}','fields');
                }
                if (this.readyState ===4 && this.status===500){
                    let res = this.responseText;
                    console.log(res)
                }
            };
            ajcall.send(NewData);
        }
        function get(url, target){
            let id = document.getElementById(target);
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
                        <td>
                            <button onclick="EditModal(${decoded[i].id})" class="btn btn-info pull-left">Edit</button >
                            <button onclick="DeleteModal(${decoded[i].id})" class="btn btn-danger pull-right">Delete</button></td>
                        </tr>
                        `;
                    }
                }
                if (this.readyState ===4 && this.status===500){
                    let res = this.responseText;
                    id.innerHTML = JSON.parse(res);
                }
            };
            ajcall.send();

        }
        function EditModal(id){
            let formModal = `
                <button type="button" hidden="hidden" id="modal_button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
                </button>
       <div class="modal fade" id="modal-success">
    <form onsubmit="post('${window.location.origin+'/api/admin/skill/update/'+id}',this,'res'); document.getElementById('dismiss-modal').click()">
        <div class="modal-dialog">
          <div class="modal-content bg-success">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" value="jBV9IRwd42Vet0ziuBkPVeTL5QAqDiVSuLU9kgxV">
                <div class="form-group">
                <input type="hidden" class="form-control" name="_method" value="PUT">
                <input type="text" class="form-control" name="name" placeholder="Enter a new Name">
                </div>


            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" id="dismiss-modal" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <input  type="submit" class="btn btn-outline-light" value="Save changes">
            </div>
          </div>
        </form>
        </div>
`;
            let modal_skill =document.getElementById('modal_skill');
            modal_skill.innerHTML = formModal;
            let btn = document.getElementById('modal_button');
            btn.click();
        }
        function DeleteModal(id){
            let formModal = `
                <button type="button" hidden="hidden" id="modal_button" class="btn btn-success" data-toggle="modal" data-target="#modal-danger">
                </button>
       <div class="modal fade" id="modal-danger">
    <form onsubmit="post('${window.location.origin+'/api/admin/skill/delete/'+id}',this,'res'); document.getElementById('dismiss-modal').click()">
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
              <input  type="submit" class="btn btn-outline-light" value="Yes, delete this skill">
            </div>
          </div>
        </form>
        </div>
`;
            let modal_skill =document.getElementById('modal_skill');
            modal_skill.innerHTML = formModal;
            let btn = document.getElementById('modal_button');
            btn.click();
        }
        window.onload = (e) => get('{{route('api.skill.all_skills')}}','fields');
        window.addEventListener('submit',function (e) {
            e.preventDefault();
        });
    </script>
@stop
