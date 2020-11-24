@extends('layouts.app')
@section('content')
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
            <li class="col-sm-3 current">
               <div class="media-left"> <i class="flaticon-delivery-truck"></i> </div>
               <div class="media-body">
                  <span>Step 2</span>
                  <h6>Delivery Methods</h6>
               </div>
            </li>
            <!-- Step 3 -->
            <li class="col-sm-3 ">
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
                  <!-- Your information -->
                  <div class="heading">
                     <h2>Your information</h2>
                     <hr>
                     <input type="radio" id="address_radio" name="address_radio" value="male"> Use Default Address
                  </div>
                  <div class="row">
                     <form action="{{ route('payment.method') }}" method="POST">
                        @csrf
                        <!-- Name -->
                        <div class="col-sm-6">
                           <label> First name
                           <input name="fname" class="form-control" type="text" value="{{ old('fname') }}" id="del_fname">
                           @error('fname')
                           <span class="invalid-feedback" role="alert">
                           <strong style="color:red;">Please Enter Your First Name</strong>
                           </span>
                           @enderror
                           </label>
                        </div>
                        <!-- Number -->
                        <div class="col-sm-6">
                           <label> Last Name
                           <input name="lname" class="form-control" type="text" value="{{ old('lname') }}" id="del_lname">
                           @error('lname')
                           <span class="invalid-feedback" role="alert">
                           <strong style="color:red;">Please Enter Your Last Name</strong>
                           </span>
                           @enderror
                           </label>
                        </div>
                        <!-- Card Number -->
                        @php $countries = \App\Models\Country::all(); @endphp
                        <div class="col-sm-7">
                           <div class="row">
                              <div class="col-xs-6">
                                 <label> Country </label>
                                 <select name="country" style="padding:5px 7px 5px 7px; width:100%;" value="{{ old('country') }}" id="del_country">
                                 <option value="">Choose Country</option>
                                 @foreach($countries as $country)
                                    <option value="{{$country->id}}"> {{$country->country_name}}</option>
                                 @endforeach
                                 </select>
                                 @error('country')
                                 <span class="invalid-feedback" role="alert">
                                 <strong style="color:red;">Please Select Your Country</strong>
                                 </span>
                                 @enderror
                              </div>
                              <div class="col-xs-6">
                                 <label> City </label>
                                 <select name="city" style="padding:5px 7px 5px 7px; width:100%;" value="{{ old('city') }}" id="del_city">
                                 </select>
                                 @error('city')
                                 <span class="invalid-feedback" role="alert">
                                 <strong style="color:red;">Please Select Your City</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-5">
                           <label> State
                           <input name="state" class="form-control" type="text" value="{{ old('state') }}" id="del_state">
                           </label>
                           @error('state')
                           <span class="invalid-feedback" role="alert">
                           <strong style="color:red;">Please Enter Your State</strong>
                           </span>
                           @enderror
                        </div>
                        <!-- Zip code -->
                        <div class="col-sm-4">
                           <label> Zip code
                           <input name="zip_code" class="form-control" type="text" value="{{ old('zip_code') }}" id="del_zipcode">
                           </label>
                           @error('zip_code')
                           <span class="invalid-feedback" role="alert">
                           <strong style="color:red;">Please Enter Your Zip Code</strong>
                           </span>
                           @enderror
                        </div>
                        <!-- Address -->
                        <div class="col-sm-8">
                           <label> Address
                           <input name="address" class="form-control" type="text" value="{{ old('address') }}" id="del_address">
                           </label>
                           @error('address')
                           <span class="invalid-feedback" role="alert">
                           <strong style="color:red;">Please Enter Your Address</strong>
                           </span>
                           @enderror
                        </div>
                        <!-- Phone -->
                        <div class="col-sm-6">
                           <label> Phone
                           <input name="phone" class="form-control" type="text" value="{{ old('phone') }}" id="del_phone">
                           </label>
                           @error('phone')
                           <span class="invalid-feedback" role="alert">
                           <strong style="color:red;">Please Enter Your Phone No</strong>
                           </span>
                           @enderror
                        </div>
                        <!-- Number -->
                        <div class="col-sm-6">
                           <label> Email
                           <input name="email" class="form-control" type="email" value="{{ old('email') }}" id="del_email">
                           </label>
                           @error('email')
                           <span class="invalid-feedback" role="alert">
                           <strong style="color:red;">{{$message}}</strong>
                           </span>
                           @enderror
                        </div>
                  </div>
               </div>
               <!-- Select Your Transportation -->
               <div class="col-md-6">
               <div class="heading">
               <h2>Select Your Transportation</h2>
               <hr>
               </div>
               <div class="transportation" id="checkboxes">
               <div class="row">
               @foreach($deliveryProcesses as $deliveryProcess)
               <div class="col-sm-6 delProc">
               <div class="charges" data-delId="{{ $deliveryProcess->id }}">
               <h6 data-delId="{{ $deliveryProcess->id }}">{{ $deliveryProcess->title }}</h6>
               <br>
               <span data-delId="{{ $deliveryProcess->id }}"> {{ $deliveryProcess->day_range }}</span> <span data-delId="{{ $deliveryProcess->id }}" class="deli-charges"> +£{{ $deliveryProcess->charge }} </span> </div>
               </div>
               @endforeach
               </div>
               @error('del_type_id')
               <span class="invalid-feedback" role="alert">
               <strong style="color:red;">Choose the Delivery Process</strong>
               </span>
               @enderror
               </div>
               </div>
            </div>
         </div>
         <!-- Button -->
         <input type="hidden" id="del_type_id" name="del_type_id"  value="{{ old('del_type_id') }}">
         <div class="pro-btn"> <a href="#." class="btn-round btn-light">Back to Payment</a> <input type="submit" class="btn-round" value="Go Payment Methods"></div>
         </form>
      </div>
   </section>
