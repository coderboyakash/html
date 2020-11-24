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
                                <li><a href="{{ route('wishlist') }}"><i class="fa fa-gratipay"></i>Wishlist</a></li>
                        <li><a href="{{ route('edit.profile') }}" class="active"><i class="fa fa-user"></i>Manage Profile</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-9">
               <div class="userpro-tabs">
                  <div class="usertab-inr">
                     <div class="cycle-tab-container2">
                        <ul class="nav nav-tabs">
                           <li class="cycle-tab-item w-diff active">
                              <a class="nav-link" role="tab" data-toggle="tab" href="#home"><i class="fa fa-id-card"></i>PERSONAL DATA</a>
                           </li>
                           <li class="cycle-tab-item w-diff"> 
                              <a class="nav-link" role="tab" data-toggle="tab" href="#profile"><i class="fa fa-file-import"></i>PASSWORD</a>
                           </li>
                           <li class="cycle-tab-item w-diff">
                              <a class="nav-link" role="tab" data-toggle="tab" href="#messages"><i class="fa fa-passport"></i>SHIPPING INFO</a>
                           </li>
                        </ul>
                        <div class="tab-content">
                           <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                              <form action="{{ route('update.profile')}}" method="POST" >
                              @csrf
                                 <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                 <div class="col-md-6">
                                    <label for="password">Username</label>
                                    <input type="text" size="10" class="form-control" name="username" value="{{ auth()->user()->username }}" placeholder="Username" required autofocus />
                                 </div>
                                 <div class="col-md-6">
                                    <label for="password">Email Address</label>
                                    <input type="text" size="10" class="form-control" name="email"  value="{{ auth()->user()->email }}"required autofocus />
                                 </div>
                                 <a href="javascript:void(0);"><button type="submit">Update Profile</button></a>
                              </form>
                           </div>
                           <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                              <form action="{{ route('update.password') }}" method="POST">
                                 @csrf
                                 <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                 <div class="col-md-6">
                                    <label for="password">Old Password</label>
                                    <input type="password" size="10" class="form-control" name="oldpassword" placeholder="Old Password" required autofocus />
                                 </div>
                                 <div class="col-md-6">
                                    <label for="password">New Password</label>
                                    <input type="password" size="10" class="form-control" name="newpassword" placeholder="New Password" required autofocus />
                                 </div>
                                 <a href="javascript:void(0);"><button type="submit">Update Password</button></a>
                              </form>
                           </div>
                           <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                              <form action="{{ route('update.info') }}" method="POST">
                                 @csrf
                                 <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                              <div class="col-md-6">
                                 <label for="Address">Address</label>
                                 <input type="text" size="10" class="form-control" name="address" placeholder="Address" value="{{ auth()->user()->address }}" required autofocus />
                                 <label for="Country">Country</label>
                                 <select class="form-control" id="Country" name="country" >
                                    <option>India</option>
                                    <option>America</option>
                                    <option>Bangladesh</option>
                                    <option>Australia</option>
                                 </select>
                                 <label for="password">City</label>
                                 <input type="text" size="10" class="form-control" name="city" placeholder="City" value="{{ auth()->user()->city }}" required autofocus />
                              </div>
                              <div class="col-md-6">
                                 <label for="password">Mobile Number</label>
                                 <input type="text" size="10" class="form-control" name="phone" placeholder="Mobile Number" value="{{ auth()->user()->phone }}" required autofocus />
                                 <label for="State">State/Province</label>
                                 <select class="form-control" id="State" name="provison">
                                    <option>West Bengal</option>
                                    <option>Jharkhand</option>
                                    <option>Madhya Pradesh</option>
                                    <option>Bihar</option>
                                 </select>
                                 <label for="password">ZIP Code</label>
                                 <input type="text" size="10" class="form-control" name="postal_code" placeholder="123456" value="{{ auth()->user()->postal_code }}" required autofocus />
                              </div>
                              <a href="#"><button type="submit">Save Information</button></a>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection