@extends('layouts.app')
@section('breadcrum')
<div class="linking">
   <div class="container">
      <ol class="breadcrumb">
         <li><a href="{{ route('home') }}">Home</a></li>
         <li class="active">Error</li>
      </ol>
   </div>
</div>
@endsection
@section('content')

<div id="content"> 
    
    <!-- Error Page -->
    <section>
      <div class="container">
        <div class="order-success error-page"> <img src="images/error-img.jpg" alt="">
          <h3>Error <span>404</span> Not Found</h3>
          <p>We’re sorry but the page you are looking for does nor exist.<br>
            You could return to <a href="#.">homepage</a> or using <a href="#.">search!</a></p>
        </div>
      </div>
    </section>
    
    <!-- Clients img -->
    <section class="light-gry-bg clients-img">
      <div class="container">
        <ul>
          <li><img src="images/c-img-1.png" alt=""></li>
          <li><img src="images/c-img-2.png" alt=""></li>
          <li><img src="images/c-img-3.png" alt=""></li>
          <li><img src="images/c-img-4.png" alt=""></li>
          <li><img src="images/c-img-5.png" alt=""></li>
        </ul>
      </div>
    </section>
  </div>
@endsection