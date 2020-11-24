@extends('layouts.app')
@section('breadcrum')
<div class="linking">
   <div class="container">
      <ol class="breadcrumb">
         <li><a href="{{ route('home') }}">Home</a></li>
         <li class="active">Contact</li>
      </ol>
   </div>
</div>
@endsection
@section('content')
<section class="contact-sec padding-top-40 padding-bottom-80">
   <div class="container">
      <!-- MAP -->
      <section class="map-block margin-bottom-40">
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2480.8041976344684!2d-0.04717358479771341!3d51.55348931515416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761d01bb7ebe71%3A0xaf5383fbce0fd4c2!2s61%20Chatsworth%20Rd%2C%20Lower%20Clapton%2C%20London%20E5%200LH!5e0!3m2!1sen!2suk!4v1589035681761!5m2!1sen!2suk"frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      </section>
      <!-- Conatct -->
      <div class="contact">
         <div class="contact-form">
            <!-- FORM  -->
               <div class="row">
                  <div class="col-md-8">
                     <!-- Payment information -->
                     <div class="heading">
                        <h2>Dou You have a Question for Us ?</h2>
                     </div>
                     <ul class="row">
                     <form role="form" id="contact_form" class="contact-form" action="{{ route('user.contact') }}" method="post">
                     @csrf
                        <li class="col-sm-6">
                           <label>First Name
                           <input type="text" class="form-control" name="name" id="name" placeholder="">
                           </label>
                        </li>
                        <li class="col-sm-6">
                           <label>Last Name
                           <input type="text" class="form-control" name="email" id="email" placeholder="">
                           </label>
                        </li>
                        <li class="col-sm-12">
                           <label>Message
                           <textarea type="text" class="form-control" name="message" id="message" placeholder=""></textarea>
                           </label>
                        </li>
                        <li class="col-sm-12 no-margin">
                           <button type="submit" value="submit" class="btn-round" id="btn_submit">Send Message</button>
                        </li>
                     </form>
                     </ul>
                  </div>
                  <!-- Conatct Infomation -->
                  <div class="col-md-4">
                     <div class="contact-info">
                        <h5>Vape Underground</h5>
                        <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> -->
                        <hr>
                        <h6> Address:</h6>
                        <p>61 Chatsworth Rd, London, E5 0LH</p>
                        <h6>Phone:</h6>
                        <p> +44 795 043 3838</p>
                        <h6>Email:</h6>
                        <p>sales@vapeunderground.co.uk</p>
                     </div>
                  </div>
               </div>
         </div>
      </div>
   </div>
</section>
@endsection