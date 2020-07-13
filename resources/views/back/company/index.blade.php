@extends('back.layout.main')
@section('css')
    <link rel="stylesheet" href="{{asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@stop
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Company</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Company</li>
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
                            <form action="{{route('company.store')}}"
                                  enctype="multipart/form-data"
                                  method="post">
                                @csrf
                                <div class="card-header">
                                    <h3 class="card-title">Create a new Company</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <input type="text" name="name" class="form-control" id="name" placeholder="Company Name"
                                                           value="{{old('name')}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <input type="text" name="email" class="form-control" id="email" placeholder="Email Address"
                                                           value="{{old('email')}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <label for="description">Description</label>
                                                    <textarea type="text" name="description" class="form-control" id="description">
                                            {{old('description')}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <input type="tel" name="phone_number" class="form-control" id="phone_number"
                                                           placeholder="Phone Number" value="{{old('phone_number')}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <input type="text" name="location" class="form-control" id="location" placeholder="Location"
                                                           value="{{old('location')}}">
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
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <label for="favicon">Logo</label>
                                                        <input type="file" accept="image/png" name="logo" onchange="showMyImage(this,'_logo')" id="logo" class="form-control">
                                                        <img alt="Preview" class="img img-responsive img-md" id="_logo"  src="{{old('logo')}}">
                                                    </div>

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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Companies</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th>--</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($companies as $item)
                                    <tr>
                                        <td>
                                            <img src="{{$item->logo}}" alt="Logo for {{$item->name}}" class="img img-responsive img-md" id="_logo" >
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->location}}</td>
                                        <td>
                                            <button onclick="EditModal({{$item->id}})" class="btn btn-info pull-left">Edit</button >
                                            <button onclick="DeleteModal({{$item->id}})" class="btn btn-danger pull-right">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th>--</th>
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
    <div id="modal_field"></div>

@stop
@section('js')
    <script src="{{asset('dashboard/plugins/jquery/jquery.min.js')}}"></script>

    <script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
            // $('#example2').DataTable({
            //     "paging": true,
            //     "lengthChange": false,
            //     "searching": false,
            //     "ordering": true,
            //     "info": true,
            //     "autoWidth": false,
            // });
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
            let d = new FormData(data);
            id = document.getElementById(id);
            // let NewData =JSON.stringify(FormDataToJSON(d));
            let ajcall = new XMLHttpRequest();
            ajcall.open('POST',url);
            ajcall.contentType = 'multipart/form-data';
            // ajcall.setRequestHeader('Content-Type','application/json');/*text/html; charset=utf-8*/
            ajcall.onload = function (e) {
                if (this.readyState ===4 && this.status===200){
                    id.innerHTML=JSON.parse(this.responseText);
                    id.hidden=false;
                    {{--get('{{route('api.field.all_fields')}}','fields');--}}
                }
                if (this.readyState ===4 && this.status===500){
                    let res = this.responseText;
                    console.log(res)
                }
            };
            ajcall.send(d);
        }
        function EditModal(id){
            let url = window.location.origin+'/api/admin/company/show/'+id;
            let c = new XMLHttpRequest();
            // url = window.location.origin+'/api/admin/company/show/'+id;
            c.open('GET',url);
            c.onload = function(){
                if (this.readyState===4 && this.status===200){
                    let   company = JSON.parse(this.responseText);
                    let formModal = `
                <button type="button" hidden="hidden" id="modal_button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
                </button>
       <div class="modal fade" id="modal-success">
    <form method="post" enctype="multipart/form-data" onsubmit="
     window.addEventListener('submit',function (e) {
            e.preventDefault();
        }); post('${window.location.origin+'/api/admin/company/update/'+id}',this,'res'); document.getElementById('dismiss-modal').click()">
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
                                                    <input type="text" name="name" class="form-control" id="name" placeholder="Company Name"
                                                           value="${company.cname}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <input type="text" name="email" class="form-control" id="email" placeholder="Email Address"
                                                           value="${company.email}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <label for="description">Description</label>
                                                    <textarea type="text" name="description" class="form-control" id="description">
                                            ${company.description}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <input type="tel" name="phone_number" class="form-control" id="phone_number"
                                                           placeholder="Phone Number" value="${company.phone}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <input type="text" name="location" class="form-control" id="location" placeholder="Location"
                                                           value="${company.location}">
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
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <label for="logo">Logo</label>
                                                        <input type="file" accept="image/png" name="logo" onchange="showMyImage(this,'new_logo')" id="logo" class="form-control">
                                                        <img alt="Preview" class="img img-responsive img-md" id="new_logo"  src="${company.logo}">
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
    <form onsubmit="post('${window.location.origin+'/api/admin/company/delete/'+id}',this,'res'); document.getElementById('dismiss-modal').click()">
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
        window.onload = (e) => get('{{route('api.company.all_companies')}}','companies');
        // window.addEventListener('submit',function (e) {
        //     e.preventDefault();
        // });
    </script>
    <script>
        function showMyImage(fileInput,id) {
            let files = fileInput.files;
            for (let i = 0; i < files.length; i++) {
                let file = files[i];
                let imageType = /image.*/;
                if (!file.type.match(imageType)) {
                    continue;
                }
                let img=document.getElementById(id);
                img.file = file;
                let reader = new FileReader();
                reader.onload = (function(aImg) {
                    return function(e) {
                        aImg.src = e.target.result;
                    };
                })(img);
                reader.readAsDataURL(file);
            }
        }
    </script>
@stop