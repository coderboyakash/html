@extends('layouts.app')
@section('slider')
<link rel="stylesheet" href="{{ asset('public/css/card.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
<section class="slid-sec">
   <div class="banner-area">
   <div class="slider">
      <div class="owl-carousel owl-theme">
         @foreach($banners as $banner)
         <div class="item">
            <img src="{{ asset('/public/'.$banner->path) }}" alt="images not found">
         </div>
         @endforeach 
      </div>
   </div>
</section>
@endsection
@section('content')
<div class="image-blocks">
   <div class="container">
      <div class="blocks-inr">
         @foreach($smallbanners as $smallbanner)
         @if($smallbanner->layout_id == 1)
         @php 
         $links = explode(",",$smallbanner->link);
         $paths = explode(",",$smallbanner->path);
         @endphp
         <!--<div class="width100">-->
         <!--   <div class="full-widthb">-->
         <!--       <div class="width20 marginr10 mblock">-->
         <!--        <div class="full-widthb">-->
         <!--           <a href="{{ $links[0] }}"><img src="{{ asset('public/'.$paths[0]) }}" class="img-responsive"/></a>-->
         <!--        </div>-->
         <!--       </div>-->
         <!--       <div class="width60 marginr10">-->
         <!--        <div class="full-widthb">-->
         <!--           <a href="{{ $links[1] }}"><img src="{{ asset('public/'.$paths[1]) }}" class="img-responsive"/></a>-->
         <!--        </div>-->
         <!--       </div>-->
         <!--       <div class="width60 marginr10 dblock">-->
         <!--        <div class="full-widthb">-->
         <!--           <a href="{{ $links[1] }}"><img src="{{ asset('public/'.$paths[1]) }}" class="img-responsive"/></a>-->
         <!--        </div>-->
         <!--       </div>-->
         <!--       <div class="width20">-->
         <!--        <div class="full-widthb">-->
         <!--           <a href="{{ $links[2] }}"><img src="{{ asset('public/'.$paths[2]) }}" class="img-responsive"/></a>-->
         <!--        </div>-->
         <!--       </div>-->
         <div class="width100 serveBanner">
            <div class="full-widthb">
               <div class="width60 marginr10 mblock" style="padding-right:18px;">
                  <div class="full-widthb">
                     <a href="{{ $links[1] }}"><img src="{{ asset('public/'.$paths[1]) }}" class="img-responsive"></a>
                  </div>
               </div>
               <div class="width20 marginr10">
                  <div class="full-widthb">
                     <a href="{{ $links[0] }}"><img src="{{ asset('public/'.$paths[0]) }}" class="img-responsive"></a>
                  </div>
               </div>
               <div class="width60 marginr10 dblock">
                  <div class="full-widthb">
                     <a href="{{ $links[1] }}"><img src="{{ asset('public/'.$paths[1]) }}" class="img-responsive"></a>
                  </div>
               </div>
               <div class="width20">
                  <div class="full-widthb">
                     <a href="{{ $links[2] }}"><img src="{{ asset('public/'.$paths[2]) }}" class="img-responsive"></a>
                  </div>
               </div>
            </div>
         </div>
         <!--<div class="width20 marginr10">-->
         <!--      <a href="{{ $links[0] }}"><img src="{{ asset('public/'.$paths[0]) }}" class="img-responsive"/></a>-->
         <!--   </div>-->
         <!--</div>-->
         <!--<div class="width60 marginr10">-->
         <!--   <div class="full-widthb">-->
         <!--      <a href="{{ $links[1] }}"><img src="{{ asset('public/'.$paths[1]) }}" class="img-responsive"/></a>-->
         <!--   </div>-->
         <!--</div>-->
         <!--<div class="width20">-->
         <!--   <div class="full-widthb">-->
         <!--      <a href="{{ $links[2] }}"><img src="{{ asset('public/'.$paths[2]) }}" class="img-responsive"/></a>-->
         <!--   </div>-->
         <!--    </div>-->
         <!--</div>-->
         @elseif($smallbanner->layout_id == 2)
         @php 
         $links = explode(",",$smallbanner->link);
         $paths = explode(",",$smallbanner->path);
         @endphp
         <div class="width60 marginr10">
            <div class="full-widthb">
               <a href="{{ $links[0] }}"><img src="{{ asset('public/'.$paths[0]) }}" class="img-responsive"/></a>
            </div>
         </div>
         <div class="width20 marginr10">
            <div class="full-widthb">
               <a href="{{ $links[1] }}"><img src="{{ asset('public/'.$paths[1]) }}" class="img-responsive"/></a>
            </div>
         </div>
         <div class="width20">
            <div class="full-widthb">
               <a href="{{ $links[2] }}"><img src="{{ asset('public/'.$paths[2]) }}" class="img-responsive"/></a>
            </div>
         </div>
         @elseif($smallbanner->layout_id == 3)
         @php 
         $links = explode(",",$smallbanner->link);
         $paths = explode(",",$smallbanner->path);
         @endphp
         <div class="width20 marginr10">
            <div class="full-widthb">
               <a href="{{ $links[0] }}"><img src="{{ asset('public/'.$paths[0]) }}" class="img-responsive"/></a>
            </div>
         </div>
         <div class="width20 marginr10">
            <div class="full-widthb">
               <a href="{{ $links[1] }}"><img src="{{ asset('public/'.$paths[1]) }}" class="img-responsive"/></a>
            </div>
         </div>
         <div class="width60">
            <div class="full-widthb">
               <a href="{{ $links[2] }}"><img src="{{ asset('public/'.$paths[2]) }}" class="img-responsive"/></a>
            </div>
         </div>
         @endif
         @endforeach
      </div>
   </div>
</div>
<section id="service">
   <div class="container">
      <div class="row">
         @foreach($servicebanners as $servicebanner)
         <a href="{{ $servicebanner->link }}">
            <div class="col-md-6 col-lg-4 col-sm-12">
               <div class="single_service hvr-curl-top-right">
                  <div class="single_service-left">
                     <div class="icon">
                        <img src="{{ asset('public/'.$servicebanner->image_path) }}" class="img-responsive"/>
                     </div>
                  </div>
                  <div class="single_service-body">
                     <h4 class="single_service-heading">{{ $servicebanner->title }}</h4>
                     <p>{{ $servicebanner->body }}</p>
                  </div>
               </div>
            </div>
         </a>
         @endforeach
      </div>
   </div>
</section>
<!-- tab Section -->
<section class="featur-tabs padding-top-60 padding-bottom-60">
   <div class="container">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs nav-pills margin-bottom-10" role="tablist">
         <li role="presentation" class="active"><a href="#featur" aria-controls="featur" role="tab" data-toggle="tab">Featured</a></li>
         <li role="presentation"><a href="#special" aria-controls="special" role="tab" data-toggle="tab">Special</a></li>
         <li role="presentation"><a href="#on-sal" aria-controls="on-sal" role="tab" data-toggle="tab">Onsale</a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content tabfea">
         <!-- Featured -->
         <div role="tabpanel" class="tab-pane active fade in" id="featur">
            <!-- Items Slider -->
            <div class="item-slide-5 with-nav">
               <!-- Product -->
               @foreach($tab_items as $tab_item)
               @if($tab_item->featured_arrival != null)
               <div class="product">
                  @php 
                  $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->name))))), '-')); 
                  $product_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->brand->type->product->name))))), '-')); 
                  $brand_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->brand->name))))), '-')); 
                  @endphp
                  <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$tab_item->id] ) }}" target="_blank">
                     <article>
                        <img class="img-responsive"
                        @if($tab_item->image)
                        src="{{ asset('public/'.$tab_item->image->path) }}"
                        @else
                        src="{{ asset('public/images/c9IMm01AZr734CJ1nLZ8C5LT6Pm2IJUP0Q9mHxip.png') }}"
                        @endif
                        alt="" >  
                        @if($tab_item->sale > 0)
                        <span class="sale-tag">-{{$tab_item->sale}}%</span>
                        @endif
                        <!-- Content --> 
                        <span class="tag">{{ mb_strimwidth($tab_item->brand->name,0,14,"...") }}</span> <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$tab_item->id] ) }} target="_blank"" class="tittle">{{ mb_strimwidth($tab_item->name,0,14,"...") }}
                  </a>
                  <!-- Reviews -->
                  <form action="{{ route('addtocart') }}" method="POST" class="addToCart">
                  @csrf
                  <input type="hidden" name="item_id" value="{{ $tab_item->id }}">
                  <input type="hidden" name="quantity" value="1">
                  <input type="hidden" name="variant_id" value="{{ $tab_item->variant_id }}">
                  <button type="submit" class="cart-btn" style="border:none; outline:none;"><i class="fa fa-shopping-cart"></i></button>
                  </form>
                  <div class="price">£{{ $tab_item->sale ? $tab_item->price-(($tab_item->sale*$tab_item->price)/100) : $tab_item->price }}</div>
                  </article></a>
               </div>
               @endif
               @endforeach
            </div>
         </div>
         <!-- Special -->
         <div role="tabpanel" class="tab-pane fade" id="special">
            <!-- Items Slider -->
            <div class="item-col-5">
               @foreach($tab_items as $tab_item)
               @if($tab_item->special_arrival != null)
               <div class="product">
                  @php $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->name))))), '-'));
                  $product_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->brand->type->product->name))))), '-')); 
                  $brand_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->brand->name))))), '-')); @endphp
                  <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$tab_item->id] ) }}" target="_blank">
                     <article>
                        <img class="img-responsive"
                        @if($tab_item->image)
                        src="{{ asset('public/'.$tab_item->image->path) }}"
                        @else
                        src="{{ asset('public/images/c9IMm01AZr734CJ1nLZ8C5LT6Pm2IJUP0Q9mHxip.png') }}"
                        @endif
                        alt="" > 
                        @if($tab_item->sale > 0)
                        <span class="sale-tag">-{{$tab_item->sale}}%</span>
                        @endif
                        <!-- Content --> 
                        <span class="tag">{{ mb_strimwidth($tab_item->brand->name,0,14,"...") }}</span> 
                  <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$tab_item->id] ) }}" target="_blank" class="tittle">{{ mb_strimwidth($tab_item->name,0,14,"...") }}</a> 
                  <!-- Reviews -->
                  <form action="{{ route('addtocart') }}" method="POST" class="addToCart">
                  @csrf
                  <input type="hidden" name="item_id" value="{{ $tab_item->id }}">
                  <input type="hidden" name="quantity" value="1">
                  <input type="hidden" name="variant_id" value="{{ $tab_item->variant_id }}">
                  <button type="submit" class="cart-btn" style="border:none; outline:none;"><i class="fa fa-shopping-cart"></i></button>
                  </form>
                  <div class="price">£{{ $tab_item->sale ? $tab_item->price-(($tab_item->sale*$tab_item->price)/100) : $tab_item->price }}</div>
                  </article></a>
               </div>
               @endif
               @endforeach
            </div>
         </div>
         <!-- on sale -->
         <div role="tabpanel" class="tab-pane fade" id="on-sal">
            <!-- Items Slider -->
            <div class="item-col-5">
               <!-- Product -->
               @foreach($tab_items as $tab_item)
               @if($tab_item->sale != 0 || $tab_item->sale != null)
               <div class="product">
                  @php $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->name))))), '-'));
                  $product_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->brand->type->product->name))))), '-')); 
                  $brand_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->brand->name))))), '-'));
                  @endphp
                  <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$tab_item->id] ) }}" target="_blank">
                     <article>
                        <img class="img-responsive"
                        @if($tab_item->image)
                        src="{{ asset('public/'.$tab_item->image->path) }}"
                        @else
                        src="{{ asset('public/images/c9IMm01AZr734CJ1nLZ8C5LT6Pm2IJUP0Q9mHxip.png') }}"
                        @endif
                        alt="" > 
                        @if($tab_item->sale > 0)
                        <span class="sale-tag">-{{$tab_item->sale}}%</span>
                        @endif
                        <!-- Content --> 
                        <span class="tag"></span> 
                  <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$tab_item->id] ) }}" target="_blank" class="tittle">{{ mb_strimwidth($tab_item->name,0,14,"...") }}</a> 
                  <!-- Reviews -->
                  <form action="{{ route('addtocart') }}" method="POST" class="addToCart">
                  @csrf
                  <input type="hidden" name="item_id" value="{{ $tab_item->id }}">
                  <input type="hidden" name="quantity" value="1">
                  <input type="hidden" name="variant_id" value="{{ $tab_item->variant_id }}">
                  <button type="submit" class="cart-btn" style="border:none; outline:none;"><i class="fa fa-shopping-cart"></i></button>
                  </form>
                  <div class="price">£{{ $tab_item->sale ? $tab_item->price-(($tab_item->sale*$tab_item->price)/100) : $tab_item->price }}</div>
                  </article></a>
               </div>
               @endif
               @endforeach
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Top Selling Week -->
<section class="light-gry-bg padding-top-60 padding-bottom-30">
   <div class="container">
      <!-- heading -->
      <div class="heading">
         <h2>Top Selling of the Week</h2>
         <hr>
      </div>
      <!-- Items -->
      <div class="item-col-5">
         <!-- Product -->
         <div class="product col-2x mdis-none">
           <div class="like-bnr">
              <div class="position-center-center">
              </div>
           </div>
         </div>
         <!-- Product -->
         @foreach($tab_items as $tab_item)
         @if($tab_item->top_selling_week != null)
         <div class="product">
            @php $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->name))))), '-')); 
            $product_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->brand->type->product->name))))), '-')); 
            $brand_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->brand->name))))), '-'));
            @endphp
            <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$tab_item->id] ) }}" target="_blank">
               <article>
                  <img class="img-responsive"
                  @if($tab_item->image)
                  src="{{ asset('public/'.$tab_item->image->path) }}"
                  @else
                  src="{{ asset('public/images/c9IMm01AZr734CJ1nLZ8C5LT6Pm2IJUP0Q9mHxip.png') }}"
                  @endif
                  alt="" > 
                  @if($tab_item->sale > 0)
                        <span class="sale-tag">-{{$tab_item->sale}}%</span>
                        @endif
                  <!-- Content --> 
                  <span class="tag">{{ mb_strimwidth($tab_item->brand->name,0,14,"...") }}</span> 
            <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$tab_item->id] ) }}" target="_blank" class="tittle">{{ mb_strimwidth($tab_item->name,0,14,"...") }}</a> 
            <!-- Reviews -->
            <form action="{{ route('addtocart') }}" method="POST" class="addToCart">
            @csrf
            <input type="hidden" name="item_id" value="{{ $tab_item->id }}">
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="variant_id" value="{{ $tab_item->variant_id }}">
            <button type="submit" class="cart-btn" style="border:none; outline:none;"><i class="fa fa-shopping-cart"></i></button>
            </form>
            <div class="price">£{{ $tab_item->sale ? $tab_item->price-(($tab_item->sale*$tab_item->price)/100) : $tab_item->price }}</div>
            </article></a>
         </div>
         @endif
         @endforeach
      </div>
   </div>
</section>
<div class="sideban-area">
   <div class="container">
      <div class="sideban-inr">
         <div class="heading">
            <h2>Top Selling of the Month</h2>
            <hr>
         </div>
         <div class="row">
            <div class="col-md-3 col-lg-3 col-sm-12">
               <div class="sideban-one">
                  <img src="{{ asset('public/frontend/images/sideban1.jpg') }}" class="img-responsive"/>
               </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
               <div class="sideban-prod">
                  <div class="row">
                     @php $i = 3; @endphp
                     @foreach($tab_items as $tab_item)
                     @if($tab_item->top_selling_month != null && $i != 0)
                     <div class="col-md-4 col-lg-4 col-sm-12 padding5px">
                        <div class="product">
                           @php $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->name))))), '-'));
                           $product_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->brand->type->product->name))))), '-')); 
                           $brand_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->brand->name))))), '-'));
                           @endphp
                           <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$tab_item->id] ) }}" target="_blank">
                              <article>
                                 <img class="img-responsive"
                                 @if($tab_item->image)
                                 src="{{ asset('public/'.$tab_item->image->path) }}"
                                 @else
                                 src="{{ asset('public/images/c9IMm01AZr734CJ1nLZ8C5LT6Pm2IJUP0Q9mHxip.png') }}"
                                 @endif
                                 alt="" > 
                                 @if($tab_item->sale > 0)
                        <span class="sale-tag">-{{$tab_item->sale}}%</span>
                        @endif
                                 <!-- Content --> 
                                 <span class="tag">{{ mb_strimwidth($tab_item->brand->name,0,14,"...") }}</span> 
                           <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$tab_item->id] ) }}" target="_blank" class="tittle">{{ mb_strimwidth($tab_item->name,0,14,"...") }}</a> 
                           <!-- Reviews -->
                           <form action="{{ route('addtocart') }}" method="POST" class="addToCart">
                           @csrf
                           <input type="hidden" name="item_id" value="{{ $tab_item->id }}">
                           <input type="hidden" name="quantity" value="1">
                           <input type="hidden" name="variant_id" value="{{ $tab_item->variant_id }}">
                           <button type="submit" class="cart-btn" style="border:none; outline:none;"><i class="fa fa-shopping-cart"></i></button>
                           </form>
                           <div class="price">£{{ $tab_item->sale ? $tab_item->price-(($tab_item->sale*$tab_item->price)/100) : $tab_item->price }}</div>
                           </article></a>
                        </div>
                     </div>
                     @php $i--; @endphp
                     @endif
                     @endforeach
                  </div>
                  <div class="row" style="margin-top:1rem;">
                     @foreach($tsm as $tab_item)
                     <div class="col-md-4 col-lg-4 col-sm-12 padding5px">
                        <div class="product">
                           @php $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->item->name))))), '-'));
                           $product_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->item->brand->type->product->name))))), '-')); 
                           $brand_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $tab_item->item->brand->name))))), '-'));
                           @endphp
                           <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$tab_item->item->id] ) }}" target="_blank">
                              <article>
                                 <img class="img-responsive"
                                 @if($tab_item->item->image)
                                 src="{{ asset('public/'.$tab_item->item->image->path) }}"
                                 @else
                                 src="{{ asset('public/images/c9IMm01AZr734CJ1nLZ8C5LT6Pm2IJUP0Q9mHxip.png') }}"
                                 @endif
                                 alt="" > 
                                 @if($tab_item->sale > 0)
                        <span class="sale-tag">-{{$tab_item->sale}}%</span>
                        @endif
                                 <!-- Content --> 
                                 <span class="tag">{{ mb_strimwidth($tab_item->item->brand->name,0,14,"...") }}</span> 
                           <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$tab_item->item->id] ) }}" target="_blank" class="tittle">{{ mb_strimwidth($tab_item->item->name,0,14,"...") }}</a> 
                           <!-- Reviews -->
                           <form action="{{ route('addtocart') }}" method="POST" class="addToCart">
                           @csrf
                           <input type="hidden" name="item_id" value="{{ $tab_item->item->id }}">
                           <input type="hidden" name="quantity" value="1">
                           <input type="hidden" name="variant_id" value="{{ $tab_item->item->variant_id }}">
                           <input type="hidden" name="quantity" value="1">
                           <button type="submit" class="cart-btn" style="border:none; outline:none;"><i class="fa fa-shopping-cart"></i></button>
                           </form>
                           <div class="price">£{{ $tab_item->item->sale ? $tab_item->item->price-(($tab_item->item->sale*$tab_item->item->price)/100) : $tab_item->item->price }}</div>
                           </article></a>
                        </div>
                     </div>
                     @endforeach
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12 padding5px">
               <div class="sideban-one">
                  <img src="{{ asset('public/frontend/images/sideban2.jpg') }}" class="img-responsive"/>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@php $active = true; $i = 0; @endphp

<section class="main-tabs-sec padding-top-60 padding-bottom-0">
   <div class="container">
      <ul class="nav margin-bottom-40" role="tablist">
         @foreach($products as $product)
            @if($i <= 5)
               @php $i++; @endphp
               <li role="presentation" class="{{ $active ? 'active' : '' }}">
                  <a href="#{{ str_replace('/', '',(str_replace('-','',(str_replace(' ', '',$product->name))))) }}" aria-controls="featur" role="tab" data-toggle="tab">
                     <img src="{{ asset('public/'.$product->icon_path) }}" style="width:25px;" class="img-responsive" class="img-responsive"/> 
                     <p>{{$product->name}}</p>
                     @php $c = 0; @endphp
                     @foreach($product->types as $type)
                     @foreach($type->brands as $brand)
                     @foreach($brand->items as $item)
                     @php $c += 1; @endphp
                     @endforeach
                     @endforeach
                     @endforeach
                     <span>{{$c}} (items)</span>
                  </a>
               </li>
               @php $active = false; @endphp
            @endif
         @endforeach
      </ul>
      <!-- Tab panes -->
      @php $active = true; $i = 0; $j = 0; @endphp
      <div class="tab-content">
         <!-- TV & Audios -->
         @foreach($products as $product)
            @if($i <= 5)
         <div role="tabpanel" class="{{ $active ? 'tab-pane active fade in' : 'tab-pane fade' }}" id="{{ str_replace('/', '',(str_replace('-','',(str_replace(' ', '',$product->name))))) }}">
            <!-- Items -->
            @if($active == true)
                <div class="item-slide-5 with-bullet no-nav">
            @else
                <div class="item-col-5">
            @endif
            @php $active = false; @endphp
               @foreach($product->types as $type)
                  @foreach($type->brands as $brand)
                     @foreach($brand->items as $item)
                     @if($j <= 4)
                     @php $j++ @endphp
                     <div class="product">
                     @php $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $item->name))))), '-')); 
                     $product_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $item->brand->type->product->name))))), '-')); 
                     $brand_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $item->brand->name))))), '-'));
                     @endphp
                        <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$item->id] ) }}" target="_blank"><article>
                           <img class="img-responsive"  @if($item->image)
                              src="{{ asset('public/'.$item->image->path) }}"
                              @else
                              src="{{ asset('public/images/c9IMm01AZr734CJ1nLZ8C5LT6Pm2IJUP0Q9mHxip.png') }}"
                              @endif
                              alt="" > 
                              @if($item->sale > 0)
                              <span class="sale-tag">-{{$item->sale}}%</span>
                              @endif 
                           <!-- Content --> 
                           <span class="tag">{{ mb_strimwidth($item->brand->name,0,14,"...") }}</span> <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$item->id] ) }}" target="_blank"" class="tittle">{{ mb_strimwidth($item->name,0,14,"...") }}</a> 
                           <!-- Reviews -->
                           <form action="{{ route('addtocart') }}" method="POST" class="addToCart">
                              @csrf
                              <input type="hidden" name="item_id" value="{{ $item->id }}">
                              <input type="hidden" name="quantity" value="1">
                              <input type="hidden" name="variant_id" value="{{ $item->variant_id }}">
                              <input type="hidden" name="quantity" value="1">
                              <button type="submit" class="cart-btn" style="border:none; outline:none;"><i class="fa fa-shopping-cart"></i></button>
                           </form>
                           <div class="price">£{{ $item->price }}</div>
                        </article></a>
                     </div>
                     @endif
                     @endforeach
                  @endforeach
               @endforeach
               @php $j = 0; @endphp
            </div>
         </div>
         @endif
         @endforeach
      </div>
   </div>
