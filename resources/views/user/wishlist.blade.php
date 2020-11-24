@extends('layouts.app')
@section('breadcrum')
<div class="linking">
   <div class="container">
      <ol class="breadcrumb">
         <li><a href="{{ route('home') }}">Home</a></li>
         <li class="active">Contact</li>
      </ol>
   </div>
</div>
@endsection
@section('content')
<div class="dash-account">
            <div class="container">
               <div class="dashacc-innr">
                  <div class="row">
                     <div class="col-md-3">
                        <div class="dside-menu">
                           <div class="sidemenu-top">
                              <div class="pro-img">
                        <img style="width:123px;" src="{{ asset('public/images/user_icon.png') }}" class="img-responsive"/>
                              </div>
                            <h1>{{auth()->user()->username}}</h1>
                           </div>
                           <div class="sidemenu-bottom">
                              <ul>
                                <li><a href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i>Dashboard</a></li>
                                <li><a href="{{ route('purchase.history') }}"><i class="fa fa-file-text"></i>Purchase History</a></li>
                                <li><a href="{{ route('wishlist') }}" class="active"><i class="fa fa-gratipay"></i>Wishlist</a></li>
                                <li><a href="{{ route('edit.profile') }}"><i class="fa fa-user"></i>Manage Profile</a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-9">
                        <div class="order-card">
                           <div class="card">
                              <div class="card-header">
                                 <h3 class="card-title">Orders List</h3>
                                 <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 215px;">
                                       <!-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search"> -->
                                       <div class="input-group-append">
                                          <!-- <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button> -->
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body table-responsive p-0" style="height: 400px;">
                                 <table class="table table-head-fixed">
                                    <thead>
                                       <tr>
                                          <th style="width: 50%">ITEM</th>
                                          <th style="width: 10%">PRICE</th>
                                          <th style="width: 15%">QUANTITY</th>
                                          <th style="width: 20%">TOTAL PRICE</th>
                                          <th style="width: 20%">Action</th>
                                          <th style="width: 5%"></th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(auth()->user()->wishlists as $wishlist)
                                        @php
                                       if($wishlist->color_id != null){
                                       $tmpItem = \App\Models\ItemColor::find($wishlist->color_id);
                                       $name = $wishlist->item->name.' '.$tmpItem->name;
                                       $price = $tmpItem->price;
                                       }else if($wishlist->size_id != null){
                                       $tmpItem = \App\Models\ItemSize::find($wishlist->size_id);
                                       $name = $wishlist->item->name.' '.$tmpItem->name;
                                       $price = $tmpItem->price;
                                       }else if($wishlist->flavour_id != null){
                                       $tmpItem = \App\Models\ItemFlavour::find($wishlist->flavour_id);
                                       $name = $wishlist->item->name.' '.$tmpItem->name;
                                       $price = $tmpItem->price;
                                       }else if($wishlist->strength_id != null){
                                       $tmpItem = \App\Models\ItemStrength::find($wishlist->strength_id);
                                       $name = $wishlist->item->name.' '.$tmpItem->name;
                                       $price = $tmpItem->price;
                                       }else{
                                       $name = $wishlist->item->name;
                                       $price = $wishlist->item->price;
                                       }
                                       @endphp
                                       <tr>
                                          <td>
                                             <div class="media">
                                                <div class="media-left" style="width: 25%"> <a href="#."> <img class="img-responsive" src="{{asset('public/'.$wishlist->item->image->path)}}" alt=""> </a> </div>
                                                <div class="media-body">
                                                   <p>
                                                       {{$wishlist->item->name}}
                                                   </p>
                                                </div>
                                             </div>
                                          </td>
                                          <td>£{{ $price }}</td>
                                          <td>
                                             <!-- <div class="quinty padding-top-20"> -->
                                                 <p>{{$wishlist->quantity}}</p>
                                                <!-- <input type="number" value="02"> -->
                                             <!-- </div> -->
                                          </td>
                                          <td>£{{ $price * $wishlist->quantity }}</td>
                                          <td><a href="javascript:void(0);">Cart</a></td>
                                          <td><a href="javascript:void(0);" class="remove" onclick="removeFromWisthList({{ $wishlist->id }})"><i class="fa fa-close" onclick="removeFromWisthList({{ $wishlist->id }})"></i></a></td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                              <!-- /.card-body -->
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <script>
            function removeFromWisthList(id){
               $.ajax({
                  type:'GET',
                  url:"{{ route('remove.from.wishlist') }}",
                  data:{id:id},
                  success:function(data) {
                     location.reload();
                  }
               })
            }
         </script>
@endsection