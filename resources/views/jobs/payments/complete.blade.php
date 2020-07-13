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
                    <h3 class="text-black mb-5 border-bottom pb-2">Mpesa Express</h3>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            @foreach($errors->all() as $error)
                                {{$error}}<br>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif
                    <blockquote class="blockquote">A Lipa Na Mpesa STK Push has been initiated to the phone number <b>{{session()->get('applicant')->phone}}
                        <ol class="list">
                            <li class="list-group-item">Enter your Pin</li>
                            <li class="list-group-item">Wait for a response from M-Pesa</li>
                            <li class="list-group-item">Click either of the buttons depending on the response from M-pesa</li>
                        </ol></b></blockquote>
                    <div class=" ml-auto">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{route('jobs.getCodes',session()->get('applicant')->job_id)}}" class="btn btn-block btn-primary ">Transaction Successful, Get Application ID</a>
                            </div>
                            <div class="col-6">
                                <form action="{{route('jobs.initiateSTK',session('applicant')->job_id)}}" method="get">@csrf</form>
                                <button onclick="document.forms[0].submit();" class="btn btn-block btn-light ">I made a mistake, trigger STK again</button>
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
