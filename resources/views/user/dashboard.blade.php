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
                        <li><a href="{{ route('dashboard') }}" class="active"><i class="fa fa-tachometer"></i>Dashboard</a></li>
                        <li><a href="{{ route('purchase.history') }}"><i class="fa fa-file-text"></i>Purchase History</a></li>
                                <li><a href="{{ route('wishlist') }}"><i class="fa fa-gratipay"></i>Wishlist</a></li>
                        <li><a href="{{ route('edit.profile') }}"><i class="fa fa-user"></i>Manage Profile</a></li>
                            </ul>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-9">
                    <div class="page-sections">
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                <div class="inner">
                                    <p>Purchase<br> History</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <a href="{{ route('purchase.history') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                <div class="inner">
                                    <p>Wishlist<br> Items</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-clipboard"></i>
                                </div>
                                <a href="{{ route('wishlist') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                <div class="inner">
                                    <p>Users<br> Profile</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <a href="{{ route('edit.profile') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        </div>
                    </div>
                    <div class="personal-detailbox">
                        <div class="form-box bg-white mt-4">
                            <div class="form-box-title px-3 py-2 clearfix ">
                                Saved Shipping Info
                                <div class="float-right">
                                <a href="{{route('edit.profile')}}" class="btn btn-link btn-sm">Edit</a>
                                </div>
                            </div>
                            <div class="form-box-content p-3">
                                <table>
                                <tbody>
                                    <tr>
                                        <td>Address:	&nbsp;	&nbsp;	&nbsp;</td>
                                        <td class="p-2">{{ auth()->user()->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Country:	&nbsp;	&nbsp;	&nbsp;</td>
                                        <td class="p-2">
                                            {{auth()->user()->country}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>City:	&nbsp;	&nbsp;	&nbsp;</td>
                                        <td class="p-2">
                                            {{auth()->user()->city}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Postal Code:	&nbsp;	&nbsp;	&nbsp;</td>
                                        <td class="p-2">
                                            {{auth()->user()->postal_code}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Phone:	&nbsp;	&nbsp;	&nbsp;</td>
                                        <td class="p-2">
                                            {{auth()->user()->phone}}
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection