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
                    <h1>App Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">App</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
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
                <form
                        action="{{route('app.update')}}"
                        method="post"
                        enctype="multipart/form-data"
                >
                    <div class="card card-success">
                    @csrf
                        @method('PUT')
                    <div class="card-header with-border">
                        <h3 class="card-title">General Settings</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <label for="name">App Name</label>
                                        <input type="text" name="name" id="name" value="{{old('name')?:$website->name}}" class="form-control">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <label for="description">Description</label>
                                        <textarea name="description"   id="description" class="form-control textarea">{{old('description')?:$website->description}}</textarea>
                                    </div>
                                   </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <label for="logo">Logo</label>
                                        <input type="file" accept="image/png" name="logo" id="logo" onchange="showMyImage(this,'_logo')" class="form-control">
                                        <br>
                                        <img src="{{old('logo')?:asset('storage/'.$website->logo)}}" alt="Preview" class="img img-responsive img-md" id="_logo" >
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <label for="favicon">Favicon</label>
                                        <input type="file" accept="image/png" name="favicon" onchange="showMyImage(this,'_favicon')" id="favicon" class="form-control">
                                        <img alt="Preview" class="img img-responsive img-md" id="_favicon"  src="{{old('favicon')?:asset('storage/'.$website->favicon)}}">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <label for="location">Location</label>
                                        <input type="text"  value="{{old('location')?:$website->location}}" name="location" id="location" class="form-control">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <label for="email">Official Email Address</label>
                                        <input type="email" name="email" value="{{old('email')?:$website->email}}"  id="email" class="form-control">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" id="phone" value="{{old('phone')?:$website->phone}}"  class="form-control" name="phone">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-block btn-primary">Apply Changes</button>
                    </div>
            </div>
                    <div class="card card-success">
                        <div class="card-header with-border">
                            <h3 class="card-title">Social Links</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">

                                <div class="col-sm-10">
                                    <label for="facebook">Facebook Page username</label>
                                    <input type="text" name="facebook" id="facebook" value="{{old('facebook')?:$website->facebook}}"   class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <label for="instagram">Instagram Username</label>
                                    <input type="text" name="instagram" value="{{old('instagram')?:$website->instagram}}"   id="instagram" class="form-control">
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <label for="twitter">Twitter Username</label>
                                    <input type="text" name="twitter" value="{{old('twitter')?:$website->twitter}}"   id="twitter" class="form-control"></div>
                                </div>

                        </div>
                        <div class="card-footer"><input type="submit" value="Apply Changes" class="btn btn-block btn-primary"></div>
                    </div>
                    <div class="card card-success">
                        <div class="card-header with-border">
                            <h3 class="card-title">Legal Documents</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <label for="terms">Terms and conditions</label>
                                    <textarea name="terms" id="terms"  class="form-control textarea">{{old('terms')?:$website->terms}}</textarea>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <label for="privacy">Privacy Policy</label>
                                    <textarea name="privacy" id="privacy"  class="form-control textarea">{{old('privacy')?:$website->privacy}}</textarea>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" value="Apply Changes" class="btn btn-block btn-primary">
                        </div>
                    </div>
                </form>

        </div>
    </section>

@endsection
@section('js')    
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
    <script src="{{asset('dashboard/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(function () {
            $('.textarea').summernote()
        })
    </script>
@endsection