@extends('layouts.jobs.main')
@section('css')

@stop
@section('content')
    <section class="section-hero home-section overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">

        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-12">
                    <div class="mb-5 text-center">
                        <h1 class="text-white font-weight-bold">The Easiest Way To Get Your Dream Job</h1>
                        <p>A fresh new free template handcrafted by the fine folks at <a href="https://free-template.co/" target="_blank" class="spepcial_link text-white">Free-Template.co</a> </p>
                    </div>
                    <form method="post" class="search-jobs-form">
                        <div class="row mb-5">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                                <input type="text" class="form-control form-control-lg" placeholder="Job title, Company...">
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                                <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Select Region">
                                    <option>Anywhere</option>
                                    <option>San Francisco</option>
                                    <option>Palo Alto</option>
                                    <option>New York</option>
                                    <option>Manhattan</option>
                                    <option>Ontario</option>
                                    <option>Toronto</option>
                                    <option>Kansas</option>
                                    <option>Mountain View</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                                <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Select Job Type">
                                    <option>Part Time</option>
                                    <option>Full Time</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                                <button type="submit" class="btn btn-primary btn-lg btn-block text-white btn-search"><span class="icon-search icon mr-2"></span>Search Job</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 popular-keywords">
                                <h3>Trending Keywords:</h3>
                                <ul class="keywords list-unstyled m-0 p-0">
                                    <li><a href="#" class="">UI Designer</a></li>
                                    <li><a href="#" class="">Python</a></li>
                                    <li><a href="#" class="">Developer</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <a href="#next" class="scroll-button smoothscroll">
            <span class=" icon-keyboard_arrow_down"></span>
        </a>
    </section>


    <section class="site-section" id="next">
        <div class="container">

            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="section-title mb-2">{{$jobs_count}} Jobs Listed</h2>
                </div>
            </div>

            <ul class="job-listings mb-5">
                @foreach ($jobs as $job)
                    <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                        <a href="{{route('jobs.single',$job['id'])}}"></a>
                        <div class="job-listing-logo">
                            <img src="{{$job['company_logo']}}" height="188px" width="188px" alt="{{$job['company_name']}}" class="img-fluid img-size-64 img-md">
                        </div>
                        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                            <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                                <h2>{{$job['title']}}</h2>
                                <strong>{{$job['company_name']}}</strong>
                            </div>
                            <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                                <span class="icon-room"></span> {{$job['location']}}
                            </div>
                            <div class="job-listing-meta">
                                <span class="badge
                                @switch($job['period_id'])
                                @case(1)
                                        badge-danger
                                @break
                                @case(2)
                                        badge-success
                                @break
                                @case(3)
                                        badge-primary
                                @break
                                @endswitch
                                        ">{{$job['period_name']}}</span>
                            </div>
                        </div>

                    </li>

                @endforeach
            </ul>

            <div class="row pagination-wrap">
                {{--<div class="col-md-6 text-center text-md-left mb-4 mb-md-0">--}}
                    {{--<span>Showing 1-7 Of 43,167 Jobs</span>--}}
                {{--</div>--}}
                <div class="col-md-6 text-center text-md-right">
                    {{ $links->appends($_GET)->links() }}

                </div>
            </div>

        </div>
    </section>
{{--
    <section class="py-5 bg-image overlay-primary fixed overlay" style="background-image: url('images/hero_1.jpg');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="text-white">Looking For A Job?</h2>
                    <p class="mb-0 text-white lead">Lorem ipsum dolor sit amet consectetur adipisicing elit tempora adipisci impedit.</p>
                </div>
                <div class="col-md-3 ml-auto">
                    <a href="#" class="btn btn-warning btn-block btn-lg">Sign Up</a>
                </div>
            </div>
        </div>
    </section>--}}
@stop
@section('js')
@stop