@foreach($items as $item)
@if($item->price < $max && $item->price > $min)
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
         @if($item->sale)
         <span class="sale-tag">Sale</span>
         @endif
         <!-- Content --> 
         <span class="tag">{{ mb_strimwidth($item->brand->name,0,14,"...") }}</span> 
   <a href="{{ route( 'show.product', ['product'=>$product_url,'brand'=>$brand_url,'slug'=>$slug, 'id'=>$item->id] ) }}" target="_blank" class="tittle">{{ mb_strimwidth($item->name,0,14,"...") }}</a> 
   <!-- Reviews -->
   <form action="{{ route('addtocart') }}" method="POST" class="addToCart">
   @csrf
   <input type="hidden" name="item_id" value="{{ $item->id }}">
   <input type="hidden" name="quantity" value="1">
   <button type="submit" class="cart-btn" style="border:none; outline:none;"><i class="fa fa-shopping-cart"></i></button>
   </form>
   <div class="price">£{{$item->price}}</div>
   </article></a>
</div>
@endif
@endforeach