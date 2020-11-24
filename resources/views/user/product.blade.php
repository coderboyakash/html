@extends('layouts.app')
@section('stylesheets')
@endsection
@section('breadcrum')
<!-- Linking -->
@php 
   $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $item->brand->name))))), '-')); 
   $product_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $item->brand->type->product->name))))), '-'));
@endphp
<div class="linking">
   <div class="container">
      <ol class="breadcrumb">
         <li><a href="{{ route('home') }}">Home</a></li>
         <li><a href="{{ route('show.products', ['slug'=>$slug, 'product'=>$product_url, 'id'=>$item->brand->id] ) }}">{{ $item->brand->name }}</a></li>
         <li>{{ $item->name }}</li>
      </ol>
   </div>
</div>
@endsection
@section('content')
<!-- Products -->
<section class="padding-top-40 padding-bottom-60">
   <div class="container">
      <div class="row">
         <!-- Products -->
         <div class="col-md-1">
         </div>
         <div class="col-md-10">
            <div class="product-detail">
               <div class="product">
                  <div class="row">
                     <!-- Slider Thumb -->
                     <div class="col-xs-5">
                        <article class="slider-item on-nav">
                           <div id="slider" class="flexslider">
                              <ul class="slides">
                                 @isset($item->images)
                                 @foreach($item->images as $image)
                                 <li>
                                    <img src="{{ asset('public/'.$image->path) }}" alt="">
                                 </li>
                                 @endforeach
                                 @endisset
                              </ul>
                           </div>
                           <div id="carousel" class="flexslider">
                              <ul class="slides">
                                 @isset($item->images)
                                 @foreach($item->images as $image)
                                 <li>
                                    <img src="{{ asset('public/'.$image->path) }}" alt="">
                                 </li>
                                 @endforeach
                                 @endisset
                              </ul>
                           </div>
                        </article>
                     </div>
                     <!-- Item Content -->
                     <div class="col-xs-7">
                        <div style="font-size:1.9rem; color:brown;">{{ getProductPriceRange($item->id) }}</div>
                        <!-- <span class="tags">{{ $item->brand->type->name }}</span> -->
                        <h5>{{ $item->name }}</h5>
                        <!-- Reviews -->
                        @php
                        $stars = 0;
                        $star = 0;
                        foreach($item->reviews as $review){
                        $stars += $review->review;
                        }
                        if(count($item->reviews) >= 1){
                        $star = $stars/(count($item->reviews));
                        }
                        @endphp
                        <!--<p class="rev"> -->
                        <!--   @for($i = 5; $i > 0; $i--)-->
                        <!--   @if($star >= 1)-->
                        <!--   <span class="fa fa-star"></span>-->
                        <!--   @else-->
                        <!--   <span class="fa fa-star-o"></span>-->
                        <!--   @endif-->
                        <!--   @php $star--; @endphp-->
                        <!--   @endfor-->
                        <!--   <span class="margin-left-10">{{count($item->reviews)}} reviews(s)</span>-->
                        <!--</p>-->
                        <div class="row">
                           <div class="col-sm-6"><span class="price" id="main_price">
                           £{{ $item->sale ? $item->price-(($item->sale*$item->price)/100) : $item->price }} </span></div>
                        </div>
                        <!-- List Details -->
                        <ul class="bullet-round-list">
                           @foreach($item->specifications as $spec)
                           <li>{{$spec->key}}: {{$spec->value}}</li>
                           @endforeach
                        </ul>
                        <!-- Colors -->
                        <div class="row">
                           <div class="col-xs-5">
                              <!-- <div class="clr"> -->
                              <!-- <div class="col-sm-6"> -->
                              @if($item->quantity > 0)
                              <p>Availability: <span class="in-stock">In stock</span></p>
                              @else
                              <p>Availability: <span class="in-stock">Out of stock</span></p>
                              @endif
                           <!-- </div> -->
                              <!-- </div> -->
                           </div>
                           <!-- Sizes -->
                           
                        </div>
                        <div class="row">
                            <div class="col-xs-5">
                              <form action="{{ route('addtocart') }}" method="POST" class="addToCart wishListForm">
                                 <div class="variants">
                                    @if($item->variants != '[]')
                                    <select name="variant_id" id="variant_id" style="padding:7px 3px 7px 3px; border:none; outline:none;">
                                       <option value="0">Base Variant</option>
                                       @foreach($item->variants as $variant)
                                          <option value="{{$variant->id}}">{{$variant->name}}</option>
                                       @endforeach
                                    </select>
                                    @endif
                                 </div>
                           </div>
                            
                        </div>
                        <!-- Compare Wishlist -->
                        <ul class="cmp-list">
                        <button type="button" style="border:none; outline:none; background:none" class="wishListBtn"><i class="fa fa-heart"></i> Add to Wishlist</button>
                        </ul>
                        <!-- Quinty -->
                        <div class="quinty">
                        <input type="number" value="01" name="quantity">
                        </div>
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <br><br><br>
                        <div class="product-button2">
                        <button type="submit" class="btn-round" style="border:none; outline:none;"><i class="icon-basket-loaded margin-right-5"></i> Add to Cart</button>
                        </div>
                        <div class="product-button2">
                        <!-- <button type="submit" class="btn-round btn-diffcolor" style="border:none; outline:none;"><i class="icon-basket-loaded margin-right-5"></i> Buy It Now</button> -->
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
               <!-- Details Tab Section-->
               <div class="item-tabs-sec">
                  <!-- Nav tabs -->
                  <ul class="nav" role="tablist">
                     <li role="presentation" class="active"><a href="#pro-detil"  role="tab" data-toggle="tab">Product Details</a></li>
                     <!--<li role="presentation"><a href="#cus-rev"  role="tab" data-toggle="tab">Customer Reviews</a></li>-->
                     <!-- <li role="presentation"><a href="#ship" role="tab" data-toggle="tab">Shipping & Payment</a></li> -->
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                     <div role="tabpanel" class="tab-pane fade in active" id="pro-detil">
                        <!-- List Details -->
                        {!! $item->description !!}
                     </div>
                     <div role="tabpanel" class="tab-pane fade" id="cus-rev"></div>
                     <div role="tabpanel" class="tab-pane fade" id="ship"></div>
                  </div>
               </div>
            </div>
            <!-- Related Products -->
            <section class="padding-top-30 padding-bottom-0">
               <!-- heading -->
               <div class="heading">
                  <h2>Related Products</h2>
                  <hr>
               </div>
               <!-- Items Slider -->
               <div class="item-slide-4 with-nav">
                  <!-- Product -->
                  @foreach($item->brand->items as $item)
                  <div class="product">
                     @php $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $item->name))))), '-'));
                     $product_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $item->brand->type->product->name))))), '-')); 
                  $brand_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $item->brand->name))))), '-'));
                  @endphp
                     <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$item->id] ) }}" target="_blank">
                        <article>
                           <img class="img-responsive"
                           @if($item->image)
                           src="{{ asset('public/'.$item->image->path) }}"
                           @else
                           src="{{ asset('public/images/c9IMm01AZr734CJ1nLZ8C5LT6Pm2IJUP0Q9mHxip.png') }}"
                           @endif
                           alt="" > 
                           @if($item->sale > 0)
                        <span class="sale-tag">-{{$item->sale}}%</span>
                        @endif
                           <!-- Content --> 
                           <span class="tag">{{ $item->brand->type->name }}</span> 
                     <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$item->id] ) }}" target="_blank" class="tittle">{{ mb_strimwidth($item->name,0,25,"...") }}</a> 
                     <!-- Reviews -->
                     <form action="{{ route('addtocart') }}" method="POST" class="addToCart">
                     @csrf
                     <input type="hidden" name="item_id" value="{{ $item->id }}">
                     <input type="hidden" name="variant_id" value="{{ $item->variant_id }}">
                     <input type="hidden" name="quantity" value="1">
                     <button type="submit" class="cart-btn" style="border:none; outline:none;"><i class="fa fa-shopping-cart"></i></button>
                     </form>
                     <div class="price">£{{$item->price}}</div>
                     </article></a>
                  </div>
                  @endforeach
               </div>
            </section>
         </div>
      </div>
   </div>
   <!-- container end -->
