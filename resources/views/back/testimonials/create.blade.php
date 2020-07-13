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
            @if(session('success'))
                <div class="alert alert-success alert-dismiss">
                    {{session()->get('success')}}
                </div>
            @endif
            <div class="row">
                <div class="col-12">

                    <div class="card card-info">
                        <form action="{{route('testimonial.store')}}"
                              enctype="multipart/form-data"
                              method="post">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">Create a new Testimonial</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <input type="text" name="author_name" class="form-control" id="author_name" placeholder="Author Name"
                                                       value="{{old('author_name')}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <input type="text" name="author_career" class="form-control" id="author_career" placeholder="Author career"
                                                       value="{{old('author_career')}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label for="details">Details</label>
                                                <textarea type="text" name="details" class="form-control" id="details">{{old('details')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <label for="author_image">Image</label>
                                                    <input type="file" accept="image/png" name="author_image" onchange="showMyImage(this,'_author_image')" id="author_image" class="form-control">
                                                    <img alt="Preview" class="img img-responsive img-md" id="_author_image"  src="{{old('logo')}}">
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
                            <h3 class="card-title">All Testimonials</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Author</th>
                                    <th>Image</th>
                                    <th>Career</th>
                                    <th>Details</th>
                                    <th>--</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($testimonials as $item)
                                    <tr>
                                        <td>{{$item->author_name}}</td>
                                        <td>
                                            <img src="{{$item->author_image}}" alt="Logo for {{$item->author_name}}" class="img img-responsive img-md" id="_logo" >
                                        </td>
                                        <td>{{$item->author_career}}</td>
                                        <td>{{$item->details}}</td>
                                        <td>
                                            {{--<button onclick="EditModal({{$item->id}})" class="btn btn-info pull-left">Edit</button >--}}
                                            <button onclick="DeleteModal({{$item->id}})" class="btn btn-danger pull-right">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Author</th>
                                    <th>Image</th>
                                    <th>Career</th>
                                    <th>Details</th>
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
            ajcall.onload = function (e) {
                if (this.readyState ===4 && this.status===200){
                    id.innerHTML=JSON.parse(this.responseText);
                    id.hidden=false;
                }
                if (this.readyState ===4 && this.status===500){
                    let res = this.responseText;
                    console.log(res)
                }
            };
            ajcall.send(d);
        }
        function DeleteModal(id){
            let formModal = `
                <button type="button" hidden="hidden" id="modal_button" class="btn btn-success" data-toggle="modal" data-target="#modal-danger">
                </button>
       <div class="modal fade" id="modal-danger">
    <form method="post" action="${window.location.origin+'/api/admin/testimonial/delete/'+id}" onsubmit="post('${window.location.origin+'/api/admin/testimonial/delete/'+id}',this,'res'); document.getElementById('dismiss-modal').click()">
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