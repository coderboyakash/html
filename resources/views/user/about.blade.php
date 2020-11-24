@extends('layouts.app')
@section('breadcrum')
<div class="linking">
   <div class="container">
      <ol class="breadcrumb">
         <li><a href="{{ route('home') }}">Home</a></li>
         <li class="active">Aboutus</li>
      </ol>
   </div>
</div>
@endsection
@section('content')
<!-- About Sec -->
<section class="about-sec padding-top-60 padding-bottom-60">
   <div class="container">
      <!-- About Adds -->
      <div class="about-adds">
         <div class="position-center-center">
            <h2>Vape Underground<small>24/7 We support you online</small></h2>
            <a href="{{ route('home') }}" class="btn-round">Shop with Us</a> 
         </div>
      </div>
   </div>
</section>
<!-- Skills -->
<section class="skills padding-top-60">
   <div class="container">
      <!-- heading -->
      <div class="heading">
         <h2>24/7 We support you online</h2>
         <hr>
      </div>
      <div class="about-desc">
         <div class="row">
            <div class="col-md-6">
               <div class="about-text">
                  <p> Donec libero dolor, tincidunt id laoreet vitae,ullamcorper eu tortor. Maecenas pellentesque, vitae iaculis mattis, tortor nisi faucibus magna, vitae ultrices lacus purus vitae metus.Vestibulum velit nibh, egestas vel faucibus vitae, feugiat sollicitudin urna. Praesent iaculis ipsuim sit amet pretium. Aliquam tristique sapien.Donec libero dolor, tincidunt id laoreet vitae, ullamcorper eu tortor Mauris rhoncus aliquet purus, a ornare nisi euismod in. Interdum et malesuada fames ante ipsum primis in faucibus. Etiam imperdiet eu metus Doneclibero dolor, tincidunt id laoreet vitae, ullamci rper eu tortor maecenas.</p>
               </div>
            </div>
            <div class="col-md-6">
               <div class="About-img">
                  <img src="{{ asset('public/images/about.jpg') }}" class="img-responsive"> 
               </div>
            </div>
         </div>
         <div class="heading">
            <h2>What can we do for you?</h2>
            <hr>
         </div>
         <div class="row">
            <div class="col-md-6">
               <div class="About-img">
                  <img src="{{ asset('public/images/about-us-img-09.jpg') }}" class="img-responsive"> 
               </div>
            </div>
            <div class="col-md-6">
               <div class="about-text">
                  <p> There are many variations of passages of Lorem Ipsum available, humour, or randomised words which don’t look even slightly believable. embarrassing hidden in the middle of text.But I must explain to you how all this mistaken idea of Denouncing pleasure i and praising pain was born and I will give you a complete account.Vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?” eu tortor.At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatu deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non prov ident, similique sunt in culpa qui officia deserunt mollitia animi.</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Team -->
<section class="padding-top-60 padding-bottom-60">
   <div class="container">
      <!-- heading -->
      <!-- <div class="heading">
         <h2>Meet Our Team</h2>
         <hr> -->
   </div>
   <div class="team container">
      <div class="row">
         <div class="col-md-4">
            <img class="img-responsive" src="public/images/about-us-img-01.jpg" alt="">
            <!-- <h3>Tom Doe</h3> -->
            <span>It is a long established fact that reader will distracted readable content of a page when looking layout. The point using orem Ipsum is that it has a more-or-less distribution It is a long established fact that reader</span> 
         </div>
         <div class="col-md-4">
            <img class="img-responsive" src="public/images/about-us-img-02.jpg" alt="">
            <!-- <h3>Tom Doe</h3> -->
            <span>Contrary to popular belief, Lorem Ipsum not simply random text It has roots in a piece of classical Latin literature from 45 BC, making over 2000 years old. Richard McClintock.</span> 
         </div>
         <div class="col-md-4">
            <img class="img-responsive" src="public/images/about-us-img-03.jpg" alt="">
            <!-- <h3>Tom Doe</h3> -->
            <span>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto spiciatis unde omnis iste natus.</span> 
         </div>
      </div>
   </div>
</section>
@endsection