@extends('layouts.app')
@section('content')
    <!-- Content -->
    <div id="content">  
    <!-- Oder-success -->
    <section>
      <div class="container"> 
        <!-- Payout Method -->
        <div class="order-success"> <i class="fa fa-check"></i>
          <h6>Congratulation! Your order has been processed</h6>
          <p>Invoice Has Been Sent To Your Registered Email Id</p>
          <a href="{{ route('home') }}" class="btn-round">Return to Shop</a> </div>
      </div>
    </section>
  </div>
  <!-- End Content --> 
@endsection