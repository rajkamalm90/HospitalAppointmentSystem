@extends('layouts.app')

@section('content')
<div id="getintouch" class="section wb wow fadeIn" style="padding-bottom:0;">
    <div class="container">
        <div class="heading">
            <span class="icon-logo"><img src="images/icon-logo.png" alt="#"></span>
            <h2>Get in Touch</h2>
        </div>
    </div>
    <div class="contact-section">
        <div class="form-contant">
            @if(session('message'))
            {{session('message')}}
        @endif
        <form method="post" action="{{ url('/contact/submit') }}" enctype="multipart/form-data">
            @csrf
        
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group in_name">
                        <input type="text" class="form-control" name="name" placeholder="Name" required="required" style="color: cyan">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group in_email">
                        <input type="email" class="form-control" name="email" placeholder="E-mail" required="required" style="color: cyan">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group in_email">
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone" required="required" style="color: cyan">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group in_email">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required="required" style="color: cyan">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group in_message">
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Message" required="required" style="color: cyan"></textarea>
                    </div>
                    <div class="actions">
                        <button class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
        <div id="googleMap" style="width:100%;height:450px;"></div>
    </div>
</div>

@endsection


//
