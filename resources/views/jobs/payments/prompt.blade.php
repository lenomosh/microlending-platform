@extends('layouts.jobs.main')
@section('content')
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-7">--}}
                    {{--<div class="custom-breadcrumbs">--}}
                        {{--<a href="{{route('jobs.index')}}">Home</a> <span class="mx-2 slash">/</span>--}}
                        {{--<a href="{{route('jobs.all')}}">Jobs</a> <span class="mx-2 slash">/</span>--}}
                        {{--<a href="{{route('jobs.single',$job->id)}}">{{$job->title}}</a> <span class="mx-2 slash">/</span>--}}
                        {{--<span class="text-white"><strong>Apply</strong></span>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </section>
    <section class="site-section">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2>{{--{{$job->title}}--}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-12">
                        <h3 class="text-black mb-5 border-bottom pb-2">Get Application Number</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                @foreach($errors->all() as $error)
                                    {{$error}}<br>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        @endif
                    <blockquote class="blockquote">Hello {{session('applicant')->name}}, you'll need an application number to check if your application went through. This will cost you Ksh. 100 for processing.</blockquote>
                    <div class="col-lg-4 ml-auto">
                        <div class="row">
                            <div class="col-6">
                                <form action="{{route('jobs.initiateSTK',session('applicant')->job_id)}}" method="get">@csrf</form>
                                {{--<a href="#" class="btn btn-block btn-light btn-md"><span class="icon-open_in_new mr-2"></span>Preview</a>--}}
                            </div>
                            <div class="col-6">
                                <button onclick="document.forms[0].submit();" href="#" class="btn btn-block btn-primary btn-md">Pay Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mb-5">
            </div>
        </div>
    </section>
@stop
