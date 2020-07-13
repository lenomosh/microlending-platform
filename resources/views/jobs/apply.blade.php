@extends('layouts.jobs.main')
@section('css')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('dashboard/plugins/summernote/summernote-bs4.css')}}">
@stop
@section('content')
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="custom-breadcrumbs">
                        <a href="{{route('jobs.index')}}">Home</a> <span class="mx-2 slash">/</span>
                        <a href="{{route('jobs.all')}}">Jobs</a> <span class="mx-2 slash">/</span>
                        <a href="{{route('jobs.single',$job->id)}}">{{$job->title}}</a> <span class="mx-2 slash">/</span>
                        <span class="text-white"><strong>Apply</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="site-section">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2>{{$job->title}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-12">
                    <form class="p-4 p-md-5 border rounded"
                          enctype="multipart/form-data"
                          method="post">
                        @csrf
                        <h3 class="text-black mb-5 border-bottom pb-2">Job Application</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                @foreach($errors->all() as $error)
                                    {{$error}}<br>
                                    @endforeach
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>

                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input name="first_name" type="text" class="form-control @if ($errors->get('first_name'))
                                            border border-danger
@endif" id="first_name" value="{{old('first_name')}}" placeholder="First Name">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input name="last_name" type="text" class="form-control
@if ($errors->get('last_name'))
                                            border border-danger
@endif" id="last_name" value="{{old('last_name')}}" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control @if ($errors->get('gender'))
                                            border border-danger
@endif" id="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input name="email" type="email" class="form-control @if ($errors->get('email'))
                                            border border-danger
@endif" id="email" value="{{old('email')}}" placeholder="Email Address">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_number">ID Number</label>
                                    <input name="id_number" type="number" min="1000000" class="form-control
@if ($errors->get('id_number'))
                                            border border-danger
@endif" id="id_number" value="{{old('id_number')}}" placeholder="National ID Number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kra">KRA Pin</label>
                                    <input name="kra" type="text"  class="form-control @if ($errors->get('kra'))
                                            border border-danger
@endif" id="kra" value="{{old('kra')}}" placeholder="KRA Pin">
                                </div></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="dob">Date of birth</label>
                                    <input name="dob" type="date" max="2002-12-31"  class="form-control @if ($errors->get('dob'))
                                            border border-danger
@endif" id="dob" value="{{old('dob')}}" placeholder="Date of birth">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location">Current Location</label>
                                    <input name="location" type="text" class="form-control @if ($errors->get('location'))
                                            border border-danger
@endif" id="location" value="{{old('location')}}" placeholder="Location">
                                </div></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Safaricom Phone Number</label>
                                    <input name="phone" type="tel" class="form-control @if ($errors->get('phone'))
                                            border border-danger
@endif" id="first_name" value="{{old('phone')}}" placeholder="eg +2547 12 345 678">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="education_level">Highest level of education</label>
                                    <input name="education_level" type="text" class="form-control @if ($errors->get('education_level'))
                                            border border-danger
@endif" id="education_level" value="{{old('education_level')}}" placeholder="eg Primary School">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="current_job">Current Job</label>
                                    <input name="current_job" type="text" class="form-control @if ($errors->get('current_job'))
                                            border border-danger
@endif" id="current_job" value="{{old('current_job')}}" placeholder="Write N/A if you are currently unemployed">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="experience">Years of Experience</label>
                                    <input name="experience" type="number" min="0" max="80" class="form-control @if ($errors->get('experience'))
                                            border border-danger
@endif" id="experience" value="{{old('experience')}}" placeholder="Write 0 (Zero) if you have no experience">
                                </div></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="availability">Availability Name</label>
                                    <select class="form-control @if ($errors->get('availability'))
                                            border border-danger
@endif" id="availability" name="availability">
                                        <option value="Immediately">Immediately</option>
                                        <option value="1 Week">1 Week</option>
                                        <option value="2 Weeks">2 Weeks</option>
                                        <option value="3 Weeks">3 Weeks</option>
                                        <option value="1 Month">1 Month</option>
                                        <option value="More Than 1 Months">More Than 1 Months</option>
                                    </select>
                                </div></div>
                            <div class="col-md-6">

                            </div>
                        </div>



                        <div class="form-group">
                            <label for="application_letter">Application Letter</label>
                            <textarea name="application_letter" class="form-control textarea @if ($errors->get('application_letter'))
                                    border border-danger
@endif" id="application_letter" cols="30" rows="10">{{old('application_letter')}}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group justify-content-md-center">
                                    <label for="cv d-block">Upload your CV <small><i>PDF format</i></small></label> <br>
                                    <label class="btn btn-primary btn-md btn-file @if ($errors->get('cv'))
                                            border border-danger
@endif">
                                        Browse File<input type="file" accept="application/pdf" name="cv" id="cv">
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group justify-content-md-center">
                                    <label for="other_documents d-block">Other Documents <small><i>PDF format</i></small></label> <br>
                                    <label class="btn btn-primary btn-md btn-file @if ($errors->get('other_documents'))
                                            border border-danger
@endif">
                                        Browse File
                                        <input type="file" accept="application/pdf" name="other_documents[]" id="other_documents" multiple >
                                    </label>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="row align-items-center mb-5">

                <div class="col-lg-4 ml-auto">
                    <div class="row">
                        <div class="col-6">
                            {{--<a href="#" class="btn btn-block btn-light btn-md"><span class="icon-open_in_new mr-2"></span>Preview</a>--}}
                        </div>
                        <div class="col-6">
                            <button onclick="document.forms[0].submit();" href="#" class="btn btn-block btn-primary btn-md">Apply Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('js')
    <script>

            function images(document, window, index) {
                let inputs = document.querySelectorAll('.inputfile1');
                Array.prototype.forEach.call(inputs, function(input) {
                    let label = input.nextElementSibling,
                        labelVal = label.innerHTML;
                    input.addEventListener('change', function(e) {
                        let fileName = '';
                        if (this.files && this.files.length > 1)
                            fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                        else
                            fileName = e.target.value.split('\\').pop();
                        if (fileName)
                            label.querySelector('span').innerHTML = fileName;
                        else
                            label.innerHTML = labelVal;
                    });
                });
            }
    </script>
    <!-- Summernote -->
    <script src="{{asset('dashboard/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(function () {
            $('.textarea').summernote()
        })
    </script>
@stop