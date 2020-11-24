@extends('layouts.app')

@section('breadcrum')
   <!-- Linking -->
   <div class="linking">
      <div class="container">
         <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">Home</a></li>
            @php $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $brand->name))))), '-')); 
            $product_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $brand->type->product->name))))), '-'));
            @endphp
            <li><a href="{{ route('show.products', ['slug'=>$slug, 'product'=>$product_url, 'id'=>$brand->id] ) }}">{{ $brand->name }}</a></li>
            <li class="active">{{ $brand->name }}</li>
         </ol>
      </div>
   </div>
@endsection
@section('content')
<!-- Products -->
<section class="padding-top-40 padding-bottom-60">
   <div class="container">
      <div class="row">
         <!-- Shop Side Bar -->
         <div class="col-md-3">
            <div class="shop-side-bar">
               <!-- Categories -->
               @if($brand->type->product->only_product->is_exsits == 0)
                   <h6 id="brand_name">{{ $brand->type->product->name }} <h6>
                   <div class="checkbox checkbox-primary">
                      <ul id="item_type_checkboxes">
                         <form action="{{ route('get.filtered.products') }}" id="filter" method="POST">
                            @csrf
                            @foreach($brand->type->product->types as $type)
                               @foreach($type->brands as $brand)
                                  @if($brand->id == $check_id || $check_id == 0)
                                     <li class="type_box">
                                        <input id="{{ $brand->id }}" class="styled" type="checkbox" name="{{ $brand->id }}" checked>
                                        <label for="{{ $brand->id }}"> {{ $brand->name }} </label>
                                     </li>
                                  @else
                                     <li class="type_box">
                                        <input id="{{ $brand->id }}" class="styled" type="checkbox" name="{{ $brand->id }}">
                                        <label for="{{ $brand->id }}"> {{ $brand->name }} </label>
                                     </li>
                                  @endif
                               @endforeach
                            @endforeach
                            <input type="hidden" value="{{ $type_id }}" name="type_id_for_filter">
                            <input type="submit" id="filtersubmit" style="display:none">
                         </form>
                      </ul>
                   </div>
                 @else
                 <h6 id="brand_name">{{ $brand->type->product->name }} <h6>
                   <div class="checkbox checkbox-primary" style="display:none;">
                      <ul id="item_type_checkboxes">
                         <form action="{{ route('get.filtered.products') }}" id="filter" method="POST">
                            @csrf
                            @foreach($brand->type->product->types as $type)
                               @foreach($type->brands as $brand)
                                  @if($brand->id == $check_id || $check_id == 0)
                                     <li class="type_box">
                                        <input id="{{ $brand->id }}" class="styled" type="checkbox" name="{{ $brand->id }}" checked>
                                        <label for="{{ $brand->id }}"> {{ $brand->name }} </label>
                                     </li>
                                  @else
                                     <li class="type_box">
                                        <input id="{{ $brand->id }}" class="styled" type="checkbox" name="{{ $brand->id }}">
                                        <label for="{{ $brand->id }}"> {{ $brand->name }} </label>
                                     </li>
                                  @endif
                               @endforeach
                            @endforeach
                            <input type="hidden" value="{{ $type_id }}" name="type_id_for_filter">
                            <input type="submit" id="filtersubmit" style="display:none">
                         </form>
                      </ul>
                   </div>
                 @endif
               <!-- Categories -->
               <h6>Price</h6>
               <!-- PRICE -->
               <div class="cost-price-content">
                  <div id="price-range" class="price-range"></div>
                  <span id="price-min" class="price-min">20</span> 
                  <span id="price-max" class="price-max">80</span> 
                  <a href="javascript:void(0);" class="btn-round" id="price_filter_btn" >Filter</a> 
               </div>
               
               <!-- Colors -->
               <!-- <h6>Size</h6>
                  <div class="sizes"> <a href="#.">S</a> <a href="#.">M</a> <a href="#.">L</a> <a href="#.">XL</a> </div> -->
               <!-- Colors -->
               <!-- <h6>Colors</h6> -->
               <!-- <div class="checkbox checkbox-primary">
                  <ul>
                    <li>
                      <input id="colr1" class="styled" type="checkbox" >
                      <label for="colr1"> Red <span>(217)</span> </label>
                    </li>
                    <li>
                      <input id="colr2" class="styled" type="checkbox" >
                      <label for="colr2"> Yellow <span> (179) </span> </label>
                    </li>
                    <li>
                      <input id="colr3" class="styled" type="checkbox" >
                      <label for="colr3"> Black <span>(79)</span> </label>
                    </li>
                    <li>
                      <input id="colr4" class="styled" type="checkbox" >
                      <label for="colr4">Blue <span>(283) </span></label>
                    </li>
                    <li>
                      <input id="colr5" class="styled" type="checkbox" >
                      <label for="colr5"> Grey <span> (116)</span> </label>
                    </li>
                    <li>
                      <input id="colr6" class="styled" type="checkbox" >
                      <label for="colr6"> Pink<span> (29) </span></label>
                    </li>
                    <li>
                      <input id="colr7" class="styled" type="checkbox" >
                      <label for="colr7"> White <span> (38)</span> </label>
                    </li>
                    <li>
                      <input id="colr8" class="styled" type="checkbox" >
                      <label for="colr8">Green <span>(205)</span></label>
                    </li>
                  </ul>
                  </div> -->
            </div>
         </div>
         <!-- Products -->
         <div class="col-md-9">
            <!-- Short List -->
            <div class="short-lst">
               <h2></h2>
               <ul>
                  <!-- Short List -->
                  <!-- <li>
                     <p>Showing 1–12 of results</p>
                     </li> -->
                  <!-- Short  -->
                  <!-- <li >
                     <select class="selectpicker">
                       <option>Show 12 </option>
                       <option>Show 24 </option>
                       <option>Show 32 </option>
                     </select>
                     </li> -->
                  <!-- by Default -->
                  <!-- <li>
                     <select class="selectpicker">
                       <option>Sort by Default </option>
                       <option>Sort by Default </option>
                       <option>Sort by Default</option>
                     </select>
                     </li> -->
                  <!-- Grid Layer -->
                  <!-- <li class="grid-layer"> <a href="#."><i class="fa fa-list margin-right-10"></i></a> <a href="#."><i class="fa fa-th"></i></a> </li> -->
               </ul>
            </div>
            <!-- Items -->
            <div class="col-list" id="col-list">
               @if($items)
               @foreach($items as $item)
               <div class="product col-sm-4">
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
                        <span class="tag">{{ mb_strimwidth($item->name,0,10,"...") }}</span> 
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
                  </article>
                  </a>
               </div>
               @endforeach
               @endif
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Your Recently Viewed Items -->
<section class="padding-bottom-60">
   <div class="container">
      <!-- heading -->
      <div class="heading">
         <h2>Related Items</h2>
         <hr>
      </div>
      <!-- Items Slider -->
      <div class="item-slide-5 with-nav">
         @foreach($brand->type->product->types as $type)
         @if($type->items)
         @foreach($type->items as $item)
         <div class="product">
                  @php $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $item->name))))), '-'));
                  $product_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $item->brand->type->product->name))))), '-')); 
                  $brand_url = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $item->brand->name))))), '-'));
                  @endphp
                  <a href="{{ route( 'show.product', ['slug'=>$slug, 'type'=>$type_url, 'id'=>$brand->id] ) }}" target="_blank">
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
                  <span class="tag">{{$item->name}}</span> 
            <a href="{{ route( 'show.product', ['slug'=>$slug, 'type'=>$type_url, 'id'=>$brand->id] ) }}" target="_blank" class="tittle">{{ mb_strimwidth($item->name,0,25,"...") }}</a> 
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
         @endif
         @endforeach
      </div>
   </div>