</div>
<!-- End Content --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
   document.querySelectorAll('.charges').forEach(item => {
     item.addEventListener('click', event => {
       delId = event.target.getAttribute('data-delId')
       console.log(delId)
       document.getElementById("del_type_id").value = delId;
     })
   })
   document.querySelectorAll('.delProc').forEach(item => {
     item.addEventListener('click', event => {
       event.target.classList.toggle('select');
     })
   })
   $(document).ready(function() {
     $('.charges').click(function() {
         $('.charges.select').removeClass("select");
         $(this).addClass("select");
     });
   });
</script>

<script>
   $(document).ready(function(){
      $("input[type='radio']").click(function(){
         var radioValue = $("input[name='address_radio']:checked").val();
         if(radioValue){
            email = "{{auth()->user()->email}}"
            city = "{{auth()->user()->city}}"
            address = "{{auth()->user()->address}}"
            country = "{{auth()->user()->country}}"
            postal_code = "{{auth()->user()->postal_code}}"
            phone = "{{auth()->user()->phone}}"
            state = "{{auth()->user()->provison}}"
            tmp1 = `<option value="${city}" selected>${city}</option>`;
            tmp2 = `<option value="${country}" selected>${country}</option>`;
            $("#del_city").prepend(tmp1);
            $("#del_country").prepend(tmp2);
            document.getElementById("del_address").value = address; 
            document.getElementById("del_zipcode").value = postal_code; 
            document.getElementById("del_email").value = email; 
            document.getElementById("del_phone").value = phone; 
            document.getElementById("del_state").value = state; 
         }
      });
   });
</script>

<script>
document.getElementById('del_country').addEventListener('change', function(e){
    let country_id = this.options[this.selectedIndex].value;
    let url = "{{ route('get.cities') }}";
    $.ajax({
      type:'GET',
      url:url,
      data: {country_id: country_id},
      success:function(data) {
        $("#del_city").html(data);
      }
    });
  })
</script>
@endsection