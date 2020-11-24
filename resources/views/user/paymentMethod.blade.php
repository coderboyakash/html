@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('public/css/card.css') }}" />
<script src="https://js.stripe.com/v3/"></script>
<!-- Content -->
<div id="content">
   <!-- Ship Process -->
   <div class="ship-process padding-top-30 padding-bottom-30">
      <div class="container">
         <ul class="row">
            <!-- Step 1 -->
            <li class="col-sm-3">
               <div class="media-left"> <i class="flaticon-shopping"></i> </div>
               <div class="media-body">
                  <span>Step 1</span>
                  <h6>Shopping Cart</h6>
               </div>
            </li>
            <!-- Step 2 -->
            <li class="col-sm-3">
               <div class="media-left"> <i class="flaticon-delivery-truck"></i> </div>
               <div class="media-body">
                  <span>Step 2</span>
                  <h6>Delivery Methods</h6>
               </div>
            </li>
            <!-- Step 3 -->
            <li class="col-sm-3 current">
               <div class="media-left"> <i class="flaticon-business"></i> </div>
               <div class="media-body">
                  <span>Step 3</span>
                  <h6>Payment Methods</h6>
               </div>
            </li>
            <!-- Step 4 -->
            <li class="col-sm-3">
               <div class="media-left"> <i class="fa fa-check"></i> </div>
               <div class="media-body">
                  <span>Step 4</span>
                  <h6>Confirmation</h6>
               </div>
            </li>
         </ul>
      </div>
   </div>
   <!-- Payout Method -->
   <section class="padding-bottom-60">
      <div class="container">
         <!-- Payout Method -->
         <div class="pay-method">
            <div class="row">
               <div class="col-md-6">
                  <!-- Your Card -->
                  <div class="heading">
                     <h2>Your Card</h2>
                     <hr>
                  </div>
                  <img src="{{ asset('public/images/card-icon.png') }}" alt="" > 
               </div>
               <div class="col-md-6">
                  <!-- Your information -->
                  <div class="heading">
                     <h2>Your information</h2>
                     <hr>
                  </div>
                  <form action="{{ route('create-payment-card') }}" method="post" id="payment-form">
                     @csrf
                     <div class="form-row">
                        <label for="card-element">
                        Credit or debit card
                        </label>
                        <div id="card-element">
                           <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                     </div>
                     <input type="hidden" name="payment_id" value="{{ $payment_id }}">
                     <button class="btn-round">Submit Payment</button>
                  </form>
                  <form class="col-sm-5" action="{{ route('create-payment') }}" method="POST">
                     @csrf
                     <input type="hidden" name="payment_id" value="{{ $payment_id }}">
                     <div class="pro-btn">
                        <button type="submit" class="btn-round btn-light">Paypal Checkout</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="pro-btn">
            <a href="{{ route('show.cart') }}" class="btn-round btn-light">Back to Shopping Cart</a>
         </div>
         <!-- Button -->
      </div>
   </section>
</div>
<!-- End Content --> 
<script>
   var publishable_key = '{{ env('STRIPE_PUBLISHABLE_KEY') }}';
</script>
<script src="{{ asset('public/js/card.js') }}"></script>
@endsection