</section>
@endsection
@section('scripts')
<script>
   document.getElementById('price_filter_btn').addEventListener('click', function(){
     setTimeout(function(){
     console.log('running')
     $('#col-list').fadeOut();
     let url = document.getElementById('filter').getAttribute('action');
     let method = document.getElementById('filter').getAttribute('method');
     let form = document.getElementById('filter');
     let min = document.getElementById('price-min').innerHTML
     let max = document.getElementById('price-max').innerHTML
     console.log('min', min)
     console.log('max', max)
     let formdata = new FormData(form);
     formdata.append('min',min);
     formdata.append('max',max);
     $.ajax({
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type:method,
       url:url,
       data: formdata,
       contentType: false,
       processData: false,
       success:function(response) {
         $('#col-list').html('')
         $('#col-list').html(response)
         $('#col-list').fadeIn();
       }
     });
   }, 500);
   })
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
   $('#item_type_checkboxes').mouseup(function(){
      console.log('clicked')
      $('#col-list').fadeOut();
      setTimeout(function(){
      let url = document.getElementById('filter').getAttribute('action');
      let min = document.getElementById('price-min').innerHTML
      let max = document.getElementById('price-max').innerHTML
      let method = document.getElementById('filter').getAttribute('method');
      let form = document.getElementById('filter');
      let formdata = new FormData(form);
      formdata.append('min',min);
      formdata.append('max',max);
      $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         type:method,
         url:url,
         data: formdata,
         contentType: false,
         processData: false,
         success:function(response) {
            console.log(response)
            $('#col-list').html('')
            $('#col-list').html(response)
            $('#col-list').fadeIn();
         }
      });
      }, 500);
   })
</script>
<script>
   $('#featuredBrand').mouseup(function(){
     $('#col-list').fadeOut();
     $('#col-list').html('');
     $('#item_type_checkboxes').fadeOut();
     $('#item_type_checkboxes').html('');
     setTimeout(function(){
     let url = document.getElementById('featuredBrand').getAttribute('action');
     let method = document.getElementById('featuredBrand').getAttribute('method');
     let form = document.getElementById('featuredBrand');
     let formdata = new FormData(form);
     $.ajax({
       headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type:method,
       url:url,
       data: formdata,
       contentType: false,
       processData: false,
       success:function(response) {
          $('#col-list').html('')
          $('#col-list').html(response)
          $('#col-list').fadeIn();
       }
     });
     $.ajax({
       headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type:method,
       url:'{{ route("get.filtered.itemtype") }}',
       data: formdata,
       contentType: false,
       processData: false,
       success:function(response) {
          $('#item_type_checkboxes').html(response)
          $('#item_type_checkboxes').fadeIn();
       }
    });
   }, 500);
   })
</script>
<script>
   jQuery(document).ready(function($) {
   
     //  Price Filter ( noUiSlider Plugin)
       $("#price-range").noUiSlider({
       range: {
         'min': [ 0 ],
         'max': [ 1000 ]
       },
       start: [40, 940],
           connect:true,
           serialization:{
               lower: [
           $.Link({
             target: $("#price-min")
           })
         ],
         upper: [
           $.Link({
             target: $("#price-max")
           })
         ],
         format: {
         // Set formatting
           decimals: 2,
           prefix: ''
         }
           }
     })
   })
   
</script>
@endsection