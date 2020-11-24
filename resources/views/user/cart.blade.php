@extends('layouts.app')
@section('content')
<style>
 @media (max-width: 780px){
 .table {
 overflow:scroll;
 display:block;
 }
 }
</style>
<!-- Content -->
<div id="content">
   @php $total = 0; @endphp
   <!-- Ship Process -->
   <div class="ship-process padding-top-30 padding-bottom-30">
      <div class="container">
         <ul class="row">
            <!-- Step 1 -->
            <li class="col-sm-3 current">
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
            <li class="col-sm-3">
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
   <!-- Shopping Cart -->
      @if(auth()->user()->carts != '[]')
   <section class="shopping-cart padding-bottom-60">
      <div class="container">
         <table class="table">
            <thead>
               <tr>
                  <th>Items</th>
                  <th class="text-center">Price</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-center">Total Price </th>
                  <th>&nbsp; </th>
               </tr>
            </thead>
            <tbody>
               <!-- Item Cart -->
               @if(auth()->user())
               @foreach(auth()->user()->carts as $cart)
               <tr>
                  <td>
                     <div class="media">
                        @php 
                        $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $cart->item->name))))), '-'));
                        $product_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $cart->item->brand->type->product->name))))), '-')); 
                  $brand_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $cart->item->brand->name))))), '-')); 
                        @endphp
                        <div class="media-left"> <a href="{{ route('show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$cart->item->id] ) }}" target="_blank"> <img class="img-responsive" style="top:0px;" src="{{ asset('public/'.$cart->item->image->path) }}" alt="" > </a> </div>
                        <div class="media-body">
                           <p>{{$cart->item->name}}</p>
                        </div>
                     </div>
                  </td>
                  @php
                  if($cart->variant_id != null){
                  $tmpItem = \App\Models\ItemVariant::find($cart->variant_id);
                  $name = $cart->item->name.' '.$tmpItem->name;
                  $price = $tmpItem->price;
                  }else{
                  $name = $cart->item->name;
                  $price = $cart->item->price;
                  }
                  @endphp
                  <td class="text-center padding-top-60">£{{ $price }}</td>
                  <td class="text-center">
                     <!-- Quantity -->
                     <div class="quinty padding-top-20">
                        <input type="number" value="{{ $cart->quantity }}" class="changeCartItemQuantity" data-cartId="{{ $cart->id }}"
                     </div>
                  </td>
                  <td class="text-center padding-top-60">£{{ $price * $cart->quantity }}</td>
                  @php $total += $price * $cart->quantity; @endphp
                  <td class="text-center padding-top-60"><a href="javascript:void(0);" data-cartId="{{ $cart->id }}" class="remove removeFromCart"><i class="fa fa-close"></i></a></td>
               </tr>
               @endforeach
               @endif
            </tbody>
         </table>
         <!-- Promotion -->
         <div class="promo">
            <div class="coupen">
               <label> Promotion Code
               <input type="text" placeholder="Your code here">
               <button type="submit"><i class="fa fa-arrow-circle-right"></i></button>
               </label>
            </div>
            <!-- Grand total -->
            <div class="g-totel">
               <h5>Grand total: <span>£{{ $total }}</span></h5>
            </div>
         </div>
         <!-- Button -->
         <div class="pro-btn"> <a href="{{ route('home') }}" class="btn-round btn-light">Continue Shopping</a> <a href="{{ route('delivery.methods') }}" class="btn-round">Go Delivery Methods</a> </div>
      </div>
   </section>
   
   @else
      <h2 style="text-align:center">No Item Added</h2>
   @endif
</div>
<!-- End Content --> 
<script>
   document.querySelectorAll('.removeFromCart').forEach(item => {
     item.addEventListener('click', event => {
       cartId = item.getAttribute('data-cartId')
       $.ajax({
         type:'GET',
         url:"{{ route('remove.from.cart') }}",
         data:{id:cartId},
         success:function(data) {
           location.reload();
         }
       })
     })
   })
   document.querySelectorAll('.changeCartItemQuantity').forEach(item => {
     item.addEventListener('change', event => {
       cartId = item.getAttribute('data-cartId')
       quantity = item.value;
       $.ajax({
         type:'GET',
         url:"{{ route('change.cart.item.quantity') }}",
         data:{id:cartId, quantity:quantity},
         success:function(data) {
           location.reload();
         }
       })
     })
   })
</script>
@endsection