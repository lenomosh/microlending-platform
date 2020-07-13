{{--@dd(session())--}}
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
                    <h3 class="text-black mb-5 border-bottom pb-2">
                        @if(isset($codes)) Payment was Successful @else No payment has been received @endif </h3>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            @foreach($errors->all() as $error)
                                {{$error}}<br>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif
                    @if (!empty($response))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{$response}}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif
                    @if (!empty($codes))
                        <blockquote class="blockquote">Transaction was successful. Please keep the below information save</blockquote>
                        <p class="note-para">Your application code is <strong> <i>{{$codes->application_id}}</i></strong><br>
                            You'll be required to present this code on your day of interview. All the best</p>
                    @endif
                    @if (!empty($response))
                        <div class=" ml-auto">
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{route('jobs.getCodes',session()->get('applicant')->job_id)}}" class="btn btn-block btn-primary ">I've paid, check again</a>
                                </div>
                                <div class="col-6">
                                    <form action="{{route('jobs.initiateSTK',session('applicant')->job_id)}}" method="get">@csrf</form>
                                    <button onclick="document.forms[0].submit();" class="btn btn-block btn-light ">Trigger STK again</button>
                                </div>
                            </div>
                        </div>

                    @endif

                </div>
            </div>
            <div class="row align-items-center mb-5">
            </div>
        </div>
    </section>
@stop
@section('js')
    @if (!empty($codes))
        @php(session()->pull('applicant'))
    @endif
@stop