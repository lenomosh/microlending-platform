@extends('layouts.front1')
@section('script')
    <script>
        var element = document.getElementById("contact");
        element.classList.add("active");
    </script>

@endsection
@section('contact')

    <div id="breadcrumb">
        <div class="container">
            <div class="breadcrumb">
                <li><a href="">Home</a></li>
                <li>Contact</li>
            </div>
        </div>
    </div>

    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510564.6498664422!2d36.56720029142611!3d-1.3031933719272915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f1172d84d49a7%3A0xf7cf0254b297924c!2sNairobi!5e0!3m2!1sen!2ske!4v1557646318523!5m2!1sen!2ske" width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
        {{--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22864.11283411948!2d-73.96468908098944!3d40.630720240038435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sbg!4v1540447494452" width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>--}}
    </div>

    <section id="contact-page">
        <div class="container">
            <div class="center">
                <h2>Drop Your Message</h2>
                <p>We value your response. Send us a message and we'll reply to you ASAP</p>
            </div>
            <div class="row contact-wrap">
                <div class="status alert alert-success" style="display: none"></div>
                <div class="col-md-6 col-md-offset-3">
                    <div id="sendmessage">Your message has been sent. Thank you!</div>
                    <div id="errormessage"></div>
                    <form action="" method="post" role="form" class="contactForm">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                            <div class="validation"></div>
                        </div>
                        <div class="text-center"><button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Submit Message</button></div>
                    </form>
                </div>
            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
    </section>
    <!--/#contact-page-->
    <script src="{{asset('contactform/contactform.js')}}"></script>


@endsection