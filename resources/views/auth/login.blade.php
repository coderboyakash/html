@extends('layouts.app')
@section('nav_bar')
  @foreach($products as $product)
    <li class="dropdown megamenu">
      <a href="index-2.html" class="dropdown-toggle" data-toggle="dropdown">{{ ucfirst($product->type) }}</a>
      <div class="dropdown-menu animated-2s fadeInUpHalf">
        <div class="mega-inside">
            <div class="row">
              @foreach($product->types as $type)
                <div class="col-sm-3">
                    <h6>{{ ucfirst($type->name) }}</h6>
                    <ul>
                    @foreach($type->brands as $brand)
                      <li><a href="#">{{ ucfirst($brand->name) }}</a></li>
                    @endforeach
                    </ul>
                </div>
              @endforeach
              <div class="col-sm-4"> <img class="nav-img" src="{{ asset('public/images/item-img-1-8.jpg') }}" alt="" > </div>
            </div>
        </div>
      </div>
    </li>
  @endforeach
@endsection
@section('content')
<section class="login-sec padding-top-30 padding-bottom-100">
      <div class="container">
        <div class="row">
          <div class="col-md-6"> 
            <!-- Login Your Account -->
            <h5>Login Your Account</h5>
            <!-- FORM -->
            <form method="POST" action="{{ route('login') }}">
            @csrf
              <ul class="row">
                <li class="col-sm-12">
                  <label>Username
                    <input type="text" class="form-control" name="username" placeholder="">
                  </label>
                </li>
                <li class="col-sm-12">
                  <label>Password
                    <input type="password" class="form-control" name="password" placeholder="">
                  </label>
                </li>
                <li class="col-sm-6">
                  <div class="checkbox checkbox-primary">
                    <input id="cate1" class="styled" type="checkbox" >
                    <label for="cate1"> Keep me logged in </label>
                  </div>
                </li>
                <li class="col-sm-6"> <a href="#" class="forget">Forgot your password?</a> </li>
                <li class="col-sm-12 text-left">
                  <button type="submit" class="btn-round">Login</button>
                </li>
              </ul>
            </form>
          </div>
          
          <!-- Don’t have an Account? Register now -->
          <div class="col-md-6">
            <h5>Don’t have an Account? Register now</h5>
            
            <!-- FORM -->
            <form method="POST" action="{{ route('register') }}">
            @csrf
              <ul class="row">
                <li class="col-sm-12">
                  <label>Username
                    <input type="text" class="form-control" name="username" placeholder="">
                  </label>
                </li>
                <li class="col-sm-12">
                  <label>Email
                    <input type="email" class="form-control" name="email" placeholder="">
                  </label>
                </li>
                <li class="col-sm-12">
                  <label>Password
                    <input type="password" class="form-control" name="password" placeholder="">
                  </label>
                </li>
                <li class="col-sm-12">
                  <label>Confirm Password
                    <input type="password" class="form-control" name="password_confirmation" placeholder="">
                  </label>
                </li>
                <li class="col-sm-12 text-left">
                  <button type="submit" class="btn-round">Register</button>
                </li>
              </ul>
            </form>
          </div>
        </div>
      </div>
    </section>
@endsection

