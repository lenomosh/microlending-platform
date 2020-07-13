@extends('layouts.jobs.main')
@section('content')
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold">Candidate's Testimonials</h1>
                    <div class="custom-breadcrumbs">
                        <a href="{{route('jobs.index')}}">Home</a> <span class="mx-2 slash">/</span>
                        <span class="text-white"><strong>Testimonials</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="site-section" id="next-section">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="block__87154 bg-primary">
                        <blockquote>
                            <p class="text-white">&ldquo;
                                {{$random_testimonial->details}}&rdquo;</p>
                        </blockquote>
                        <div class="block__91147 d-flex align-items-center">
                            <figure class="mr-4"><img src="{{$random_testimonial->image}}" alt="Image for {{$random_testimonial->name}}" class="img-fluid"></figure>
                            <div>
                                <h3 class="text-white">{{$random_testimonial->name}}</h3>
                                <span class="position position-2">{{$random_testimonial->career}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($testimonials as $item)
                    <div class="col-lg-6 mb-4">
                        <div class="block__87154">
                            <blockquote>
                                <p>&ldquo;
                                    {{$item->details}}
                                    &rdquo;</p>
                            </blockquote>
                            <div class="block__91147 d-flex align-items-center">
                                <figure class="mr-4"><img src="{{$item->image}}" alt="Image for {{$item->name}}" class="img-fluid"></figure>
                                <div>
                                    <h3>{{$item->name}}</h3>
                                    <span class="position">{{$item->career}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
        </div>
    </section>
@stop