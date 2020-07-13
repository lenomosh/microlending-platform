@extends('back.layout.main')
@section('css')
    <link rel="stylesheet" href="{{asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <!-- Toastr -->
    {{--<link rel="stylesheet" href="{{asset('dashboard/plugins/toastr/toastr.min.css')}}">--}}
@stop
@section('content')
    <div id="res" class="alert alert-success alert-dismissible" hidden>

    </div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Field of specialization</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Field</a></li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="row">
        <div class="col-md-8">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Field Name</th>
                        <th>Companies</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="fields">

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Field Name</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <form id="field_form" onsubmit="post('{{route('api.field.store')}}',this,'res'); console.log(this)" method="post">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Create new field</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Field Name</label>
                            <input  type="text" class="form-control" id="name" name="name" required="required" placeholder="Name of a Career Field">
                        </div>
                        <input type="submit" class="btn btn-block btn-success" value="Create">
                    </div>
                    <!-- /.card-body -->

                </form>

            </div>

        </div>
    </div>
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
                    get('{{route('api.field.all_fields')}}','fields');
                }
                if (this.readyState ===4 && this.status===500){
                    let res = this.responseText;
                    console.log(JSON.parse(res))
                }
            };
            ajcall.send(NewData);
        }
        function get(url, target){
            id = document.getElementById(target);
            let ajcall = new XMLHttpRequest();
            ajcall.open('GET',url);
            ajcall.onload = function (e) {
                if (this.readyState ===4 && this.status===200){

                    let decoded=JSON.parse(this.responseText);
                    let fields = [];
                    id.innerHTML = null;
                    for ( let i=0;i<decoded.length;i++){
                        id.innerHTML += `
                        <tr>
                        <td>${decoded[i].field_name}</td>
                        <td>${decoded[i].companies}</td>
                        <td>
                            <button onclick="EditModal(${decoded[i].id})" class="btn btn-info pull-left">Edit</button >
                            <button onclick="DeleteModal(${decoded[i].id})" class="btn btn-danger pull-right">Delete</button></td>
                        </tr>
                        `;
                    }

                }
                if (this.readyState ===4 && this.status===500){
                    let res = this.responseText;
                    window.document.body.innerHTML =JSON.parse(res);

                    console.log(JSON.parse(res))
                }
            };
            ajcall.send();

        }
        function EditModal(id){
            let formModal = `
                <button type="button" hidden="hidden" id="modal_button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
                </button>
       <div class="modal fade" id="modal-success">
    <form onsubmit="post('${window.location.origin+'/api/admin/field/update/'+id}',this,'res'); document.getElementById('dismiss-modal').click()">
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
            let modal_field =document.getElementById('modal_field');
            modal_field.innerHTML = formModal;
            let btn = document.getElementById('modal_button');
            btn.click();
        }
        function DeleteModal(id){
            let formModal = `
                <button type="button" hidden="hidden" id="modal_button" class="btn btn-success" data-toggle="modal" data-target="#modal-danger">
                </button>
       <div class="modal fade" id="modal-danger">
    <form onsubmit="post('${window.location.origin+'/api/admin/field/delete/'+id}',this,'res'); document.getElementById('dismiss-modal').click()">
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
        window.onload = (e) => get('{{route('api.field.all_fields')}}','fields');
        window.addEventListener('submit',function (e) {
            e.preventDefault();
        });
    </script>
    @stop