</section>
<!-- Top Selling Week -->
<!----------------------video-area---------------------------------------->
<div class="whowe-area">
<div class="container">
<div class="whowe-inr">
   <div class="row">
      <div class="col-md-6 no-padding">
         <div class="whowe-des">
            <h1>About Us</h1>
            <p> The Vape underground is committed to providing the latest in innovative vaping technology and high-quality e-liquid / e juice. 
               Vape underground supplies customers with premium vape products from all corners of the globe.   Vape underground have a Huge range of premium e-liquid  And High-End Mods very reasonable prices and offers. Large selection of Eliquids, Nic salts, and CBD Starter kits to professional kits Loads off pod kits All replacement coils, replacement glass, and parts.
            </p>
         </div>
      </div>
      <div class="col-md-6 no-padding">
         <div class="whowe-video">
            <img src="public/frontend/images/videoban.png" class="img-responsive"/>
            <a id="play-video" class="video-play-button" href="#">
            <span></span>
            </a>
            <div id="video-overlay" class="video-overlay">
               <a class="video-overlay-close">&times;</a>
            </div>
         </div>
      </div>
   </div>
</div>
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
</script>
<script>
   setTimeout(function() {
      document.querySelector(".banner-area .owl-prev").innerHTML = "<";
      document.querySelector(".banner-area .owl-next").innerHTML = ">";
   }, 500)
</script>
@endsection
