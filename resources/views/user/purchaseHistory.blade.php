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
                                <li><a href="{{ route('purchase.history') }}" class="active"><i class="fa fa-file-text"></i>Purchase History</a></li>
                                <li><a href="{{ route('wishlist') }}"><i class="fa fa-gratipay"></i>Wishlist</a></li>
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
                              @php $tmpId = 0; @endphp
                              <!-- /.card-header -->
                              <div class="card-body table-responsive p-0" style="height: 400px;">
                                 <table class="table table-head-fixed">
                                    <thead>
                                       <tr>
                                          <th style="width: 10%">Invoice</th>
                                          <th style="width: 10%">Name</th>
                                          <th style="width: 10%">Quantity</th>
                                          <th style="width: 25%">Price</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach(auth()->user()->orders as $order)
                                       @php
                                          $invoice = \App\Models\Payment::find($order->invoice_id);
                                       @endphp
                                          <tr>
                                             <td>
                                                @if($tmpId != $invoice->id)
                                                   <a href="{{ route('user.show.invoice',$invoice->id) }}" target="_blank">Invoice</a>
                                                @endif
                                             </td>
                                             @php $tmpId = $invoice->id; @endphp
                                             <td>{{$order->name}}</td>
                                             <td>{{$order->quantity}}</td>
                                             <td>{{$order->price}}</td>
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
@endsection