@extends('layouts.app')
@php
$products = \App\Models\Product::all();
$contactus = \App\Models\ContactUs::first();
@endphp
@section('breadcrum')
<div class="linking">
   <div class="container">
      <ol class="breadcrumb">
         <li><a href="{{ route('home') }}">Home</a></li>
         <li>Error</li>
      </ol>
   </div>
</div>
@endsection
@section('content')
<div id="content"> 
    
    <!-- Error Page -->
    <section>
      <div class="container">
        <div class="order-success error-page"> <img src="{{ asset('public/frontend/images/error-img.jpg') }}" alt="">
          <h3>Error <span>500</span> Not Found</h3>
          <p>We’re sorry but the page you are looking for does nor exist.<br>
            You could return to <a href="#.">homepage</a> or using <a href="#.">search!</a></p>
        </div>
      </div>
    </section>
    
    <!-- Clients img -->

  </div>
@endsection