</section>

@endsection
@section('scripts')
<script>
   document.querySelectorAll('.addToCart').forEach(item => {
     item.addEventListener('submit', event => {
       event.preventDefault();
       url = event.target.getAttribute('action');
       let formdata = new FormData(event.target);
       $.ajax({
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type:'POST',
       url:url,
       data: formdata,
       contentType: false,
       processData: false,
       success:function(response) {
     toastr.success('Item Added To Cart')
       setTimeout(function() {
        location.reload();
       }, 1000)
   },
   error:function(response) {
    toastr.success('Please Login First')
   }
     });
     }) 
   })
   document.querySelectorAll('.addToWishList').forEach(item => {
     item.addEventListener('submit', event => {
       event.preventDefault();
       url = event.target.getAttribute('action');
       let formdata = new FormData(event.target);
       $.ajax({
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type:'POST',
       url:url,
       data: formdata,
       contentType: false,
       processData: false,
       success:function(response) {
         toastr.success('Item Added To Wishlist')
       }
     });
     }) 
   })
   document.querySelector('.wishListBtn').addEventListener('click', function(event) {
     form = document.querySelector('.wishListForm')
     let formdata = new FormData(form);
     $.ajax({
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type:'POST',
       url:"{{ route('addToWishList') }}",
       data: formdata,
       contentType: false,
       processData: false,
       success:function(response) {
         toastr.success('Item Added To Wishlist')
       }
     });
   })
</script>

<script>
   document.getElementById("variant_id").addEventListener("change", function(event) {
      console.log('called');
      let variant_id = this.options[this.selectedIndex].value;
      if(variant_id == 0) {
         location.reload();
      }
      $.ajax({
         type: "GET",
         url:"{{ route('get.product.variant.price') }}",
         data: {id: variant_id},
         success: function(data) {
            document.getElementById('main_price').innerHTML = '£'+data;
         }
      })
   })
</script>
@endsection